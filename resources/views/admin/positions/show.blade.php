@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.position.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.positions.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.position.fields.id') }}
                        </th>
                        <td>
                            {{ $position->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.position.fields.title') }}
                        </th>
                        <td>
                            {{ $position->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.position.fields.content') }}
                        </th>
                        <td>
                            {!! $position->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.position.fields.image') }}
                        </th>
                        <td>
                            @if($position->image)
                                <a href="{{ $position->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $position->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.position.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Position::IS_ACTIVE_RADIO[$position->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.positions.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#position_menus" role="tab" data-toggle="tab">
                    {{ trans('cruds.menu.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="position_menus">
                @includeIf('admin.positions.relationships.positionMenus', ['menus' => $position->positionMenus])
            </div>
        </div>
    </div>

@endsection
