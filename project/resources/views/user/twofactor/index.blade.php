@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
    <h3 class="title">@lang('Two factor authentication')</h3>
    <ul class="breadcrumb">
        <li>
          <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
    </ul>
  </div>

<div class="dashboard--content-item">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if(Auth::user()->twofa)
                <div class="card default--card">
                    <div class="card-header">
                        <h5 class="card-title text-dark text-center">@lang('Two Factor Authenticator')</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mx-auto text-center">
                            <a href="javascript:void(0)"  class="btn w-100 btn-md btn--danger" data-bs-toggle="modal" data-bs-target="#disableModal">
                                @lang('Disable Two Factor Authenticator')</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="card default--card">
                    <div class="card-header">
                        <h5 class="card-title text-dark text-center">@lang('Two Factor Authenticator')</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mx-auto text-center">
                            <div class="input-group input--group">
                                <input type="text" name="key" value="{{$secret}}" class="form-control" id="referralURL" readonly>
                                <button class="btn input-group-text btn--secondary btn-sm copytext px-4" id="copyBoard" onclick="myFunction()"> <i class="fa fa-copy"></i> </button>
                            </div>
                        </div>
                        <div class="form-group mx-auto text-center mt-3">
                            <img class="mx-auto" src="{{$qrCodeUrl}}">
                        </div>
                        <div class="form-group mx-auto text-center">
                            <a href="javascript:void(0)" class="btn btn--base btn-md mt-3 mb-1" data-bs-toggle="modal" data-bs-target="#enableModal">@lang('Enable Two Factor Authenticator')</a>
                        </div> 

                        <div class="form-group mx-auto text-center">
                            <a class="btn btn--base btn-md mt-3" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">@lang('DOWNLOAD APP')</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!--Enable Modal -->
    <div id="enableModal" class="modal modal-blur fade" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Your Otp')</h4>
                </div>
                <form action="{{route('user.createTwoFactor')}}" method="POST">
                    @csrf
                    <div class="modal-body ">
                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('close')</button>
                        <button type="submit" class="btn btn-success">@lang('verify')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal modal-blur fade" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Your Otp Disable')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('user.disableTwoFactor')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-success">@lang('Verify')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<script src="{{asset('assets/user/js/sweetalert2@9.js')}}"></script>
<script>
    "use strict";
    function myFunction() {
        var copyText = document.getElementById("referralURL");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        $.notify("Two factor authentication code copied", "success");
    }
</script>


    @if($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                'use strict';
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
                Toast.fire({
                icon: 'error',
                title: '{{ $error }}'
                })
            </script>
        @endforeach
    @endif


    @if(Session::has('success'))
    <script>
        'use strict';
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
    })
    Toast.fire({
        icon: 'success',
        title: '{{Session::get('success')}}'
    })
  </script>
@endif

@endpush
