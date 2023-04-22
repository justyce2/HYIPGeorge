
<div class="navbar-bottom">
    <div class="container">
        <div class="navbar-wrapper">
            <div class="logo me-auto">
                <a href="{{ url('/') }}">
                    <img src="{{asset('assets/images/'.$gs->logo)}}" alt="logo" />
                </a>
            </div>
            <div class="nav-toggle d-lg-none">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-menu-area">
                <div class="menu-close text--danger d-lg-none">
                    <i class="fas fa-times"></i>
                </div>
                <ul class="nav-menu">
                    @foreach(json_decode($gs->menu,true) as $key => $menue)
                        <li><a href="{{ url($menue['href']) }}" target="{{ $menue['target'] == 'blank' ? '_blank' : '_self' }}">{{ $menue['title'] }}</a></li>
                    @endforeach
        
                    @if ($gs->is_contact)
                        <li>
                            <a href="{{route('front.contact')}}">@lang('Contact')</a>
                        </li>
                    @endif
                    <li>
                        <div class="btn__grp ms-lg-3">
                            @auth
                                <a href="{{ route('user.dashboard') }}" class="cmn--btn">@lang('Dashboard')</a>
                            @endauth

                            @guest
                                <a href="{{ route('user.login') }}" class="cmn--btn">@lang('Login Now')</a>
                            @endguest
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mode--toggle d-sm-none">
                <i class="fas fa-moon"></i>
            </div>
        </div>
    </div>
</div>