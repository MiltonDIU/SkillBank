@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.slider.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.sliders.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.id') }}
                        </th>
                        <td>
                            {{ $slider->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.title') }}
                        </th>
                        <td>
                            {{ $slider->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.sub_title') }}
                        </th>
                        <td>
                            {{ $slider->sub_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.content') }}
                        </th>
                        <td>
                            {!! $slider->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.get_started_text') }}
                        </th>
                        <td>
                            {{ $slider->get_started_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.get_started_url') }}
                        </th>
                        <td>
                            {{ $slider->get_started_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.learn_more_text') }}
                        </th>
                        <td>
                            {{ $slider->learn_more_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.learn_more_url') }}
                        </th>
                        <td>
                            {{ $slider->learn_more_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.slider_image') }}
                        </th>
                        <td>
                            @if($slider->slider_image)
                                <a href="{{ $slider->slider_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $slider->slider_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Slider::IS_ACTIVE_RADIO[$slider->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.sliders.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
