@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
  <h3 class="title">@lang('Request Money')</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
      </li>

      <li>
          @lang('Request Money')
      </li>
  </ul>
</div>

<div class="dashboard--content-item">
  <div class="row g-3">
    <div class="col-12">
      <div class="card default--card">
        <div class="card-body">
            @includeIf('includes.flash')
            <form id="request-form" action="{{ route('user.money.request.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row gy-3 gy-md-4">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="form-label required">{{__('Receiver Email')}}</label>
                      <input name="email" id="accountemail" class="form-control @error('email') is-invalid @enderror" autocomplete="off" placeholder="{{__('doe@gmail.com')}}" type="email" value="{{ old('email') }}">
                      @error('email')
                        <p class="text-danger mt-2">{{ $message }}</p>
                      @enderror

                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="form-label required">{{__('Account Name')}}</label>
                      <input name="name" id="account_name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" placeholder="{{__('Jhon Doe')}}" type="text" value="{{ old('name') }}" readonly>
                      @error('name')
                        <p class="text-danger mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="form-label required">{{__('Amount')}}</label>
                      <input name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" autocomplete="off" placeholder="{{__('0.0')}}" type="number" value="{{ old('amount') }}" min="1">
                      @error('amount')
                        <p class="text-danger mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                        <label class="form-label">{{__('Description')}}</label>
                        <textarea name="details" class="form-control nic-edit" cols="30" rows="5" placeholder="{{__('Receive account details')}}"></textarea>
                    </div>
                </div>

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
</div>

<div class="dashboard--content-item">
    <div class="table-responsive table--mobile-lg">
        <table class="table bg--body">
            <thead>
                <tr>
                  <th>{{ __('Date') }}</th>
                  <th>{{ __('Sender') }}</th>
                  <th>{{ __('Amount') }}</th>
                  <th>{{ __('Receiver') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Details') }}</th>
                </tr>
            </thead>
            <tbody>
              @if (count($requests) == 0)
                <tr>
                  <td colspan="12">
                    <h4 class="text-center m-0 py-2">{{__('No Data Found')}}</h4>
                  </td>
                </tr>
                @else
                @foreach($requests as $key=>$data)
                  <tr>
                      <td data-label="{{ __('Date') }}">
                        <div>
                          {{ $data->created_at->toFormattedDateString() }}
                        </div>
                      </td>
                      <td data-label="{{ __('Sender') }}">
                        <div>
                          {{ auth()->user()->name }}
                        </div>
                      </td>
                      <td data-label="{{ __('Amount') }}">
                        <div>
                          {{ showprice($data->amount,$currency) }}
                        </div>
                      </td>
                      <td data-label="{{ __('Receiver') }}">
                        <div>
                          {{ $data->receiver_name }}
                        </div>
                      </td>
                      <td data-label="{{ __('Status') }}">
                        <div>
                          <span class="badge bg-{{ $data->status == 1 ? 'success' : 'warning'}}">{{ $data->status == 1 ? 'completed' : 'pending'}}</span>
                        </div>
                      </td>

                      <td data-label="{{ __('Details') }}">
                        <div class="btn-list">
                            <a href="{{route('user.money.request.details',$data->id)}}" class="btn btn-primary">
                              {{__('Details')}}
                            </a>
                        </div>
                      </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
        </table>
    </div>
    {{ $requests->links() }}
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
