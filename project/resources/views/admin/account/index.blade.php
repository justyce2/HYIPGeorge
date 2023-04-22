@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('How to start') }}</h5>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">{{ __('Home Page Manage') }}</a></li>
	</ol>
	</div>
</div>


<div class="row mt-3">
  <div class="col-lg-12 mb-2">
	<div class="card">

  
		<div class="card-body">
		  <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
		  <form class="geniusform" action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">
  
			  @include('includes.admin.form-both')
  
			  {{ csrf_field() }}
  
			  <div class="form-group">
				<label for="hero_title">{{  __('Title')  }}</label>
				<input type="text" class="form-control" id="hero_title" name="start_title"  placeholder="{{ __('Enter About Title') }}" value="{{ $data->start_title }}" required>
			  </div>
  
			  <div class="form-group">
				<label for="hero_subtitle">{{  __('Hero Subtitle')  }}</label>
				<input type="text" class="form-control" id="hero_subtitle" name="start_text"  placeholder="{{ __('Enter Subtitle') }}" value="{{ $data->start_title }}" required>
			  </div>

  
			  <div class="form-group">
				<label>{{ __('Set Background Image') }}</label>
				<div class="wrapper-image-preview">
					<div class="box full-width">
						<div class="back-preview-image" style="background-image: url({{ $data->start_photo ? asset('assets/images/'.$data->start_photo) : asset('assets/images/placeholder.jpg') }});"></div>
						<div class="upload-options">
							<label class="img-upload-label full-width" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
							<input id="img-upload" type="file" class="image-upload" name="start_photo" accept="image/*">
						</div>
					</div>
				</div>
			</div>

  
			  <button type="submit" id="submit-btn" class="btn btn-primary mt-2 w-100">{{ __('Submit') }}</button>
  
		  </form>
		</div>
	  </div>
  </div>

  <div class="col-lg-12">
	@include('includes.admin.form-success')

	<div class="card mb-4">
	  <div class="table-responsive p-3">
		<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
		  <thead class="thead-light">
			<tr>
                <th width="30%">{{ __('Title') }}</th>
                <th width="50%">{{ __('Details') }}</th>
                <th >{{ __('Options') }}</th>
			</tr>
		  </thead>
		</table>
	  </div>
	</div>
  </div>

</div>
<!--Row-->

{{-- STATUS MODAL --}}

<div class="modal fade confirm-modal" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalTitle" aria-hidden="true">
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
				<p class="text-center">{{__("You are about to delete this account process.")}}</p>
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
           ajax: '{{ route('admin.account.process.datatables') }}',
           columns: [
                    { data: 'title', name: 'title' },
                    { data: 'details', name: 'details' },
                    { data: 'action', searchable: false, orderable: false }

                 ],
            language : {
                processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
            }
        });

        $(function() {
        $(".btn-area").append('<div class="col-sm-12 col-md-4 pr-3 text-right">'+
            '<a class="btn btn-primary" href="{{route('admin.account.process.create')}}">'+
        '<i class="fas fa-plus"></i> Add New Register Process'+
        '</a>'+
        '</div>');
    });


</script>






@endsection


