@extends('layouts.front')

@push('css')

@endpush

@section('content')
    <!-- Banner -->
    <section class="banner-section bg--gradient overflow-hidden position-relative border-bottom">
        <div class="hero-bg bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}"></div>
        <div class="container">
            <div class="hero-text">
                <h2 class="hero-text-title">@lang('Contact US')</h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('front.index') }}">@lang('Home')</a>
                    </li>
                    <li>
                        @lang('Contact US')
                    </li>
                </ul>
            </div>
        </div>
        </div>
    </section>
    <!-- Banner -->


    <!-- Contact Section -->
    <section class="contact-section overflow-hidden bg--gradient-light pb-100 pt-100 border-bottom">
        <div class="container">
            <div class="row gy-5 flex-wrap-reverse">
                <div class="col-lg-6">
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe width="600" height="400" id="gmap_canvas"
                                src="https://maps.google.com/maps?q={{ $gs->latitude }},{{ $gs->longitude }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ms-xl-4 ms-xxl-5">
                        <div class="section-header">
                            <h6 class="section-header__subtitle mt-0">@lang('Contact US')</h6>
                            <h2 class="section-header__title">{{ $ps->side_title }}</h2>
                            <p>
                                {{ $ps->side_text }}
                            </p>
                        </div>
                        <div class="contact-area">
                            <div class="contact__item">
                                <div class="contact__item-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact__item-cont">
                                    <h6 class="contact__item-cont-title">@lang('Headquater')</h6>
                                    <span class="text--base">
                                        {{$ps->street}}
                                    </span>
                                </div>
                            </div>
                            <div class="contact__item">
                                <div class="contact__item-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact__item-cont">
                                    <h6 class="contact__item-cont-title">@lang('Call US')</h6>
                                    <a href="{{ $ps->phone}}" class="text--base">{{ $ps->phone}}</a>
                                </div>
                            </div>
                            <div class="contact__item">
                                <div class="contact__item-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact__item-cont">
                                    <h6 class="contact__item-cont-title">@lang('Email US')</h6>
                                    <a href="mailto:{{$ps->email}}" class="text--base">{{$ps->email}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="contact-wrapper bg--body border rounded">
                    <div class="section-header">
                        <h3 class="section-header__subtitle mb-0">@lang('Send Message to Get Connected')</h3>
                    </div>
                    <form class="row g-4" action="{{route('front.contact.submit')}}" id="contactform">
                        @csrf
                        <div class="col-sm-6 form-group">
                            <label for="name" class="form-label">@lang('Your Name')</label>
                            <input type="text" name="name" class="form-control bg--section" id="name">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="email" class="form-label">@lang('Your Email')</label>
                            <input type="email" name="email" class="form-control bg--section" id="email">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="phone" class="form-label">@lang('Your Phone')</label>
                            <input type="text" name="phone" class="form-control bg--section" id="phone">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="subject" class="form-label">@lang('Your Subject')</label>
                            <select name="subject" id="subject" class="form-control bg--section">
                                <option value="Investment">@lang('Investment')</option>
                                <option value="Withdraw">@lang('Withdraw')</option>
                                <option value="Transaction">@lang('Transaction')</option>
                                <option value="Deposit">@lang('Deposit')</option>
                            </select>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="phone" class="form-label">@lang('Your Message')</label>
                            <textarea name="message" id="message" class="form-control bg--section"></textarea>
                        </div>

                        <div class="col-sm-12">
                            <button class="cmn--btn w-100" type="submit">@lang('Send Message')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section -->

    <!-- Payment Gateways -->
    @includeIf('partials.front.payment')
    <!-- Payment Gateways -->

@endsection

@push('js')

@endpush
