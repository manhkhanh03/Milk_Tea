@extends('frame_user')

@push('body_frame')
    <section>
        <div class="container">
            <div class="container__profile">
                <div class="nav-profile">
                    <div class="__header img-user">
    
                    </div>
                    <ul class="list-nav__profile">
                        <li class="nav__profile-item">
                            <div class="__profile-item__name">
                                <i class="fa-regular fa-user"></i>
                                <p class="name">My account</p>
                            </div>
    
                            <ul class="list__item my-account">
                                <li class="list__item-item">
                                    <a href="{{$url_web}}/user/account/profile">
                                        <button class="__item-item__btn">
                                            Profile
                                        </button>
                                    </a>
                                </li>
                                <li class="list__item-item active">
                                    <a>
                                        <button class="__item-item__btn">
                                            Bank
                                        </button>
                                    </a>
                                </li>
                                <li class="list__item-item">
                                    <a href="{{$url_web}}/user/account/change_password">
                                        <button class="__item-item__btn">
                                            Change password
                                        </button></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav__profile-item purchase-order">
                            <a href="{{$url_web}}/user/purchase_order?customer=4&status=Awaiting delivery">
                                <div class="__profile-item__name">
                                    <i class="fa-solid fa-list-check"></i>
                                    <p class="name">Purchase order</p>
                                </div>
                            </a>
                        </li>
                        <li class="nav__profile-item">
                            <a href="{{$url_web}}/user/notification">
                                <div class="__profile-item__name">
                                    <i class="fa-regular fa-bell"></i>
                                    <p class="name">Notification</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
    
                <div class="info-profile">
                    <div class="__header bank">
                        <h3 style="font-size: 20px; height: 50px; display: flex;
                                                                align-items: center;">Credit card/ Debit card/ Visa card</h3>
                        <button class="bank-btn">
                            <p class="img" style="background-image: url(/img/plus.png);"></p>
                            <p>Add card</p>
                        </button>
                    </div>
                    <div style="margin: 100px 0">You have not linked your card.</div>
                    <div class="__header bank">
                        <h3 style="font-size: 20px; height: 50px; display: flex;
                                                                align-items: center;">Bank account</h3>
                        <button class="bank-btn">
                            <p class="img" style="background-image: url(/img/plus.png);"></p>
                            <p>Add a bank account</p>
                        </button>
                    </div>
                    <div style="margin: 100px 0">You do not have a bank account.</div>
                    
                </div>
    
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
                form: '#form-information',
                purchaseOrder: '.purchase-order a',
                handleDataGet: function(data, options) {
                    const selectorElement = document.querySelector(options.selectorUser);
                    const purchaseOrder = document.querySelector(options.purchaseOrder)
                    selectorElement.innerHTML = `
                        <p class="img-user__img" id="user-image"
                            style="background-image: url(${data.img_user});">
                            <label for="file-upload" class="label-input"></label>
                            <input type="file" name="file-img" id="file-upload" placeholder="Choose images">
                        </p>
                        <p class="__header__name">${data.user_name}</p>
                    `
                    purchaseOrder.href = `${URLWeb}/user/await_shipping?customer=${user.userId}&status=Awaiting delivery`;
                }
            });
        }

        main();
    </script>
@endpush