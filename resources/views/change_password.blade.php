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
                            <li class="list__item-item ">
                                <a href="{{$url_web}}/user/account/bank">
                                    <button class="__item-item__btn">
                                        Bank
                                    </button>
                                </a>
                            </li>
                            <li class="list__item-item active">
                                <a>
                                    <button class="__item-item__btn">
                                        Change password
                                    </button>
                                </a>
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
                                                                align-items: center;">Password</h3>
                    <button class="bank-btn" id="change-password-btn">
                        <p>Change password</p>
                    </button>
                </div>
                
                <form class="info-address" id="info-change-password">
                    <div class="form-group">
                        <label class="form-label">Old password</label>
                        <input class="form-input" type="password" name="password" id="password" placeholder="Password">
                        <p class="form-message"></p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">New password</label>
                        <input class="form-input" type="password" name="new_password" id="new_password" placeholder="New password">
                        <p class="form-message"></p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm new password</label>
                        <input class="form-input" type="password" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm new password">
                        <p class="form-message"></p>
                    </div>

                    {{-- <button></button> --}}
                </form>

            </div>

        </div>
</section>
@endpush

@push('js_frame')
<script>
    async function main(){
            await handleInfomartionUser('.login__user');

            handleInput({
                form: '#info-change-password',
                inputs: '.form-input',
                labels: '.form-label',
                css: {
                    fontSize: "16px",
                    top: '-10px',
                    color: 'var(--color-title)',
                }
            })

            handleImport({
                form: '#info-change-password',
                formInput: '.form-input',
                formMessage: '.form-message',
                btnOther: '#change-password-btn',
                rules: [
                    handleImport.isFocus('#password', 'Please enter your Password'),
                    handleImport.isFocus('#new_password', 'Please enter your new Password'),
                    handleImport.isFocus('#confirm_new_password', 'Please confirm your new password'),
                    handleImport.isPassword('#password', 'Password must be at least 8 characters long'),
                    handleImport.isConfirmPassword('#confirm_new_password', 'Re-enter your new password', '#new_password'),
                ],
                isSuccess: function (data) {
                    const newData = {
                        current_password: data.password,
                        new_password: data.new_password,
                    }
                    console.log(newData, data);
                    handleApiMethodPut({
                        data: newData,
                        urlApi: `/api/user/password/${user.userId}`,
                        formMessage: '.form-message',
                        handle: function(data, options) {
                            console.log(data)
                            if(data.error) {
                                const message = document.querySelector(options.formMessage)
                                message.innerText = data.error
                            }else {
                                alert('Password changed successfully.')
                                window.location.reload();
                            }
                        }
                    })
                }
            })

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