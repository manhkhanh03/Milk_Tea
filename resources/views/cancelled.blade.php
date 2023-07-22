@extends('purchase_order')

@push('body-products')
<div class="info-profile purchase-order__products">
    <ul class="__header purchase-order__header">
        <li class="__header-item await-shipping ">
            <a href="">
                Await shipping
            </a>
        </li>
        <li class="__header-item in-delivery">
            <a href="">
                In delivery
            </a>
        </li>
        <li class="__header-item delivered">
            <a href="">
                Delivered
            </a>
        </li>
        <li class="__header-item cancelled active">
            <a href="">
                Cancelled
            </a>
        </li>
    </ul>

    <ul class="list-products__order">
        @foreach ($shipping as $sp)
        <li class="__order-item">
            <div class="__order-item__status">
                {{ $sp['status'] }}
            </div>
            <a href="">
                <div class="__status__info-order">
                    <div class="__info-order__decription">
                        <div class="__decription__img" style="background-image: 
                                                                    url({{$sp['image']}});"></div>
                        <div class="__decription__decription">
                            <h3 class="name">{{$sp['product']}}</h3>
                            <p class="flavor">Flavor: {{$sp['flavor']}}</p>
                            <p class="size">Size: {{$sp['size']}}</p>
                            <p class="quantity">Quantity: {{$sp['quantity']}}</p>
                        </div>
                    </div>
                    <div class="__info-order__price">
                        ${{$sp['price']}}
                    </div>
                </div>
            </a>
            <div class="__detail__total">
                <div class="__total">
                    Total: <span style="color: var(--color-title);">${{$sp['total']}}</span>
                </div>
                <div class="__btn_order">
                    <button class="buy-again">By Again</button>
                    <button class="view-cancellation-details">View Cancellation Details</button>
                    <button class="contact-seller">Contact Seller</button>
                </div>
            </div>
        </li>
        @endforeach
    </ul>

</div>
@endpush