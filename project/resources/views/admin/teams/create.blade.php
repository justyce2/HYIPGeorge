@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add New Member') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.teams.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
    <ol class="breadcrumb py-0 m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
    </ol>
  </div>
</div>

<div class="card mb-4 mt-3">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">{{ __('Member Form') }}</h6>
  </div>

  <div class="card-body">
    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
    <form class="geniusform" action="{{route('admin.teams.store')}}" method="POST" enctype="multipart/form-data">

        @include('includes.admin.form-both')

        {{ csrf_field() }}

        <div class="form-group">
          <label for="inp-name">{{  __('Name')  }}</label>
          <input type="text" class="form-control" id="inp-name" name="name"  placeholder="{{ __('Enter Name') }}" value="" required>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook-square"></i></span>
          </div>
          <input type="text" class="form-control" name="fb_link" placeholder="@lang('Facebook Link')" aria-label="@lang('Facebook Link')" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fab fa-twitter"></i></span>
          </div>
          <input type="text" class="form-control" name="fb_link" placeholder="@lang('Twitter Link')" aria-label="@lang('Twitter Link')" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fab fa-instagram"></i></span>
          </div>
          <input type="text" class="form-control" name="instra_link" placeholder="@lang('Instragram Link')" aria-label="@lang('Instragram Link')" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fab fa-linkedin-in"></i></span>
          </div>
          <input type="text" class="form-control" name="linkedin_link" placeholder="@lang('Linkedin Link')" aria-label="@lang('Linkedin Link')" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fab fa-youtube"></i></span>
          </div>
          <input type="text" class="form-control" name="youtube_link" placeholder="@lang('Youtube Link')" aria-label="@lang('Youtube Link')" aria-describedby="basic-addon1">
        </div>

        <div class="form-group">
          <label>{{ __('Set Background Image') }}</label>
          <div class="wrapper-image-preview">
              <div class="box full-width">
                  <div class="back-preview-image" style="background-image: url({{ asset('assets/images/placeholder.jpg') }});"></div>
                  <div class="upload-options">
                      <label class="img-upload-label full-width" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                      <input id="img-upload" type="file" class="image-upload" name="photo" accept="image/*">
                  </div>
              </div>
          </div>
        </div>

        <button type="submit" id="submit-btn" class="btn btn-primary mt-2 w-100">{{ __('Submit') }}</button>

    </form>
  </div>
</div>

@endsection

@section('scripts')


@endsection
