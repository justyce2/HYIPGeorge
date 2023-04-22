@extends('layouts.admin')

@section('content')
<div class="content-area">
	<div class="card">
	  <div class="d-sm-flex align-items-center justify-content-between py-3">
	  <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Font Settings') }}</h5>
	  <ol class="breadcrumb py-0 m-0">
		  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
		  <li class="breadcrumb-item"><a href="javascript:;">{{ __('Font Settings') }}</a></li>
		  <li class="breadcrumb-item"><a href="{{ route('admin.font.index') }}">{{ __('Website Font') }}</a></li>
	  </ol>
	  </div>
	</div>
  </div>

	<!-- Row -->
	<div class="row mt-3">
		<!-- Datatables -->
		<div class="col-lg-12">
			<div class="card mb-4">
				<div class="table-responsive p-3">
		  			@include('includes.admin.form-success')
                      <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
						<thead class="thead-light">
							<tr>
								<th>{{ __('Font') }}</th>
								<th>{{ __('Options') }}</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<!-- DataTable with Hover -->
	</div>
	<!--Row-->

{{-- DELETE MODAL --}}
<div class="modal fade confirm-modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">{{ __("Confirm Delete") }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-center">{{__("You are about to delete this Font. Every informtation under this font will be deleted.")}}</p>
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



@section('scripts')

    <script type="text/javascript">
	"use strict";

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               searching: true,
               ajax: '{{ route('admin.font.datatables') }}',
               columns: [
                        { data: 'font_family', name: 'font_family' },
            			{ data: 'action', searchable: false, orderable: false }
                     ],
               language: {
					processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

	   $(function() {
            $(".btn-area").append('<div class="col-sm-12 col-md-4 pr-3 text-right">'+
                '<a class="btn btn-primary" href="{{route('admin.font.create')}}">'+
            '<i class="fas fa-plus"></i> {{ __('Add New Font') }}'+
            '</a>'+
            '</div>');
        });

    </script>
@endsection
