@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
    <h3 class="title">@lang('Deposit History')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.deposit.index') }}">@lang('Deposit')</a>
        </li>
        <li>
            @lang('Deposit History')
        </li>
    </ul>
</div>

<div class="dashboard--content-item">
  <div class="card p-3 default--card">
    <form action="{{ route('user.deposit.index') }}" method="get">
      <div class="row g-3">
        <div class="col-md-4">
          <input name="trx_no" class="form-control" autocomplete="off" placeholder="{{__('Deposit number')}}" type="text" value="{{ old('trx_no')}}">
        </div>

        <div class="col-md-4">
          <select id="type" name="type" required class="form-control">
            <option value="">{{ __('Select Method') }}</option>                              
            <option value="all">{{ __('All') }}</option>                              
            <option value="stripe">{{ __('Stripe') }}</option>                              
            <option value="paypal">{{ __('Paypal') }}</option>                              
            <option value="authorize.net">{{ __('Authorize.net') }}</option>                              
            <option value="flutterwave">{{ __('Flutterwave') }}</option>                              
            <option value="mollie">{{ __('Mollie Payment') }}</option>                              
            <option value="instamojo">{{ __('Instamojo') }}</option>                              
            <option value="razorpay">{{ __('Razorpay') }}</option>                              
            <option value="paytm">{{ __('Paytm') }}</option>                              
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
    <div class="table-responsive table--mobile-lg">
        <table class="table bg--body">
            <thead>
                <tr>
                    <th>@lang('Deposit Date')</th>
                    <th>@lang('Deposit Number')</th>
                    <th>@lang('Method')</th>
                    <th>@lang('Account')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Status')</th>
                </tr>
            </thead>
            <tbody>
              @if (count($deposits) == 0)
              <tr>
                <td colspan="12">
                  <h4 class="text-center m-0 py-2">{{__('No Data Found')}}</h4>
                </td>
              </tr>
              @else
                @foreach ($deposits as $key=>$data)  
                  <tr>
                      <td data-label="Deposit Date">
                        <div>
                            {{date('d-M-Y',strtotime($data->created_at))}}
                        </div>
                      </td>

                      <td data-label="Deposit Number">
                        <div>
                            {{ strtoupper($data->deposit_number) }}
                        </div>
                      </td>

                      <td data-label="Method">
                        <div>
                            {{ ucfirst($data->method) }}
                        </div>
                      </td>

                      <td data-label="Account">
                        <div>
                            {{ auth()->user()->email }}
                        </div>
                      </td>

                      <td data-label="Amount">
                          <div>
                            {{ showprice($data->amount,$currency) }}
                          </div>
                      </td>


                      <td data-label="Status">
                          <div>
                           <!-- <span class="badge btn--{{ $data->status == 1 ? 'warning' : 'success'}} btn-sm">{{ $data->status == 1 ? 'Pending' : 'Succeed'}}</span>-->
                           <span badge btn-success btn-sm>{{$data->status}}</span>
                          </div>
                      </td>

                  </tr>
                @endforeach
              @endif
            </tbody>
        </table>
    </div>
    {{ $deposits->links() }}
</div>
@endsection

@push('js')
    
@endpush