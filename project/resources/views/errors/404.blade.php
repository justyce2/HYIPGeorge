@extends('layouts.front')

@push('css')
    
@endpush

@section('content')
	<!-- Banner -->
	<section class="banner-section bg--gradient overflow-hidden position-relative border-bottom">
		<div class="hero-bg bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}"></div>
		<div class="container">
			<div class="hero-text">
				<h2 class="hero-text-title">@lang('Error Page')</h2>
				<ul class="breadcrumb">
					<li>
						<a href="{{route('front.index')}}">@lang('Home')</a>
					</li>
					<li>
						@lang('404')
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
			<div class="row gy-5 justify-content-center">
				<div class="col-lg-8">
						<div class="section-title text-center">
							<h3>
                {{ $gs->error_title}}
							</h3>
              <div class="error-img">
                <img src="{{ asset('assets/images/'.$gs->error_photo)}}" alt="blog" class="mw-100 my-5">
              </div>

              <p>
                {{ $gs->error_text}}
							</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- About -->

	

@endsection

@push('js')
    
@endpush