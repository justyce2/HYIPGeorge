@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit Plan') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.plans.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="javascript:;">{{ __('Manage Plan') }}</a></li>
    </ol>
	</div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-md-10">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Plan Form') }}</h6>
      </div>

      <div class="card-body py-5">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.plans.update',$data->id)}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
              <label for="inp-title">{{ __('Title') }}</label>
              <input type="text" class="form-control" id="inp-title" name="title"  placeholder="{{ __('Enter Title') }}" value="{{ $data->title }}" required>
            </div>

            <div class="form-group">
              <label for="inp-subtitle">{{ __('Subtitle') }}</label>
              <input type="text" class="form-control" id="inp-subtitle" name="subtitle"  placeholder="{{ __('Enter Subtitle') }}" value="{{ $data->subtitle }}" required>
            </div>

            <div class="form-group">
                <label for="invest_type">{{ __('Invest Type') }}</label>
                <select name="invest_type" class="form-control" id="invest_type">
                  <option value="fixed" {{ $data->invest_type == 'fixed' ? 'selected' : ''}}> {{__('Fixed')}} </option>
                  <option value="range" {{ $data->invest_type == 'range' ? 'selected' : ''}}> {{__('Range')}} </option>
                </select>
            </div>

            <div class="form-group {{ $data->fixed_amount != NULL ? '' : 'd-none'}}" id="fixedAmount">
              <label for="inp-fixed_amount">{{ __('Fixed Amount') }} ({{ $currency->name }})</label>
              <input type="number" class="form-control" id="inp-fixed_amount" name="fixed_amount"  placeholder="{{ __('Fixed Amount') }}" value="{{ $data->fixed_amount }}">
            </div>

            <div class="row {{ $data->fixed_amount == NULL ? '' : 'd-none'}}" id="Range">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="min_amount">{{ __('Minimum Amount') }} ({{$currency->name}})</label>
                      <input type="number" class="form-control" id="min_amount" name="min_amount" placeholder="{{ __('Minimum Amount') }}" value="{{ $data->min_amount }}">
                    </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                      <label for="max_amount">{{ __('Maximum Amount') }} ({{$currency->name}})</label>
                      <input type="number" class="form-control" id="max_amount" name="max_amount" placeholder="{{ __('Maximum Amount') }}" value="{{ $data->max_amount }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label for="inp-percentage">{{ __('Return Percentage') }} (%)</label>
              <input type="number" class="form-control" id="inp-percentage" name="profit_percentage"  placeholder="{{ __('Enter Return Percentage') }}" value="{{ $data->profit_percentage }}" required>
            </div>

            <div class="form-group">
              <label for="schedule_hour">{{ __('Every') }}</label>
              <select name="schedule_hour" class="form-control" id="schedule_hour">
                @foreach ($schedules as $key=>$schedule)
                  <option value="{{ $schedule->time }}" data-sechedule-id="{{ $schedule->id }}" {{ $schedule->time == $data->schedule_hour ? 'selected' : ''}}> {{ $schedule->name }} </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="lifetime_return">{{ __('Lifetime Return ?') }}</label>
              <select name="lifetime_return" class="form-control" id="lifetime_return" required>
                <option value="1" {{ $data->lifetime_return == 1 ? 'selected' : ''}}> {{__('Yes')}} </option>
                <option value="0" {{ $data->lifetime_return == 0 ? 'selected' : ''}}> {{__('No')}} </option>
              </select>
            </div>

            <div class="form-group {{ $data->lifetime_return == 0 ? '' : 'd-none'}}" id="repeatable">
              <label for="inp-name">{{ __('Repeatable') }}</label>
              <div class="input-group mb-3">
                <input type="text" name="profit_repeat" class="form-control" placeholder="@lang('Repeatable')" aria-label="@lang('Repeatable')" value="{{ $data->profit_repeat }}" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2">@lang('Times')</span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="captial_return">{{ __('Capital Return ?') }}</label>
              <select name="captial_return" class="form-control" id="captial_return">
                <option value="1" {{ $data->captial_return == 1 ? 'selectd' : ''}}> {{__('Yes')}} </option>
                <option value="0" {{ $data->captial_return == 0 ? 'selectd' : ''}}> {{__('No')}} </option> 
              </select>
            </div>

            <div class="form-group">
              <label for="status">{{ __('Status') }}</label>
              <select name="status" class="form-control" id="status">
                <option value="1" {{ $data->status == 1 ? 'selectd' : ''}}> {{__('activated')}} </option>
                <option value="0" {{ $data->status == 0 ? 'selectd' : ''}}> {{__('deactivated')}} </option>
              </select>
            </div>
            <input type="hidden" name="manage_schedule_id" value="{{ $data->manage_schedule_id }}" id="scheduleId">
            <button type="submit" id="submit-btn" class="btn btn-primary w-100 mt-3">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>
  </div>

</div>
@endsection

@section('scripts')
    <script>
        'use strict';
        $(document).on('change','#schedule_hour',function(){
          $('#scheduleId').val($(this).find(':selected').data('sechedule-id'))
        });

        $(document).on('change','#invest_type',function(){
           if($(this).val() == 'range'){
              $("#Range").removeClass('d-none');
              $("#fixedAmount").addClass('d-none');
           }else{
              $("#Range").addClass('d-none');
              $("#fixedAmount").removeClass('d-none');
           }
        });

        $(document).on('change','#lifetime_return',function(){
           if($(this).val() == 0){
              $("#repeatable").removeClass('d-none');
           }else{
              $("#repeatable").addClass('d-none');
           }
        });
    </script>
@endsection
