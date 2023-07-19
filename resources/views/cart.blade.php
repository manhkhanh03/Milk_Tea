@extends('frame')

@section('title', 'Cart')

@push('style')
    <link rel="stylesheet" href="/css/cart.css">
@endpush

@section('menu')
@parent
@endsection

@section('slider')
@endsection
@push('banner')
<div class="slider">
    <div class="slider__slide slider__slide--active" data-slide="1">
        <div class="slider__wrap">
            <div class="slider__back"></div>
        </div>
        <div class="slider__inner">
            <div class="slider__content">
                <h1 style="font-family: var(--font-family-title); color: var(--color-title);">Welcome To The Cart
                </h1><a href="#order" class="go-to-next">Order Now</a>
            </div>
        </div>
    </div>
</div>
@endpush

@push('body')
    <section>
        <div class="container">
            <div
                style="width: 80%; background-color: var(--color-title); display: flex; padding: 10px 40px; justify-content: space-between;">
                <div style="width: 26%;"></div>
                <ul class="list-nav">
                    <li class="nav-item">Product</li>
                    <li class="nav-item">Price</li>
                    <li class="nav-item">Quantity</li>
                    <li class="nav-item">Total</li>
                </ul>
            </div>
    
            <ul class="list-products"></ul>
        </div>
    </section>
    
    <section style="margin: 0;">
        <div class="container">
            <div class="container__cart-total">
                <div style="border: 1px solid var(--color-title); padding: 30px ;">
                    <h2>CART TOTALS</h2>
                    <div class="box-price">
                        <p>Subtotal</p>
                        <p class="price ">
                            <span class="subtotal_price">0.00</span>
                            <span>$</span>
                        </p>
                    </div>
                    <div class="box-price">
                        <p>Delivery</p>
                        <p class="price ">
                            <span class="delivery_price">0.00</span>
                            <span>$</span>
                        </p>
                    </div>
                    <div class="box-price">
                        <p>Discount</p>
                        <p class="price ">
                            <span class="discount_price">0.00</span>
                            <span>$</span>
                        </p>
                    </div>
    
                    <div class="box-price total">
                        <p>TOTAL</p>
                        <p class="price ">
                            <span class="total_price">0.00</span>
                            <span>$</span>
                        </p>
                    </div>
                    <button class="btn-checkout">
                        <a href="{{$url_web}}/menu/products/checkout">Proceed to Checkout</a>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endpush

@section('footer')
@parent
@endsection

@section('scripts')
@push('js')
<script src="/js/cart.js"></script>
<script>
    async function main() {
        await handleInfomartionUser('.login__user');
        
        await handleApiMethodGet({
            urlApi: `/api/cart/customer?customer_id=${user.userId}`,
            selector: '.list-products',
            handleDataGet: function (data, options) {
            
            const htmls = data.map(function (product, index) {
                return `
                <li class="__item-product">
                    <div class="box-left-product">
                        <input type="checkbox" class="__item-product__child" name="checkbox-product" id="">
                        <p class="__item-product__child __item-product__img" style="background-image: url(${product.url});">
                        </p>
                    </div>
                    <div class="box-right-product">
                        <div class="__item-product__info __item-product__child">
                            <p class="name">${product.product_name}</p>
                            <p class="flavor">Flavor: ${product.flavor_name}</p>
                            <p class="size">Size: ${product.size_name}</p>
                        </div>
                        <div class="__item-product__child __item-product__price">${product.price}$</div>
                        <input type="number" name="" value="${product.quantity}" class="__item-product__child __item-product__quantity"
                            id="">
                        <p class="__item-product__child __item-product__total">${product.total}$</p>
                    </div>
                </li>
                `
            })
            
            const parentElement = document.querySelector(options.selector)
            // if(Array.isArray(htmls) && !htmls.length === 0)
                parentElement.innerHTML = htmls.join('')
            // else 
            //     parentElement.innerHTML = 'Log in to use the service'
            
            handleCheckout({
                input: 'input[name="checkbox-product"]',
                parentElement: '.__item-product',
                
                parentTotalCart: '.container__cart-total',
                total: '.total_price',
                discount: '.discount_price',
                delivery: '.delivery_price',
                subtotal: '.subtotal_price',
                quantity: '.__item-product__quantity',
                }, data)
            }
        });
    }

    main();
</script>
@endpush
@parent
@endsection