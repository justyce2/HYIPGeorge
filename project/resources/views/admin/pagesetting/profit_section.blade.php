@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Profit Calculator') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Homepage Manage') }}</a></li>
    </ol>
    </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Profit Calculator') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group">
            <label for="inp-title">{{  __('Title')  }}</label>
            <input type="text" class="form-control" id="inp-title" name="profit_title"  placeholder="{{ __('Enter Profit Title') }}" value="{{ $data->profit_title }}" required>
          </div>

          <div class="form-group">
            <label for="error_text">{{ __('Subtitle') }} </label>
            <textarea class="form-control summernote" id="profit_text" name="profit_text" required rows="3" placeholder="{{__('Enter Profit Text')}}">{{ $data->profit_text }}</textarea>
          </div>

          <div class="form-group">
            <label>{{ __('Set Background Image') }}</label>
            <div class="wrapper-image-preview">
                <div class="box full-width">
                    <div class="back-preview-image" style="background-image: url({{ $data->profit_banner ? asset('assets/images/'.$data->profit_banner) : asset('assets/images/placeholder.jpg') }});"></div>
                    <div class="upload-options">
                        <label class="img-upload-label full-width" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                        <input id="img-upload" type="file" class="image-upload" name="profit_banner" accept="image/*">
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