@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between py-3">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add WithDraw Method') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin-withdraw-method-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
	<ol class="breadcrumb py-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Manage Customers') }}</a></li>
	</ol>
	</div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-md-10">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New WithDraw Method Form') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.withdraw.method.store')}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
              <label for="inp-name">{{ __('WithDraw Method Name') }}</label>
              <input type="text" class="form-control" id="inp-name" name="name" placeholder="{{ __('Enter Name') }}" value="" required>
            </div>

            <div class="form-group">
              <label for="inp-name">{{ __('Currency') }}</label>
              <select class="form-control mb-3" name="currency_id">
                <option value="" selected>{{__('Select Currency')}}</option>
                @foreach ($currencies as $key=>$data) 
                  <option value="{{ $data->id }}">{{ $data->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="inp-min">{{  __('Minimum Amount')  }} </label>
              <input type="number" class="form-control" id="inp-min" placeholder="{{  __('Minimum Amount') }}" name="min_amount" value="" required>
            </div>

            <div class="form-group">
              <label for="inp-max">{{  __('Maximum Amount')  }} </label>
              <input type="number" class="form-control" id="inp-max" placeholder="{{  __('Maximum Amount') }}" name="max_amount" value="" required>
            </div>

            <div class="form-group">
              <label>{{ __('Set Picture') }} </label>
              <div class="wrapper-image-preview">
                  <div class="box">
                      <div class="back-preview-image" style="background-image: url({{ asset('assets/images/placeholder.jpg') }});"></div>
                      <div class="upload-options">
                          <label class="img-upload-label" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                          <input id="img-upload" type="file" class="image-upload" name="photo" accept="image/*">
                      </div>
                  </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inp-fixed">{{  __('Withdraw Fixed Fee')  }} <small>({{__('Leave 0 if you don\'t want to add')}})</small></label>
              <input type="number" class="form-control" id="inp-fixed" placeholder="{{  __('Withdraw Fixed Fee')  }}" name="fixed" step="0.1" value="" required>
            </div>

            <div class="form-group">
              <label for="inp-percentage">{{  __('Withdraw Percentage Charge')  }} <small>({{__('Leave 0 if you don\'t want to add')}})</small></label>
              <input type="number" class="form-control" id="inp-percentage" placeholder="{{  __('Withdraw Percentage Charge')  }}" step="0.1" name="percentage" value="" required>
            </div>

            <div class="form-group">
              <label for="inp-name">{{ __('Status') }}</label>
              <select class="form-control mb-3" name="status">
                <option value="" selected>{{__('Select Status')}}</option>
                <option value="1">{{__('Activated')}}</option>
                <option value="0">{{__('Deactivated')}}</option>
              </select>
            </div>

            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>
  </div>

</div>
@endsection
