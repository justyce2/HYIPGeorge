@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
  <h3 class="title">@lang('Support Tickets')</h3>
  <ul class="breadcrumb">
    <li>
      <a href="user-dashboard.html">Dashboard</a>
    </li>
    <li>
      @lang('Support Tickets')
    </li>
  </ul>
</div>




<div class="dashboard--content-item">
  <div class="d-flex justify-content-between">
    <a href="{{ route('user.message.create') }}" class="ms-auto btn btn-primary mb-2">
      @lang('Create Ticket')
    </a>
  </div>
	  <div class="table-responsive table--mobile-lg">
		  <table class="table bg--body">
			  <thead>
				  <tr>
            <th>{{ __('Ticket') }}</th>
            <th>{{ __('Subject') }}</th>
            <th>{{ __('Message') }}</th>
            <th>{{ __('Time') }}</th>
            <th>{{ __('Action') }}</th>
				  </tr>
			  </thead>
			  <tbody>
          @if (count($convs) == 0)
            <tr>
              <td colspan="12">
                <h4 class="text-center m-0 py-2">{{__('No Data Found')}}</h4>
              </td>
            </tr>
          @else
            @foreach($convs as $conv)
              <tr class="conv">
                <input type="hidden" value="{{$conv->id}}">
                <td data-label="{{ __('Ticket') }}">
                  <div>
                    <strong>{{ $conv->ticket_number}}</strong>
                  </div>
                </td>

                <td data-label="{{ __('Subject') }}">
                  <div>
                    {{$conv->subject}}
                  </div>
                </td>

                <td data-label="{{ __('Message') }}">
                  <div>
                    {{$conv->message}}
                  </div>
                </td>

                <td data-label="{{ __('Time') }}">
                  <div>
                    {{$conv->created_at->diffForHumans()}}
                  </div>
                </td>
                <td data-label="{{ __('Action') }}">
                  <div class="d-flex">
                    <a href="{{route('user.message.show',$conv->id)}}" class="link view me-1 btn d-block btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                  </div>
                </td>

              </tr>
            @endforeach
          @endif
			  </tbody>
		  </table>
	  </div>
</div>




<div class="modal modal-blur fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-status bg-danger"></div>
      <div class="modal-body text-center py-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
        <h3>{{__('Are you sure')}}?</h3>
        <div class="text-muted">{{__("You are about to delete this Ticket.")}}</div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                {{__('Cancel')}}
              </a></div>
            <div class="col">
              <a href="javascript:;" class="btn btn-danger w-100 btn-ok">
                {{__('Delete')}}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


@endsection

@push('js')


<script type="text/javascript">
    'use strict';

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

</script>

@endpush
