@extends('layouts.admin')
@section('content')


<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Website Loader') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('General Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.gs.load') }}">{{ __('Website Loader') }}</a></li>
    </ol>
    </div>
</div>

<div class="row mt-3">

    <div class="col-lg-6">

      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Website Loader') }}</h6>

          <div class="btn-group mb-1">
            <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_loader == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              {{ $gs->is_loader == 1 ? __('Activated') : __('Deactivated')}}
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['is_loader',1]) }}">{{ __('Activate') }}</a>
              <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['is_loader',0]) }}">{{ __('Deactivate') }}</a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row justify-content-center">

          <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

          <form class="geniusform" action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">

              @include('includes.admin.form-both')

              {{ csrf_field() }}

              <div class="form-group">
                  <div class="wrapper-image-preview-settings">
                      <div class="box-settings">
                          <div class="back-preview-image color-white" style="background-image: url({{ $gs->loader ? asset('assets/images/'.$gs->loader):asset('assets/images/placeholder.jpg') }});"></div>
                          <div class="upload-options-settings">
                              <label class="img-upload-label" for="img-upload-1">
                                   <i class="fas fa-camera"></i> {{ __('Upload Picture') }}
                                   <br>
                                   
                              </label>
                              <input id="img-upload-1" type="file" class="image-upload" name="loader" accept="image/*">
                          </div>
                      </div>
                  </div>
              </div>

              <button type="submit" id="submit-btn" class="btn btn-primary btn-block">{{ __('Submit') }}</button>

          </form>
        </div>
        </div>
      </div>

    </div>



    <div class="col-lg-6">

      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Admin Loader') }}</h6>

          <div class="btn-group mb-1">
            <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_admin_loader == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              {{ $gs->is_admin_loader == 1 ? __('Activated') : __('Deactivated')}}
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['is_admin_loader',1]) }}">{{ __('Activate') }}</a>
              <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['is_admin_loader',0]) }}">{{ __('Deactivate') }}</a>
            </div>
          </div>

        </div>

        <div class="card-body">
          <div class="row justify-content-center">

          <form class="geniusform" action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">

              @include('includes.admin.form-both')

              {{ csrf_field() }}

              <div class="form-group">
                  <div class="wrapper-image-preview-settings">
                      <div class="box-settings">
                          <div class="back-preview-image color-white" style="background-image: url({{ $gs->admin_loader ? asset('assets/images/'.$gs->admin_loader):asset('assets/images/placeholder.jpg') }});"></div>
                          <div class="upload-options-settings">
                              <label class="img-upload-label" for="img-upload-2">
                                   <i class="fas fa-camera"></i> {{ __('Upload Picture') }}
                                   <br>
                                   <small class="small-font">{{ __('600 X 600') }}</small>
                              </label>
                              <input id="img-upload-2" type="file" class="image-upload" name="admin_loader" accept="image/*">
                          </div>
                      </div>
                  </div>
              </div>

              <button type="submit" id="submit-btn" class="btn btn-primary btn-block">{{ __('Submit') }}</button>

          </form>
        </div>
        </div>
      </div>

    </div>





</div>
<!--Row-->

@endsection
