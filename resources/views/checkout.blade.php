@extends('frame')

@section('title', 'Checkout')

@push('style')
<link rel="stylesheet" href="/css/menu.css">
<link rel="stylesheet" href="/css/checkout.css">
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
                <h1 style="font-family: var(--font-family-title); color: var(--color-title);">Checkout
                </h1><a href="#order" class="go-to-next">Order Now</a>
            </div>
        </div>
    </div>
</div>
@endpush

@push('body')
<section>
    <div class="container">
        <div class="__checkout">
            <form action="" id="checkout">
                <h1 style="font-size: 30px; font-weight: 400; margin-bottom: 30px;">BILLING DETAILS</h1>
                <div class="form-group">
                    <label for="" class="form-label">Name or nickname</label>
                    <input class="form-input" type="text" name="name" id="name" placeholder="Name or nickname">
                    <p class="form-message"></p>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Phone</label>
                    <input class="form-input" type="number" name="phone" id="phone" placeholder="Phone">
                    <p class="form-message"></p>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Shipping address</label>
                    <input class="form-input" type="text" name="shipping" id="shipping" placeholder="Shipping address">
                    <p class="form-message"></p>
                </div>
            </form>
        </div>
    </div>
</section>

<section style="margin: 30px 0;">
    <div class="container">
        <div class="container__cart-total">
            <div style="width: 100%;border: 1px solid var(--color-title); padding: 30px ;">
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
            </div>
        </div>
        <div class="container__cart-total">
            <div style="width: 100%;border: 1px solid var(--color-title); padding: 30px ;">
                <h2>PAYMENT METHOD</h2>
                <div class="box-input__pay">
                    <input class="__input-checkout" data-checkout="1" type="checkbox" name="" id="">
                    <p>Direct Bank Transfer</p>
                </div>
                <div class="box-input__pay">
                    <input class="__input-checkout" data-checkout="2" type="checkbox" name="" id="">
                    <p>Cash On Delivery</p>
                </div>
                <button class="btn-checkout" id="btn-checkout">
                    Place an order
                </button>
            </div>
        </div>
    </div>
</section>
    
@endpush

@section('scripts')
@push('js')
<script src="/js/checkout.js"></script>
<script src="/js/login.js"></script>
<script>
    handleInput({
        form: '#checkout',
        inputs: '.form-input',
        labels: '.form-label',
        css: {
            fontSize: "16px",
            top: '-12px',
            color: 'var(--color-title)',
        }
    })
    handleImport({
        form: '#checkout',
        formInput: '.form-input',
        formMessage: '.form-message',
        btnOther: '#btn-checkout',
        rules: [
            handleImport.isFocus('#name', 'Please enter your Name or Nickname'),
            handleImport.isFocus('#phone', 'Please enter your Phone number'),
            handleImport.isFocus('#shipping', 'Please enter your Shipping address'),
        ],
        isSuccess: function (data) {
        }
    })

    handleCheckoutMethod({
        checkbox: '.__input-checkout',
    })

    async function main() {
        await handleInfomartionUser('.login__user');
        
        await handleTotalCart({
            form: '#checkout',
            username: '#name',
            phone: '#phone',
            shipping: '#shipping',
            subTotal: '.subtotal_price',
            delivery: '.delivery_price',
            discount: '.discount_price',
            total: '.total_price',
            checkout: '.__input-checkout',
            btnOrder: '#btn-checkout',
            handle: function(data, options) {

                if(Object.keys(user).length != 0) {
                    handleApiMethodGet({
                        urlApi: `/api/order/decode_token`,
                        handleDataGet: function(data, newOptions) {
                            dataOrder.quantity = data.quantity;
                            dataOrder.product_size_flavor_id = data.product_size_flavor_id;
                            dataOrder.customer_id = data.user_id;


                            function addTotalCart(data, options) {
                                const totalElement = document.querySelector(options.total)
                                const subTotalElement = document.querySelector(options.subTotal)
                                const delivery = document.querySelector(options.delivery)
                                const discount = document.querySelector(options.discount)

                                let sub = data.price * data.quantity
                                dataOrder.total = (parseFloat(sub + data.delivery) - parseFloat(data.discount + data.web_discount))
                                subTotalElement.innerText = sub.toFixed(2)
                                delivery.innerText = data.delivery.toFixed(2)
                                discount.innerText = (parseFloat(data.discount) + parseFloat(data.web_discount)).toFixed(2)
                                totalElement.innerText = dataOrder.total.toFixed(2)
                            }

                            addTotalCart(data, options)
                        },
                    })
                }
            }
        })
    }

    handleOrder({
        btn: '#btn-checkout',
        delivery: '#shipping',
        rules: [
            handleOrder.isInfo('#checkout .form-message', 'Please enter all the information', 'data-checkout'),
            handleOrder.isPaymentMethod('.__input-checkout', 'Please select a payment method'),
        ],
        handle: function(options, value) {
            value.forEach(item => {
                if(item[0].nodeType === Node.ELEMENT_NODE) {
                    const dataCheckout = item[0].getAttribute('data-checkout');
                    if (dataCheckout == 1) 
                        dataOrder.payment_method = 'Direct Bank Transfer'
                    else 
                        dataOrder.payment_method = 'Cash On Delivery'
                }else {
                    dataOrder.shipping_address = item[0]
                }
            })
            
            // getmethodpost
            handleApiMethodPost({
                data: dataOrder,
                urlApi: '/api/order',
                urlWeb: '/home',
                handle: function(data, options) {
                    alert('Order successful')
                    window.location.href = @json($url_web) + '.home';
                }
            })
        }
    })
    
    main();
</script>
@endpush
@parent
@endsection