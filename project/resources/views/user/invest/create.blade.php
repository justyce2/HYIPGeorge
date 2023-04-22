@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
  <h3 class="title">@lang('Invest')</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
      </li>

      <li>
          @lang('Invest')
      </li>
  </ul>
</div>

<div class="dashboard--content-item">
  <div class="row g-3">
    <div class="col-12">
      <div class="card p-5 default--card">
          @includeIf('includes.flash')
          <form id="payment-form" method="POST" action="">
              @csrf

              <div class="row gy-3 gy-md-4">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label required">{{__('User Email')}}</label>
                    <input name="email" id="accountemail" class="form-control @error('email') is-invalid @enderror" autocomplete="off" placeholder="{{__('doe@gmail.com')}}" type="email" value="{{ auth()->user()->email }}" readonly>
                    @error('email')
                      <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror

                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label required">{{__('User Name')}}</label>
                    <input name="name" id="account_name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" placeholder="{{__('Jhon Doe')}}" type="text" value="{{ auth()->user()->name }}" readonly>
                    @error('name')
                      <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <div class="col-sm-12">
                  <div id="card-view" class="col-md-12 d-none">
                      <div class="row gy-3">
                          <input type="hidden" name="cmd" value="_xclick">
                          <input type="hidden" name="no_note" value="1">
                          <input type="hidden" name="lc" value="UK">
                          <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">
  
                          <div class="col-md-6">
                              <input type="text" class="form-control card-elements" name="cardNumber" placeholder="{{ __('Card Number') }}" autocomplete="off" required autofocus oninput="validateCard(this.value);"/>
                              <span id="errCard"></span>
                          </div>
  
                          <div class="col-lg-6 cardRow">
                              <input type="text" class="form-control card-elements" placeholder="{{ ('Card CVC') }}" name="cardCVC" oninput="validateCVC(this.value);">
                              <span id="errCVC"></span>
                          </div>
  
                          <div class="col-lg-6">
                              <input type="text" class="form-control card-elements" placeholder="{{ __('Month') }}" name="month" >
                          </div>
  
                          <div class="col-lg-6">
                              <input type="text" class="form-control card-elements" placeholder="{{ __('Year') }}" name="year">
                          </div>
  
                      </div>
                  </div>
              </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label required">{{__('Amount')}}</label>
                    <input name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" autocomplete="off" placeholder="{{__('0.0')}}" type="number" value="{{ rootPrice(session('invest_amount')) }}" min="1" readonly>
                    @error('amount')
                      <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <div class="col-sm-6">
                  <label class="form-label required">{{__('Payment Method')}}</label>
                  <select id="method" name="method" required class="form-control @error('method') is-invalid @enderror">
                      <option value="">{{ __('Select Payment Method') }}</option>                 
                         @foreach ($gateways as $gateway)
                          @if ($gateway->type == 'manual')
                              <option value="Manual" data-details="{{$gateway->details}}">{{ $gateway->title }}</option>
                              @else
                              <option value="{{$gateway->keyword}}">{{ $gateway->name }}</option>
                          @endif
                        @endforeach             
                  </select>
                  @error('method')
                    <p class="text-danger mt-2">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-sm-12 mt-4 manual-payment d-none">
                  <div class="card default--card">
                    <div class="card-body">
                      <div class="row">

                        <div class="col-sm-12 pb-2 manual-payment-details">
                        </div>
                        
                        <div class="col-sm-12">
                          <label class="form-label required">@lang('Transaction ID')#</label>
                          <input class="form-control" name="txn_id4" type="text" placeholder="Transaction ID" id="manual_transaction_id">
                        </div>
                        
                      </div>
                    </div>
                  </div>
              </div>

                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="plan_id" value="{{ session('investPlanId') }}">
                <input type="hidden" name="currency_sign" value="{{ $defaultCurrency->sign }}">
                <input type="hidden" name="currency_code" value="{{ $defaultCurrency->name }}">
                <input type="hidden" name="currency_id" value="{{ $defaultCurrency->id }}">

                <div class="col-sm-12">
                  <label class="form-label d-none d-sm-block">&nbsp;</label>
                  <button type="submit" class="cmn--btn bg--primary submit-btn w-100 border-0">{{__('Submit')}}</button>

                </div>
              </div>

          </form>
      </div>
  </div>
  </div>
</div>

