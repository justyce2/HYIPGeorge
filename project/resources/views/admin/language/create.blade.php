@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add Language') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.lang.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Language Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.lang.index') }}">{{ __('Website Language') }}</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.lang.create')}}">{{ __('Add Language') }}</a></li>
    </ol>
    </div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-lg-12">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      </div>

      <div class="card-body">
        
        <form class="geniusform" action="{{route('admin.lang.create')}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          @include('includes.admin.form-both')

          <div class="row">
            <div class="col-lg-4">
              <div class="left-area">
                  <h6 class="heading float-right">{{ __('Language') }} *</h6>
              </div>
            </div>
            <div class="col-lg-7">
              <input type="text" class="input-field" name="language" placeholder="{{ __('Language') }}" required="" value="English">
            </div>
          </div>


          <div class="row">
            <div class="col-lg-4">
              <div class="left-area">
                  <h6 class="heading float-right">{{ __('Language Direction') }} *</h6>
              </div>
            </div>
            <div class="col-lg-7">
              <select name="rtl" class="input-field" required="">
                <option value="0">{{ __('Left To Right') }}</option>
                <option value="1">{{ __('Right To Left') }}</option>
              </select>
            </div>
          </div>


        <hr>

          <h4 class="text-center">{{ __('SET LANGUAGE KEYS & VALUES') }}</h4>

        <hr>

        <div class="row mb-3">

          <div class="col-lg-2">
            <div class="left-area">
            </div>
          </div>

            <div class="col-lg-4">
              <h5><b>Main Languages</b></h5>
            </div>

            <div class="col-lg-5">
              <h5><b>Translated Languages</b></h5>
            </div>

        </div>


        <div class="row">
          <div class="col-lg-2">
            <div class="left-area">

            </div>
          </div>
         <div class="col-lg-8">
            <div class="featured-keyword-area">
              <div class="lang-tag-top-filds" id="lang-section">



                @foreach($lang as $key => $val)

                <div class="lang-area mb-3">
                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                  <div class="row">
                    <div class="col-lg-6">
                      <textarea name="keys[]" class="form-control" placeholder="{{ __('Enter Language Key') }}" readonly="">{{ $key }}</textarea>
                    </div>

                    <div class="col-lg-6">
                      <textarea  name="values[]" class="form-control" placeholder="{{ __('Enter Language Value') }}" required="">{{ $val}}</textarea>
                    </div>
                  </div>
                </div>

              @endforeach



              </div>

              <a href="javascript:;" id="lang-btn" class="add-fild-btn d-flex justify-content-center"><i class="icofont-plus"></i> {{__('Add More Field')}}</a>
            </div>
          </div>


          <div class="col-lg-2">
            <div class="left-area">

            </div>
          </div>

        </div>
          <div class="row justify-content-center mt-4">
            <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Form Sizing -->

    <!-- Horizontal Form -->

  </div>
</div>
<!--Row-->
@endsection


@section('scripts')
  <script type="text/javascript">
    "use strict";
    function isEmpty(el){
        return !$.trim(el.html())
    }


  $("#lang-btn").on('click', function(){

      $("#lang-section").append(''+
                                  '<div class="lang-area mb-3">'+
                                    '<span class="remove lang-remove"><i class="fas fa-times"></i></span>'+
                                    '<div class="row">'+
                                      '<div class="col-lg-6">'+
                                      '<textarea name="keys[]" class="form-control" placeholder="{{ __('Enter Language Key') }}" required=""></textarea>'+
                                      '</div>'+
                                      '<div class="col-lg-6">'+
                                      '<textarea  name="values[]" class="form-control" placeholder="{{ __('Enter Language Value') }}" required=""></textarea>'+
                                      '</div>'+
                                    '</div>'+
                                  '</div>'+
                              '');

  });

  $(document).on('click','.lang-remove', function(){

      $(this.parentNode).remove();
      if (isEmpty($('#lang-section'))) {

      $("#lang-section").append(''+
                                  '<div class="lang-area">'+
                                    '<span class="remove lang-remove"><i class="fas fa-times"></i></span>'+
                                    '<div class="row">'+
                                      '<div class="col-lg-6">'+
                                      '<textarea name="keys[]" class="form-control" placeholder="{{ __('Enter Language Key') }}" required=""></textarea>'+
                                      '</div>'+
                                      '<div class="col-lg-6">'+
                                      '<textarea  name="values[]" class="form-control" placeholder="{{ __('Enter Language Value') }}" required=""></textarea>'+
                                      '</div>'+
                                    '</div>'+
                                  '</div>'+
                              '');


      }

  });

  </script>
@endsection

