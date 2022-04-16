<section id="about_part" class="section_padding section_gradient">
    <div class="container">
        <div class="row justify_content">
            <div class="col-lg-6 xs-about-title">
                <div class="section_title">
                    <p class="text_red mb-16" data-aos="fade-up" data-aos-delay="100">SBAC</p>
                    <h2 class="heading_one text_blue" data-aos="fade-up" data-aos-delay="100">{{$about->title}}</h2>
                </div>
            </div>

            <div class="col-lg-6 xs-about-btn">
                <div class="section_btn" data-aos="fade-up" data-aos-delay="100">
                    <a href="#" class="btn_light">Learn More</a>
                </div>
            </div>
        </div>
    </div>

    <div class="section_content">
        <div class="container">
            <div class="row">

               @foreach($about->categoryArticles as $key=>$article)
@if($key<3)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="content_box">
                        <div class="content_title mb-50">
                            <div class="c_icon">
                                <i class="{{$article->icon_class_name}}"></i>
                            </div>

                            <div class="c_text">
                                <h3 class="c_heading">{{$article->title}}</h3>
                            </div>
                        </div>

                        <div class="content_details">
                            <p>{!! $article->summary !!}</p>
                        </div>
                    </div>
                </div>
                    @endif
                @endforeach


            </div>
        </div>
    </div>
</section>
