@foreach($childs as $key=> $parent)
    <li>

        @if($parent->link_type=='1')

            <a class="dropdown-item dropdown-toggle" href="{{$parent->external_link}}"   aria-expanded="false">{{$parent->title}}  </a>
        @else
            <a class="dropdown-item dropdown-toggle" href="{{ route('article-details',[$parent->slug]) }}"  aria-expanded="false"> {{$parent->title}} </a>

        @endif

        <ul class="dropdown-submenu dropdown-submenu-left" aria-labelledby="navbarSubDropdown">
            @if(\App\Models\Menu::parent($parent->id)!=false)
                @include('theme.partial.menu-child', [
                'childs' => \App\Models\Menu::parent($parent->id)
                ])
            @endif
        </ul>
    </li>
@endforeach
