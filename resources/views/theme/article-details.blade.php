@extends('layouts.master')
@section('content')
    <section id="skill_resource" class="section_padding mb-125">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="section_title mb-50 ml-105">
                        <p class="text_red mb-16" data-aos="fade-up" data-aos-delay="100">SBAC</p>
                        <h2 class="heading_one text_blue" data-aos="fade-up" data-aos-delay="300">{{$article->title}}</h2>
                    </div>
                    @if($article->feature_image!=null)
                        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
                            <div  style="width: 100%; margin: 0 auto" data-aos="fade-up" data-aos-delay="100">
                                <img width="100%" src="{{$article->feature_image->getUrl()}}" alt="{{$article->title}}">
                            </div>
                        </div>
                    @endif
                    <div class="section_links" style="padding-top: 30px" data-aos="fade-up" data-aos-delay="500">
                        {!! $article->content !!}
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection



@section('style')

@endsection

@section('script')

@endsection
