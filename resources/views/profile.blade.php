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
                                <li class="list__item-item active">
                                    <a>
                                        <button class="__item-item__btn">
                                            Profile
                                        </button>
                                    </a>
                                </li>
                                <li class="list__item-item">
                                    <a href="{{$url_web}}/user/account/bank">
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
                            <a href="/user/purchase_order?customer=4&status=Awaiting delivery">
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
    
                <div class="info-profile">
                    <div class="__header ">
                        <h3 style="font-size: 20px; height: 50px; display: flex;
                                                                align-items: center;">My Profile</h3>
                    </div>
                    <form action="" class="form-information" id="form-information">
                    </form>
                    <button id="btn-save-profile">Save</button>
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
                    console.log(user);
                    const formElement = document.querySelector(options.form)
                    const inputElements = formElement.querySelectorAll(options.inputForm)
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

                    formElement.innerHTML = `
                        <div class="form-group">
                            <label for="login-name" class="form-label">Login name</label>
                            <input class="form-input" type="text" id="login-name" value="${data.login_name}" placeholder="Login name">
                        </div>
                        <div class="form-group">
                            <label for="user-name" class="form-label">User name</label>
                            <input class="form-input" type="text" id="user-name" value="${data.user_name}" placeholder="User name">
                        </div>
                        <div class="form-group">
                            <label for="phone-number" class="form-label">Phone number</label>
                            <input class="form-input" type="number" id="phone-number" value="${data.phone}" placeholder="Phone number">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-input" type="text" id="email" value="${data.email}" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <input class="form-input" type="text" id="address" value="${data.address}" placeholder="Address">
                        </div>
                    `
                    handleImageUser({
                        selectorImage: '.img-user__img',
                        btnChange: '#file-upload',
                    })

                    handleAlterInformationUser({
                        btn: '#btn-save-profile',
                        rules: [
                            handleAlterInformationUser.isSelector('#login-name', true),
                            handleAlterInformationUser.isSelector('#user-name', true),
                            handleAlterInformationUser.isSelector('#phone-number', true),
                            handleAlterInformationUser.isSelector('#email', true),
                            handleAlterInformationUser.isChangeImage('#user-image', true, `url("${data.img_user}")`),
                        ],
                        handle: function (data, options) {
                            const newData = {
                                login_name: data['#login-name'],
                                user_name: data['#user-name'],
                                email: data['#email'],
                                phone: data['#phone-number'],
                                img_user: data['#user-image'],
                            }

                            const dataUser = Object.keys(newData).reduce((acc, key) => {
                                const value = newData[key];
                                if (value !== undefined) {
                                    acc[key] = value;
                                }
                                return acc;
                            }, {});
                            console.log(dataUser)
                            
                            handleApiMethodPut({
                                urlApi: `/api/user/${user.userId}`,
                                data: dataUser,
                                handle: function (data, options) {
                                    window.location.reload()
                                }
                            })
                        },
                    }, data)
                }
            });
        }

    main();
    </script>
@endpush