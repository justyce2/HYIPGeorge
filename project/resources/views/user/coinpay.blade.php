@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
    <h3 class="title">@lang('Coinpay invest')</h3>
    <ul class="breadcrumb">
        <li>
          <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
    </ul>
  </div>

<div class="dashboard--content-item">
    <div class="row">
        <div class="col-lg-12 col-md-12">
                <div class="card default--card">
                    <div class="card-header">
                        <h5 class="card-title text-dark text-center">@lang('Bitcoin Invest Information')</h5>
                    </div>
                    <div class="card-body">
                        <img src="{{ Session::get('qrcode_url') }}">
                        <br>
                        <br>
                        <h3 class="text-center">@lang('Address'): {{ Session::get('address') }}</h3>
                        <p>@lang('Please send approximately') <b>{{ Session::get('amount') }}</b> @lang('BTC to this address. After completing your payment'), <b>{{ Session::get('currency_sign') }}{{ Session::get('currency_value') }}</b> invest will be deposited. <br>This Process may take some time for confirmations. Thank you.</p>
                        <h4><a href="{{ Session::get('status_url') }}" class="btn btn-success">@lang('Check Status')</a></h4>
                        <h4><a href="javascript:history.back();">@lang('Back')</a></h4>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>


@endsection

@push('js')

@endpush
