@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Subscribers') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.subs.index') }}">{{ __('Subscribers') }}</a></li>
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
                <th>{{ __("#Sl") }}</th>
                <th>{{ __("Email") }}</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <!-- DataTable with Hover -->

  </div>
  <!--Row-->

@endsection

@section('scripts')

    <script type="text/javascript">
	"use strict";

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               searching: true,
               ajax: '{{ route('admin.subs.datatables') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'email', name: 'email' }
                     ],
                language : {
                  processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

			$(function() {
            $(".btn-area").append('<div class="col-sm-12 col-md-4 text-right">'+
                '<a class="btn btn-primary" href="{{route('admin.subs.download')}}">'+
            '<i class="fas fa-download"></i> {{ __("Download") }}'+
            '</a>'+
            '</div>');
        });

    </script>

@endsection
