<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ProductController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function show_web(Request $request, $address) {
        $url = $request->getSchemeAndHttpHost();
        return view($address)->with('url_web', $url);
    }

    public function show_pagination(Request $request) {
        $products = new ProductController();
        if(!$request->page) {
            $request->page = 1;
            $request->per_page = 8;
        }
        $result = json_decode(json_encode($products->handleGetProduct($request)), true);

        $url = $request->getSchemeAndHttpHost();

        return view('menu')->with('products', $result['original'])->with('url_web', $url);
        // return $result['original'];
    }

    public function show_product($title, Request $request) {
        $product = new ProductController();
        $response = $product->show($request->product, true); 
        $data = $response->getData();

        $url = $request->getSchemeAndHttpHost();
        return view('product')->with('product', $data)->with('url_web', $url);
        // return view('product')->with('product', $product->show($request->product, true))->with('url_web', $url);
        // return $data;
    }
}
