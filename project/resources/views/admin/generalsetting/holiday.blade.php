@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Manage Holiday') }} </h5>
        <ol class="breadcrumb py-0 m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ __('Roles') }}</a></li>
        </ol>
    </div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-md-10">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Manage Holiday') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="day_of[Sun]" value="Sun" {{ $data->dayOffCheck('Sun') ? 'checked' : '' }} class="custom-control-input" id="sun">
                  <label class="custom-control-label" for="sun">{{__('Sunday')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="day_of[Mon]" value="Mon" {{ $data->dayOffCheck('Mon') ? 'checked' : '' }} class="custom-control-input" id="mon">
                  <label class="custom-control-label" for="mon">{{__('Monday')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="day_of[Tue]" value="Tue" {{ $data->dayOffCheck('Tue') ? 'checked' : '' }} class="custom-control-input" id="tue">
                  <label class="custom-control-label" for="tue">{{__('Tuesday')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="day_of[Wed]" value="Wed"  {{ $data->dayOffCheck('Wed') ? 'checked' : '' }} class="custom-control-input" id="wed">
                  <label class="custom-control-label" for="wed">{{__('Wednesday')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="day_of[Thu]" value="Thu" {{ $data->dayOffCheck('Thu') ? 'checked' : '' }} class="custom-control-input" id="thur">
                  <label class="custom-control-label" for="thur">{{__('Thursday')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="day_of[Fri]" value="Fri" {{ $data->dayOffCheck('Fri') ? 'checked' : '' }} class="custom-control-input" id="fri">
                  <label class="custom-control-label" for="fri">{{__('Friday')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="day_of[Sat]" value="Sat" {{ $data->dayOffCheck('Sat') ? 'checked' : '' }} class="custom-control-input" id="sat">
                  <label class="custom-control-label" for="sat">{{__('Saturday')}}</label>
                  </div>
              </div>
            </div>

            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>
  </div>

</div>
<!--Row-->

@endsection
