@extends('layouts.front')

@push('css')
    
@endpush

@section('content')
    <!-- Banner -->
    <section class="banner-section bg--gradient overflow-hidden">
        <div class="particle"></div>
        <div class="particle2"></div>
        <div class="particle3"></div>
        <div class="particle4"></div>
        <div class="banner-bg bg_img" data-img="{{ asset('assets/images/'.$ps->hero_photo) }}">
            <div class="container">
                <div class="banner-wrapper">
                    <div class="banner-cont text--light">
                        <h1 class="title text--base">{{ $ps->hero_title }}</h1>
                        <p>
                            {{ $ps->hero_subtitle }}
                        </p>
                        <div class="btn__grp">
                            <a href="{{ $ps->hero_btn_url }}" class="cmn--btn">@lang('Get Started') <span class="round-effect">
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </span></a>
                            <a href="{{ $ps->hero_link }}" class="video--btn" data-lightbox>
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
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
                        <a href="{{ $ps->about_link }}" class="cmn--btn">@lang('Read More') 
                            <span class="round-effect">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </span>
                        </a>
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

    <!-- Profit Calculator -->
    <section class="profit-calculator pt-100 pb-100 bg--shapes overflow-hidden">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="profit-thumb">
                        <img src="{{ asset('assets/images/'.$ps->profit_banner) }}" alt="profit">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="profit-calculator-area">
                        <div class="section-header text-lg-start">
                            <h6 class="section-header__subtitle">@lang('Profit Calculator')</h6>
                            <h2 class="section-header__title">{{ $ps->profit_title }}</h2>
                            <p>
                               @php
                                   echo $ps->profit_text;
                               @endphp
                            </p>
                        </div>
                        <form id="profitCalculate" class="row gy-4" action="{{ route('front.profit.calculate') }}" method="POST">
                            @includeIf('includes.user.form-both')
                            @csrf
                            <div class="col-md-6">
                                <label for="select-plan" class="form-label">@lang('Select Plan')</label>
                                <select name="plan" id="select-plan" class="form-control form--control bg--section">
                                    @foreach ($plans as $key=>$data)
                                        <option value="{{ $data->id }}">{{ $data->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="amount" class="form-label">@lang('Enter Amount')</label>
                                <input type="number" name="amount" class="form-control form--control bg--section" placeholder="0.00">
                            </div>
                            <div class="col-md-12">
                                <label for="profit-amount" class="form-label">@lang('Profit Amount')</label>
                                <input type="text" class="form-control form--control bg--section" id="profit-calculate-amount"
                                    value="0.00" readonly>
                            </div>
                            <div class="col-md-12">
                                <button class="cmn--btn" type="submit">@lang('Calculate Now')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Profit Calculator -->

    <!-- Investment Plan -->
    <section class="investment-plan-section overflow-hidden bg--gradient-light pb-50 pt-100 border-top">
        <div class="container">
            <div class="section-header text-center">
                <h6 class="section-header__subtitle">@lang('Pricing Plan')</h6>
                <h2 class="section-header__title">{{ $ps->plan_title }}</h2>
                <p>
                    @php
                        echo $ps->plan_subtitle;
                    @endphp
                </p>
            </div>
            <div class="pricing--wrapper row g-3 g-md-4 g-lg-3 g-xxl-4 justify-content-center">
                @foreach ($plans as $key=>$data)
                @php
                    $schedule = \App\Models\ManageSchedule::where('time',$data->schedule_hour)->first();
                @endphp
                    <div class="col-lg-3 col-sm-6 col-md-6">
                        <div class="plan__item">
                            <div class="plan__item-header">
                                <div class="left">
                                    <h5 class="title">{{ $data->title }}</h5>
                                    <span>{{ $data->subtitle }}</span>
                                </div>
                                <div class="right">
                                    <h5 class="title">{{ $data->profit_percentage }}%</h5>
                                    <span>@lang('Return')</span>
                                </div>
                            </div>
                            <div class="plan__item-body">
                                <ul>
                                    <li>
                                        <span class="name">@lang('Profit')</span>
                                        <span class="info">
                                            {{ $data->lifetime_return == 1 ? 'Lifetime' :  'Every '.$schedule->name }}
                                        </span>
                                    </li>

                                    <li>
                                        <span class="name me-1">@lang('Capital will back')</span>
                                        <span class="badge align-self-center me-auto bg--{{ $data->captial_return == 1 ? 'primary' : 'danger'}}">{{ $data->captial_return == 1 ? 'Yes' : 'No'}}</span>
                                    </li>

                                    <li>
                                        <span class="name {{ $data->profit_repeat == NULL ?? me-1 }}">@lang('Repeatable')</span>
                                        @if ($data->profit_repeat == NULL)  
                                            <span class="badge align-self-center me-auto bg--danger">@lang('NO')</span>
                                        @else 
                                            <span class="info">
                                                {{ $data->profit_repeat.' Times' }}
                                            </span>
                                        @endif
                                    </li>
                                </ul>
                                
                                @if ($data->invest_type == 'range')
                                    <h6 class="text-center amount-range">{{ showPrice($data->min_amount) }} - {{ showPrice($data->max_amount) }}</h6>
                                @else 
                                    <h6 class="text-center amount-range">{{ showPrice($data->fixed_amount) }}</h6>
                                @endif
                                <button class="cmn--btn w-100 invest-plan" type="button" data-bs-toggle="modal"
                                    data-bs-target="#invest-modal" data-title="{{ $data->title }}" data-id="{{ $data->id }}" data-type="{{ $data->invest_type == 'range' ? 0 : 1}}" data-fixAmount="{{ rootPrice($data->fixed_amount) }}">
                                    @lang('Invest Now')
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('front.plans') }}" class="cmn--btn btn-outline">@lang('All Packages')</a>
            </div>
        </div>
    </section>
    <!-- Investment Plan -->

    <!-- Partners -->
    <section class="partner-section pt-50 pb-50 overflow-hidden bg--gradient-light">
        <div class="container">
            <div class="partner-slider owl-theme owl-carousel">
                @foreach ($partners as $key=>$data) 
                    <div class="partner-item border">
                        <img src="{{asset('assets/images/'.$data->photo)}}" alt="brand">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Partners -->

    <!-- Transactions -->
    <section class="transactions-section pt-50 pb-100 bg--gradient-light">
        <div class="container">
            <ul class="nav nav-tabs nav--tabs justify-content-center mb-4">
                <li>
                    <a href="#deposit-log" class="cmn--btn active" data-bs-toggle="tab">@lang('Deposit Log')</a>
                </li>
                <li>
                    <a href="#withdraw-log" class="cmn--btn" data-bs-toggle="tab">@lang('Withdraw Log')</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="deposit-log">
                    <div class="table-responsive table--mobile-lg">
                        <table class="table table-mobile-lg bg--body">
                            <thead>
                                <tr>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Transaction Number')</th>
                                    <th>@lang('Method')</th>
                                    <th>@lang('Account Name')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Status')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (getDeposits() as $key=>$data)
                                    @php
                                        $user = App\Models\User::whereId($data->user_id)->first();
                                    @endphp
                                    <tr>
                                        <td data-label="Date">{{ $data->created_at->format('M d, Y')}}</td>
                                        <td data-label="Transaction Number">{{ strtoupper($data->deposit_number) }}</td>
                                        <td data-label="Method">{{ ucfirst($data->method) }}</td>
                                        <td data-label="Account Name">{{ $user != NULL ? $user->name : 'Customer Deleted'}}</td>
                                        <td data-label="Amount">{{ showPrice($data->amount) }}</td>
                                        <td data-label="Status">
                                            @if ($data->status == 'pending')
                                                <span class="badge badge--warning">@lang('Pending')</span>
                                            @else 
                                                <span class="badge badge--success">@lang('Completed')</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="withdraw-log">
                    <div class="table-responsive table--mobile-lg">
                        <table class="table table-mobile-lg bg--body">
                            <thead>
                                <tr>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Transaction no')</th>
                                    <th>@lang('Method')</th>
                                    <th>@lang('Account Name')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Fee')</th>
                                    <th>@lang('Status')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (getWithdraws() as $key=>$data)
                                    @php
                                        $user = App\Models\User::whereId($data->user_id)->first();
                                    @endphp
                                    <tr>
                                        <td data-label="Date">{{ $data->created_at->format('M d, Y') }}</td>
                                        <td data-label="Transaction Number">{{ strtoupper($data->txnid) }}</td>
                                        <td data-label="Method">{{ ucfirst($data->method) }}</td>
                                        <td data-label="Account Name">{{ $user != NULL ? $user->name : 'Customer Deleted'}}</td>
                                        <td data-label="Amount">{{ showPrice($data->amount) }}</td>
                                        <td data-label="Fee">{{ showPrice($data->fee) }}</td>
                                        <td data-label="Status">
                                            @if ($data->status == 'pending')
                                                <span class="badge badge--warning">@lang('Pending')</span>
                                            @elseif($data->status == 'completed')
                                                <span class="badge badge--success">@lang('Completed')</span>
                                            @else 
                                                <span class="badge badge--danger">@lang('Rejected')</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Transactions -->

    <!-- How To Start -->
    <section class="how-to-start-section pt-100 border-top border-bottom overflow-hidden">
        <div class="container">
            <div class="row align-items-center flex-wrap-reverse gy-5">
                <div class="col-lg-6">
                    <div class="pe-xl-4 pe-xxl-5">
                        <div class="section-header text-lg-end">
                            <h6 class="section-header__subtitle">@lang('How To Get Started')</h6>
                            <h2 class="section-header__title">{{ $ps->start_title }}</h2>
                            <p>
                                @php
                                    echo $ps->start_text;
                                @endphp
                            </p>
                        </div>
                        <div class="how-wrapper">
                            @foreach ($process as $key=>$data)
                                <div class="how__item">
                                    <div class="how__item-thumb">
                                        <i class="{{$data->icon}}"></i>
                                    </div>
                                    <div class="how__item-content">
                                        <h5 class="how__item-title text--base">
                                            {{ $data->title}}
                                        </h5>
                                        <p>
                                           @php
                                               echo $data->details;
                                           @endphp
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="how-thumb">
                        <img src="{{asset('assets/images/'.$ps->start_photo)}}" alt="about" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- How To Start -->

    <!-- Choose -->
    @includeIf('partials.front.choose')
    <!-- Choose -->

    <!-- Referral -->
    <section class="referral-section pt-50 pb-100">
        <div class="container">
            <div class="row align-items-center justify-content-between flex-wrap-reverse">
                <div class="col-lg-6 col-xl-5">
                  <!--  <div class="referral-thumb">
                        <img src="{{ asset('assets/images/'.$ps->referral_banner) }}" alt="about">
                    </div>-->
                    <div class="referral-thumb">
                        <img src="{{ asset('assets/images/'.$ps->start_photo) }}" alt="about">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-header mb-lg-0">
                        <h6 class="section-header__subtitle">@lang('Referral Comission')</h6>
                        <h2 class="section-header__title">{{ $ps->referral_title }}</h2>
                        <p>
                            @php
                                echo $ps->referral_text;
                            @endphp
                        </p>
                        <div class="comission-area">
                            @if ($ps->referral_percentage)
                                @foreach (json_decode($ps->referral_percentage,true) as $key=>$data)
                                    <div class="comission-item">
                                        <div class="thumb">
                                            {{$data}}%
                                        </div>
                                        <div class="cont">
                                            <div class="name">@lang('Level 0') {{ $key + 1}}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <a href="#" class="cmn--btn">
                            @lang('Send Referral Link') <span class="round-effect"><i
                                    class="fas fa-long-arrow-alt-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Referral -->

    <!-- Team Members -->
    <section class="team-section pt-100 bg--section pb-100 border-top">
        <div class="container">
            <div class="section-header text-center">
                <h6 class="section-header__subtitle">@lang('Team')</h6>
                <h2 class="section-header__title">{{ $ps->team_title }}</h2>
                <p>
                    @php
                        echo $ps->team_text;
                    @endphp
                </p>
            </div>
            <div class="row g-md-3 g-4 g-xl-4 justify-content-center">
                @foreach ($teams as $key=>$data)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="team__card bg--section">
                            <div class="team__card-cont" style="color:#fff">
                             <!-- <div class="team__card-img" >
                              <img src="{{asset('assets/images/'.$data->photo)}}" alt="team">
                               
                            </div>-->
                            
                                <h6 class="team__card-cont-title">{{ $data->name }}</h6>
                              <!--  <ul class="social-icons py-1 py-md-0 me-md-auto">
                                    <li>
                                        <a href="{{ $data->fb_link }}"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ $data->twitter_link }}"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ $data->instra_link }}"><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ $data->linkedin_link }}"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ $data->youtube_link }}"><i class="fab fa-youtube"></i></a>
                                    </li>
                                </ul>-->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Team Members -->

    <!-- Testimonials -->
    <section class="testimonial-section pt-100 pb-50 border-top">
        <div class="container">
            <div class="client__slider owl-theme owl-carousel">
                @foreach ($testimonials as $key=>$data)
                    <div class="client__item">
                        <div class="client__item-img">
                            <img src="{{ asset('assets/images/'.$data->photo) }}" alt="clients">
                        </div>
                        <div class="client__item-cont bg--section">
                            <div class="section-header">
                                <h6 class="section-header__subtitle">{{ $data->title }}</h6>
                                <h3 class="section-header__title">{{ $data->subtitle }}</h3>
                            </div>
                           <blockquote class="quote">
                                @php
                                    echo $data->details;
                                @endphp
                            </blockquote>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Testimonials -->

    <!-- CTAs -->
    <section class="ctas-section bg--gradient position-relative overflow-hidden" style="background: {{ $ps->call_bg }}">
        <div class="particle"></div>
        <div class="particle2"></div>
        <div class="particle3"></div>
        <div class="particle4"></div>
        <div class="container">
            <div class="section-header text-center text-white mb-0">
                <h6 class="section-header__subtitle">{{ $ps->call_title }}?</h6>
                <h2 class="section-header__title">{{ $ps->call_subtitle }}</h2>
                <a href="{{ $ps->call_link }}" class="cmn--btn">
                    @lang('Get Started')
                    <span class="round-effect"><i class="fas fa-long-arrow-alt-right"></i></span>
                </a>
            </div>
        </div>
    </section>
    <!-- CTAs -->

    <!-- Blogs -->
    <section class="blog-section pt-100 pb-50 border-top">
        <div class="container">
            <div class="section-header">
                <h6 class="section-header__subtitle">@lang('Blog Posts')</h6>
                <h2 class="section-header__title">{{ $ps->blog_title }}</h2>
                <p>
                    @php
                        echo $ps->blog_text;
                    @endphp
                </p>
            </div>
            <div class="row g-4 g-lg-3 g-xl-4 justify-content-center">
                @foreach ($blogs as $key=>$data)
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="blog__item">
                            <a href="{{ route('blog.details',$data->slug) }}" class="blog-link">&nbsp;</a>
                            <div class="blog__item-img">
                                <img src="{{asset('assets/images/'.$data->photo)}}" alt="blog">
                                <span class="date">
                                    <span>{{ $data->created_at->format('M') }}</span>
                                    <span>{{ $data->created_at->format('d') }}</span>
                                </span>
                            </div>
                            <div class="blog__item-cont">
                                <h5 class="blog__item-cont-title line--2">
                                    {{ Str::limit($data->title,30) }}
                                </h5>
                                <p class="line--3">
                                    {{ Str::limit($data->details,90) }}

                                </p>

                                <div class="blog__author">
                                    <div class="author">
                                        <img src="{{ asset('assets/images/'.getAdmin()->photo)}}" alt="blog">
                                        <h6>@lang('Admin')</h6>
                                    </div>
                                    <span class="read--more">@lang('Read More')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blogs -->

    <!-- Payment Gateways -->
    @includeIf('partials.front.payment')
    <!-- Payment Gateways -->

@endsection

@push('js')
    
@endpush