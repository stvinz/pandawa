<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {
    
    public function getProduct(Request $request)
    {
        $query_list = $request->query();
        $searchQ = 'Showing all products';
        $res = DB::table('prod_mat')
            ->join('products', 'prod_mat.products_id', '=', 'products.id')
            ->join('materials', 'prod_mat.materials_id', '=', 'materials.id')
            ->join('categories', 'products.categories_id', '=', 'categories.id')
            ->select('prod_mat.id as id', 'prod_mat.extra as extra', 'products.img as img', 'products.name as name', 'products.desc as desc', 'materials.name as material', 'categories.name as category');

        if (array_key_exists('s', $query_list)) {
            $s = $request->query('s');
            
            if ($s != '') {
                // NEED TO CHECK PERFORMANCE
                /*
                // Multi-queries

                $prods = [];
                $sel = DB::table('materials')
                    ->whereRaw('MATCH(materials.name) AGAINST(? IN BOOLEAN MODE)', [$s])
                    ->join('prod_mat', 'prod_mat.materials_id', '=', 'materials.id')
                    ->select('prod_mat.products_id as id')
                    ->get();

                foreach ($sel as $row) {
                    array_push($prods, $row->id);
                }

                $sel = DB::table('prod_mat')
                    ->whereRaw('MATCH(extra) AGAINST(? IN BOOLEAN MODE)', [$s])
                    ->select('products_id as id')
                    ->get();
                
                foreach ($sel as $row) {
                    if (!in_array($row->id, $prods)) {
                        array_push($prods, $row->id);
                    }
                }

                $res = $res
                    ->addSelect(DB::raw("MATCH(products.name) AGAINST('".$s."') + MATCH(categories.name) AGAINST('".$s."') + MATCH(materials.name) AGAINST('".$s."') + MATCH(prod_mat.extra) AGAINST('".$s."') AS relevance"))
                    ->whereRaw(
                        'MATCH(products.name) AGAINST(? IN BOOLEAN MODE) OR
                        MATCH(categories.name) AGAINST(? IN BOOLEAN MODE)', [$s, $s]
                    )
                    ->orWhereIn('products.id', $prods)
                    ->orderBy('relevance', 'desc');
                */
                /*
                // Material Single-query
                // Seems buggy (value sometimes changes for the same query)
                ->whereIn('products.id', function($sel) use($s) {
                    $sel->from('materials')
                        ->whereRaw('MATCH(materials.name) AGAINST(? IN BOOLEAN MODE)', [$s])
                        ->join('prod_mat', 'prod_mat.materials_id', '=', 'materials.id')
                        ->select('prod_mat.products_id as id');
                })
                */

                $prods = [];
                $sel = DB::table('materials')
                    ->whereRaw('MATCH(materials.name) AGAINST(? IN BOOLEAN MODE)', [$s])
                    ->join('prod_mat', 'prod_mat.materials_id', '=', 'materials.id')
                    ->select('prod_mat.products_id as id')
                    ->get();

                foreach ($sel as $row) {
                    array_push($prods, $row->id);
                }

                $res = $res
                    ->whereIn('products.id', $prods)
                    ->orWhereIn('products.id', function($sel) use($s) {
                        $sel->select('prod_mat.products_id as id')
                            ->from('prod_mat')
                            ->whereRaw('MATCH(extra) AGAINST(? IN BOOLEAN MODE)', [$s]);
                    })
                    ->orWhereRaw(
                        'MATCH(products.name) AGAINST(? IN BOOLEAN MODE) OR
                        MATCH(categories.name) AGAINST(? IN BOOLEAN MODE)', [$s, $s]
                    )
                    ->addSelect(DB::raw("MATCH(products.name) AGAINST('".$s."') + MATCH(categories.name) AGAINST('".$s."') + MATCH(materials.name) AGAINST('".$s."') + MATCH(prod_mat.extra) AGAINST('".$s."') AS relevance"));

                
                $res = $res->orderBy('relevance', 'desc');
                
                $searchQ = 'You searched for '.$s;
            }
        }
        else {
            if (array_key_exists('m', $query_list)) {
                $res = $res->whereIn('products.id', function($sel) use($request) {
                    $sel->select('prod_mat.products_id as id')
                        ->from('materials')
                        ->where('materials.name', '=', $request->query('m'))
                        ->join('prod_mat', 'prod_mat.materials_id', '=', 'materials.id');
                });

                $searchQ = 'Showing "'.$request->query('m').'" products';
            }

            if (array_key_exists('c', $query_list)) {
                $res = $res->where('categories.name', '=', $request->query('c'));
            
                if (array_key_exists('m', $query_list)) {
                    $searchQ = $searchQ.' and "'.$request->query('c').'" products';
                }
                else {
                    $searchQ = 'Showing "'.$request->query('c').'" products';
                }
            }
        }

        // Sort options
        $sort_mod = "def";

        if (array_key_exists('o', $query_list)) {
            switch ($request->query('o')) {
                case "nasc":
                    $sort_mod = "nasc";
                    $res = $res->reorder('products.name', 'asc');
                    break;
                case "ndesc":
                    $sort_mod = "ndesc";
                    $res = $res->reorder('products.name', 'desc');
                    break;
            }
        }

        $res = $res->get();
        $total_items = 0;
        $arranged = [];

        foreach ($res as $row) {
            // Somehow need to encrypt id and decrypt id OR just echo name
            if (!array_key_exists($row->name, $arranged)) {
                $arranged[$row->name] = [
                    'id' => $row->id,
                    'desc' => $row->desc, 
                    'img' => $row->img, 
                    'category' => $row->category, 
                    'materials' => [[
                        'name' => $row->material, 
                        'extra' => $row->extra
                    ]]
                ];
                
                $total_items++;
            }
            else {
                array_push($arranged[$row->name]['materials'], ['name' => $row->material, 'extra' => $row->extra]);
            }
        }

        // Pagination
        $lim = 20;

        if (array_key_exists('p', $query_list)) {
            try {
                $p = (int) $request->query('p');
            }
            catch (Exception $e) {
                $p = 1;
            }
        }
        else {
            $p = 1;
        }

        $total_page = intdiv($total_items, $lim);

        if ($total_items % $lim > 0) {
            $total_page++;
        }

        if (($p <= 0) || ($p > $total_page)) {
            $p = 1;
        }

        $arranged = array_slice($arranged, $lim * ($p - 1), $lim);

        return View::make('pages.catalogue')->withProducts(json_encode($arranged))
            ->withSearchQ($searchQ)
            ->withPage($p)
            ->withTotalPage($total_page)
            ->withItemsPage($lim)
            ->withTotalItems($total_items)
            ->withSortMod($sort_mod);
    }
}