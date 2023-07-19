<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\ProductSizeFlavor;
use App\Models\DiscountCodeHasProduct;
use App\Models\DiscountCode;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::join('product_size_flavors', 'products.id', '=', 'product_size_flavors.product_id')
            ->select('products.id', 'sales', 'products.name', 'vendor_id')
            ->groupBy('products.id', 'sales', 'products.name', 'vendor_id')
            ->get();

        $products = json_decode($products, true);
            
        foreach ($products as &$value) {
            $prices = ProductSizeFlavor::where('product_id', $value['id'])
                ->select('price')
                ->get();
            $images = ProductImage::where('product_id', $value['id'])
                ->select('url')
                ->get();

            $sold = ProductSizeFlavor::join('orders', 'product_size_flavors.id', '=', 'orders.product_size_flavor_id')
                ->where('product_id', $value['id'])
                ->selectRaw('count(product_id) as total')
                ->get();

            $user = User::where('id', '=', $value['vendor_id'])->first();
            $value['user'] = $user;
            $value['prices'] = $prices;
            $value['images'] = $images;
            $value['sold'] = $sold;
        }
        return response()->json($products, 200, ['OK']);
    }

    public function totalProduct() {
        $total = Product::selectRaw('count(id)')
            ->get();
        return $total;
    }

    public function handleGetProduct(Request $request) {
        $limit = $request->per_page;
        $offset = ($request->page - 1) * $request->per_page;
        $products = Product::join('product_size_flavors', 'products.id', '=', 'product_size_flavors.product_id')
            ->select('products.id', 'products.name', 'vendor_id')
            ->groupBy('products.id', 'products.name', 'vendor_id')
            ->offset($offset)->limit($limit)
            ->get();    
        $products = json_decode($products, true);
            
        foreach ($products as &$value) {
            $prices = ProductSizeFlavor::where('product_id', $value['id'])
                ->select('price')
                ->get();

            $sold = ProductSizeFlavor::join('orders', 'product_size_flavors.id', '=', 'orders.product_size_flavor_id')
                ->where('product_id', $value['id'])
                ->selectRaw('count(product_id) as total')
                ->get();

            $images = ProductImage::where('product_id', $value['id'])
                ->select('url')
                ->get();
            $user = User::where('id', '=', $value['vendor_id'])->first();
            $value['user'] = $user;
            $value['prices'] = $prices;
            $value['images'] = $images;
            $value['sold'] = $sold;
        }
        return response()->json([$products, $this->totalProduct(), $request->page], 200, ['OK']);
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
        $product = Product::where('products.id', '=', $id)->first();
        $sizes = ProductSizeFlavor::join('sizes', 'product_size_flavors.size_id', '=', 'sizes.id')
            ->where('product_id', '=', $id)
            ->select('product_id', 'size_id', 'price', 'name', 'size')
            ->get();
        $user = User::where('id', '=', $product->vendor_id)->first();
        $flavors = ProductSizeFlavor::join('flavors', 'product_size_flavors.flavor_id', '=', 'flavors.id')
            ->where('product_id', '=', $id)
            ->groupBy('product_id', 'flavor_id', 'flavors.name', 'type')
            ->select('product_id', 'flavor_id', 'flavors.name', 'type')
            ->get();

        $images = ProductImage::where('product_id', $id)
            ->select('url')
            ->get();

        $sold = ProductSizeFlavor::join('orders', 'product_size_flavors.id', '=', 'orders.product_size_flavor_id')
            ->where('product_id', $id)
            ->selectRaw('count(product_id) as total')
            ->get();

        $current_date = date('Y-m-d H:i:s');
        $discount_codes = DiscountCodeHasProduct::join('discount_codes', 'discount_code_has_products.discount_code_id', 
            '=', 'discount_codes.id')
            ->where('product_id', $id)
            ->where('start_date', '<=', $current_date)
            ->where('end_date', '>=', $current_date)
            ->select('type_discount_amount', 'discount_amount', 'discount_codes.id')
            ->get();

        $web_discount_codes = DiscountCode::where('applies_to_all_products', 1)
            ->where('start_date', '<=', $current_date)
            ->where('end_date', '>=', $current_date)
            ->select('type_discount_amount', 'discount_amount')
            ->get();

        // A collection includes a key and a value.
        $collection = collect(['sizes' => $sizes]);
        $collection->put('user', $user);
        $collection->put('flavors', $flavors);
        $collection->put('images', $images);
        $collection->put('sold', $sold);
        $collection->put('shop_discount_codes', $discount_codes);
        $collection->put('web_discount_codes', $web_discount_codes);
        $result = $collection->merge($product);

        return response()->json($result, 200, ['OK']);
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
