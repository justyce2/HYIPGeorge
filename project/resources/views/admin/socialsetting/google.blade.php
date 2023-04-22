@extends('layouts.admin')

@section('content')

<div class="content-area">
  <div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Google Login') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Social Links') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.social.google') }}">{{ __('Google Login') }}</a></li>
    </ol>
    </div>
  </div>

  <div class="row justify-content-center mt-3">
    <div class="col-lg-6">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        </div>

        <div class="card-body">
          <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
          <form class="geniusform" action="{{ route('admin.social.update') }}" method="POST" enctype="multipart/form-data">

              @include('includes.admin.form-both')

              {{ csrf_field() }}

              <div class="form-group">
                <label for="inp-name">{{ __('Client ID') }} *</label>
                <small>{{ __('(Get Your Client ID from console.cloud.google.com)') }}</small>
                <input type="text" class="input-field" placeholder="{{ __('Enter Client ID') }}" name="gclient_id" value="{{ $data->gclient_id }}" required="">
              </div>

              <div class="form-group">
                <label for="inp-name">{{ __('Client Secret') }} *</label>
                <small>{{ __('(Get Your Client Secret from console.cloud.google.com)') }}</small>
                <input type="text" class="input-field" placeholder="{{ __('Enter Client Secret') }}" name="gclient_secret" value="{{ $data->gclient_secret }}" required="">
              </div>

              <div class="form-group">
                <label for="inp-name">{{ __('Website URL') }} *</label>
                <input type="text" class="input-field" placeholder="{{ __('Website URL') }}"  value="{{ url('/') }}" readonly="">
              </div>

              <div class="form-group">
                <label for="inp-name">{{ __('Redirect URL') }} *</label>
                <small>{{ __('(Copy this url and paste it to your Redirect URL in console.cloud.google.com.)') }}</small>
                <input type="text" class="input-field" placeholder="{{ __('Enter Site URL') }}" name="gredirect" value="{{url('/auth/google/callback')}}" readonly>
              </div>

              <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>

          </form>
        </div>
      </div>
    </div>
  </div>


@endsection
