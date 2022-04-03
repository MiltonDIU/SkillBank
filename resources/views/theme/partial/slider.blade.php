<section id="main_banner">
    <div class="swiper banner_swiper">
        <div class="swiper-wrapper">

            @foreach($sliders as $slider)

            <div class="swiper-slide banner-slide">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="banner_content">
                                <p class="text_red mb-20">{{$slider->sub_title}}</p>

                                <h1 class="heading_one mb-100">{{$slider->title}}</h1>

                                <div class="banner_btns">
                                    <a href="{{$slider->get_started_url}}" class="btn_red">{{$slider->get_started_text}}</a>
                                    <a href="{{$slider->learn_more_url}}" class="btn_blue">{{$slider->learn_more_text}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 xs-banner-img">
                            <div class="banner_img">
                                <div class="img_box">
                                    <img src="{{ $slider->slider_image->getUrl() }}" alt="Skill Bank">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>

        <div class="swiper-pagination"></div>
    </div>
</section>
