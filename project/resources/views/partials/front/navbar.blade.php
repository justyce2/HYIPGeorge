




<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<div class="navbar-top">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-evenly justify-content-md-between">
            <div class="d-flex flex-wrap align-items-center">
                
                <div class="change-language d-md-none">
                    <select name="currency" class="currency selectors nice language-bar">
                        @foreach(DB::table('currencies')->get() as $currency)
                            <option value="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}>
                                {{$currency->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="google_translate_element"></div>
            <ul class="contact-bar py-1 py-md-0">
                <li>
                    <div id="google_translate_element"></div>
                   <!-- <a href="Tel:{{$ps->phone}}">{{$ps->phone}}</a>-->
                </li>
                <li>
                    <a href="Mailto:{{$ps->email}}">{{$ps->email}}</a>
                </li>
                <li>
                    <div class="change-language d-none d-sm-block">
                        <select name="language" class="language selectors nice language-bar">
                            @foreach(DB::table('languages')->get() as $language)
                                <option value="{{route('front.language',$language->id)}}" {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }} >
                                    {{$language->language}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </li>
                <li>
                    <div class="mode--toggle d-none d-sm-block">
                        <i class="fas fa-moon"></i>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>