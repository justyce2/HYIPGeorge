@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')

<div class="breadcrumb-area">
  <h3 class="title">@lang('User Profile')</h3>
  <ul class="breadcrumb">
      <li>
          <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
      </li>
      <li>
        @lang('User Profile')
      </li>
  </ul>
</div>
<div class="dashboard--content-item">
  @includeIf('includes.flash')
  <form id="request-form" action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="profile--card">
      <div class="user--profile mb-5">
          <div class="thumb">
              <img src="{{ auth()->user()->photo ? asset('assets/images/'.auth()->user()->photo) : asset('assets/front/images/clients/client2.jpg') }}" alt="clients">
          </div>
          <div class="remove-thumb">
              <i class="fas fa-times"></i>
          </div>
          <div class="content">
              <div>
                  <h3 class="title">
                      {{ auth()->user()->name }}
                  </h3>
                  <a href="#0" class="text--base">
                      {{ auth()->user()->email }}
                  </a>
              </div>
              <div class="mt-4">
                  <label class="btn btn-sm btn--base text--dark">
                      @lang('Update Profile Picture')
                      <input type="file" id="profile-image-upload" name="photo" hidden>
                  </label>
              </div>
          </div>
      </div>

          <div class="row gy-4">
              <div class="col-sm-6 col-xxl-4">
                  <label for="name" class="form-label">@lang('Name')</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
              </div>

              <div class="col-sm-6 col-xxl-4">
                  <label for="email" class="form-label">@lang('Email Address')</label>
                  <input type="email" id="email" class="form-control"
                      value="{{ $user->email }}" readonly>
              </div>

              <div class="col-sm-6 col-xxl-4">
                  <label for="phone" class="form-label">@lang('Phone Number')</label>
                  <div class="input-group">
                      <label for="phone" class="input-group-text">+123</label>
                      <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
                  </div>
              </div>

              <div class="col-sm-6 col-xxl-4">
                  <label for="name" class="form-label">@lang('Zip')</label>
                  <input type="text" name="zip" class="form-control" value="{{ $user->zip }}">
              </div>

              <div class="col-sm-6 col-xxl-4">
                <label for="city" class="form-label">@lang('City')</label>
                <input type="text" name="city" id="city" class="form-control" value="{{ $user->city }}">
              </div>

              <div class="col-sm-6 col-xxl-4">
                <label for="last-name" class="form-label">@lang('Fax')</label>
                <input type="text" id="last-name" name="fax" class="form-control" value="{{ $user->fax }}">
              </div>

              <div class="col-sm-6 col-xxl-4">
                <label for="address" class="form-label">@lang('Address')</label>
                <input type="text" id="address"  name="address" class="form-control" value="{{ $user->address }}">
              </div>

              <div class="col-sm-6 col-xxl-4">
                
              </div>

              <div class="col-sm-12">
                  <div class="text-end">
                      <button type="submit" class="cmn--btn">@lang('Update Profile')</button>
                  </div>
              </div>
          </div>
        </div>
      </form>
</div>
@endsection

@push('js')
<script>
  "use strict"
  var prevImg = $('.user--profile .thumb').html();
  function proPicURL(input) {
      if (input.files && input.files[0]) {
          var uploadedFile = new FileReader();
          uploadedFile.onload = function (e) {
              var preview = $('.user--profile').find('.thumb');
              preview.html(`<img src="${e.target.result}" alt="user">`);
              preview.addClass('image-loaded');
              preview.hide();
              preview.fadeIn(650);
              $(".image-view").hide();
              $(".remove-thumb").show();
          }
          uploadedFile.readAsDataURL(input.files[0]);
      }
  }
  $("#profile-image-upload").on('change', function () {
      proPicURL(this);
  });
  $(".remove-thumb").on('click', function () {
      $(".user--profile .thumb").html(prevImg);
      $(".user--profile .thumb").removeClass('image-loaded');
      $(".image-view").show();
      $(this).hide();
  })
</script>
@endpush
