@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
      <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit Payment Gateway') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.payment.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
      <ol class="breadcrumb m-0 py-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.payment.edit',$data->id)}}">{{ __('Edit Payment') }}</a></li>
      </ol>
    </div>
</div>

    <div class="card mb-4 mt-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Payment Form') }}</h6>
      </div>

      <div class="card-body">
        
        <form class="geniusform"  action="{{route('admin.payment.update',$data->id)}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}


            @if($data->type == 'automatic')


            <div class="form-group">
              <label for="inp-name">{{ __('Name') }}</label>
              <input type="text" class="form-control" id="inp-name" name="name"  placeholder="{{ __('Enter Name') }}" value="{{ $data->name }}" required>
            </div>


            @if($data->information != null)

              @foreach($data->convertAutoData() as $pkey => $pdata)

              @if($pkey == 'sandbox_check')

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="pkey[{{ __($pkey) }}]" class="custom-control-input" {{ $pdata == 1  ? 'checked' : '' }} id="{{ $pkey }}">
                    <label class="custom-control-label" for="{{ $pkey }}">
                      {{ __( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) ) }}
                    </label>
                  </div>
                </div>


              @else

              <div class="form-group">
                <label for="inp-{{ __($pkey) }}">{{ __( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) ) }}</label>
                <input type="text" class="form-control" id="inp-{{ __($pkey) }}" name="pkey[{{ __($pkey) }}]"  placeholder="{{ __( $data->name.' '.ucwords(str_replace('_',' ',$pkey)) ) }}" value="{{ $pdata }}" required>
              </div>


              @endif

              @endforeach

            @endif

            @else

              <div class="form-group">
                <label for="inp-title">{{ __('Name') }}</label>
                <input type="text" class="form-control" id="inp-title" name="title"  placeholder="{{ __('Enter Name') }}" value="{{ $data->title }}" required>
              </div>

              <div class="form-group">
                <label for="inp-subtitle">{{ __('Subtitle') }}</label>
                <input type="text" class="form-control" id="inp-subtitle" name="subtitle"  placeholder="{{ __('Enter Subtitle') }}" value="{{ $data->subtitle }}" required>
              </div>

              @if($data->keyword == null)


              <div class="form-group">
                <label for="inp-details">{{ __('Description') }}</label>
                <textarea name="details" class="form-control summernote" id="inp-details" cols="30" rows="10" >{{ $data->details }}</textarea>
              </div>

              @endif


            @endif

            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>
        </form>
      </div>
    </div>


@endsection

