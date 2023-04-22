@extends('layouts.front')

@section('content')
  <!-- Banner -->
  <section class="banner-section bg--gradient overflow-hidden position-relative border-bottom">
    <div class="hero-bg bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}"></div>
    <div class="container">
        <div class="hero-text">
            <h2 class="hero-text-title">@lang('OTP')</h2>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('front.index') }}">@lang('Home')</a>
                </li>
                <li>
                    @lang('OTP')
                </li>
            </ul>
        </div>
    </div>
    </div>
  </section>
 <!-- Banner -->

 <section class="account-section pt-100 pb-100">
  <div class="container">
      <div class="account-wrapper bg--body">
          <div class="section-title mb-3">
              <h3 class="title">@lang('Otp verification')</h3>
          </div>
          <form action="{{ route('user.otp.submit') }}" method="POST">
              @includeIf('includes.user.form-both')
              @csrf
              <div class="col-lg-12">
                <div class="form-input">
                  <input type="text" class="form-control" name="otp" placeholder="@lang('Type Your otp')" required="">
                </div>
              </div>

              <div class="col-sm-12">
                  <button type="submit" class="cmn--btn bg--base me-3 mt-2">
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

@endsection

@section('scripts')

<script src="{{asset('assets/user/js/sweetalert2@9.js')}}"></script>

@if($errors->any())
    @foreach ($errors->all() as $error)
        <script>
          "use strict";
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
            Toast.fire({
            icon: 'error',
            title: '{{ $error }}'
            })
        </script>
    @endforeach
@endif
@endsection