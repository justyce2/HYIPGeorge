@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
    <h3 class="title">@lang('Invest History')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.invest.plans') }}">@lang('Plans')</a>
        </li>
        <li>
            @lang('Invest History')
        </li>
    </ul>
</div>

<div class="dashboard--content-item">
  <div class="card p-3 default--card">
    <form action="{{ route('user.invest.history') }}" method="get">
      <div class="row g-3">
        <div class="col-md-4">
          <input name="trx_no" class="form-control" autocomplete="off" placeholder="{{__('Transaction no')}}" type="text" value="{{ old('trx_no')}}">
        </div>

        <div class="col-md-4">
          <select id="type" name="type" required class="form-control">
            <option value="">{{ __('Select Type') }}</option>                              
            <option value="all">{{ __('All') }}</option>                              
            <option value="pending">{{ __('Pending') }}</option>                              
            <option value="running">{{ __('Running') }}</option>                              
            <option value="completed">{{ __('Completed') }}</option>                              
          </select>
        </div>

        <div class="col-md-4">
          <button type="submit" class="cmn--btn bg--primary submit-btn w-100 border-0">{{__('Submit')}}</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="dashboard--content-item">
    <h5 class="dashboard-title">@lang('Invests')</h5>
    <div class="table-responsive table--mobile-lg">
        <table class="table bg--body">
            <thead>
                <tr>
                    <th>@lang('Transaction')</th>
                    <th>@lang('Method')</th>
                    <th>@lang('Plan')</th>
                    <th>@lang('Method')</th>
                    <th>@lang('Profit Amount')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Next Profit')</th>
                </tr>
            </thead>
            <tbody>
              @if (count($invests) == 0)
              <tr>
                <td colspan="12">
                  <h4 class="text-center m-0 py-2">{{__('No Data Found')}}</h4>
                </td>
              </tr>
              @else
                @foreach ($invests as $key=>$data)
                @if($data->user_id == auth()->id())
                  <tr>
                      <td data-label="Transaction">
                        <div>
                          {{ strtoupper($data->transaction_no) }}
                        </div>
                      </td>

                      <td data-label="Method">
                        <div>
                          {{ strtoupper($data->method) }}
                          
                        </div>
                      </td>

                      <td data-label="Plan">
                        <div>
                          {{ $data->plan->title }}
                          <br>
                          {{ showPrice($data->amount) }}
                        </div>
                      </td>

                      <td data-label="Method">
                        <div>
                          {{ ucfirst($data->method) }}
                        </div>
                      </td>

                      <td data-label="Profit Amount">
                        <div>
                          {{ showPrice($data->profit) }}
                        </div>
                      </td>

                      @if ($data->status == 0)
                        <td data-label="Status">
                          <div>
                              <span class="badge btn--warning btn-sm">@lang('pending')</span>
                          </div>
                        </td>
                      @elseif($data->status == 1)
                        <td data-label="Status">
                          <div>
                              <span class="badge btn--info btn-sm">@lang('running')</span>
                          </div>
                        </td>
                      @else 
                        <td data-label="Status">
                          <div>
                              <span class="badge btn--success btn-sm">@lang('completed')</span>
                          </div>
                        </td>
                      @endif

                      @if ($data->status == 0)
                        <td data-label="Next Profit">
                          <div>
                              @lang('N/A')
                          </div>
                        </td>
                      @elseif($data->status == 1) 
                        <td data-label="Next Profit" class="countdown" data-date="{{ Carbon\Carbon::parse($data->profit_time) }}"></td>
                      @else
                        <td data-label="Next Profit">
                          <div>
                            <span class="badge btn--success btn-sm">@lang('completed')</span>
                          </div>
                        </td>
                      @endif

                  </tr>
                   @endif
                @endforeach
              @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
	'use strict';

	$('.countdown').each(function(){
		var date = $(this).data('date');
		var countDownDate = new Date(date).getTime();
		var $this = $(this);
		var x = setInterval(function() {
		  var now = new Date().getTime();
		  var distance = countDownDate - now;

		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		  var text = days + "d " + hours + "h "
		  + minutes + "m " + seconds + "s ";
		  $this.html(text);

		  if (distance < 0) {
		    clearInterval(x);
		   var text = 0 + "d " + 0 + "h "
		  + 0 + "m " + 0 + "s ";
		  $this.html(text);
		  }
		}, 1000);
	});

</script>
@endpush