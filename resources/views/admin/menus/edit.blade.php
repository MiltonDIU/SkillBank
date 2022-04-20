@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.menu.title_singular') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("admin.menus.update", [$menu->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf


                <select class="form-control select2 {{ $errors->has('parent') ? 'is-invalid' : '' }}" name="parent" id="parent">
                    <option value="0">{{ "Select Parent Menu" }}
                    @foreach($menus as $key => $m)
                        <option value="{{ $m->id }}" {{ $menu->parent ===  $m->id ? 'selected' : '' }}>
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
                                @include('partials.chield-menu-edit', [
                                'childs' => \App\Models\Menu::parent($m->id)
                                ])
                            @endif
                        @endif
                    @endforeach
                </select>


                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.menu.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $menu->title) }}" required>
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="slug">{{ trans('cruds.menu.fields.slug') }}</label>
                    <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $menu->slug) }}" required>
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
                            <option value="{{ $key }}" {{ old('link_type', $menu->link_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('link_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('link_type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.link_type_helper') }}</span>
                </div>
                <div class="orm-group 1 depend-on-link-type">
                    <label for="external_link">{{ trans('cruds.menu.fields.external_link') }}</label>
                    <input class="form-control {{ $errors->has('external_link') ? 'is-invalid' : '' }}" type="text" name="external_link" id="external_link" value="{{ old('external_link', $menu->external_link) }}">
                    @if($errors->has('external_link'))
                        <div class="invalid-feedback">
                            {{ $errors->first('external_link') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.menu.fields.external_link_helper') }}</span>
                </div>
                <div class="orm-group 2 depend-on-link-type">
                    <label for="menu_id">{{ trans('cruds.article.title_singular') }}</label>
                    <select class="form-control select2 {{ $errors->has('menu') ? 'is-invalid' : '' }}" name="article_id" id="article_id">

                        @foreach($articles as $key => $article)
                            <option value="{{ $article->id }}" {{ $article->menu_id!=null?$article->menu_id==$menu->id?'selected' : '':'' }}>{{ $article->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('article_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('article_id') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="serial">{{ trans('cruds.menu.fields.serial') }}</label>
                    <input class="form-control {{ $errors->has('serial') ? 'is-invalid' : '' }}" type="number" name="serial" id="serial" value="{{ old('serial', $menu->serial) }}" step="1">
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
                            <option value="{{ $id }}" {{ (in_array($id, old('positions', [])) || $menu->positions->contains($id)) ? 'selected' : '' }}>{{ $position }}</option>
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
                            <input class="form-check-input" type="radio" id="is_active_{{ $key }}" name="is_active" value="{{ $key }}" {{ old('is_active', $menu->is_active) === (string) $key ? 'checked' : '' }}>
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
