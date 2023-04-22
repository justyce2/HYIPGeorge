@extends('layouts.admin')

@section('content')

<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between py-3">
  <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Social Links') }}</h5>
  <ol class="breadcrumb m-0 py-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="javascript:;">{{ __('Seo Tools') }}</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.social.index') }}">{{ __('Social Links') }}</a></li>
  </ol>
  </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Social Links') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{ route('admin.social.update.all') }}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="row mb-2">
            <label class="control-label col-sm-3" for="facebook">{{ __('Facebook') }} *</label>
            <div class="col-sm-6">
              <input class="form-control" name="facebook" id="facebook" placeholder="{{ __('http://facebook.com/') }}" type="text" value="{{$data->facebook}}">
            </div>
            <div class="col-sm-3">
              <label class="switch">
                <input type="checkbox" name="f_status" value="1" {{$data->f_status==1?"checked":""}}>
                <span class="slider round"></span>
              </label>
            </div>
          </div>


          <div class="row mb-2">
            <label class="control-label col-sm-3" for="twitter">{{ __('Twitter') }} *</label>
            <div class="col-sm-6">
              <input class="form-control" name="twitter" id="twitter" placeholder="{{ __('http://twitter.com/') }}" type="text" value="{{$data->twitter}}">
            </div>
            <div class="col-sm-3">
              <label class="switch">
                <input type="checkbox" name="t_status" value="1" {{$data->t_status==1?"checked":""}}>
                <span class="slider round"></span>
              </label>
            </div>
          </div>

          <div class="row mb-2">
            <label class="control-label col-sm-3" for="linkedin">{{ __('Linkedin') }} *</label>
            <div class="col-sm-6">
              <input class="form-control" name="linkedin" id="linkedin" placeholder="{{ __('http://linkedin.com/') }}" type="text" value="{{$data->linkedin}}">
            </div>
            <div class="col-sm-3">
              <label class="switch">
                <input type="checkbox" name="l_status" value="1" {{$data->l_status==1?"checked":""}}>
                <span class="slider round"></span>
              </label>
            </div>
          </div>

          <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>

@endsection
