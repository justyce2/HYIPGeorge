@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Transactions') }}</h5>
    <ol class="breadcrumb m-0 py-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="javascript:;">{{ __('Transactions') }}</a></li>
    </ol>
	</div>
</div>


<!-- Row -->
<div class="row mt-3">
  <div class="col-lg-12">
	@include('includes.admin.form-success')
	<div class="card mb-4">
	  <div class="table-responsive p-3">
		<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
		  <thead class="thead-light">
			<tr>
        <th>{{__('Customer Email')}}</th>
        <th>{{__('Amount')}}</th>
        <th>{{__('Type')}}</th>
        <th>{{__('Txnid')}}</th>
        <th>{{__('Date')}}</th>
			</tr>
		  </thead>
		</table>
	  </div>
	</div>
  </div>
</div>



@endsection



@section('scripts')

<script type="text/javascript">
	"use strict";

    var table = $('#geniustable').DataTable({
           ordering: false,
           processing: true,
           serverSide: true,
           searching: true,
           ajax: '{{ route('admin.transactions.datatables') }}',
           columns: [
                { data: 'email', name: 'email' },
                { data: 'amount', name: 'amount' },
                { data: 'type', name: 'type' },
                { data: 'txnid', name: 'txnid' },
                { data: 'created_at', name: 'created_at' },
            ],
            language : {
                processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
            }
        });

</script>

@endsection


