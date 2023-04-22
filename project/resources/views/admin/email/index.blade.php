@extends('layouts.admin')

@section('content')

<div class="content-area">
  <div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Email Templates') }}</h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Email Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.mail.index') }}">{{ __('Email Templates') }}</a></li>
    </ol>
    </div>
  </div>
</div>

    <div class="row mt-3">
      <div class="col-lg-12">
        @include('includes.admin.form-success')
        <div class="card mb-4">
          <div class="table-responsive p-3">
            <table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
              <thead class="thead-light">
                <tr>
                  <th>{{ __('Email Type') }}</th>
                  <th>{{ __('Email Subject') }}</th>
                  <th>{{ __('Options') }}</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="submit-loader">
            <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
          </div>
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
          </div>
        </div>
      </div>
  </div>


  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-block text-center">
          <h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
          <p class="text-center">{{ __('You are about to delete this Email. Everything will be deleted under this Email.') }}</p>
          <p class="text-center">{{ __('Do you want to proceed?') }}</p>
        </div>

        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
          <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
        </div>

      </div>
    </div>
  </div>

@endsection



@section('scripts')

    <script type="text/javascript">
	"use strict";

    var table = $('#example').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               searching: true,
               ajax: '{{ route('admin.mail.datatables') }}',
               columns: [
                        { data: 'email_type', name: 'email_type' },
                        { data: 'email_subject', name: 'email_subject' },
                        { data: 'action', searchable: false, orderable: false }

                     ],
               language: {
                  processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });



    </script>
@endsection
