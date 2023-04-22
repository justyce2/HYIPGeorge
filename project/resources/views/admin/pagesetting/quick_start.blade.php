@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Quick Start Section') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Home Page Setting') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ps.quick') }}">{{ __('Quick Start Section') }}</a></li>
    </ol>
    </div>
</div>

    <div class="card mb-4 mt-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Quick Start Section') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
                <label for="quick_title">{{ __('Quick Title') }} *</label>
                <input type="text" class="form-control" id="quick_title" name="quick_title"  placeholder="{{ __('Quick Title') }}" value="{{ $ps->quick_title }}" required>
            </div>

            <div class="form-group">
              <label for="quick_subtitle">{{ __('Quick Subtitle') }} *</label>
              <input type="text" class="form-control" id="quick_subtitle" name="quick_subtitle"  placeholder="{{ __('Quick Title') }}" value="{{ $ps->quick_subtitle }}" required>
            </div>

            <div class="form-group">
                <label for="quick_link">{{ __('Quick Link') }} *</label>
                <input type="text" class="form-control" id="quick_link" name="quick_link"  placeholder="{{ __('Quick Link') }}" value="{{ $ps->quick_link }}" required>
            </div>

            <div class="form-group">
                <label>{{ __('Set Background Image') }} </label>
                <div class="wrapper-image-preview">
                    <div class="box">
                        <div class="back-preview-image" style="background-image: url({{$ps->quick_background ? asset('assets/images/'.$ps->quick_background) : asset('assets/images/placeholder.jpg') }});"></div>
                        <div class="upload-options">
                            <label class="img-upload-label" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                            <input id="img-upload" type="file" class="image-upload" name="quick_background" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>{{ __('Set Banner Image') }}</label>
                <div class="wrapper-image-preview">
                    <div class="box">
                        <div class="back-preview-image" style="background-image: url({{$ps->quick_photo ? asset('assets/images/'.$ps->quick_photo) : asset('assets/images/placeholder.jpg') }});"></div>
                        <div class="upload-options">
                            <label class="img-upload-label" for="img-upload1"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                            <input id="img-upload1" type="file" class="image-upload1" name="quick_photo" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>

@endsection
