@extends('layouts.admin')

@section('content')


    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between py-3">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Withdraw Request') }}</h5>
        <ol class="breadcrumb py-0 m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>

            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">{{ __('Withdraw Request') }}</a></li>
        </ol>
        </div>
    </div>


    <!-- Row -->
    <div class="row mt-3">
      <!-- Datatables -->
      <div class="col-lg-12">

        @include('includes.admin.form-success')

        <div class="card mb-4">
          <div class="table-responsive p-3">
            <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
              <thead class="thead-light">
                <tr>
                    <th>{{ __("Email") }}</th>
                    <th>{{ __("Phone") }}</th>
                    <th>{{ __("Amount") }}</th>
                    <th>{{ __("Method") }}</th>
                    <th>{{ __("Withdraw Date") }}</th>
                    <th>{{ __("Status") }}</th>
                    <th>{{ __("Actions") }}</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <!-- DataTable with Hover -->

    </div>
    <!--Row-->

    <div class="modal fade confirm-modal" id="details" tabindex="-1" role="dialog"
    aria-labelledby="statusModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">{{ __("Withdraw Request Details
            ") }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
        <a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Back") }}</a>
        </div>
    </div>
    </div>
    </div>


    {{-- REJECT MODAL --}}

<div class="modal fade confirm-modal" id="status-modal" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __("Accpet Withdraw") }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">{{ __("You are about to accept this Withdraw.") }}</p>
                <p class="text-center">{{ __("Do you want to proceed?") }}</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
                <a class="btn btn-success btn-ok">{{ __("Accept") }}</a>
            </div>

        </div>
    </div>
</div>
<div class="modal fade status-modal" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __("Reject Withdraw") }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">{{ __("You are about to reject this Withdraw.") }}</p>
                <p class="text-center">{{ __("Do you want to proceed?") }}</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
                <a class="btn btn-danger btn-ok">{{ __("Reject") }}</a>
            </div>

        </div>
    </div>
</div>

{{-- REJECT MODAL ENDS --}}




@endsection


@section('scripts')

<script type="text/javascript">
"use strict";
var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               searching: false,
               ajax: '{{ route('admin.withdraw.datatables') }}',
               columns: [

                        { data: 'email', name: 'email' },
                        {data:'phone',name: 'phone'},
                        {data:'amount',name:'amount'},
                        {data:'method',name:'method'},
                        {data: 'created_at',name:'created_at'},
                        { data: 'status',searchable: false, orderable: false},
            			{ data: 'action', searchable: false, orderable: false }
                     ],
                language : {

                }
            });

            $(document).on('click', '#applicationDetails', function () {
      let detailsUrl = $(this).data('href');
      $.get(detailsUrl, function( data ) {
        $( "#details .modal-body" ).html( data );
      });
    })





</script>

@endsection

