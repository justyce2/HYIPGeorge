
@extends('layouts.admin')

@section('content')


    <div class="card">
        <div class="d-sm-flex align-items-center py-3 justify-content-between">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Conversation With') }} {{$conv->user->name}}</h5>
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ __('Manage Message') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.message') }}">{{ __('All Message') }}</a></li>
        </ol>
        </div>
    </div>


    <!-- Row -->
    <div class="row mt-3">
      <!-- Datatables -->
      <div class="col-lg-12">



        <div class="order-table-wrap support-ticket-wrapper ">
            <div class="panel panel-primary">
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            @include('includes.admin.form-both')
                <div class="panel-body" id="messages">
                    @foreach($conv->messages as $key=>$message)
                        @if($message->user_id != 0)
                    <div class="single-reply-area user">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="reply-area">
                                    <div class="left">
                                        <p>{{ $message->message }}</p>
                                        @if ($message->photo != NULL)
                                            <a href="{{ asset('assets/images/'.$message->photo)}}" download="" class=""><i class="fas fa-paperclip"></i> @lang('attachment')-{{ $key +=1 }}</a>
                                        @endif
                                    </div>
                                    <div class="right">
                                        @if($message->conversation->user)
                                        <img class="img-circle" src="{{$message->conversation->user->photo != null ? asset('assets/images/'.$message->conversation->user->photo) : asset('assets/images/noimage.png')}}" alt="">
                                        @else

                                        <img class="img-circle" src="{{Auth::guard('admin')->user()->photo != null ? asset('assets/images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/noimage.png')}}" alt="">

                                        @endif
                                        <a target="_blank" class="d-block profile-btn mt-1" href="{{ route('admin-user-show',$message->conversation->user->id) }}" class="d-block">{{ __('View Profile') }}</a>
                                        <p class="ticket-date">{{ $message->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    @else

                    <div class="single-reply-area admin">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="reply-area">
                                    <div class="left">
                                        <img class="img-circle" src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/'.Auth::guard('admin')->user()->photo ):asset('assets/images/noimage.png') }}" alt="">
                                        <p class="ticket-date">{{ $message->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="right">
                                        <p>{{ $message->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    @endif

                    @endforeach
                </div>
                <div class="panel-footer">
                    <form id="messageform" action="{{route('admin.message.store')}}" data-href="{{ route('admin-message-load',$conv->id) }}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="hidden" name="user_id" value="0">
                            <input type="hidden" name="conversation_id" value="{{$conv->id}}">
                            <textarea class="form-control" name="message" id="wrong-invoice" rows="5" required="" placeholder="{{ __('Message') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-rounded">
                                {{ __('Add Reply') }}
                            </button>
                        </div>
                    </form>
                </div>
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
				<p class="text-center">{{__("You are about to delete this Product.")}}</p>
				<p class="text-center">{{ __("Do you want to proceed?") }}</p>
			</div>

			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</a>
				<a href="javascript:;" class="btn btn-danger btn-ok">{{ __("Delete") }}</a>
			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')


@endsection
