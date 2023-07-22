<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ShippingController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function show_web(Request $request, $address) {
        $url = $request->getSchemeAndHttpHost();
        return view($address)->with('url_web', $url);
    }

    public function show_web_order(Request $request, $address) {
        $url = $request->getSchemeAndHttpHost();
        $shipping = new ShippingController();
        $all_shipping = json_decode(json_encode($shipping->show_status_shipping_by_customer_id($request)), true);
        return view($address)->with('url_web', $url)->with('shipping', $all_shipping);
    }

    public function show_web_shipping_information(Request $request, $address) {
        $url = $request->getSchemeAndHttpHost();
        $shipping = new ShippingController();
        $location = json_decode(json_encode($shipping->show_shipping_info_by_customer_id($request)), true);
        
        return view($address)->with('url_web', $url)->with('location', $location);
        // return response()->json($location, 200);
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
        $response = $product->show($request->product); 
        $data = $response->getData();

        $products = new ProductController();
        $request->page = mt_rand(1, 5);
        $request->per_page = 4;

        $result = json_decode(json_encode($products->handleGetProduct($request)), true);
        $url = $request->getSchemeAndHttpHost();
        return view('product')->with('product', $data)->with('url_web', $url)->with('products', $result['original'][0]);
        // return view('product')->with('product', $product->show($request->product, true))->with('url_web', $url);
        // return $data;
    }

    public function show_checkout(Request $request) {
        // ................
        $url = $request->getSchemeAndHttpHost();
        return view('checkout')->with('url_web', $url)->with('web', $request->web);
    }
}
