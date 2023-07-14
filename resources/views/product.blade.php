@extends('frame')

@section('title',  $product->name)

@push('style')
<link rel="stylesheet" href="/css/menu.css">
<link rel="stylesheet" href="/css/product.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <h1 style="font-family: var(--font-family-title); color: var(--color-title);">Product Detail
                </h1><a href="#order" class="go-to-next">Order Now</a>
            </div>
        </div>
    </div>
</div>
@endpush

@push('body')
    <section>
        <div class="container">
            <div class="container__list-img">
                @if (!empty($product->images) && is_array($product->images))
                    <div class="container__list-img__main" style="background-image: url({{ $product->images[0]->url}});"></div>
                    <ul class="container__list-img__small">
                        @foreach ($product->images as $image)
                        <li class="__small-item" style="background-image: url({{ $image->url ?? '' }});"></li>
                        @endforeach
                    </ul>
                @endif
            </div>
    
            <div class="container__information-product">
                <div class="__information-product__name">{{$product->name}}</div>
                <ul class="__information-product__assessment">
                    <li class="item">4 Assessment</li>
                    <li class="item">{{$product->sold[0]->total}} Sold</li>
                </ul>
                <div class="__information-product">
                    <span class="price" style="color: var(--color-title);">{{count($product->sizes) - 1 == 0 ? '' : $product->sizes[count($product->sizes) - 1]->price. '$' . ' - '}} {{$product->sizes[0]->price. '$'}}</span>
                    <span class="discount-codes-web"
                        style="color: var(--color-title); font-size: 14px; margin-left: 10px;">web discount code</span>
                </div>
    
                <ul class="__information-product">
                    <span>Shop discount codes:</span>
                    <li class="__discount-codes__item">-15%</li>
                    <li class="__discount-codes__item">-0.5$</li>
                </ul>
    
                <div class="__information-product">
                    <span>Flavors</span>
                    <div class="__box-flavors product-flavors">
                        <span class="__is-flavor" style="">Select:</span>
                        <ul class="__list-flavors">
                            {{-- <li class="__flavor-item">Chocolate</li>
                            <li class="__flavor-item">Mango</li>
                            <li class="__flavor-item">Orange</li> --}}
                            @foreach ($product->flavors as $flavor)
                                <li class="__flavor-item">{{$flavor->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
    
                <div class="__information-product ">
                    <span>Sizes</span>
                    <div class="__box-flavors product-sizes">
                        <span class="__is-flavor" style="">Select:</span>
                        <ul class="__list-flavors">
                            {{-- <li class="__flavor-item">S: small</li>
                            <li class="__flavor-item">M: medium</li>
                            <li class="__flavor-item">L: large</li> --}}
                            @foreach ($product->sizes as $size)
                                <li class="__flavor-item">{{$size->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
    
                <div class="__information-product">
                    <span>Quantity</span>
                    <div class="__quantity">
                        <div class="quantity-minus">
                            <i class="fa-solid fa-minus"></i>
                        </div>
                        <input type="number" value="1" name="quantity" id="quantity">
                        <div class="quantity-plus">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                </div>
    
                <div class="__information-product">
                    <div class="__cart">
                        <div class="_cart-add-cart">
                            <i class="fa-solid fa-cart-plus"></i>
                            <p>Add to cart</p>
                        </div>
                        <button class="btn-buy-now">Buy now</button>
                    </div>
                </div>
    
            </div>
    
            <!-- Relevant Products -->
            <div class="relevant-products">
                <div class="container__child-introduce">
                    <h1 style="font-family: var(--font-family-title); font-size: 40px; color: var(--color-title);">Milk
                        Tea</h1>
                    <h1 style="font-size: 40px;padding: 6px 0 30px; line-height: 0;">Other Products</h1>
                    <button>
                        <a href="">View Full Products</a> <!-- ???????? view now-->
                    </button>
                </div>
                <ul class="relevant-products__child">
                    <li class="container__child-product__item">
                        <a style="display: block; height: 100%;">
                            <div style="height: 270px; overflow: hidden;">
                                <p class="container__child-product__item-img"
                                    style="background-image: url(https://th.bing.com/th/id/OIP.7IZF6hng2J3XP_7dj-IrSwHaLG?pid=ImgDet&rs=1)">
                                </p>
                            </div>
                            <div class="container__child-product__item-description">
                                <h2
                                    style="margin: 18px 0; font-size: 18px; text-overflow: ellipsis; overflow: hidden; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">
                                    $product['name']</h2>
                                <p
                                    style="color: var(--color-light); text-overflow: ellipsis; overflow: hidden; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">
                                    $product['user']['address']</p>
                                <div class="description__price-total" style="color: var(--color-light);">
                                    <p class="price" style="color: var(--color-light);">
                                        $product['prices'][count($product['prices']) -
                                        1]['price'] $
                                    </p>
                                    <p class="total" style="color: var(--color-light);">$product['sales'] Sold</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="container__child-product__item">
                        <a style="display: block; height: 100%;">
                            <div style="height: 270px; overflow: hidden;">
                                <p class="container__child-product__item-img"
                                    style="background-image: url(https://th.bing.com/th/id/OIP.7IZF6hng2J3XP_7dj-IrSwHaLG?pid=ImgDet&rs=1)">
                                </p>
                            </div>
                            <div class="container__child-product__item-description">
                                <h2
                                    style="margin: 18px 0; font-size: 18px; text-overflow: ellipsis; overflow: hidden; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">
                                    $product['name']</h2>
                                <p
                                    style="color: var(--color-light); text-overflow: ellipsis; overflow: hidden; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">
                                    $product['user']['address']</p>
                                <div class="description__price-total" style="color: var(--color-light);">
                                    <p class="price" style="color: var(--color-light);">
                                        $product['prices'][count($product['prices']) -
                                        1]['price'] $
                                    </p>
                                    <p class="total" style="color: var(--color-light);">$product['sales'] Sold</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="container__child-product__item">
                        <a style="display: block; height: 100%;">
                            <div style="height: 270px; overflow: hidden;">
                                <p class="container__child-product__item-img"
                                    style="background-image: url(https://th.bing.com/th/id/OIP.7IZF6hng2J3XP_7dj-IrSwHaLG?pid=ImgDet&rs=1)">
                                </p>
                            </div>
                            <div class="container__child-product__item-description">
                                <h2
                                    style="margin: 18px 0; font-size: 18px; text-overflow: ellipsis; overflow: hidden; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">
                                    $product['name']</h2>
                                <p
                                    style="color: var(--color-light); text-overflow: ellipsis; overflow: hidden; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">
                                    $product['user']['address']</p>
                                <div class="description__price-total" style="color: var(--color-light);">
                                    <p class="price" style="color: var(--color-light);">
                                        $product['prices'][count($product['prices']) -
                                        1]['price'] $
                                    </p>
                                    <p class="total" style="color: var(--color-light);">$product['sales'] Sold</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="container__child-product__item">
                        <a style="display: block; height: 100%;">
                            <div style="height: 270px; overflow: hidden;">
                                <p class="container__child-product__item-img"
                                    style="background-image: url(https://th.bing.com/th/id/OIP.7IZF6hng2J3XP_7dj-IrSwHaLG?pid=ImgDet&rs=1)">
                                </p>
                            </div>
                            <div class="container__child-product__item-description">
                                <h2
                                    style="margin: 18px 0; font-size: 18px; text-overflow: ellipsis; overflow: hidden; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">
                                    $product['name']</h2>
                                <p
                                    style="color: var(--color-light); text-overflow: ellipsis; overflow: hidden; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">
                                    $product['user']['address']</p>
                                <div class="description__price-total" style="color: var(--color-light);">
                                    <p class="price" style="color: var(--color-light);">
                                        $product['prices'][count($product['prices']) -
                                        1]['price'] $
                                    </p>
                                    <p class="total" style="color: var(--color-light);">$product['sales'] Sold</p>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endpush

@section('scripts')
@push('js')
<script src="/js/aProduct.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    handleEventQuantityProduct({
        selector: {
        next: '.quantity-plus',
        prev: '.quantity-minus'
        },
        input: '#quantity',
    })
    
    handleEventSelectedProduct({
        selector: '.product-flavors',
        item: '.__flavor-item',
        input: '.__is-flavor'
    })
    
    handleEventSelectedProduct({
        selector: '.product-sizes',
        item: '.__flavor-item',
        input: '.__is-flavor'
    })
    
    handleEventChangeImageMain({
        parent: '.container__list-img',
        imageMain: '.container__list-img__main',
        imageList: '.__small-item',
    })


    // handleApiMethodGet({
    //     urlApi: `/api/product/${idProduct}`,
    // })
</script>
@endpush
@parent
@endsection


    