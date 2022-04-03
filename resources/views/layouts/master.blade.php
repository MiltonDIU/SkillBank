<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Site::config()->site_title, 'SkillBank' }} </title>

    <link rel="shortcut icon" href="images/skillbank_logo.png') }}" type="image/x-icon">

    <!-- Google Fonts Start -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Google Fonts End -->

    <link rel="stylesheet" href="{{ url('assets/theme/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ url('assets/theme/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/theme/css/aos.css') }}">
    <link rel="stylesheet" href="{{ url('assets/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/theme/css/responsive.css') }}">
    @stack('style')
</head>
<body>
<!-- --------------------------------- Header Start --------------------------------- -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 xs_header_left">
                <div class="header_logo">

<a href="{{url('/')}}">
    <img src="{!! Site::config()->logo!=null?Site::config()->logo->getUrl()??url('assets/theme/images/skillbank_logo.png'):url('assets/theme/images/skillbank_logo.png') !!} " alt="SkillBank">
</a>

                </div>
            </div>

            <div class="col-lg-6 xs_header_right">
                <div class="header_left">
                    <div class="search">
                        <input type="text" placeholder="Search">

                        <div class="search_icon">
                            <i class="bi bi-search search_i"></i>
                        </div>
                    </div>

                    <div class="header_btn">
                        <div class="dropdown">
                            <a class="btn_light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-grid-fill"></i>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
@foreach(\App\Models\Position::positionWiseMenu(1) as $menu)
    @if($menu->link_type=='1')
                                <li><a class="dropdown-item" target="_blank" href="{{$menu->external_link}}">{{$menu->title}}</a></li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" target="_blank" href="{{ url($menu->slug) }}">
                                                </a>
                                                </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- --------------------------------- Header End --------------------------------- -->

<!-- --------------------------------- Navbar Start --------------------------------- -->

<nav class="navbar sticky-top navbar-expand-lg navbar-light shadow">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">

                    @foreach(\App\Models\Position::positionWiseRootMenu(2) as $key => $m)

                    <li class="nav-item {{\App\Models\Menu::parent($m->id)!=false?"dropdown":""}}">
                        <a class="nav-link" aria-current="page" href="#">  {{ $m->title }}</a>

                        @if($m->id!=0)
                            @if(\App\Models\Menu::parent($m->id)!=false)
                                @php
                                    $i=1;
                                @endphp
                                <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown">
                                @include('theme.partial.menu-child', [
                                'childs' => \App\Models\Menu::parent($m->id)
                                ])
                                </ul>
                            @endif
                        @endif

                    </li>
                    @endforeach
            </ul>
        </div>
    </div>
</nav>

<!-- --------------------------------- Navbar End --------------------------------- -->

@yield('content')
<!-- --------------------------------- Footer Start --------------------------------- -->

<footer>
    <!-- ------------------------------ Return to Top start ------------------------------ -->
    <a href="javascript:" id="return-to-top">
        <i class="bi bi-chevron-up"></i>
    </a>
    <!-- ------------------------------ Return to Top end ------------------------------ -->
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer_logo_text" data-aos="fade-up" data-aos-delay="100">
                    <div class="f_logo mb-50">
                        <img src="{!! Site::config()->logo!=null?Site::config()->logo->getUrl()??url('assets/theme/images/skillbank_logo.png'):url('assets/theme/images/skillbank_logo.png') !!} " alt="SkillBank">
                    </div>

                    <div class="f_text mb-50">
                        <p class="text_white">{!! Site::config()->about_in_footer??'A national-level facility to promote the flexibility of the curriculum framework and interdisciplinary academic mobility of students.' !!} </p>
                    </div>

                    <div class="f_copyright">
                        <p>{!! Site::config()->copyright??'copyright@Skillbank, 2022' !!}  </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="footer_links" data-aos="fade-up" data-aos-delay="300">
                    <h6 class="footer_title mb-50 text_white">Featured Links</h6>
                    <ul>
                        @foreach(\App\Models\Position::positionWiseMenu(3) as $menu)
                            @if($menu->link_type=='1')
                            <li><a href="{{$menu->external_link}}" target="_blank">{{$menu->title}}</a></li>
                            @else
                                <li><a href="{{ route('article-details',[$menu->id,$menu->slug]) }}">{{$menu->title}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="footer_social" data-aos="fade-up" data-aos-delay="500">
                    <h6 class="footer_title mb-50">Social Links</h6>

                    <div class="social_box">
                        <ul>
                            <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                            <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                            <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                            <li><a href="#"><i class="bi bi-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- --------------------------------- Footer End --------------------------------- -->


<script src="{{ url('assets/theme/js/jquery-1.12.4.min.js')}}"></script>

<script>
    // ===== Return to Top ====
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 200) {        // If page is scrolled more than 200px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });

    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });
</script>

<script src="{{ url('assets/theme/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ url('assets/theme/js/swiper-bundle.min.js')}}"></script>
<script src="{{ url('assets/theme/js/aos.js')}}"></script>
<script src="{{ url('assets/theme/js/script.js')}}"></script>

@stack('script')
</body>
</html>
