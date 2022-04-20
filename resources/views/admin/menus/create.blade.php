@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.menu.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.menus.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="orm-group 2 depend-on-menus">
                    <label for="parent">{{ trans('cruds.menu.fields.parent') }}</label>

<select class="form-control select2 {{ $errors->has('parent') ? 'is-invalid' : '' }}" name="parent" id="parent">
    <option value="0">{{ "Select Parent Menu" }}
    @foreach($menus as $key => $m)
        <option value="{{ $m->id }}">
            {{ $m->title }}
            @foreach($m->positions as $position)
                - {{$position->title}}
            @endforeach
        </option>
        @if($m->id!=0)
            @if(\App\Models\Menu::parent($m->id)!=false)
                @php
                $i=1;
                @endphp
                @include('partials.chield-menu', [
                'childs' => \App\Models\Menu::parent($m->id)
                ])
            @endif
        @endif
    @endforeach
</select>

{{--                    <select name="item_category" id="item_category" class="text_field" data-bvalidator="required">--}}
{{--                        <option value="">Select</option>--}}
{{--                        @foreach($categories['menu'] as $menu)--}}
{{--                            <option value="category_{{ $menu->cat_id }}" @if($cat_name=='category' ) @if($menu->cat_id == $cat_id) selected="selected" @endif @endif>{{ $menu->category_name }}</option>--}}
{{--                            @foreach(\App\Models\Menu::parent($id) as $sub_category)--}}
{{--                                <option value="subcategory_{{$sub_category->subcat_id}}" @if($cat_name=='subcategory' ) @if($sub_category->subcat_id == $cat_id) selected="selected" @endif @endif> - {{ $sub_category->subcategory_name }}</option>--}}
{{--                            @endforeach--}}
{{--                        @endforeach--}}
{{--                    </select>--}}

                    @if($errors->has('parent'))
                        <div class="invalid-feedback">
                            {{ $errors->first('parent') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.parent_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.menu.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="slug">{{ trans('cruds.menu.fields.slug') }}</label>
                    <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                    @if($errors->has('slug'))
                        <div class="invalid-feedback">
                            {{ $errors->first('slug') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.slug_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.menu.fields.link_type') }}</label>
                    <select class="form-control {{ $errors->has('link_type') ? 'is-invalid' : '' }}" name="link_type" id="link_type" required>
                        <option value disabled {{ old('link_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Menu::LINK_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('link_type', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('link_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('link_type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.link_type_helper') }}</span>
                </div>


                <div class="orm-group 2 depend-on-link-type">

                        <label for="menu_id">{{ trans('cruds.article.title_singular') }}</label>
                        <select class="form-control select2 {{ $errors->has('menu') ? 'is-invalid' : '' }}" name="article_id" id="article_id">
                            @foreach($articles as $id => $entry)
                                <option value="{{ $id }}" {{ old('article_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('article_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('article_id') }}
                            </div>
                        @endif


                </div>



                <div class="form-group 1 depend-on-link-type" >
                    <label for="external_link">{{ trans('cruds.menu.fields.external_link') }}</label>
                    <input class="form-control {{ $errors->has('external_link') ? 'is-invalid' : '' }}" type="text" name="external_link" id="external_link" value="{{ old('external_link', '') }}">
                    @if($errors->has('external_link'))
                        <div class="invalid-feedback">
                            {{ $errors->first('external_link') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.external_link_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="serial">{{ trans('cruds.menu.fields.serial') }}</label>
                    <input class="form-control {{ $errors->has('serial') ? 'is-invalid' : '' }}" type="number" name="serial" id="serial" value="{{ old('serial', '') }}" step="1">
                    @if($errors->has('serial'))
                        <div class="invalid-feedback">
                            {{ $errors->first('serial') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.serial_helper') }}</span>
                </div>


                <div class="form-group">
                    <label class="required" for="positions">{{ trans('cruds.menu.fields.position') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('positions') ? 'is-invalid' : '' }}" name="positions[]" id="positions" multiple required>
                        @foreach($positions as $id => $position)
                            <option value="{{ $id }}" {{ in_array($id, old('positions', [])) ? 'selected' : '' }}>{{ $position }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('positions'))
                        <div class="invalid-feedback">
                            {{ $errors->first('positions') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.position_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.menu.fields.is_active') }}</label>
                    @foreach(App\Models\Menu::IS_ACTIVE_RADIO as $key => $label)
                        <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="is_active_{{ $key }}" name="is_active" value="{{ $key }}" {{ old('is_active', '1') === (string) $key ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active_{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                    @if($errors->has('is_active'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_active') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.is_active_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection

@push('style')
    <style>

    </style>
@endpush
@push('script')

    <script>
        $(document).ready(function(){
            $("#link_type").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");
                    if(optionValue){
                        $(".depend-on-link-type").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else{
                        $(".depend-on-link-type").hide();
                    }
                });
            }).change();
        });
        var convertName2Alias = function () {
            var title = $(this).val().trim().toLowerCase().replace(/\s+/g, '-');
            var slug = $('#slug').val();
            if (slug == '') {
                $('#slug').val(title);
            }
        };
        $(function () {
            $('#title').on('change', convertName2Alias);
        });
    </script>
@endpush
