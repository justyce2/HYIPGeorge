<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="AcademyZpresso">
  <meta name="author" content="AcademyZpresso">
  <link rel="icon"  type="image/x-icon" href=""/>
  <title></title>
  <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/css/ruang-admin.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ __('Forgot Password') }}</h1>
                  </div>
                  <form id="forgotform" action="{{ route('admin.forgot.submit') }}" method="POST" class="user">
                    {{ csrf_field() }}
                    @include('includes.admin.form-login')
                    <div class="form-group">
                      <input name="email"  type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="{{ __('Enter Email Address') }}" required >
                    </div>
                    <div class="form-group">
                        <input id="authdata" type="hidden"  value="{{ __('Checking...') }}">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Submit') }}</button>
                    </div>

                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="{{ route('admin.login') }}">{{ __('Remember Password? Login') }}</a>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/ruang-admin.js') }}"></script>

<script>
"use strict";
    // FORGOT FORM

    $("#forgotform").on('submit',function(e){
    e.preventDefault();
    $('button.submit-btn').prop('disabled',true);
    $('.alert-info').show();
    $('.alert-info p').html($('#authdata').val());
        $.ajax({
        method:"POST",
        url:$(this).prop('action'),
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            if ((data.errors)) {
            $('.alert-success').hide();
            $('.alert-info').hide();
            $('.alert-danger').show();
            $('.alert-danger ul').html('');
                for(var error in data.errors)
                {
                $('.alert-danger p').html(data.errors[error]);
                }
            }
            else
            {
                $('.alert-info').hide();
                $('.alert-danger').hide();
                $('.alert-success').show();
                $('.alert-success p').html(data);
                $('input[type=email]').val('');
            }
            $('button.submit-btn').prop('disabled',false);
        }

        });

    });


    // FORGOT FORM ENDS

</script>

</body>

</html>
