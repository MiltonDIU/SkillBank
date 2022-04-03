@extends('layouts.master')
@section('content')

    <!-- --------------------------------- Banner Start --------------------------------- -->
@include('theme.partial.slider',['sliders'=>$sliders])
    <!-- --------------------------------- Banner End --------------------------------- -->

    <!-- --------------------------------- About End --------------------------------- -->

    @include('theme.partial.about',['about'=>$about])

    <!-- --------------------------------- About End --------------------------------- -->

    <!-- --------------------------------- Service Start --------------------------------- -->
    @include('theme.partial.services',['service'=>$service])

    <!-- --------------------------------- Service End --------------------------------- -->

    <!-- --------------------------------- Virtual Tour Start --------------------------------- -->

    <section id="virtual_tour">

        <div class="virtual_content">
            <p class="text_white mb-16" data-aos="fade-up" data-aos-delay="100">Lets’ Have A Quick Virtual Tour</p>
            <h5 class="heading_one mb-20" data-aos="fade-up" data-aos-delay="300">How We Work</h5>
        </div>

        <div class="virtual_modal">
            <!-- Button trigger modal -->
            <button type="button" class="play_btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-play-fill"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <iframe width="765" height="430" src="https://www.youtube.com/embed/FkLZ3xs-V5w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- --------------------------------- Virtual Tour End --------------------------------- -->

    <!-- --------------------------------- Career Resource start --------------------------------- -->
    @include('theme.partial.career_resource',['career_resource_menu'=>$career_resource_menu])
    <!-- --------------------------------- Career Resource End --------------------------------- -->

    <!-- --------------------------------- Skill Resource start --------------------------------- -->
    @include('theme.partial.skill_resource',['skill_resource_menu'=>$skill_resource_menu])

    <!-- --------------------------------- Career Resource End --------------------------------- -->

    <!-- --------------------------------- Join Start --------------------------------- -->

    <section id="join_part">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="join_content" data-aos="fade-up" data-aos-delay="100">
                        <h6 class="heading_one text_blue">Join SBAC With 20,000 Students</h6>

                        <div class="content_btn">
                            <a href="http://192.53.117.239:8069/web/login" target="_blank" class="btn_orange">Join Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 join_box">
                    <div class="join_img">
                        <img src="{{ url('assets/theme/images/join-us.png') }}" alt="Join SkillBank">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- --------------------------------- Join End --------------------------------- -->

    <!-- --------------------------------- Partner Start --------------------------------- -->

    <section id="partner_part">
        <div class="container">
            <div class="section_title mb-50">
                <p class="text_red mb-20" data-aos="fade-up" data-aos-delay="100">SBAC</p>
                <h2 class="heading_one text_blue" data-aos="fade-up" data-aos-delay="300">Our Partners</h2>
            </div>

            <div class="partner_logo" data-aos="fade-up" data-aos-delay="500">
                <div class="swiper partner_swiper">
                    <div class="swiper-wrapper">

                        @foreach($partners as $partner)
                            @if($partner->partner_logo!=null)
                                <div class="swiper-slide">
                                    <div class="logo_box">
                                        <img src="{{ $partner->partner_logo->getUrl() }}" alt="{{$partner->title}}">
                                    </div>
                                </div>
                            @endif
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- --------------------------------- Partner End --------------------------------- -->

@endsection



@section('style')

@endsection

@section('script')

@endsection
