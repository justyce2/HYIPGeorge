@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Website Maintenance') }}</h5>
    <ol class="breadcrumb py-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('General Settings') }}</a></li>
    </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-lg-12">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Website Maintenance') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.gs.update')}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
              <label for="inp-title">{{  __('Website Maintenance')  }}</label>
              <div class="frm-btn btn-group mb-1">
                <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_maintain == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  {{ $gs->is_maintain == 1 ? __('Activated') : __('Deactivated')}}
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['is_maintain',1]) }}">{{ __('Activate') }}</a>
                  <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['is_maintain',0]) }}">{{ __('Deactivate') }}</a>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inp-maintain_text">{{  __('Maintenance Text')  }}</label>
              <textarea class="form-control summernote" name="maintain_text" required="">{{ $gs->maintain_text }}</textarea>
            </div> 

            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>
  </div>

</div>


@endsection
