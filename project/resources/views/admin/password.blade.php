@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between py-3">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Change Password') }}</h5>
        <ol class="breadcrumb py-0 m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.password') }}">{{ __('Change Password') }}</a></li>
        </ol>
        </div>
    </div>

    <div class="card mb-4 mt-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Change Password Form') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style=""></div>
        <form class="geniusform" action="{{ route('admin.password.update') }}" method="POST" >

            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
                <label for="inp-cpass">{{ __('Current Password') }}</label>
                <input type="password" class="form-control" id="inp-cpass" name="cpass"  placeholder="{{ __('Enter Current Password') }}" value="" required>
            </div>

            <div class="form-group">
                <label for="inp-newpass">{{ __('New Password') }}</label>
                <input type="password" class="form-control" id="inp-newpass" name="newpass"  placeholder="{{ __('Enter New Password') }}" value="" required>
            </div>

            <div class="form-group">
                <label for="inp-renewpass">{{ __('Re-Type New Password') }}</label>
                <input type="password" class="form-control" id="inp-renewpass" name="renewpass"  placeholder="{{ __('Re-Type New Password') }}" value="" required>
            </div>

            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>

@endsection
