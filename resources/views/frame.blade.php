<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/slide.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
    @stack('style')
</head>

<body>
    @section('menu')
        <menu>
            <div class="menu__logo">
                <img src="/img/Initial Fashion Logo Caffe.png" alt="">
            </div>
            <ul class="menu__navbar">
                <li class="menu__navbar-item">
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li class="menu__navbar-item">
                    <a href="menu.html">
                        Menu
                    </a>
                </li>
                <li class="menu__navbar-item">
                    <a href="#footer">
                        About
                    </a>
                </li>
                <li class="menu__navbar-item">
                    <a href="">
                        Contact
                    </a>
                </li>
                <li class="menu__navbar-item">
                    <a href="">
                        <img src="/img/bag.png" alt="" class="icon">
                    </a>
                </li>
                <li class="menu__navbar-item login__user">
                    <a href="login" class="menu__navbar-item__icon">
                        <img style="margin-right: 6px" src="/img/user.png" alt="" class="icon">
                        <span></span>
                    </a>
                </li>
            </ul>
        </menu>
    @show

    @section('slider')
        <div class="slider">
            <div class="slider__slide slider__slide--active" data-slide="1">
                <div class="slider__wrap">
                    <div class="slider__back"></div>
                </div>
                <div class="slider__inner">
                    <div class="slider__content">
                        <h1 style="font-family: var(--font-family-title); color: var(--color-title);">Welcome</h1><a
                            href="menu.html" class="go-to-next">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="slider__slide" data-slide="2">
                <div class="slider__wrap">
                    <div class="slider__back"></div>
                </div>
                <div class="slider__inner">
                    <div class="slider__content">
                        <h1 style="font-family: var(--font-family-title); color: var(--color-title);">Welcome</h1><a
                            href="menu.html" class="go-to-next">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="slider__slide" data-slide="3">
                <div class="slider__wrap">
                    <div class="slider__back"></div>
                </div>
                <div class="slider__inner">
                    <div class="slider__content">
                        <h1 style="font-family: var(--font-family-title); color: var(--color-title);">Welcome</h1><a
                            href="menu.html" class="go-to-next">Order Now</a>
                    </div>
                </div>
            </div>
        <div class="slider__indicators"></div>
    @show
    </div><a class="sig" target="_blank">Manh Khanh</a>

    @stack('body')

    @section('footer')
        <footer id="footer" style="margin: auto; text-align: center;"> About </footer>
    @show

    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="/js/slide.js"></script>
        <script src="/js/main.js"></script>
        @stack('js')
        <script>
            $('a[href*="#"]')
                    // Remove links that don't actually link to anything
                    .not('[href="#"]')
                    .not('[href="#0"]')
                    .click(function (event) {
                        // On-page links
                        if (
                            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                            &&
                            location.hostname == this.hostname
                        ) {
                            // Figure out element to scroll to
                            var target = $(this.hash);
                            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                            // Does a scroll target exist?
                            if (target.length) {
                                // Only prevent default if animation is actually gonna happen
                                event.preventDefault();
                                $('html, body').animate({
                                    scrollTop: target.offset().top
                                }, 1000, function () {
                                    // Callback after animation
                                    // Must change focus!
                                    var $target = $(target);
                                    $target.focus();
                                    if ($target.is(":focus")) { // Checking if the target was focused
                                        return false;
                                    } else {
                                        $target.attr('tabindex', '-1');
                                        $target.focus(); // Set focus again
                                    };
                                });
                            }
                        }
                    });
        </script>
    @show
    
</body>

</html>