@extends('layouts.admin')

@section('content')
  <div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Facebook Login') }}</h5>
    <ol class="breadcrumb py-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Social Links') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.social.facebook') }}">{{ __('Facebook Login') }}</a></li>
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
                <label for="inp-name">{{ __('App ID') }} *</label>
                <small>{{ __('(Get Your App ID from developers.facebook.com)') }}</small>
                <input type="text" class="input-field" placeholder="{{ __('Enter App ID') }}" name="fclient_id" value="{{ $data->fclient_id }}" required="">
              </div>

              <div class="form-group">
                <label for="inp-name">{{ __('App Secret') }} *</label>
                <small>{{ __('(Get Your App Secret from developers.facebook.com)') }}</small>
                <input type="text" class="input-field" placeholder="{{ __('Enter App Secret') }}" name="fclient_secret" value="{{ $data->fclient_secret }}" required="">
              </div>

              <div class="form-group">
                <label for="inp-name">{{ __('Website URL') }} *</label>
                <input type="text" class="input-field" placeholder="{{ __('Website URL') }}"  value="{{ url('/') }}" readonly="">
              </div>

              <div class="form-group">
                <label for="inp-name">{{ __('Valid OAuth Redirect URI') }} *</label>
                <small>{{ __('(Copy this url and paste it to your Valid OAuth Redirect URI in developers.facebook.com.)') }}</small>
                @php
                $url = url('/auth/facebook/callback');
                $url = preg_replace("/^http:/i", "https:", $url);
                @endphp
                <input type="text" class="input-field" placeholder="{{ __('Enter Site URL') }}" name="fredirect" value="{{$url}}" readonly>
              </div>


              <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>


          </form>
        </div>
      </div>

      <!-- Form Sizing -->


      <!-- Horizontal Form -->

    </div>


  </div>

@endsection
