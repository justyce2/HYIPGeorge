@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
  <h3 class="title">@lang('Withdraw')</h3>
  <ul class="breadcrumb">
      <li>
          <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
      </li>
      <li>
          @lang('Withdraw')
      </li>
  </ul>
</div>

<div class="dashboard--content-item">
  <div class="row g-3">
    @foreach ($methods as $key=>$data) 
      <div class="col-sm-6 col-lg-4 col-xxl-3">
          <div class="card default--card">
              <div class="card-header text-center bg--section py-2 border-bottom">
                  <h5 class="card-title m-0">{{ucfirst($data->name)}}</h5>
              </div>
              <div class="card-body">
                  <img src="{{asset('assets/images/'.$data->photo)}}" class="card-img" alt="payment">
                  <ul class="list-group list-group-flush withdraw--list pt-3">
                      <li class="list-group-item">
                        <strong class="name">@lang('Withdraw Amount') </strong>
                        <span class="info text--success">{{ $data->min_amount }} {{ $data->currency->name }} - {{ $data->max_amount }} {{ $data->currency->name }}</span>
                      </li>

                      <li class="list-group-item">
                        <strong class="name">@lang('Total Fixed Charge') </strong>
                        <span class="info text--danger">{{ $data->fixed }} {{ $data->currency->name }}</span>
                      </li>

                      <li class="list-group-item">
                        <strong class="name">@lang('Total Percentage Charge') </strong>
                        <span class="info text--danger">{{ $data->percentage }} %</span>
                      </li>
                  </ul>
              </div>
              <div class="card-footer bg--section border-top d-flex">
                  <a href="#0" id="withdrawNow" class="cmn--btn w-100" data-bs-toggle="modal"
                      data-bs-target="#withdraw-modal" data-id="{{ $data->id }}" data-name="{{ $data->name }}" data-currName="{{ $data->currency->name}}" data-currSign="{{ $data->currency->sign}}">@lang('Withdraw Now')</a>
              </div>
          </div>
      </div>
    @endforeach
  </div>
</div>

<div class="dashboard--content-item">
    <div class="table-responsive table--mobile-lg">
        <table class="table bg--body">
            <thead>
                <tr>
                    <th>@lang('Buyer')</th>
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


<div class="modal fade" id="withdraw-modal" aria-modal="true" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('user.withdraw.request')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body p-4">
              <h4 class="modal-title text-center" id="withdrawModalTitle">@lang('Stripe Withdraw')</h4>
              <div class="pt-3 pb-4">
                <label for="amount" class="form-label">@lang('Enter Amount')</label>
                <div class="input-group input--group">
                    <input type="number" name="amount" class="form-group-input form-control form--control bg--section"
                        placeholder="0.00" id="amount" >
                    <button type="button" class="input-group-text" id="withdrawModalCurrency">USD</button>
                </div>

                <label for="withdraw_wallet" class="form-label">@lang('Select Wallet')</label>
                <div class="input-group input--group">
                    <select name="withdraw_wallet" id="withdraw_wallet" class="form-control" required>
                        <option value="main_wallet">{{ __('Main Balance') }}</option>
                        <option value="interest_wallet">{{ __('Interest Balance') }}</option>
                    </select>
                </div>

                <label for="info" class="form-label mt-2">@lang('Enter Account Information')</label>
                <div class="input-group input--group">
                    <textarea name="details" class="form-group-input form-control form--control bg--section" cols="30" rows="10"></textarea>
                </div>
                <input type="hidden" name="method_id" value="" id="withdrawMethodId">
              </div>
              <div class="d-flex">
                  <button type="button" class="btn shadow-none btn--danger me-2 w-50" data-bs-dismiss="modal">@lang('Close')</button>
                  <button type="submit" class="btn shadow-none btn--success w-50">@lang('Proceed')</button>
              </div>
          </div>
        </form>
      </div>
  </div>
</div>
@endsection

@push('js')
  <script>
    'use strict';
    $(document).on('click','#withdrawNow',function(){
      $("#withdrawModalTitle").text($(this).attr('data-name')+' Withdraw');
      $("#withdrawModalCurrency").text($(this).attr('data-currName'));
      $("#withdrawMethodId").val($(this).attr('data-id'));
    });
  </script>
@endpush

