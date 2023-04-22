@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
  <h3 class="title">@lang('Withdraw Details')</h3>
  <ul class="breadcrumb">
      <li>
          <a href="{{ route('user.withdraw.index') }}">@lang('Payout')</a>
      </li>
      <li>
          @lang('Withdraw Details')
      </li>
  </ul>
</div>

<div class="dashboard--content-item">
  <div class="table-responsive-sm">
      <table class="table mb-0">
          <tbody>
          <tr class="border-top">
              <th class="45%" width="45%">{{__('WithDraw Method')}}</th>
              <td width="10%">:</td>
              <td class="45%" width="45%">{{ $data->method }}</td>
          </tr>

          <tr>
              <th class="45%" width="45%">{{__('User Name')}}</th>
              <td width="10%">:</td>
              <td class="45%" width="45%">{{ $data->user->name }}</td>
          </tr>

          <tr>
              <th class="45%" width="45%">{{__('Amount')}}</th>
              <td width="10%">:</td>
              <td class="45%" width="45%">{{ convertedPrice($data->amount,$data->currency_id) }}</td>
          </tr>

          <tr>
              <th class="45%" width="45%">{{__('Fees')}}</th>
              <td width="10%">:</td>
              <td class="45%" width="45%">{{ convertedPrice($data->fee,$data->currency_id) }}</td>
          </tr>

          <tr>
            <th class="45%" width="45%">{{__('Details')}}</th>
            <td width="10%">:</td>
            <td class="45%" width="45%">{{ $data->details }}</td>
          </tr>

          <tr>
              <th class="45%" width="45%">{{__('Status')}}</th>
              <td width="10%">:</td>
              <td class="45%" width="45%">
                @if ($data->status == 'completed')
                  <span class="badge bg-success">{{__('Completed')}}</span>
                @elseif($data->status == 'pending')
                  <span class="badge bg-warning">{{__('Pending')}}</span>
                @else 
                  <span class="badge bg-danger">{{__('Rejected')}}</span>
                @endif
              </td>
          </tr>


          </tbody>
      </table>
  </div>
</div>


@endsection

@push('js')

@endpush
