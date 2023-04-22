@extends('layouts.front')

@push('css')

@endpush

@section('content')
    <!-- Banner -->
    <section class="banner-section bg--gradient overflow-hidden position-relative border-bottom">
        <div class="hero-bg bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}"></div>
        <div class="container">
            <div class="hero-text">
                <h2 class="hero-text-title">@lang('About US')</h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{route('front.index')}}">@lang('Home')</a>
                    </li>
                    <li>
                        @lang('About US')
                    </li>
                </ul>
            </div>
        </div>
        </div>
    </section>
    <!-- Banner -->


    <!-- About -->
    <section class="about-section overflow-hidden pt-100 pb-100 position-relative">
        <div class="container">
            <div class="row gy-4 gy-sm-5 flex-wrap-reverse align-items-center">
                <div class="col-lg-6">
                    <div class="about--img">
                        <img src="{{ asset('assets/images/'.$ps->about_photo) }}" alt="about">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about--content">
                        <div class="section-header mb-4">
                            <h6 class="section-header__subtitle">@lang('Who We are')</h6>
                            <h2 class="section-header__title">{{ $ps->about_title }}</h2>
                        </div>
                        <p class="about-txt m-0 mb-4">
                            @php
                                echo $ps->about_text;
                            @endphp
                        </p>
                        <a href="{{ $ps->about_link }}" class="cmn--btn">@lang('Read More') <span class="round-effect">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </span></a>
                    </div>
                    <div class="border-top mt-4">
                        <div class="counter-area">
                            @foreach ($counters as $key=>$data)  
                                <div class="counter-item">
                                    <div class="counter-thumb">
                                        <img src="{{asset('assets/images/'.$data->photo)}}" alt="about">
                                    </div>
                                    <div class="counter-content">
                                        <div class="counter-header">
                                            <h4 class="title odometer" data-odometer-final="{{ $data->count }}">0</h4>
                                            <h4 class="title">{{ $data->messurement }}</h4>
                                        </div>
                                        <h6 class="text--base">{{ $data->title }}</h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About -->

    <!-- About Content -->
    <section class="about-content-section pt-100 pb-100 bg--section border-top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <div class="about-text-item">
                       @php
                           echo $ps->about_details;
                       @endphp
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Content -->

    <!-- Choose -->
    @includeIf('partials.front.choose')
    <!-- Choose -->

    <!-- Payment Gateways -->
    @includeIf('partials.front.payment')
    <!-- Payment Gateways -->

@endsection

@push('js')

@endpush