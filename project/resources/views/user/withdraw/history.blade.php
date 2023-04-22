@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
    <h3 class="title">@lang('Withdraw History')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.withdraw.index') }}">@lang('Payout')</a>
        </li>
        <li>
            @lang('Withdraw History')
        </li>
    </ul>
</div>

<div class="dashboard--content-item">
    <div class="card p-3 default--card">
      <form action="{{ route('user.withdraw.history') }}" method="get">
        <div class="row g-3">
          <div class="col-md-4">
            <input name="trx_no" class="form-control" autocomplete="off" placeholder="{{__('Transaction no')}}" type="text" value="{{ old('trx_no')}}">
          </div>
  
          <div class="col-md-4">
            <select id="type" name="type" required class="form-control">
              <option value="">{{ __('Select Type') }}</option>                              
              <option value="all">{{ __('All') }}</option>                              
              <option value="pending">{{ __('Pending') }}</option>                              
              <option value="completed">{{ __('Completed') }}</option>                              
              <option value="rejected">{{ __('Rejected') }}</option>                              
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
                    <th>@lang('Buyer')</th>
                    <th>@lang('Transaction no')</th>
                    <th>@lang('Payment Method')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Fee')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Options')</th>
                </tr>
            </thead>
            <tbody>
                @if (count($withdraws) == 0)
                    <tr>
                        <td colspan="12">
                            <h4 class="text-center m-0 py-2">{{__('No Data Found')}}</h4>
                        </td>
                    </tr>
                @else
                    @foreach ($withdraws as $key=>$data)  
                    <tr>
                        <td data-label="Buyer">
                            <div class="cmn--media">
                                <img src="{{ auth()->user()->photo ? asset('assets/images/'.auth()->user()->photo) : asset('assets/front/images/clients/client1.jpg') }}" alt="clients">
                                <h6 class="m-0 subtitle">{{ auth()->user()->name }}</h6>
                            </div>
                        </td>
                        <td data-label="Transaction no">
                            <div>
                                {{ strtoupper($data->txnid) }}
                            </div>
                        </td>

                        <td data-label="Payment Method">
                            <div>
                                {{ ucfirst($data->method) }}
                            </div>
                        </td>

                        <td data-label="Amount">
                            <div>
                                {{ convertedPrice($data->amount,$data->currency_id) }}
                            </div>
                        </td>

                        <td data-label="Fee">
                            <div>
                                {{ convertedPrice($data->fee,$data->currency_id) }}
                            </div>
                        </td>

                        <td data-label="Status">
                            <div>
                                @if ($data->status == 'pending')
                                    <span class="badge btn--warning btn-sm">@lang('Pending')</span>
                                @elseif($data->status == 'completed')
                                    <span class="badge btn--success btn-sm">@lang('Completed')</span>
                                @else
                                    <span class="badge btn--danger btn-sm">@lang('Rejected')</span>
                                @endif
                            </div>
                        </td>

                        <td data-label="Options">
                            <div class="text-center">
                                <a href="{{ route('user.withdraw.details',$data->id) }}" class="btn btn--base text--dark btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                    @lang('details')
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
    
@endpush