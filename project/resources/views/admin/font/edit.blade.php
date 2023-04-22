@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
      <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit Font') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.font.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
      <ol class="breadcrumb m-0 py-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">{{ __('Font Settings') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.font.index') }}">{{ __('Website Font') }}</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.font.edit',$data->id)}}">{{ __('Add Font') }}</a></li>
      </ol>
    </div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-md-10">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      </div>

      <div class="card-body">
       
        <form class="geniusform" action="{{route('admin.font.update',$data->id)}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          @include('includes.admin.form-both')

          <div class="row">
            <div class="col-lg-4">
              <div class="left-area">
                  <h6 class="heading float-right">{{ __('Font Family') }} *</h6>
              </div>
            </div>
            <div class="col-lg-7">
              <input type="text" class="input-field" name="font_family" placeholder="{{__('Font Family')}}" required="" value="{{$data->font_family}}">
            </div>
          </div>


          <div class="row justify-content-center mt-4">
            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection


@section('scripts')

@endsection

