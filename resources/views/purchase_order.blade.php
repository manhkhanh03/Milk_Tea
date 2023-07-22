@extends('frame_user')

@push('style-css')
<style>
    .form-message {
        bottom: -4px;
    }
</style>
@endpush

@push('body_frame')
<section>
    <div class="container">
        <div class="container__profile">
            <div class="nav-profile">
                <div class="__header img-user">

                </div>
                <ul class="list-nav__profile">
                    <li class="nav__profile-item">
                        <a href="{{$url_web}}/user/account/profile" >
                            <div class="__profile-item__name">
                                <i class="fa-regular fa-user"></i>
                                <p class="name">My account</p>
                            </div>
                        </a>
                    </li>
                    <li class="nav__profile-item active purchase-order">
                        <a href="">
                            <div class="__profile-item__name">
                                <i class="fa-solid fa-list-check"></i>
                                <p class="name">Purchase order</p>
                            </div>
                        </a>
                    </li>
                    <li class="nav__profile-item">
                        <div class="__profile-item__name">
                            <i class="fa-regular fa-bell"></i>
                            <p class="name">Notification</p>
                        </div>
                    </li>
                </ul>
            </div>

            @stack('body-products')

        </div>
</section>
@endpush

@push('js_frame')
<script>
    async function main(){
            await handleInfomartionUser('.login__user');

            await handleUserProfile({
                urlApi: `/api/user/profile/${user.userId}`,
                selectorUser: '.nav-profile .img-user',
                purchaseOrder: '.purchase-order a',
                cancelled: '.cancelled a',
                delivered: '.delivered a',
                inDelivery: '.in-delivery a',
                awaitShipping: '.await-shipping a',
                handleDataGet: function(data, options) {
                    const selectorElement = document.querySelector(options.selectorUser);
                    const purchaseOrder = document.querySelector(options.purchaseOrder)
                    const cancelled = document.querySelector(options.cancelled)
                    const delivered = document.querySelector(options.delivered)
                    const inDelivery = document.querySelector(options.inDelivery)
                    const awaitShipping = document.querySelector(options.awaitShipping)

                    for (dt in data) {
                        if(data[dt] == null) {
                            data[dt] = ''
                        }
                    }
                    cancelled.href = `${URLWeb}/user/cancelled?customer=${user.userId}&status=Cancelled`
                    delivered.href = `${URLWeb}/user/delivered?customer=${user.userId}&status=Delivered`
                    inDelivery.href = `${URLWeb}/user/in_delivery?customer=${user.userId}&status=In delivery`
                    awaitShipping.href = `${URLWeb}/user/await_shipping?customer=${user.userId}&status=Awaiting delivery`
                    purchaseOrder.href = `${URLWeb}/user/await_shipping?customer=${user.userId}&status=Awaiting delivery`;

                    selectorElement.innerHTML = `
                        <p class="img-user__img" id="user-image"
                            style="background-image: url(${data.img_user});">
                            <label for="file-upload" class="label-input"></label>
                            <input type="file" name="file-img" id="file-upload" placeholder="Choose images">
                        </p>
                        <p class="__header__name">${data.user_name}</p>
                    `
                }
            });
        }

        main();
</script>
@endpush