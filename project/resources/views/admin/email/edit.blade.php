@extends('layouts.admin')

@section('content')

<div class="content-area">
  <div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit Template') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __("Back") }}</a></h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Email Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.mail.edit',$data->id) }}">{{ __('Edit Template') }}</a></li>
    </ol>
    </div>
  </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 text-center">
      <div class="row" >
        <div class="col-lg-12 offset-lg-4 col-md-12 offset-md-4">
        <p>{{ __('Use the BB codes, it show the data dynamically in your emails.') }}</p>
        <br>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>{{ __('Meaning') }}</th>
                <th>{{ __('BB Code') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ __('Customer Name') }}</td>
                <td>{customer_name}</td>
              </tr>
              <tr>
                <td>{{ __('Withdraw Amount') }}</td>
                <td>{withdraw_amount}</td>
              </tr>
              <tr>
                <td>{{ ('Admin Name') }}</td>
                <td>{admin_name}</td>
              </tr>
              <tr>
                <td>{{ __('Admin Email') }}</td>
                <td>{admin_email}</td>
              </tr>
              <tr>
                <td>{{ __('Website Title') }}</td>
                <td>{website_title}</td>
              </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.mail.update',$data->id)}}" method="POST" enctype="multipart/form-data">
          @include('includes.admin.form-both')
          {{ csrf_field() }}

          <div class="form-group">
            <label>{{ __('Email Type') }} *</label>
            <input type="text" class="input-field" placeholder="{{ __('Email Type') }}" required="" value="{{$data->email_type}}" disabled="">
          </div>

          <div class="form-group">
            <label>{{ __('Email Subject') }} *</label>
            <small>{{ __('(In Any Language)') }}</small>
            <input type="text" class="input-field" name="email_subject" placeholder="{{ __('Email Subject') }}" required="" value="{{$data->email_subject}}">
          </div>

          <div class="form-group">
            <label>{{ __('Email Body') }} *</label>
            <small>{{ __('(In Any Language)') }}</small>
            <textarea class="form-control " name="email_body" placeholder="{{ __('Email Body') }}">{{ $data->email_body }}</textarea>
          </div>

          <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>


@endsection
