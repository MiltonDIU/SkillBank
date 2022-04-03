
<section id="service_part" class="section_padding section_gradient">
    <div class="container service_container">
        <div class="section_title">
            <p class="text_red mb-16" data-aos="fade-up" data-aos-delay="100">SBAC</p>
            <h2 class="heading_one text_blue" data-aos="fade-up" data-aos-delay="100">{{$service->title}}</h2>
        </div>

        <div class="service_content" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper service_swiper">
                <div class="swiper-wrapper">
@foreach($service->categoryArticles as $key=>$article)
                    <div class="swiper-slide">
                        <div class="content_box">
                            <div class="content_title mb-50">
                                <div class="c_icon">
                                    <h4 class="service_number">{{$key+1}}</h4>
                                </div>

                                <div class="c_text">
                                    <h3 class="c_heading">{{$article->title}}</h3>
                                </div>
                            </div>

                            <div class="content_details">
                                <p>{!! $article->summary !!}</p>
                            </div>

                            <div class="content_btn">
                                <a href="#" class="btn_light">Learn More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>
