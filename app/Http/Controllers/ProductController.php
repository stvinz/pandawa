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

        if (count($request->query()) == 0) {
            // Show all
            $action = View::make('pages.catalogue')->withProducts("all");
        }
        else {
            // Show some
            $action = View::make('pages.catalogue')->withProducts("some");
        }

        return $action;
    }
}