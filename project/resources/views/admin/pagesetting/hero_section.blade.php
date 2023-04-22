@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Hero Section') }}</h5>
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ __('Page Settings') }}</a></li>
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

            <div class="form-group">
              <label for="hero_title">{{  __('Hero Title')  }}</label>
              <input type="text" class="form-control" id="hero_title" name="hero_title"  placeholder="{{ __('Enter About Title') }}" value="{{ $data->hero_title }}" required>
            </div>

            <div class="form-group">
                <label for="hero_subtitle">{{  __('Hero Subtitle')  }}</label>
                <input type="text" class="form-control" id="hero_subtitle" name="hero_subtitle"  placeholder="{{ __('Enter Subtitle') }}" value="{{ $data->hero_subtitle }}" required>
            </div>

            <div class="form-group">
                <label for="hero_btn_url">{{  __('Hero Button Url')  }}</label>
                <input type="text" class="form-control" id="hero_btn_url" name="hero_btn_url"  placeholder="{{ __('Enter Button Url') }}" value="{{ $data->hero_btn_url }}" required>
            </div>

            <div class="form-group">
                <label for="hero_link">{{  __('Hero Video Link')  }}</label>
                <input type="text" class="form-control" id="hero_link" name="hero_link"  placeholder="{{ __('Enter Video Link') }}" value="{{ $data->hero_link }}" required>
            </div>

            <div class="form-group">
              <label>{{ __('Set Background Image') }} </label>
              <div class="wrapper-image-preview">
                  <div class="box full-width">
                      <div class="back-preview-image" style="background-image: url({{ $data->hero_photo ? asset('assets/images/'.$data->hero_photo) : asset('assets/images/placeholder.jpg') }});"></div>
                      <div class="upload-options">
                          <label class="img-upload-label full-width" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                          <input id="img-upload" type="file" class="image-upload" name="hero_photo" accept="image/*">
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