<section id="skill_resource" class="section_padding mb-125">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section_title mb-50 ml-105">
                    <p class="text_red mb-16" data-aos="fade-up" data-aos-delay="100">SBAC</p>
                    <h2 class="heading_one text_blue" data-aos="fade-up" data-aos-delay="300">{{$skill_resource_menu->title}}</h2>
                </div>

                <div class="section_links ml-105" data-aos="fade-up" data-aos-delay="500">
                    <ul>
                        @foreach($skill_resource_menu->positionMenus as $menu)
                            @if($menu->link_type=='1')
                                <li><a href="{{$menu->external_link}}" class="c_heading" target="_blank">{{$menu->title}}</a></li>
                            @else
                                <li><a href="{{ route('article-details',[$menu->slug]) }}" class="c_heading">{{$menu->title}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="img_box ml-105" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{$skill_resource_menu->image->getUrl()}}" alt="SkillBank Career Services">
                </div>
            </div>
        </div>
    </div>
</section>
