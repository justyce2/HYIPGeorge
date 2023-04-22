    <!-- Footer -->
    <footer class="bg--gradient border-top overflow-hidden position-relative">
        <div class="particle"></div>
        <div class="particle2"></div>
        <div class="particle3"></div>
        <div class="particle4"></div>
        <div class="footer-top py-5">
            <div class="container">
                <div class="footer-wrapper flex-wrap">
                    <div class="footer-logo
                    w-100">
                        <a href="{{ url('/') }}">
                            <img src="{{asset('assets/images/'.$gs->logo)}}" alt="logo" />
                        </a>
                    </div>
                    <div class="footer-text">
                        {{ $gs->footer }}
                    </div>
                    <ul class="footer-link w-100 mw-100 justify-content-center">
                        @foreach(DB::table('pages')->whereStatus(1)->orderBy('id','desc')->get() as $data)
                            <li>
                                <a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="text--light w-100 mw-100 text-center">
                        @php
                            echo $gs->copyright;
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->
    