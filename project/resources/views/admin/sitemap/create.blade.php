@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
      <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add SiteMap') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.sitemap.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
      <ol class="breadcrumb py-0 m-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">{{ __('SiteMap') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.sitemap.index') }}">{{ __('Website SiteMap') }}</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.sitemap.create')}}">{{ __('Add SiteMap') }}</a></li>
      </ol>
    </div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-lg-12">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.sitemap.store')}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          @include('includes.admin.form-both')

          <input type="hidden" name="filename">

          <div class="row">
            <div class="col-lg-4">
              <div class="left-area">
                  <h6 class="heading float-right">{{ __('Sitemap Url') }} *</h6>
              </div>
            </div>
            <div class="col-lg-7">
              <input type="text" class="input-field" name="sitemap_url" placeholder="{{__('Enter Sitemap Url')}}" required="">
            </div>
          </div>


          <div class="row justify-content-center mt-4">
            <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
<!--Row-->
@endsection


@section('scripts')

@endsection

