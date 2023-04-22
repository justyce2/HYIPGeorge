@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit Review') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.review.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
    <ol class="breadcrumb py-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.review.index')}}">{{ __('Review') }}</a></li>
    </ol>
  </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New Review Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.review.update',$data->id)}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" class="input-field" name="title" placeholder="{{ __('Title') }}" required="" value="{{$data->title}}">
          </div>

          <div class="form-group">
            <label for="subtitle">{{ __('Sub Title') }}</label>
            <input type="text" class="input-field" name="subtitle" placeholder="{{ __('Sub Title') }}" required="" value="{{$data->subtitle}}">
          </div>

          <div class="form-group">
            <label>{{ __('Set Picture') }}</label>
            <div class="wrapper-image-preview">
                <div class="box">
                    <div class="back-preview-image" style="background-image: url({{$data->photo ? asset('assets/images/'.$data->photo) : asset('assets/images/placeholder.jpg') }});"></div>
                    <div class="upload-options">
                        <label class="img-upload-label" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                        <input id="img-upload" type="file" class="image-upload" name="photo" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="details">{{ __('Description ') }}</label>
            <textarea class="form-control summernote"  id="details" name="details" required rows="3" placeholder="{{__('Description')}}">{{ $data->details }}</textarea>
        </div>


          <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>

@endsection

@section('scripts')


@endsection
