@extends('layouts.admin')

@section('content')


<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Money Transfer Settings') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.gs.moneytransfer') }}">{{ __('Money Transfer Settings') }}</a></li>
    </ol>
    </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Money Transfer Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label for="inp-fixed">{{  __('Fixed Charge')  }}</label>
                <input type="number" class="form-control" id="inp-fixed" name="transfer_fixed"  placeholder="{{ __('Enter Fixed Charge') }}" value="{{ $gs->transfer_fixed }}" min="0" step="0.1" required>
              </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="inp-percentage">{{  __('Percent Charge')  }}</label>
              <input type="number" class="form-control" id="inp-percentage" name="transfer_percentage"  placeholder="{{ __('Enter Percent Charge') }}" value="{{ $gs->transfer_percentage }}" min="0" step="0.1" required>
            </div>    
          </div>
        </div>


        <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>

@endsection
