<section class="payment-gateway-section pt-50 pb-100">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <div class="section-header">
                    <h6 class="section-header__subtitle">@lang('Brand & Payment Gateway')</h6>
                    <h2 class="section-header__title">{{ $ps->brand_title }}</h2>
                    <p>
                        @php
                            echo $ps->brand_text;
                        @endphp
                    </p>
                </div>
                <div class="brand-slider owl-theme owl-carousel">
                    @foreach (getBrands() as $key=>$data)
                        <div class="brand-item">
                            <img src="{{asset('assets/images/'.$data->photo)}}" alt="partner">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <div class="payement-gateway-thumb">
                    <img src="{{asset('assets/images/'.$ps->brand_photo)}}" alt="partner">
                </div>
            </div>
        </div>
    </div>
</section>