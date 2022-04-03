@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.social.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.socials.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.social.fields.id') }}
                        </th>
                        <td>
                            {{ $social->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.social.fields.title') }}
                        </th>
                        <td>
                            {{ $social->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.social.fields.url') }}
                        </th>
                        <td>
                            {{ $social->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.social.fields.icon_class_name') }}
                        </th>
                        <td>
                            {{ $social->icon_class_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.social.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Social::IS_ACTIVE_RADIO[$social->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.socials.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
