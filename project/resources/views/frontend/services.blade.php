@extends('layouts.front')

@push('css')
    
@endpush

@section('content')

	<!-- Hero -->
	<section class="hero-section bg--overlay bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}">
		<div class="container">
			<div class="hero-content">
				<h2 class="hero-title">@lang('Service')</h2>
				<ul class="breadcrumb">
					<li>
						<a href="{{route('front.index')}}">@lang('Home')</a>
					</li>
					<li>
						@lang('Service')
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- Hero -->

	<!-- Service -->
	<section class="service-section pt-100 pb-100">
		<div class="container">
			<div class="row g-4 g-xxl-4 g-xl-3 justify-content-center">
				@if (count($services) == 0)
					<div class="card">
						<div class="card-body">
							<h3 class="text-center">{{__('No Service Found')}}</h3>
						</div>
					</div>
				@else 
					@foreach ($services as $key=>$data)
						<div class="col-md-6 col-xl-4">
							<div class="service-item">
								<div class="service-item__icon">
									<i class="fas fa-piggy-bank"></i>
								</div>
								<div class="service-item__cont">
									<h5 class="service-item__cont-title">
										{{$data->title}}
									</h5>
									<p>
										@php
											echo $data->details;
										@endphp
									</p>
								</div>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</section>
	<!-- Service -->

	<!-- CTAs -->
	@includeIf('partials.front.cta')
	<!-- CTAs -->

	<!-- Faqs -->
	<section class="faqs-section pt-100 pb-100">
		<div class="container">
			<div class="row justify-content-center gy-3">
				@foreach ($faqs->chunk(3) as $faqs)
					<div class="col-lg-6">
						<div class="accordion-wrapper">
								@foreach ($faqs as $key=>$data)
								<div class="accordion-item {{ $loop->first ? 'active open' : ''}}">
									<div class="accordion-title">
										<h6 class="title">
											{{$data->title}}
										</h6>
										<span class="icon"></span>
									</div>
									<div class="accordion-content">
										@php
											echo $data->details;
										@endphp
									</div>
								</div>
								@endforeach
							</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Faqs -->

@endsection

@push('js')
    
@endpush