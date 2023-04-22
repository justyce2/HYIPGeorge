@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Twilio') }}</h5>
        <ol class="breadcrumb py-0 m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ __('SMS Settings') }}</a></li>
        </ol>
    </div>
</div>


  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Twilio Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">

        @include('includes.admin.form-both')

          {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inp-sid">{{  __('Account Sid')  }}</label>
                    <input type="text" class="form-control" id="inp-sid" name="twilio_account_sid"  placeholder="{{ __('Account Sid') }}" value="{{ $gs->twilio_account_sid }}">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="inp-token">{{  __('Auth Token')  }}</label>
                    <input type="text" class="form-control" id="inp-token" name="twilio_auth_token"  placeholder="{{ __('Auth Token') }}" value="{{ $gs->twilio_auth_token }}">
                </div>    
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="inp-number">{{  __('Default Phone Number')  }}</label>
                    <input type="text" class="form-control" id="inp-number" name="twilio_default_number"  placeholder="{{ __('Default Phone Number') }}" value="{{ $gs->twilio_default_number }}">
                </div>    
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="inp-name">{{ __('Status') }}</label>
                    <select class="form-control mb-3" name="twilio_status">
                      <option value="1" {{ $gs->twilio_status == 1 ? 'selected' : '' }}>{{ __('YES') }}</option>
                      <option value="0" {{ $gs->twilio_status == 0 ? 'selected' : '' }}>{{ __('NO') }}</option>
                    </select>
                </div>
            </div>

        </div>

        <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>

@endsection
