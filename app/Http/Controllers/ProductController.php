<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller {
    
    public function getProduct(Request $request)
    {
        $action = null;

        if ($request->query("s", "") == "") {
            // Show all
            $action = View::make('pages.product')->withProducts("all");
        }
        else {
            // Show some
            $action = View::make('pages.product')->withProducts("some");
        }

        return $action;
    }

}