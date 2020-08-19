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

        $res = DB::table('prod_mat')
            ->join('products', 'prod_mat.products_id', '=', 'products.id')
            ->join('materials', 'prod_mat.materials_id', '=', 'materials.id')
            ->join('categories', 'products.categories_id', '=', 'categories.id')
            ->select('prod_mat.id as id', 'prod_mat.extra as extra', 'products.img as img', 'products.name as name', 'products.desc as desc', 'materials.name as material', 'categories.name as category');
        
        if (array_key_exists('s', $query_list)) {
            $s = $request->query('s');
            
            if ($s != '') {
                /*
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
                
                $res = $res
                ->addSelect(DB::raw("MATCH(products.name) AGAINST('".$s."') + MATCH(categories.name) AGAINST('".$s."') + MATCH(materials.name) AGAINST('".$s."') + MATCH(prod_mat.extra) AGAINST('".$s."') AS relevance"))
                ->whereIn('products.id', function($sel) use($s) {
                    $sel->select('prod_mat.products_id as id')
                        ->from('materials')
                        ->whereRaw('MATCH(materials.name) AGAINST(? IN BOOLEAN MODE)', [$s])
                        ->join('prod_mat', 'prod_mat.materials_id', '=', 'materials.id');
                })
                ->orWhereIn('products.id', function($sel) use($s) {
                    $sel->select('prod_mat.products_id as id')
                        ->from('prod_mat')
                        ->whereRaw('MATCH(extra) AGAINST(? IN BOOLEAN MODE)', [$s]);
                })
                ->orWhereRaw(
                    'MATCH(products.name) AGAINST(? IN BOOLEAN MODE) OR
                    MATCH(categories.name) AGAINST(? IN BOOLEAN MODE)', [$s, $s]
                )
                ->orderBy('relevance', 'desc');
                
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
            }

            if (array_key_exists('c', $query_list)) {
                $res = $res->where('categories.name', '=', $request->query('c'));
            }
        }

        $res = $res->get();
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
            }
            else {
                array_push($arranged[$row->name]['materials'], ['name' => $row->material, 'extra' => $row->extra]);
            }
        }

        return View::make('pages.catalogue')->withProducts(json_encode($arranged))->withSearchQ('You Searched For ...');
    }
}