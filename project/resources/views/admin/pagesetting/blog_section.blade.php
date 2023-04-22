@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Blog Section') }}</h5>
    <ol class="breadcrumb py-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Home Page Setting') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ps.blog') }}">{{ __('Blog Section') }}</a></li>
    </ol>
    </div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Blog Section') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">
            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">{{ __('Blog Section Title') }} *</label>
                <input type="text" class="form-control" id="title" name="blog_section_title"  placeholder="{{ __('Title') }}" value="{{ $ps->blog_section_title }}" required>
            </div>

            <div class="form-group">
              <label for="text">{{ __('Blog Section Text') }} *</label>
              <textarea name="blog_section_text" id="text" cols="30" rows="5" class="form-control" placeholder="{{ __('Text') }}" required>{{ $ps->blog_section_text }} </textarea>
            </div>

            <button type="submit" id="submit-btn" class="btn btn-primary btn-block">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>

  </div>

</div>
<!--Row-->

@endsection
