<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="@php echo $page->meta_description; @endphp"> 
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="@php echo $blog->meta_description; @endphp"> 
    @else
        <meta name="keywords" content="{{ $seo->meta_keys }}">
        <meta name="author" content="GeniusOcean">
    @endif
    <title>{{$gs->title}}</title>

    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/lightbox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/odometer.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/front/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors)) }}">
    @if ($default_font->font_value)
        <link href="https://fonts.googleapis.com/css?family={{ $default_font->font_value }}&display=swap" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    @endif

    @if ($default_font->font_family)
        <link rel="stylesheet" id="colorr" href="{{ asset('assets/front/css/font.php?font_familly='.$default_font->font_family) }}">
    @else
        <link rel="stylesheet" id="colorr" href="{{ asset('assets/front/css/font.php?font_familly='."Open Sans") }}">
    @endif

    <link rel="shortcut icon" href="{{asset('assets/images/'.$gs->favicon)}}">
    @stack('css')

    @if(!empty($seo->google_analytics))
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() {
				dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', '{{ $seo->google_analytics }}');
	</script>
	@endif
</head>

<body>
    <!-- Overlayer -->
    <span class="toTopBtn">
        <i class="fas fa-angle-up"></i>
    </span>
    <div class="overlayer"></div>
    <div class="loader"></div>
    <!-- Overlayer -->

    <!-- Header -->
    <header class="bg--gradient">
        @includeIf('partials.front.navbar')
        @includeIf('partials.front.nav')
    </header>
    <!-- Header -->

    @yield('content')

    <!-- Footer -->
    @include('partials.front.footer')
    <!-- Footer -->

    @include('cookieConsent::index')


    <!-- Invest Modal -->
    <div class="modal fade" id="invest-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="investForm" action="{{ route('user.invest.amount') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <h4 class="modal-title text-center plan-title">@lang('Basic Plan')</h4>
                        <div class="pt-3 pb-4">
                            <label for="amount" class="form-label">@lang('Enter Amount')</label>
                            <div class="input-group input--group">
                                <input type="number" name="amount" class="form-group-input form-control form--control bg--section"
                                    placeholder="0.00" id="modalAmount">
                                <button type="button" class="input-group-text">@lang('USD')</button>
                            </div>

                            <label for="amount" class="form-label">@lang('Select Wallet')</label>
                            <div class="input-group input--group">
                                <select name="wallet" id="investMethod" class="form-control" required>
                                    <option value="checkout">{{ __('checkout') }}</option>
                                    <option value="main_wallet">{{ __('Main Balance') }}</option>
                                    <option value="interest_wallet">{{ __('Interest Balance') }}</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="investId" id="investId" value="">
                        <div class="d-flex">
                            <button type="button" class="btn shadow-none btn--danger me-2 w-50"
                                data-bs-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn shadow-none btn--success w-50">@lang('Proceed')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Invest Modal -->

    <script src="{{asset('assets/front/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/front/js/viewport.jquery.js')}}"></script>
    <script src="{{asset('assets/front/js/odometer.min.js')}}"></script>
    <script src="{{asset('assets/front/js/lightbox.min.js')}}"></script>
    <script src="{{asset('assets/front/js/owl.min.js')}}"></script>
    <script src="{{asset('assets/front/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/front/js/notify.js')}}"></script>
    <script src="{{asset('assets/front/js/main.js')}}"></script>
    <script src="{{asset('assets/front/js/custom.js')}}"></script>

    <script>
        'use strict';
		let mainurl = '{{ url('/') }}';
	</script>


    <script>
        'use strict';
    
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.success("{{ session('message') }}");
        @endif
      
        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.error("{{ session('error') }}");
        @endif
      
        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.info("{{ session('info') }}");
        @endif
      
        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    <script>
        'use strict';

        $('.invest-plan').on('click',function(){
            $('#modalAmount').val('');
            $('#modalAmount').prop('readonly',false)

            let id = $(this).data('id');
            let title = $(this).data('title');
            let type = $(this).data('type');

            if(type == 1){
                $('#modalAmount').val($(this).attr('data-fixAmount'));
                $('#modalAmount').prop('readonly',true)
            }
            $('#investId').val(id);
            $('.plan-title').text(title);
        });

        $(document).on('change','#investMethod',function(){
            var val = $(this).val();
            if(val == 'checkout'){
                $('.investForm').prop('action','{{ route('user.invest.amount') }}');
            }

            if(val == 'main_wallet'){
                $('.investForm').prop('action','{{ route('user.invest.mainWallet') }}');
            }

            if(val == 'interest_wallet'){
                $('.investForm').prop('action','{{ route('user.invest.interestWallet') }}');
            }
        });

    </script>
  @stack('js')
    
 <script src="//code.tidio.co/hcaptpa7sbuogouxc1q7vrcbbfl57zaf.js" async></script>
</body>

</html>
