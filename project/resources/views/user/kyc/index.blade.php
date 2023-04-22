@extends('layouts.user')

@section('styles')

@endsection

@section('contents')
<div class="breadcrumb-area">
  <h3 class="title">@lang('KYC Form')</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
      </li>

      <li>
          @lang('KYC Form')
      </li>
  </ul>
</div>

<div class="dashboard--content-item">
  <div class="row g-3">
    <div class="col-12">
      <div class="card default--card">
        <div class="card-body">
          @includeIf('includes.flash')
          <form action="{{route('user.kyc.submit')}}" method="POST" enctype="multipart/form-data">
              @csrf

              @foreach ($userForms as $field)
                @if ($field->type == 1 || $field->type == 3 )
                  <div class="form-group mb-3 mt-3">
                    <label class="form-label {{$field->required == 1 ? 'required':'Optional'}}">@lang($field->label)</label>
                    @if ($field->type == 1)
                      <input type="text" name="{{strtolower(str_replace(' ', '_', $field->label))}}" class="form-control" autocomplete="off" placeholder="@lang($field->label)" min="1" {{$field->required == 1 ? 'required':'Optional'}}>
                      @else 
                      <textarea class="form-control" name="{{strtolower(str_replace(' ', '_', $field->label))}}" placeholder="@lang($field->label)"></textarea>
                    @endif
                  </div>
                @elseif($field->type == 2)
                  <div class="form-group mb-3 mt-3">
                    <label class="form-label {{$field->required == 1 ? 'required':'Optional'}}">@lang($field->label)</label>
                    <input type="file" name="{{strtolower(str_replace(' ', '_', $field->label))}}" class="form-control" autocomplete="off" {{$field->required == 1 ? 'required':'Optional'}}>
                  </div>
                @endif
              @endforeach

              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">{{__('Submit')}}</button>
              </div>
          </form>
        </div>
      </div>
  </div>
  </div>
</div>

@endsection

@push('js')

@endpush
