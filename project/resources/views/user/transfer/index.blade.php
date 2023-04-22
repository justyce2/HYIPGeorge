@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
  <h3 class="title">@lang('Transfer Money')</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
      </li>

      <li>
          @lang('Transfer Money')
      </li>
  </ul>
</div>

<div class="dashboard--content-item">
  <div class="row g-3">
    <div class="col-12">
      <div class="card default--card">
        <div class="card-body">
            @includeIf('includes.flash')
            <form id="request-form" action="{{ route('money.transfer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row gy-3 gy-md-4">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="form-label required">{{__('Receiver Email')}}</label>
                      <input name="email" id="accountemail" class="form-control @error('email') is-invalid @enderror" autocomplete="off" placeholder="{{__('doe@gmail.com')}}" type="email" value="{{ old('email') }}">
                      @error('email')
                        <p class="text-danger mt-2">{{ $message }}</p>
                      @enderror

                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="form-label required">{{__('Account Name')}}</label>
                      <input name="name" id="account_name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" placeholder="{{__('Jhon Doe')}}" type="text" value="{{ old('name') }}" readonly>
                      @error('name')
                        <p class="text-danger mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="form-label required">{{__('Amount')}}</label>
                      <input name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" autocomplete="off" placeholder="{{__('0.0')}}" type="number" value="{{ old('amount') }}" min="1">
                      @error('amount')
                        <p class="text-danger mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <label class="form-label required">{{__('Wallet')}}</label>
                    <select name="wallet" id="wallet" class="form-control @error('wallet') is-invalid @enderror">
                        <option value="">{{ __('Select Wallet') }}</option>                 
                        <option value="main_balance">{{ __('Main Balance') }}</option>                 
                        <option value="interest_balance">{{ __('Interest Balance') }}</option>                 
                    </select>
                    @error('wallet')
                      <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="col-sm-6">
                    <label class="form-label required">{{__('Password')}}</label>
                      <input name="password" id="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off"  type="password">
                      @error('password')
                        <p class="text-danger mt-2">{{ $message }}</p>
                      @enderror
                  </div>

                  <div class="col-sm-6">
                    <label class="form-label d-none d-sm-block">&nbsp;</label>
                    <button type="submit" class="cmn--btn bg--primary submit-btn w-100 border-0">{{__('Submit')}}</button>

                  </div>
                </div>

            </form>
        </div>
      </div>
  </div>
  </div>
</div>

<div class="dashboard--content-item">
    <div class="table-responsive table--mobile-lg">
        <table class="table bg--body">
            <thead>
                <tr>
                    <th>@lang('Date')</th>
                    <th>@lang('Transaction')</th>
                    <th>@lang('Receiver')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Fee')</th>
                    <th>@lang('Status')</th>
                </tr>
            </thead>
            <tbody>
              @if (count($transfers) == 0)
                <tr>
                  <td colspan="12">
                    <h4 class="text-center m-0 py-2">{{__('No Data Found')}}</h4>
                  </td>
                </tr>
              @else
                @foreach ($transfers as $key=>$data)
                  @php
                      $receiver = \App\Models\User::whereId($data->receiver_id)->first();
                  @endphp  
                  <tr>
                      <td data-label="Date">
                        <div>
                          {{ $data->created_at->toFormattedDateString() }}
                        </div>
                      </td>

                      <td data-label="Transaction">
                          <div>
                              {{ strtoupper($data->transaction_no) }}
                          </div>
                      </td>

                      <td data-label="Receiver">
                        <div>
                            {{ $receiver != NULL ? $receiver->email : 'Customer Deleted' }}
                        </div>
                      </td>

                      <td data-label="Amount">
                          <div>
                              {{ $data->amount }}
                          </div>
                      </td>

                      <td data-label="Fee">
                          <div>
                              {{ $data->cost }}
                          </div>
                      </td>

                      <td data-label="Status">
                          <div>
                              <span class="badge btn--{{ $data->status == 1 ? 'success' : 'warning'}} btn-sm">{{ $data->status == 1 ? 'Succeed' : 'Pending'}}</span>
                          </div>
                      </td>

                  </tr>
                @endforeach
              @endif

            </tbody>
        </table>
    </div>
    {{ $transfers->links() }}
</div>


@endsection

@push('js')
<script>
  'use strict';
  
  $("#account_name").on('click',function(){
    let accountEmail = $("#accountemail").val();
    
    let url = `${mainurl}/user/username/${accountEmail}`;

    $.get(url, function(data){
      $("#account_name").val(data);
    });
  })
</script>
@endpush



