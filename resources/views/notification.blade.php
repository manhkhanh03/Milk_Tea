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
                        <a href="{{$url_web}}/user/account/profile">
                            <div class="__profile-item__name">
                                <i class="fa-regular fa-user"></i>
                                <p class="name">My account</p>
                            </div>
                        </a>
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
                        <div class="__profile-item__name">
                            <i class="fa-regular fa-bell"></i>
                            <p class="name">Notification</p>
                        </div>

                        <ul class="list__item my-account">
                            <li class="list__item-item active">
                                <a>
                                    <button class="__item-item__btn">
                                        Update order
                                    </button>
                                </a>
                            </li>
                            <li class="list__item-item">
                                <a>
                                    <button class="__item-item__btn">
                                        Shop
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="info-profile">
                <div class="__header ">
                    <h3 style="font-size: 20px; height: 50px; display: flex;
                                                                                align-items: center;">Notifications</h3>
                </div>
                <div class="noti">
                    <ul class="noti__list-noti">The order hasn't been updated yet</ul>
                </div>
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
                purchaseOrder: '.purchase-order a',
                handleDataGet: function(data, options) {
                    console.log(user);
                    const selectorElement = document.querySelector(options.selectorUser);
                    const purchaseOrder = document.querySelector(options.purchaseOrder)

                    for (dt in data) {
                        if(data[dt] == null) {
                            data[dt] = ''
                        }
                    }

                    purchaseOrder.href = `${URLWeb}/user/await_shipping?customer=${user.userId}&status=Awaiting delivery`;

                    selectorElement.innerHTML = `
                        <p class="img-user__img" id="user-image"
                            style="background-image: url(${data.img_user});">
                            <label for="file-upload" class="label-input"></label>
                            <input type="file" name="file-img" id="file-upload" placeholder="Choose images">
                        </p>
                        <p class="__header__name">${data.user_name}</p>
                    `

                    handleApiMethodGet({
                        urlApi: `/api/notification/update/order/${user.userId}`,
                        notiSelector: '.noti__list-noti',
                        handleDataGet: function (data, options) {
                            console.log(data);
                            const noti = document.querySelector(options.notiSelector)
                            if(data.length > 0) {
                                // noti.innerHTML = data.map(function(ele, i) {
                                //     return `
                                //         ${ele.title}
                                //     `
                                // })
                            }
                        }
                    })
                }
            });
        }

    main();
</script>
@endpush