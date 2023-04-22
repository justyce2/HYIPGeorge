<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}"> 
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}"> 
    @else
        <meta name="keywords" content="{{ $seo->meta_keys }}">
        <meta name="author" content="GeniusOcean">
    @endif
    <title>{{$gs->title}}</title>

    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/lightbox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/odometer.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/toastr.min.css')}}">

    @if ($default_font->font_value)
        <link href="https://fonts.googleapis.com/css?family={{ $default_font->font_value }}&display=swap" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    @endif

    @if ($default_font->font_family)
        <link rel="stylesheet" id="colorr" href="{{ asset('assets/front/css/font.php?font_familly='.$default_font->font_family) }}">
    @else
        <link rel="stylesheet" id="colorr" href="{{ asset('assets/front/css/font.php?font_familly='."Open Sans") }}">
    @endif

    @stack('css')
    <link rel="shortcut icon" href="{{asset('assets/images/'.$gs->favicon)}}">
</head>

<body>
    <!-- Overlayer -->
    <span class="toTopBtn">
        <i class="fas fa-angle-up"></i>
    </span>
    <div class="overlayer"></div>
    <div class="loader"></div>
    <div class="particle"></div>
    <div class="particle2"></div>
    <div class="particle3"></div>
    <div class="particle4"></div>
    <!-- Overlayer -->

    <!-- Account Section -->
    <section class="accounts-section">
        <div class="accounts-inner">
            <div class="accounts-inner__wrapper bg--section">
                
                       
                        <div class="section-header">
                             <a href="{{ url('/') }}">
                            <img src="{{asset('assets/images/'.$gs->logo)}}" max-width="70%" alt="logo" />
                        </a>
                            <h6 class="section-header__subtitle"></h6>
                            <h3 class="section-header__title">@lang('Sign in to Genius Hyip')</h3>
                            <p>
                                {{ $ps->login_title}}
                            </p>
                        </div>
                        <form class="row gy-4" id="loginform" action="{{ route('user.login.submit') }}" method="POST">
                            @includeIf('includes.user.form-both')
                            @csrf
                            <div class="col-sm-12">
                                <label for="username" class="form-label">@lang('Your Email')</label>
                                <input type="email" name="email" id="username" class="form-control" value="{{ old('email') }}">
                            </div>
                            <div class="col-sm-12">
                                <label for="password" class="form-label">@lang('Your Password')</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-12 mt-2">
                                <div class="d-flex flex-wrap justify-content-between">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input"
                                            checked>
                                        <label for="remember" class="form-check-label">@lang('Remember Me')</label>
                                    </div>
                                    <a href="{{route('user.forgot')}}" class="text--base">@lang('Forget Password')</a>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button class="cmn--btn">@lang('Sign In')</button>
                            </div>
                            <div class="col-sm-12">
                                @lang('Not Registered Yet ?') <a href="{{route('user.register')}}" class="text--base">@lang('Create an
                                    Account')</a>
                            </div>
                        </form>
                    
               <!-- <div class="accounts-right bg--blue">
                    <img src="{{asset('assets/images/'.$ps->login_banner)}}" alt="images">
                    <div class="section-header text-center text-white mb-0">
                        <h6 class="section-header__subtitle"></h6>
                        <h3 class="section-header__title">{{ $ps->login_title}}</h3>
                        <p>
                            @php
                                echo $ps->login_subtitle;
                            @endphp
                        </p>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    <!-- Accounts Section -->

    <script src="{{asset('assets/front/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/front/js/viewport.jquery.js')}}"></script>
    <script src="{{asset('assets/front/js/odometer.min.js')}}"></script>
    <script src="{{asset('assets/front/js/lightbox.min.js')}}"></script>
    <script src="{{asset('assets/front/js/owl.min.js')}}"></script>
    <script src="{{asset('assets/front/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/front/js/notify.js')}}"></script>
    <script src="{{asset('assets/front/js/main.js')}}"></script>
    <script src="{{asset('assets/front/js/custom.js')}}"></script>

</body>

</html>