<div class="dashboard--content-item">
    <div class="table-responsive table--mobile-lg">
        <table class="table bg--body">
            <thead>
                <tr>
                    <th>@lang('Transaction')</th>
                    <th>@lang('Method')</th>
                    <th>@lang('Plan')</th>
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
                        @else 
                          <td data-label="Next Profit" class="countdown" data-date="{{ Carbon\Carbon::parse($data->profit_time)->format('M d,Y h:i:s') }}"></td>
                        @endif

                    </tr>
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

  $(document).on('change','#method',function(){
      var val = $(this).val();

      if(val == 'stripe')
      {
          $('#payment-form').prop('action','{{ route('checkout.stripe.submit') }}');
          $('#card-view').removeClass('d-none');
          $('.card-elements').prop('required',true);
          $('#manual_transaction_id').prop('required',false);
          $('.manual-payment').addClass('d-none');

      }

      if(val == 'authorize.net')
      {
          $('#payment-form').prop('action','{{ route('checkout.authorize.submit') }}');
          $('#card-view').removeClass('d-none');
          $('.card-elements').prop('required',true);
          $('#manual_transaction_id').prop('required',false);
          $('.manual-payment').addClass('d-none');
      }

      if(val == 'paypal') {
          $('#payment-form').prop('action','{{ route('checkout.paypal.submit') }}');
          $('#card-view').addClass('d-none');
          $('.card-elements').prop('required',false);
          $('#manual_transaction_id').prop('required',false);
          $('.manual-payment').addClass('d-none');
      }

      if(val == 'mollie') {
          $('#payment-form').prop('action','{{ route('checkout.molly.submit') }}');
          $('#card-view').addClass('d-none');
          $('.card-elements').prop('required',false);
          $('#manual_transaction_id').prop('required',false);
          $('.manual-payment').addClass('d-none');
      }

      if(val == 'flutterwave') {
          $('#payment-form').prop('action','{{ route('checkout.flutter.submit') }}');
          $('#card-view').addClass('d-none');
          $('.card-elements').prop('required',false);
          $('#manual_transaction_id').prop('required',false);
          $('.manual-payment').addClass('d-none');
      }


      if(val == 'paytm') {
          $('#payment-form').prop('action','{{ route('checkout.paytm.submit') }}');
          $('#card-view').addClass('d-none');
          $('.card-elements').prop('required',false);
          $('#manual_transaction_id').prop('required',false);
          $('.manual-payment').addClass('d-none');
      }

      if(val == 'instamojo') {
          $('#payment-form').prop('action','{{ route('checkout.instamojo.submit') }}');
          $('#card-view').addClass('d-none');
          $('.card-elements').prop('required',false);
          $('#manual_transaction_id').prop('required',false);
          $('.manual-payment').addClass('d-none');
      }

      if(val == 'coinPayment') {
        $('#payment-form').prop('action','{{ route('checkout.coinpay.submit') }}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
      }

      if(val == 'coingate') {
        $('#payment-form').prop('action','{{route('checkout.coingate.submit')}}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
      }

      if(val == 'razorpay') {
          $('#payment-form').prop('action','{{ route('checkout.razorpay.submit') }}');
          $('#card-view').addClass('d-none');
          $('.card-elements').prop('required',false);
          $('#manual_transaction_id').prop('required',false);
          $('.manual-payment').addClass('d-none');
      }

      if(val == 'Manual'){
      $('#payment-form').prop('action','{{route('checkout.manual.submit')}}');
      $('.manual-payment').removeClass('d-none');
      $('#card-view').addClass('d-none');
      $('.card-elements').prop('required',false);
      $('#manual_transaction_id').prop('required',true);
      const details = $(this).find(':selected').data('details');
      $('.manual-payment-details').empty();
      $('.manual-payment-details').append(`<font size="3">${details}</font>`)
    }
  });

  </script>

  <script>
      'use strict';
      closedFunction=function() {
          alert('Payment Cancelled!');
      }

      successFunction=function(transaction_id) {
          window.location.href = '{{ url('order/payment/return') }}?txn_id=' + transaction_id;
      }

      failedFunction=function(transaction_id) {
          alert('Transaction was not successful, Ref: '+transaction_id)
      }
  </script>

<script type="text/javascript">
  'use strict';

  var cnstatus = false;
  var dateStatus = false;
  var cvcStatus = false;

  function validateCard(cn) {
    cnstatus = Stripe.card.validateCardNumber(cn);
    if (!cnstatus) {
      $("#errCard").html('Card number not valid<br>');
    } else {
      $("#errCard").html('');
    }
    btnStatusChange();


  }

  function validateCVC(cvc) {
    cvcStatus = Stripe.card.validateCVC(cvc);
    if (!cvcStatus) {
      $("#errCVC").html('CVC number not valid');
    } else {
      $("#errCVC").html('');
    }
    btnStatusChange();
  }

</script>

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

<script type="text/javascript" src="{{ asset('assets/front/js/payvalid.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/paymin.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/payform.js') }}"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
@endpush



