@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.menu.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.menus.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.id') }}
                        </th>
                        <td>
                            {{ $menu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.title') }}
                        </th>
                        <td>
                            {{ $menu->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.slug') }}
                        </th>
                        <td>
                            {{ $menu->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.link_type') }}
                        </th>
                        <td>
                            {{ App\Models\Menu::LINK_TYPE_SELECT[$menu->link_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.external_link') }}
                        </th>
                        <td>
                            {{ $menu->external_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.serial') }}
                        </th>
                        <td>
                            {{ $menu->serial }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.parent') }}
                        </th>
                        <td>
                            {{ $menu->parent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.position') }}
                        </th>
                        <td>
                            @foreach($menu->positions as $key => $position)
                                <span class="label label-info">{{ $position->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Menu::IS_ACTIVE_RADIO[$menu->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.menus.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
