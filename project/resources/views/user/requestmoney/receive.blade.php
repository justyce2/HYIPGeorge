@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
  <h3 class="title">@lang('Receive Request Money')</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
      </li>

      <li>
          @lang('Receive Request Money')
      </li>
  </ul>
</div>

<div class="dashboard--content-item">
    <div class="table-responsive table--mobile-lg">
        <table class="table bg--body">
            <thead>
                <tr>
                  <th>{{ __('Date') }}</th>
                  <th>{{ __('Request From') }}</th>
                  <th>{{ __('Amount') }}</th>
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
                  @php
                      $from = App\Models\User::where('id',$data->user_id)->first();
                  @endphp
                  <tr>
                      <td data-label="{{ __('Date') }}">
                        <div>
                          {{ $data->created_at->toFormattedDateString() }}
                        </div>
                      </td>
                      <td data-label="{{ __('Request From') }}">
                        <div>
                          {{ $from != NULL ? $from->name : 'User Deleted' }}
                        </div>
                      </td>
                      <td data-label="{{ __('Amount') }}">
                        <div>
                          {{ showprice($data->amount,$currency) }}
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

                            @if ($data->status == 0)
                              <a href="javascript:;" id="sendBtn" data-href="{{ route('user.request.money.send',$data->id) }}" class="btn text--body" data-bs-toggle="modal" data-bs-target="#modal-success">
                                {{__('Send')}}
                              </a>
                            @endif
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


<div class="modal fade confirm-modal" id="modal-success" aria-modal="true" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
        <form id="requestMoney" action="" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body p-4">
            <h4 class="modal-title text-center" id="withdrawModalTitle">@lang('Receive Request Money')</h4>
              <div class="modal-body text-center py-4">
                <p class="text-center">{{ __("You are about to change the status.") }}</p>
                <p class="text-center">{{ __("Do you want to proceed?") }}</p>
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
    
    $("#sendBtn").on('click',function(){
      $("#requestMoney").prop("action",$(this).data('href'))
    })
  </script>
@endpush

