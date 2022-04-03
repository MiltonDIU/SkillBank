@foreach($childs as $key=> $parent)
    <li>
{{--        {{\App\Models\Menu::parent($parent->id)!=false?count(\App\Models\Menu::parent($parent->id))==1?"item-one":"":""}}--}}
        <a class="dropdown-item" href="#">
        {{ $parent->title }}
        @if(\App\Models\Menu::parent($parent->id)!=false)
            @php
                $i+=1;
            @endphp
                <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown">
            @include('partials.chield-menu', [
                                     'childs' => \App\Models\Menu::parent($parent->id)
                                 ])
                </ul>

        @endif
     </a>
    </li>
@endforeach
