@extends('layouts.front')

@push('css')
    
@endpush

@section('content')
	<!-- Banner -->
	<section class="banner-section bg--gradient overflow-hidden position-relative border-bottom">
		<div class="hero-bg bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}"></div>
		<div class="container">
			<div class="hero-text">
				<h2 class="hero-text-title">{{ $page->title }}</h2>
				<ul class="breadcrumb">
					<li>
						<a href="{{route('front.index')}}">@lang('Home')</a>
					</li>
					<li>
						@lang('Pages')
					</li>
				</ul>
			</div>
		</div>
		</div>
	</section>
	<!-- Banner -->


	<!-- About -->
	<section class="about-section pt-100 pb-50">
		<div class="container">
			<div class="row gy-5">
				<div class="col-lg-12">
					<div class="about-content">
						<div class="section-title">
							<p>
								@php
									echo $page->details;
								@endphp
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- About -->

	

@endsection

@push('js')
    
@endpush