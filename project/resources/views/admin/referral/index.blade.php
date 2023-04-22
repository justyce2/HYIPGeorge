@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('Referral System') }}</h5>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>

		<li class="breadcrumb-item"><a href="{{ route('admin.referral.index') }}">{{ __('Referral System') }}</a></li>
	</ol>
	</div>
</div>


<!-- Row -->
<div class="row mt-3">
  <div class="col-lg-7">
	<div class="card mb-4">
        <div class="table-responsive p-3">
            <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
              <thead class="thead-light">
                <tr>
                    <th>{{__('Level')}}</th>
                    <th>{{__('Bonus')}}</th>
                </tr>
              </thead>
    
              <tbody>
                  @forelse ($referrals as $key=>$data)
                    <tr>
                        <td>@lang('LEVEL')# {{ $data->level }}</td>
                        <td>{{ $data->percent }} (%)</td>
                    </tr>
                  @empty
                      <tr>
                          <td>@lang('No Data Found')</td>
                      </tr>
                  @endforelse
              </tbody>
            </table>
          </div>
	</div>
  </div>

  <div class="col-lg-5">
	<div class="card">
        <div class="row pt-5 pb-3 px-3">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>
                        @php
                        echo \Session::get('success');
                        @endphp
                    </p>
                </div>
            @endif
            <div class="col-md-6 col-lg-12 col-xl-6">
                <div class="form-group">
                    <label for="title">{{ __('Set Number Of Level') }}</label>
                    <input type="text" class="form-control" id="level" name="level" placeholder="{{ __('Enter Level') }}" value="" required>
                  </div>
            </div>

            <div class="col-md-6 col-lg-12 col-xl-6">
                <label for="title" class="d-none d-md-block d-lg-none d-xl-block">&nbsp;</label>
                <button type="button" id="submit-btn" class="btn btn-primary w-100 generate">{{ __('Generate') }}</button>
            </div>
        </div>
        <form action="{{ route('admin.referral.store') }}" method="post">
            @csrf
            <div class="featured-keyword-area p-3">
                <div class="lang-tag-top-filds" id="referral-section">

                </div>
                <button type="submit" id="levelFormBtn" class="btn btn-primary w-100 d-none">{{ __('Submit') }}</button>
            </div>
        </form>
	</div>
  </div>
</div>

@endsection


@section('scripts')
    <script>
        $(document).on('click',".generate",function(){
            let level = $("#level").val();
            levelHtml = '';
            if(parseInt(level)>0){
                $("#levelFormBtn").removeClass('d-none');
                for(let i=1; i<=parseInt(level); i++){
                    levelHtml += `
                        <div class="lang-area">
                            <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="level" name="level[]" placeholder="@lang('LEVEL')# ${i}" value="${i}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" id="level" name="percent[]" placeholder="{{ __('Enter Level Percentage') }}" value="" required>
                                </div>
                            </div>
                        </div>
                    `;
                }
            }
            $("#referral-section").html(levelHtml);
        })

        $(document).on('click','.lang-remove', function(){
            $(this.parentNode).remove();
            
        })
    </script>
@endsection


