@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit Schedule') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.schedule.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="javascript:;">{{ __('Manage Plan') }}</a></li>
    </ol>
	</div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-md-10">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Schedule Form') }}</h6>
      </div>

      <div class="card-body py-5">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.schedule.edit',$data->id)}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
              <label for="inp-name">{{ __('Name') }}</label>
              <input type="text" class="form-control" id="inp-name" name="name"  placeholder="{{ __('Enter Name') }}" value="{{ $data->name }}" required>
            </div>

            <div class="form-group">
              <label for="inp-name">{{ __('Time') }}</label>
              <div class="input-group mb-3">
                <input type="text" name="time" class="form-control" placeholder="@lang('Time')" aria-label="@lang('Time')" aria-describedby="basic-addon2" value="{{ $data->time }}">
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2">@lang('HOUR')</span>
                </div>
              </div>
            </div>


            <button type="submit" id="submit-btn" class="btn btn-primary w-100 mt-3">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>
  </div>

</div>
@endsection
