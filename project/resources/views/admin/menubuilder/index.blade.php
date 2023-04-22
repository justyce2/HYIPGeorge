@extends('layouts.admin')

@section('content')
<div class="card">
   <div class="d-sm-flex align-items-center justify-content-between py-3">
      <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Update Menu Builder') }}</h5>
      <ol class="breadcrumb py-0 m-0">
         <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
         <li class="breadcrumb-item"><a href="{{ route('admin.gs.menubuilder') }}">{{ __('Update Menu Builder') }}</a></li>
      </ol>
   </div>
</div>

<div class="row justify-content-center mt-3">
   <div class="col-xl-4">
      <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-bottom">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Select From Built In Menus') }}</h6>
         </div>
         <div class="card-body ">
            <div class="row menu-builder">
               <div class="col-lg-12">
                  <ul class="list-group">
                     <li class="list-group-item d-flex justify-content-between">
                        <span class="menu-items">{{ __('Home') }}</span>
                        <a data-title="{{ __('Home') }}" data-dropdown="no" data-href="/" data-target="self" class="btn btn-primary btn-sm btn-rounded addToMenu" href="javascript:;">{{ __('Add To Menu') }}</a>
                     </li>

                     <li class="list-group-item d-flex justify-content-between">
                        <span class="menu-items">{{ __('Plans') }}</span>
                        <a data-title="{{ __('Plans') }}" data-dropdown="no" data-href="/plans" data-target="self" class="btn btn-primary btn-sm btn-rounded addToMenu" href="javascript:;">{{ __('Add To Menu') }}</a>
                     </li>

                     <li class="list-group-item d-flex justify-content-between">
                        <span class="menu-items">{{ __('About') }}</span>
                        <a data-title="{{ __('About') }}" data-dropdown="no" data-href="/about" data-target="self" class="btn btn-primary btn-sm btn-rounded addToMenu" href="javascript:;">{{ __('Add To Menu') }}</a>
                     </li>

                     <li class="list-group-item d-flex justify-content-between">
                        <span class="menu-items">{{ __('Blog') }}</span>
                        <a data-title="{{ __('Blog') }}" data-dropdown="no" data-href="/blogs" data-target="self" class="btn btn-primary btn-sm btn-rounded addToMenu" href="javascript:;">{{ __('Add To Menu') }}</a>
                     </li>

                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-4">
      <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-bottom">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Add Custom Menu') }}</h6>
         </div>
         <div class="card-body">
            <div class="alert alert-danger show__url__validation" style="display: none" role="alert">
               <button type="button" class="close hide-close" aria-label="Close">
                 <span aria-hidden="true">×</span>
               </button>
               <p class="m-0">{{__('Url Not Valid')}}</p>
             </div>
            <div class="form-group">
               <label for="title">{{ __('Title') }} *</label>
               <input type="text" class="form-control" id="title"
                  placeholder="{{ __('Enter Title') }}" value="" required>
            </div>
            <div class="form-group">
               <label for="url">{{ __('Url') }} *</label>
               <input type="text" class="form-control" id="url"
                  placeholder="{{ __('Enter Url') }}" value="" required>
            </div>
            <div class="form-group">
               <label for="target">{{ __('Target') }} *</label>
               <select class="form-control" id="target">
                  <option value="self">{{__('Self')}}</option>
                  <option value="blank">{{__('New Tab')}}</option>
               </select>
            </div>
            <div class="form-group">
               <button type="button" id="custom-submit" class="btn btn-primary btn-block w-100 mx-0">{{ __('Submit') }}</button>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-4">
      <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-bottom">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Website Menus') }}</h6>
         </div>
         <div class="card-body">
            <form class="admin-form geniusform" action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">
               @csrf
               @include('includes.admin.form-both')
               <input type="hidden" name="menu" value="menu">
               <div id="section-list">
                  @if(!empty($gs->menu))
                  @foreach(json_decode($gs->menu,true) as $key => $menu)
                  <div class="card mt-2  draggable-item">
                     <div class="card-body">
                        <div class="media">
                           <div class="media-body">
                              <h5 class="mb-1 mt-0">{{ $menu['title'] }}</h5>
                              <input type="hidden" name="{{ $key }}[title]" value="{{ $menu['title'] }}">
                              <input type="hidden" name="{{ $key }}[dropdown]" value="{{ $menu['dropdown'] }}">
                              <input type="hidden" name="{{ $key }}[href]" value="{{ $menu['href'] }}">
                              <input type="hidden" name="{{ $key }}[target]" value="{{ $menu['target'] }}">
                           </div>
                           <i class="remove-menu fa fa-trash-alt"></i>
                        </div>
                     </div>
                  </div>
                  @endforeach
                  @endif
               </div>
               <div class="form-group my-2">
                  <button type="submit"  class="btn btn-primary btn-block w-100 mx-0">{{ __('Submit') }}</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection