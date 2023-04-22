@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Contact Us') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Menu Page Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.ps.contact')}}">{{ __('Contact Us Page') }}</a></li>
    </ol>
    </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Contact Us') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{ route('admin.ps.contactupdate') }}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group">
              <label for="inp-title">{{  __('Contact Page')  }} </label>
              <div class="frm-btn btn-group mb-1">
                <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_contact == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  {{ $gs->is_contact == 1 ? __('Activated') : __('Deactivated')}}
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['is_contact',1]) }}">{{ __('Activate') }}</a>
                  <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['is_contact',0]) }}">{{ __('Deactivate') }}</a>
                </div>
              </div>
          </div>
        
        <div class="form-group">
          <label for="side_title">{{ __('Contact Title') }} *</label>
          <textarea class="form-control summernote"  id="side_title" name="side_title" required rows="3" placeholder="{{__('Contact title')}}">{{$data->side_title}}</textarea>
        </div>

        <div class="form-group">
          <label for="side_text">{{ __('Contact text') }} *</label>
          <textarea class="form-control summernote"  id="side_text" name="side_text" required rows="3" placeholder="{{__('Contact Text')}}">{{$data->side_text}}</textarea>
        </div>

        <div class="form-group">
          <label for="contact_email">{{ __('Contact Us Email Address') }} *</label>
          <input type="text" class="form-control" id="contact_email" name="contact_email"  placeholder="{{ __('Contact Us Email Address') }}" value="{{$data->contact_email}}" required>
        </div>

        <div class="form-group">
          <label for="email">{{ __('Email') }} *</label>
          <input type="email" class="form-control" id="email" value="{{$data->email}}" name="email"  placeholder="{{ __('Email') }}" value="" required>
        </div>

        <div class="form-group">
          <label for="site">{{ __('Website') }} *</label>
          <input type="text" class="form-control" id="site" value="{{$data->site}}" name="site"  placeholder="{{ __('Website') }}" value="" required>
        </div>

        <div class="form-group">
          <label for="phone">{{ __('Phone') }} *</label>
          <input type="text" class="form-control" id="phone" value="{{$data->phone}}" name="phone"  placeholder="{{ __('Phone') }}" value="" required>
        </div>

        <div class="form-group">
          <label for="fax">{{ __('Fax') }} *</label>
          <input type="text" class="form-control" id="fax" value="{{$data->fax}}" name="fax"  placeholder="{{ __('Fax') }}" value="">
        </div>

        <div class="form-group">
          <label for="street">{{ __('Street Address') }} *</label>
          <textarea class="form-control summernote"  id="street" name="street" required rows="3" placeholder="{{__('Street Address')}}">{{$data->street}}</textarea>
        </div>

        <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>


@endsection
