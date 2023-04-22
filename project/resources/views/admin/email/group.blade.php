@extends('layouts.admin')

@section('content')

<div class="content-area">
  <div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Group Email') }}</h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Email Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.group.show') }}">{{ __('Group Email') }}</a></li>
    </ol>
    </div>
  </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.group.submit')}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}


          <div class="form-group">
            <label for="inp-name">{{ __('Select User Type') }}*</label>
              <select name="type" required="" class="input-field">
                  <option value=""> {{ __('Choose User Type') }} </option>
                  <option value="User">{{ __('Users') }}</option>
                  <option value="2">{{ __('Subscribers') }}</option>
              </select>
          </div>

          <div class="form-group">
            <label for="inp-name">{{ __('Email Subject') }} *</label>
            <small>{{ __('(In Any Language)') }}</small>
            <input type="text" class="input-field" name="subject" placeholder="{{ __('Email Subject') }}" value="" required="">
          </div>


          <div class="form-group">
            <label for="inp-name">{{ __('Email Body') }} *</label>
            <small>{{ __('(In Any Language)') }}</small>
            <textarea class="form-control " name="body" placeholder="{{ __('Email Body') }}"></textarea>
          </div>

          <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>

@endsection
