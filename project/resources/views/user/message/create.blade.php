@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
    <h3 class="title">@lang('Support Ticket')</h3>
    <ul class="breadcrumb">
        <li>
          <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
  
        <li>
            @lang('Support Ticket')
        </li>
    </ul>
</div>

<div class="dashboard--content-item">
    <div class="row g-3">
      <div class="col-12">
        <div class="card default--card">
            <div class="card-body">
                @includeIf('includes.flash')
                <form id="request-form" action="{{ route('user.message.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
    
                    <div class="row gy-3 gy-md-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label required">{{__('Subject')}}</label>
                                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" autocomplete="off" placeholder="{{__('Enter Subject')}}" value="{{ old('subject') }}">
                                @error('subject')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{__('Message')}}</label>
                                <textarea name="message" class="form-control nic-edit @error('message') is-invalid @enderror" cols="30" rows="5" placeholder="{{__('Enter Subject')}}"></textarea>
                                @error('message')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
    
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror">
                                @error('attachment')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
    
    
                        <div class="col-sm-12">
                            <label class="form-label d-none d-sm-block">&nbsp;</label>
                            <button type="submit" class="cmn--btn bg--primary submit-btn w-100 border-0">{{__('Submit')}}</button>
                        </div>
                    </div>
    
                </form>
            </div>
        </div>
    </div>
    </div>
  </div>
@endsection

