@foreach($childs as $key=> $parent)
    <option value="{{ $parent->id }}" {{ $menu->parent ===  $parent->id ? 'selected' : '' }}>
        @for($j=0;$j<$i; $j++)
            -
        @endfor
        {{ $parent->title }}
            @foreach($menu->positions as $position)
                - {{$position->title}}
            @endforeach
        @if(\App\Models\Menu::parent($parent->id)!=false)
                @php
                    $i+=1;
                @endphp
            @include('partials.chield-menu', [
                                     'childs' => \App\Models\Menu::parent($parent->id)
                                 ])
        @endif
    </option>
@endforeach
