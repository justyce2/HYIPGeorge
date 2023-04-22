@extends('layouts.admin')

@section('content')

<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between">
  <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add New Currency') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.currency.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="javascript:;">{{ __('Payment Settings') }}</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.currency.index') }}">{{ __('Currencies') }}</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.currency.create')}}">{{ __('Add New Currency') }}</a></li>
  </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
<div class="col-md-10">
  <!-- Form Basic -->
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New Currency Form') }}</h6>
    </div>

    <div class="card-body">
      
      <form class="geniusform" action="{{route('admin.currency.store')}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group">
              <label for="c-name">{{ __('Currency Name') }}</label>
              <input type="text" class="form-control" name="name" placeholder="{{ __('Enter Currency Name') }}" required="" value="">
          </div>

          <div class="form-group">
              <label for="inp-sign">{{ __('Currency sign') }}</label>
              <input type="text" class="form-control"  id="inp-sign" name="sign" placeholder="{{ __('Enter Currency Sign') }}" required="" value="">
          </div>

          <div class="form-group">
            <label for="inp-value">{{ __('Value') }}</label>
            <input type="text" class="form-control" id="inp-value" name="value" placeholder="{{ __('Enter Currency Value') }}" required="" value="">
        </div>

          <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>
</div>

</div>

@endsection
