@extends('layouts.front')

@push('css')

@endpush

@section('content')
	<!-- Banner -->
	<section class="banner-section bg--gradient overflow-hidden position-relative border-bottom">
		<div class="hero-bg bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}"></div>
		<div class="container">
			<div class="hero-text">
				<h2 class="hero-text-title">@lang('Investment Plan')</h2>
				<ul class="breadcrumb">
					<li>
						<a href="{{ route('front.index') }}">@lang('Home')</a>
					</li>
					<li>
						@lang('Invest Plan')
					</li>
				</ul>
			</div>
		</div>
		</div>
	</section>
	<!-- Banner -->

    <!-- Investment Plan -->
    <section class="investment-plan-section overflow-hidden bg--gradient-light pb-100 pt-100">
        <div class="container">
            <div class="pricing--wrapper row g-3 g-md-4 g-lg-3 g-xxl-4 justify-content-center">
                @if (count($plans) == 0)
                    <div class="col-12 text-center">
                            <h3 class="m-0">{{__('No Plan Found')}}</h3>
                    </div>
                @else
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
                @endif
            </div>
        </div>
    </section>
    <!-- Investment Plan -->

    <!-- Choose -->
    @includeIf('partials.front.choose')
    <!-- Choose -->

    <!-- Payment Gateways -->
    @includeIf('partials.front.payment')
    <!-- Payment Gateways -->

@endsection

@push('js')

@endpush
