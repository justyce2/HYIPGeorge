@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Call to action') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Homepage Manage') }}</a></li>
    </ol>
    </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Call to action') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group">
            <label for="inp-title">{{  __('Title')  }}</label>
            <input type="text" class="form-control" id="inp-title" name="call_title"  placeholder="{{ __('Enter Title') }}" value="{{ $data->call_title }}" required>
          </div>

          <div class="form-group">
            <label for="error_text">{{ __('Subtitle') }} </label>
            <textarea class="form-control summernote" id="call_subtitle" name="call_subtitle" required rows="3" placeholder="{{__('Enter Subtitle')}}">{{ $data->call_subtitle }}</textarea>
          </div>

          <div class="form-group">
            <label for="inp-link">{{  __('Link')  }}</label>
            <input type="text" class="form-control" id="inp-link" name="call_link"  placeholder="{{ __('Enter Link') }}" value="{{ $data->call_link }}" required>
          </div>

          <div class="form-group">
                <div class="cp-container cp-contain" id="cp3-container">
                    <div class="input-group" title="Using input value">
                        <input type="color" name="call_bg" class="form-control" value="{{ $data->call_bg }}" id="exampleInputPassword1">
                    </div>
                </div>
          </div>

          <button type="submit" id="submit-btn" class="btn btn-primary mt-2 w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>


@endsection

@section('scripts')

@endsection