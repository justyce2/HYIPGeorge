
@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
    <h3 class="title">@lang('Change Password')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('Change Password')
        </li>
    </ul>
</div>
<div class="dashboard--content-item">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7 col-xxl-6">
            <div class="profile--card">
                @includeIf('includes.flash')
                <form id="request-form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-sm-12">
                            <label for="password" class="form-label">@lang('Old Password')</label>
                            <input type="password" name="cpass" id="password" class="form-control"
                                placeholder="@lang('Old Password')" required>
                        </div>
                        <div class="col-sm-12">
                            <label for="new-password" class="form-label">@lang('New Password')</label>
                            <input type="password" name="newpass" id="new-password" class="form-control"
                                placeholder="@lang('New Password')" required>
                        </div>
                        <div class="col-sm-12">
                            <label for="confirm-password" class="form-label">@lang('Confirm Password')</label>
                            <input type="password" name="renewpass" id="confirm-password" class="form-control"
                                placeholder="@lang('Confirm Password')" required>
                        </div>
                        <div class="col-sm-12">
                            <div class="text-end">
                                <button type="submit" class="cmn--btn">@lang('Change Password')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush