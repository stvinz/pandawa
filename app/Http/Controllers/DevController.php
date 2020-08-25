<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

// To see everything in detail, dev controller select all relevant columns of a table
class DevController extends Controller
{
    // 
    public function getCats()
    {
        $categories = DB::table('categories')->select('id', 'name', 'img')->orderBy('name', "asc")->get();
        return View::make('dev.inputCats')->withItems($categories);
    }

    public function getMats()
    {
        $materials = DB::table('materials')->select('id', 'name', 'img')->orderBy('name', "asc")->get();
        return View::make('dev.inputMats')->withItems($materials);
    }

    public function getProds($err = null)
    {
        $prods = DB::table('prod_mat')
            ->join('products', 'prod_mat.products_id', '=', 'products.id')
            ->leftJoin('materials', 'prod_mat.materials_id', '=', 'materials.id')
            ->leftJoin('brands', 'prod_mat.brands_id', '=', 'brands.id')
            ->join('categories', 'products.categories_id', '=', 'categories.id')
            ->select('prod_mat.id as id', 'prod_mat.extra as extra', 'products.img as img', 'products.name as name', 'products.desc as desc', 'materials.name as material', 'categories.name as category', 'brands.name as brand')
            ->get();

        return View::make('dev.inputProds')->withItems($prods)->withErr($err);
    }

    private function img_parse($name, $ext){
        $img = trim(strtolower($name));
        $res = '';
        $prev = '';

        for($i = 0; $i < strlen($name); $i++) {
            $char = $img[$i];
            $is_char = (ord($char) >= ord('a')) and (ord($char) <= ord('z'));
            $is_num = (ord($char) >= ord('0')) and (ord($char) <= ord('9'));

            if ($is_char or $is_num) {
                $res .= $char;        
            }
            else {
                switch ($char) {
                    case '+':
                        $res .= 'plus';
                        break;
                    case '-':
                        if ($prev == '(') {
                            $res .= 'flat';
                        }
                        else {
                            $res .= '-';
                        }
                        break;
                    case ' ':
                        $res .= '-';
                        break;
                    case '/':
                        $res = substr($res, 0, strlen($res) - 1);
                        
                        if ((ord($prev) >= ord('a')) and (ord($prev) <= ord('z'))) {
                            $res .= $prev . '-';
                        }
                        break;
                    case '&':
                        $res = substr($res, 0, strlen($res) - 1);
                        break;
                    default:
                        break;
                }
            }

            $prev = $char;
        }

        return $res.$ext;
    }

    public function postProds(Request $request) 
    {       
        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required|string',
            'materials' => 'required_without_all:brands|string|nullable',
            'brands' => 'required_without_all:materials|string|nullable'
        ]);

        $name = ucwords($request->input('name'));
        
        // Category validation
        $category = ucwords($request->input('category'));
        $cat = DB::table('categories')->select('id')->where('name', '=', $category)->get();

        if (count($cat) == 0) {
            return $this->getProds('No such category "'.$category.'"');
        }

        // Materials validation
        if ($request->input('materials') !== null) {
            $mat_ex = [];
            $materials = explode(", ", $request->input('materials'));
        
            foreach ($materials as $material) {
                $pos = strpos($material, '(');

                if ($pos) {
                    $mats = ucwords(substr($material, 0, $pos - 1));
                    $extra = ucwords(substr($material, $pos + 1));
                    $extra = substr($extra, 0, strlen($extra) - 1);
                }
                else {
                    $mats = ucwords($material);
                    $extra = '';
                }

                $mat_ex[$mats] = $extra;
            }

            $mats = [];

            foreach (array_keys($mat_ex) as $material) {
                $id = DB::table('materials')->select('id')->where('name', '=', $material)->get();

                $mats[$material] = $id[0]->id;
            }

            if (count($mats) != count(array_keys($mat_ex))) {
                return $this->getProds('No such materials');
            }
        }
        
        // Brands validation
        if ($request->input('brands') !== null) {
            $brands_val = [];
            $brands = explode(", ", $request->input('brands'));
        
            foreach ($brands as $brand) {
                array_push($brands_val, ucwords($brand));
            }

            $brands_id = [];

            foreach ($brands_val as $brand) {
                $id = DB::table('brands')->select('id')->where('name', '=', $brand)->get();

                if ($id[0]->id !== null) {
                    array_push($brands_id, $id[0]->id);
                }
                else {
                    array_push($brands_id, null);
                }
            }
        }

        DB::beginTransaction();

        try {
            $ext = '.jpg';

            if (($name == 'Split Cotter Pin') or ($name == 'Snap Pin / Single Coil')) {
                $ext = '.png';
            }
            
            $img = $this->img_parse(str_replace('&deg;', '', $name), $ext);
            $pid = preg_replace('/[^a-zA-Z0-9]/','', base64_encode($category.$name));

            $new_prod = DB::table('products')->insertGetId(
                ['name' => $name, 'categories_id' => $cat[0]->id, 'img' => $img, 'pid' => $pid]
            );

            $data_prod_mat = [];

            if (isset($mat_ex) && isset($brands_id)) {
                $index = 0;

                foreach ($mat_ex as $material => $extra) {
                    if ($brands_id !== null) {
                        array_push($data_prod_mat, ['products_id' => $new_prod, 'materials_id' => $mats[$material], 'extra' => $extra, 'brands_id' => $brands_id[index]]);
                    }
                    else {
                        array_push($data_prod_mat, ['products_id' => $new_prod, 'materials_id' => $mats[$material], 'extra' => $extra]);
                    }

                    $index++;
                }
            }
            else if (isset($mat_ex)) {
                foreach ($mat_ex as $material => $extra) {
                    array_push($data_prod_mat, ['products_id' => $new_prod, 'materials_id' => $mats[$material], 'extra' => $extra]);
                }
            }
            else {
                foreach ($brands_id as $brand) {
                    array_push($data_prod_mat, ['products_id' => $new_prod, 'extra' => '', 'brands_id' => $brand]);
                }
            }

            $new_prod_mat = DB::table('prod_mat')->insert(
                $data_prod_mat
            );
        }
        catch (Exception $e) {
            DB::rollBack();
        }

        DB::commit();

        return $this->getProds();
    }
}
