<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingTracking;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\ProductSizeFlavor;
use App\Models\Size;
use App\Models\Order;
use App\Models\User;
use App\Models\Flavor;
use App\Models\Location;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function show_status_shipping_by_customer_id(Request $request) {
        if ($request->shipping) {
            $shipping = ShippingTracking::join('orders', 'shipping_tracking.order_id', '=', 'orders.id')
            ->where('customer_id', $request->customer)
            ->where('shipping_tracking.id', $request->shipping)
            ->where('status', $request->status)
            ->select('order_id', 'shipping_tracking.id as shipping_tracking_id', 'status',
                 'delivery_person_id', 'order_date', 'shipping_address', 'quantity', 'total', 'product_size_flavor_id')
            ->get();
        }else {
            $shipping = ShippingTracking::join('orders', 'shipping_tracking.order_id', '=', 'orders.id')
            ->where('customer_id', $request->customer)
            ->where('status', $request->status)
            ->select('order_id', 'shipping_tracking.id as shipping_tracking_id', 'status',
                 'delivery_person_id', 'order_date', 'shipping_address', 'quantity', 'total', 'product_size_flavor_id', 'orders.id as order_id')
            ->get();
        }

        $shipping = json_decode($shipping, true);
        foreach ($shipping as &$sp) {
            $psf = ProductSizeFlavor::find($sp['product_size_flavor_id']);
            $img = ProductImage::where('product_id', $psf->product_id)
                ->select('url')
                ->first();
            $product = Product::where('id', $psf->product_id)
                ->select('name')
                ->first();
            
            $size = Size::where('id', $psf->size_id)
                ->select('name')
                ->first();
            $flavor = Flavor::where('id', $psf->flavor_id)
                ->select('name')
                ->first();
            
            $sp['image'] = $img->url;
            $sp['product'] = $product->name;
            $sp['size'] = $size->name;
            $sp['flavor'] = $flavor->name;
            $sp['price'] = $psf->price;
            $sp['user_id'] = $request->customer;

        }
        return $shipping;
        // return response()->json($shipping, 200);
    }

    public function show_shipping_info_by_customer_id(Request $request) {
        $status = $this->show_status_shipping_by_customer_id($request);
        foreach ($status as &$st) {
            $location = Location::where('shipping_tracking_id', $st['shipping_tracking_id'])
                ->select('description', 'updated_at')
                ->orderBy('updated_at', 'desc')
                ->get();
            $user = User::where('id', $st['user_id'])
                ->select('user_name', 'phone', 'address')
                ->first();
            $st['location'] = $location;
            $st['user'] = $user;
        }
        return $status;
        // return response()->json($status, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    public function update_delivery_person(Request $request, string $id)
    {
        $shipping = ShippingTracking::find($id);
        $shipping->update($request->all());
        return response()->json($shipping, 200, ['OK']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
