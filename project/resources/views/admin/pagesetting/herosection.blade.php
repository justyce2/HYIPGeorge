@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Hero Section') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Home Page Setting') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ps.hero') }}">{{ __('Hero Section') }}</a></li>
    </ol>
    </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Hero Section') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group ">
              <label for="exampleInputPassword1">{{__("Herosection Background Color")}}</label>
              <input type="color" name="hero_bg"  required  class="form-control"  value="{{ $ps->hero_bg }}" id="exampleInputPassword1">
          </div>

          <div class="form-group">
              <label>{{ __('Set Background Image') }} </label>
              <div class="wrapper-image-preview">
                  <div class="box">
                      <div class="back-preview-image" style="background-image: url({{$ps->hero_photo ? asset('assets/images/'.$ps->hero_photo) : asset('assets/images/placeholder.jpg') }});"></div>
                      <div class="upload-options">
                          <label class="img-upload-label" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                          <input id="img-upload" type="file" class="image-upload" name="hero_photo" accept="image/*">
                      </div>
                  </div>
              </div>
          </div>

          <div class="form-group">
              <label for="title">{{ __('Hero Section Title') }} *</label>
              <input type="text" class="form-control" id="title" name="hero_title"  placeholder="{{ __('Hero Section Title') }}" value="{{ $ps->hero_title }}" required>
          </div>

          <div class="form-group">
            <label for="text">{{ __('Hero Section Text') }} *</label>
            <textarea name="hero_text" id="text" cols="30" rows="5" class="form-control" placeholder="{{ __('Hero Section Text') }}" required>{{ $ps->hero_text }} </textarea>
          </div>

          <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>


@endsection
