@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
    <h3 class="title">@lang('Investment plans')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.invest.history') }}">@lang('History')</a>
        </li>
        <li>
            @lang('Investment plans')
        </li>
    </ul>
</div>
<div class="dashboard--content-item">
    <div class="pricing--wrapper row g-3 g-md-4 g-lg-3 g-xxl-4">
        @if (count($plans) == 0)
            <div class="col-12 text-center">
                    <h3 class="m-0">{{__('No Plan Found')}}</h3>
            </div>
        @else
            @foreach ($plans as $key=>$data)
            @php
                $schedule = \App\Models\ManageSchedule::where('time',$data->schedule_hour)->first();
            @endphp
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="plan__item">
                    <div class="plan__item-header">
                        <div class="left">
                            <h5 class="title">{{ $data->title }}</h5>
                            <span>{{ $data->subtitle }}</span>
                        </div>
                        <div class="right">
                            <h5 class="title">{{ $data->profit_percentage }}%</h5>
                            <span>@lang('Return')</span>
                        </div>
                    </div>
                    <div class="plan__item-body">
                        <ul>
                            <li>
                                <span class="name">@lang('Profit')</span>
                                <span class="info">
                                    {{ $data->lifetime_return == 1 ? 'Lifetime' :  'Every '.$schedule->name }}
                                </span>
                            </li>
                            <li>
                                <span class="name me-1">@lang('Capital will back')</span>
                                <span class="badge align-self-center me-auto bg--{{ $data->captial_return == 1 ? 'primary' : 'danger'}}">{{ $data->captial_return == 1 ? 'Yes' : 'No'}}</span>
                            </li>
                        </ul>
                        @if ($data->invest_type == 'range')
                            <h6 class="text-center amount-range">{{ showPrice($data->min_amount) }} - {{ showPrice($data->max_amount) }}</h6>
                        @else 
                            <h6 class="text-center amount-range">{{ showPrice($data->fixed_amount) }}</h6>
                        @endif
                        <button class="cmn--btn w-100 invest-plan" type="button" data-bs-toggle="modal"
                            data-bs-target="#invest-modal" data-title="{{ $data->title }}" data-id="{{ $data->id }}" data-type="{{ $data->invest_type == 'range' ? 0 : 1}}" data-fixAmount="{{ rootPrice($data->fixed_amount) }}">
                            @lang('Invest Now')
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>

    <!-- Invest Modal -->
    <div class="modal fade" id="invest-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="investForm" action="{{ route('user.invest.amount') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <h4 class="modal-title text-center plan-title">@lang('Basic Plan')</h4>
                        <div class="pt-3 pb-4">
                            <label for="amount" class="form-label">@lang('Enter Amount')</label>
                            <div class="input-group input--group">
                                <input type="number" name="amount" class="form-group-input form-control form--control bg--section"
                                    placeholder="0.00" id="modalAmount">
                                <button type="button" class="input-group-text">@lang('USD')</button>
                            </div>

                            <label for="amount" class="form-label">@lang('Select Wallet')</label>
                            <div class="input-group input--group">
                                <select name="wallet" id="investMethod" class="form-control" required>
                                    <option value="checkout">{{ __('checkout') }}</option>
                                    <option value="main_wallet">{{ __('Main Balance') }}</option>
                                    <option value="interest_wallet">{{ __('Interest Balance') }}</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="investId" id="investId" value="">
                        <div class="d-flex">
                            <button type="button" class="btn shadow-none btn--danger me-2 w-50"
                                data-bs-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn shadow-none btn--success w-50">@lang('Proceed')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Invest Modal -->
@endsection

@push('js')
<script>
    'use strict';

    $('.invest-plan').on('click',function(){
        $('#modalAmount').val('');
        $('#modalAmount').prop('readonly',false)

        let id = $(this).data('id');
        let title = $(this).data('title');
        let type = $(this).data('type');

        if(type == 1){
            $('#modalAmount').val($(this).attr('data-fixAmount'));
            $('#modalAmount').prop('readonly',true)
        }
        $('#investId').val(id);
        $('.plan-title').text(title);
    });

    $(document).on('change','#investMethod',function(){
        var val = $(this).val();
 
        if(val == 'checkout'){
            $('.investForm').prop('action','{{ route('user.invest.amount') }}');
        }

        if(val == 'main_wallet'){
            $('.investForm').prop('action','{{ route('user.invest.mainWallet') }}');
        }

        if(val == 'interest_wallet'){
            $('.investForm').prop('action','{{ route('user.invest.interestWallet') }}');
        }
    });

</script>
@endpush