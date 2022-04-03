@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.partner.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.partners.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.partner.fields.id') }}
                        </th>
                        <td>
                            {{ $partner->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.partner.fields.partner_name') }}
                        </th>
                        <td>
                            {{ $partner->partner_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.partner.fields.website_url') }}
                        </th>
                        <td>
                            {{ $partner->website_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.partner.fields.partner_logo') }}
                        </th>
                        <td>
                            @if($partner->partner_logo)
                                <a href="{{ $partner->partner_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $partner->partner_logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.partner.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Partner::IS_ACTIVE_RADIO[$partner->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.partners.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
