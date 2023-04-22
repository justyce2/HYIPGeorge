@extends('layouts.admin')

@section('content')


<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Website Contents') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('General Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.gs.contents') }}">{{ __('Website Contents') }}</a></li>
    </ol>
    </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Website Contents Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="inp-title">{{  __('Login Email Verification')  }}</label>
                <div class="frm-btn btn-group mb-1">
                    <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_verification_email == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      {{ $gs->is_verification_email == 1 ? __('Activated') : __('Deactivated')}}
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['is_verification_email',1]) }}">{{ __('Activate') }}</a>
                      <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['is_verification_email',0]) }}">{{ __('Deactivate') }}</a>
                    </div>
                  </div>
              </div>
            </div>


            <div class="col-md-4">
              <div class="form-group">
                <label for="inp-title">{{  __('Withdraw')  }}</label>
                <div class="frm-btn btn-group mb-1">
                    <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->withdraw_status == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      {{ $gs->withdraw_status == 1 ? __('Activated') : __('Deactivated')}}
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['withdraw_status',1]) }}">{{ __('Activate') }}</a>
                      <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['withdraw_status',0]) }}">{{ __('Deactivate') }}</a>
                    </div>
                  </div>
              </div>
            </div>


            <div class="col-md-4">
              <div class="form-group">
                <label for="inp-title">{{  __('KYC')  }}</label>
                <div class="frm-btn btn-group mb-1">
                    <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->kyc == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      {{ $gs->kyc == 1 ? __('Activated') : __('Deactivated')}}
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['kyc',1]) }}">{{ __('Activate') }}</a>
                      <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['kyc',0]) }}">{{ __('Deactivate') }}</a>
                    </div>
                  </div>
              </div>
            </div>
          </div>


        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="inp-title">{{  __('Two Factor Authentication')  }}</label>
              <div class="frm-btn btn-group mb-1">
                  <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->two_factor == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ $gs->two_factor == 1 ? __('Activated') : __('Deactivated')}}
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['two_factor',1]) }}">{{ __('Activate') }}</a>
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['two_factor',0]) }}">{{ __('Deactivate') }}</a>
                  </div>
                </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="inp-title">{{  __('Disqus')  }}</label>
              <div class="frm-btn btn-group mb-1">
                <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_disqus == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  {{ $gs->is_disqus == 1 ? __('Activated') : __('Deactivated')}}
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['is_disqus',1]) }}">{{ __('Activate') }}</a>
                  <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['is_disqus',0]) }}">{{ __('Deactivate') }}</a>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-4">
            <div class="form-group">
              <div class="cp-container" id="cp3-container">
                <div class="input-group" title="Using input value">
                    <input  type="color" name="colors"  class="form-control"  value="{{ $gs->colors }}" id="exampleInputPassword1">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="inp-phone_code">{{  __('Phone Code')  }}</label>
                <input type="text" class="form-control" id="inp-phone_code" name="phone_code"  placeholder="{{ __('Enter phone code') }}" value="{{ $gs->phone_code }}" required>
              </div>    
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="inp-latitude">{{  __('Map Latitude')  }}</label>
                <input type="text" class="form-control" id="inp-latitude" name="latitude"  placeholder="{{ __('Enter Latitude') }}" value="{{ $gs->latitude }}" required>
              </div>    
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="inp-longitude">{{  __('Map Longitude')  }}</label>
                <input type="text" class="form-control" id="inp-longitude" name="longitude"  placeholder="{{ __('Enter Longitude') }}" value="{{ $gs->longitude }}" required>
              </div>    
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="inp-title">{{  __('Website Title')  }}</label>
                <input type="text" class="form-control" id="inp-title" name="title"  placeholder="{{ __('Enter Website Title') }}" value="{{ $gs->title }}" required>
              </div>    
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="inp-disqus">{{  __('Disqus Website Short Name')  }}</label>
                <input type="text" class="form-control" id="inp-disqus" name="disqus"  placeholder="{{ __('Disqus Website Short Name') }}" value="{{ $gs->disqus }}" required>
              </div>
            </div>
          
            <div class="col-md-12">
              <div class="form-group">
                <label for="inp-name">{{ __('Currency Format') }}</label>
                <select class="form-control mb-3" name="currency_format">
                  <option value="" selected>{{__('Select Category')}}</option>
                  <option value="0" {{ $gs->currency_format== 0 ? 'selected':''}}>{{__('Before Price')}}</option>
                  <option value="1" {{ $gs->currency_format== 1 ? 'selected':''}}>{{__('After Price')}}</option>
                </select>
              </div>
            </div>
        </div>

        <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>
      </form>
    </div>
  </div>

@endsection
