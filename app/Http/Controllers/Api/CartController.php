<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductImage;
use App\Models\DiscountCodeHasProduct;
use App\Models\DiscountCode;
use App\Models\ProductSizeFlavor;

class CartController extends Controller
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
        $product = ProductSizeFlavor::where('product_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->where('flavor_id', $request->flavor_id)
            ->first();
        
        if(empty($product)) {
            return response()->json(['message' => 'Fail'], 200, ['OK']);
        } else {
            $new_product = new Request();
            $new_product->merge(['product_size_flavor_id' => $product->id]);
            $new_product->merge(['customer_id' => $request->user_id]);
            $new_product->merge(['quantity' => $request->quantity]);
            $new_product->merge(['total' => $product->price * $request->quantity]);
            $new_product = Cart::create($new_product->all());
            return response()->json($new_product, 200, ['OK']);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    public function show_cart(Request $request) {
        $cart = Cart::join('product_size_flavors', 'product_size_flavors.id', '=', 'cart.product_size_flavor_id')
            // ->join('product_images', 'product_images.product_id', '=', 'product_size_flavors.product_id')
            ->join('products', 'products.id', '=', 'product_size_flavors.product_id')
            ->join('sizes', 'sizes.id', '=', 'product_size_flavors.size_id')
            ->join('flavors', 'flavors.id', '=', 'product_size_flavors.flavor_id')
            ->where('customer_id', $request->customer_id)
            ->groupBy('products.id', 'products.name', 'total', 'price', 'size_id', 'flavor_id', 'quantity'  )
            ->select('products.id', 'products.name as product_name', 'total', 'price', 'sizes.name as size_name', 'flavors.name as flavor_name', 'quantity' )
            ->get();
            
        $cart = json_decode($cart, true);
        $current_date = date('Y-m-d H:i:s');
        foreach ($cart as &$product) {
            $images = ProductImage::where('product_id', $product['id'])->first();
            $discount_codes = DiscountCodeHasProduct::join('discount_codes', 'discount_code_has_products.discount_code_id', 
            '=', 'discount_codes.id')
            ->where('product_id', $product['id'])
            ->where('start_date', '<=', $current_date)
            ->where('end_date', '>=', $current_date)
            ->select('type_discount_amount', 'discount_amount')
            ->get();

            $web_discount_codes = DiscountCode::where('applies_to_all_products', 1)
                ->where('start_date', '<=', $current_date)
                ->where('end_date', '>=', $current_date)
                ->select('type_discount_amount', 'discount_amount')
                ->get();

            $product['discount_code'] = $discount_codes;
            $product['web_discount_code'] = $web_discount_codes;
            $product['url'] = $images['url'];
        }


        return response()->json($cart, 200, ['OK']);
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
