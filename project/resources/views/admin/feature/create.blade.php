@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between">
  <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add New Feature') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.feature.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="javascript:;">{{ __('Feature') }}</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.feature.index')}}">{{ __('Feature') }}</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.feature.create')}}">{{ __('Add New Feature') }}</a></li>
  </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-md-10">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New Feature Form') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.feature.create')}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
              <label for="title">{{ __('Title') }}</label>
              <input type="text" class="form-control" id="title" name="title"  placeholder="{{ __('Enter Title') }}" value="" required>
            </div>


            <div class="row">
              <div class="col-md-10">
                <label for="count">{{ __('Icon') }}</label>

                <div class="form-group ">
                  <div class="input-group">
                      <span class="input-group-prepend">
                        <button class="btn btn-secondary" name="icon" data-icon="fas fa-moon" role="iconpicker"></button>
                      </span>
                  </div>
                </div>
              </div>
            </div>


            <div class="form-group">
              <label for="details">{{ __('Description ') }}</label>
              <textarea class="form-control summernote"  id="details" name="details" required rows="3" placeholder="{{__('Description')}}"></textarea>
            </div>


            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>

  </div>
</div>

@endsection

@section('scripts')


@endsection
