@extends('layouts.admin')

@section('content')


    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between py-3">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('System Purchase Activation') }}</h5>
        <ol class="breadcrumb py-0 m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>

            <li class="breadcrumb-item"><a href="{{ route('admin.profile') }}">{{ __('System Activation') }}</a></li>
        </ol>
        </div>
    </div>


    <!-- Row -->
    <div class="row mt-3">
      <!-- Datatables -->
      <div class="col-lg-12">

        @include('includes.admin.form-success')
        <div class="card mb-4">
            <div class="card-body">
              <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
              @if($activation_data != "")
                        <div class="row">
                            <div class="col-lg-12 text-center" style="color:darkgreen">
                                @php
                                    echo $activation_data;
                                @endphp

                            </div>
                        </div>
                    @else
              <form class="geniusform" action="{{ route('admin-activate-purchase') }}" method="POST" enctype="multipart/form-data">

                  @include('includes.admin.form-both')

                  {{ csrf_field() }}

                  <div class="form-group">
                    <label for="inp-extented">{{ __('Purchase Code') }} *</label>
                    <p class="sub-heading"><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">{{ __('How to get purchase code?') }}</a></p>
                    <input class="form-control" name="pcode" id="admin_name" placeholder="{{ __('Enter Purchase Code') }}" required="" value="" type="text">
                  </div>
                  <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>
              </form>
              @endif
            </div>
          </div>
      </div>
    </div>
    <!--Row-->




@endsection


@section('scripts')


@endsection

