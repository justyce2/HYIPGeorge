@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between py-3">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ $data->name }}</h5>
        <ol class="breadcrumb py-0 m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ __('User') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">{{ __('Users') }}</a></li>
        </ol>
	</div>
</div>


<div class="row mt-3">
  <div class="col-lg-12">
    @php
      $currency = defaultCurr();
    @endphp
	@include('includes.admin.form-success')

	<div class="card">
        <div class="row my-5">
            <div class="col-md-2">
                <div class="user-image">
                    @if($data->is_provider == 1)
                    <img src="{{ $data->photo ? asset($data->photo):asset('assets/images/noimage.png')}}" alt="No Image">
                    @else
                    <img  class="" src="{{ $data->photo ? asset('assets/images/'.$data->photo):asset('assets/images/noimage.png')}}" alt="No Image">
                    @endif
                    <a  class="mybtn1 btn btn-primary"  data-email="{{ $data->email }}" data-toggle="modal" data-target="#vendorform" href="">{{__('Send Message')}}</a>

                </div>
            </div>
            <div class="col-md-5 mt-5">
                <div class="table-responsive show-table">
                    <table class="table">
                    <tr>
                      <th>{{__('ID#')}}</th>
                      <td>{{$data->id}}</td>
                    </tr>
                    <tr>
                      <th>{{__('Username')}}</th>
                      <td>{{$data->name}}</td>
                    </tr>
                    <tr>
                      <th>{{__('Email')}}</th>
                      <td>{{$data->email}}</td>
                    </tr>
                    <tr>
                      <th>{{__('Address')}}</th>
                      <td>{{$data->address}}</td>
                    </tr>

                    <tr>
                      <th>{{__('City')}}</th>
                      <td>{{$data->city}}</td>
                    </tr>

                    <tr>
                      <th>{{__('Zip Code')}}</th>
                      <td>{{$data->zip}}</td>
                    </tr>


                    </table>
                </div>
            </div>
            <div class="col-md-4 mx-auto ">
              <h3 class="card-title text-center"> <strong>@lang('Available Balance') : {{ convertedPrice($data->balance,$currency->id) }}</strong></h3>
              <form action="{{ route('admin.user.balance.add.deduct') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="inp-address">{{ __('Amount') }}</label>
                  <input type="number" class="form-control" id="inp-address" name="amount"  placeholder="{{ __('Enter Amount') }}" value="" min="0" step="0.01" required>
                </div>

                <input type="hidden" name="user_id" value="{{ $data->id }}">

                <div class="form-group">
                  <label for="exampleFormControlSelect1">@lang('Select Method')</label>
                  <select class="form-control" name="type" id="exampleFormControlSelect1" required>
                    <option value="add">@lang('add amount')</option>
                    <option value="subtract">@lang('subtract amount')</option>
                  </select>
                </div>
                <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>
              </form>
            </div>
        </div>


	</div>
  </div>
  <!-- DataTable with Hover -->

</div>

<div class="row mb-3">
    

  </div>
<!--Row-->

{{-- STATUS MODAL --}}

<div class="modal fade confirm-modal" id="statusModal" tabindex="-1" role="dialog"
	aria-labelledby="statusModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title">{{ __("Update Status") }}</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<p class="text-center">{{ __("You are about to change the status.") }}</p>
			<p class="text-center">{{ __("Do you want to proceed?") }}</p>
		</div>
		<div class="modal-footer">
		<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</a>
		<a href="javascript:;" class="btn btn-success btn-ok">{{ __("Update") }}</a>
		</div>
	</div>
	</div>
</div>

{{-- STATUS MODAL ENDS --}}


{{-- MESSAGE MODAL --}}
<div class="sub-categori">
    <div class="modal fade confirm-modal" id="vendorform" tabindex="-1" role="dialog"
    aria-labelledby="vendorformLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="vendorformLabel">{{ __("Send Message") }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-form">
                            <form id="emailreply1">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <input type="email" class="form-control" id="eml1" name="to"  placeholder="{{ __('Email') }}" value="{{ $data->email }}" required="">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subj1" name="subject"  placeholder="{{ __('Subject') }}" value="" required="">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="msg1" cols="20" rows="6" placeholder="{{ __('Your Message') }} "required=""></textarea>
                                </div>



                                <button class="submit-btn btn btn-primary text-center" id="emlsub1" type="submit">{{ __("Send Message") }}</button>
                            </form>
                        </div>
                    </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    {{-- MESSAGE MODAL ENDS --}}

{{-- DELETE MODAL --}}

<div class="modal fade confirm-modal" id="deleteModal" tabindex="-1" role="dialog"
aria-labelledby="deleteModalTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">{{ __("Confirm Delete") }}</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
	<p class="text-center">{{__("You are about to delete this Blog.")}}</p>
	<p class="text-center">{{ __("Do you want to proceed?") }}</p>
</div>
<div class="modal-footer">
	<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</a>
	<a href="javascript:;" class="btn btn-danger btn-ok">{{ __("Delete") }}</a>
</div>
</div>
</div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection



