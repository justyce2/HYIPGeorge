@extends('layouts.front')

@push('css')

@endpush

@section('content')
	<!-- Banner -->
	<section class="banner-section bg--gradient overflow-hidden position-relative border-bottom">
		<div class="hero-bg bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}"></div>
		<div class="container">
			<div class="hero-text">
				<h2 class="hero-text-title">@lang('Latest News & Tips')</h2>
				<ul class="breadcrumb">
					<li>
						<a href="{{route('front.index')}}">@lang('Home')</a>
					</li>
					<li>
						@lang('News & Tips')
					</li>
				</ul>
			</div>
		</div>
		</div>
	</section>
	<!-- Banner -->


	<!-- Blog Section -->
	<section class="blog-section overflow-hidden pb-100 pt-100">
		<div class="container">
			<div class="row g-4 g-lg-3 g-xl-4 justify-content-center">
				@if (count($blogs) == 0)
					<div class="col-12 text-center">
							<h3 class="m-0">{{__('No Blog Found')}}</h3>
					</div>
				@else
					@foreach ($blogs as $key=>$data)
						<div class="col-lg-4 col-md-6 col-sm-10">
							<div class="blog__item">
								<a href="{{ route('blog.details',$data->slug) }}" class="blog-link">&nbsp;</a>
								<div class="blog__item-img">
									<img src="{{asset('assets/images/'.$data->photo)}}"" alt="blog">
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
										{{ Str::limit($data->details,100) }}
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
				@endif
			</div>
		</div>
	</section>
	<!-- Blog Section -->

@endsection

@push('js')

@endpush
