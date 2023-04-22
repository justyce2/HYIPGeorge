<section class="choose-section pt-100 pb-50 border-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="section-header mb-lg-0">
                    <h6 class="section-header__subtitle">@lang('Features')</h6>
                    <h2 class="section-header__title">{{ $ps->feature_title }}</h2>
                    <p>
                        @php
                            echo $ps->feature_text;
                        @endphp
                    </p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="choose-area bg--section border">
                    <div class="choose-inner">
                        @foreach ($features as $key=>$data)
                            <div class="choose-item">
                                <div class="choose-thumb">
                                    <i class="{{ $data->icon }}"></i>
                                </div>
                                <div class="choose-content">
                                    <h5 class="choose-content-title">{{ $data->title }}</h5>
                                    <p>
                                       @php
                                           echo $data->details;
                                       @endphp
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>