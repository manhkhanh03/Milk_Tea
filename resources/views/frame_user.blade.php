@extends('frame')

@section('title', 'Milk Tea User Profile')

@push('style')
<link rel="stylesheet" href="/css/user_profile.css">
<link rel="stylesheet" href="/css/login.css">
@stack('style-css')
@endpush

@section('menu')
@parent
@endsection

@section('slider')
@endsection
{{-- @push('banner')
<div class="slider">
    <div class="slider__slide slider__slide--active" data-slide="1">
        <div class="slider__wrap">
            <div class="slider__back"></div>
        </div>
        <div class="slider__inner">
            <div class="slider__content">
                <h1 style="font-family: var(--font-family-title); color: var(--color-title);">User Profile
                </h1><a href="#order" class="go-to-next">Order Now</a>
            </div>
        </div>
    </div>
</div>
@endpush --}}

@push('body')    
@stack('body_frame')
@endpush

@section('footer')
@endsection

@section('scripts')
@push('js')
<script src="/js/user_profile.js"></script>
<script src="/js/login.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stack('js_frame')
<script>
</script>
@endpush
@parent
@endsection