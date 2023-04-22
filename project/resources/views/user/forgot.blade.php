@extends('layouts.front')

@push('css')
    
@endpush

@section('content')

	<!-- Banner -->
	<section class="banner-section bg--gradient overflow-hidden position-relative border-bottom">
		<div class="hero-bg bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}"></div>
		<div class="container">
			<div class="hero-text">
				<h2 class="hero-text-title">@lang('Forgot Password')</h2>
				<ul class="breadcrumb">
					<li>
						<a href="{{route('front.index')}}">@lang('Home')</a>
					</li>
					<li>
						@lang('Forgot Password')
					</li>
				</ul>
			</div>
		</div>
		</div>
	</section>
	<!-- Banner -->



    <!-- Account -->
    <section class="account-section pt-100 pb-100">
        <div class="container">
            <div class="account-wrapper bg--body">
                <div class="section-title mb-3">
                    <h3 class="title">@lang('Forgot Password')</h3>
                </div>
                <form class="account-form row gy-3 gx-4 align-items-center" id="" action="{{ route('user.forgot.submit') }}" method="POST">
                    @includeIf('includes.user.form-both')
                    @csrf
                    <div class="col-sm-12">
                        <label for="email" class="form-label">@lang('Your Email')</label>
                        <input type="text" id="email" name="email" class="form-control form--control">
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="cmn--btn bg--base me-3">
                            @lang('Submit')
                        </button>
                        
                       
                        <div class="d-flex flex-wrap justify-content-between align-items-center mt-2">
                            <a href="{{ route('user.login') }}" class="text--base mt-1">@lang('Login Now?')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Account -->


@endsection

@push('js')
    
@endpush