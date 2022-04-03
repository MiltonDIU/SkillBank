@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.social.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.socials.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.social.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.social.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="url">{{ trans('cruds.social.fields.url') }}</label>
                    <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', '') }}" required>
                    @if($errors->has('url'))
                        <div class="invalid-feedback">
                            {{ $errors->first('url') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.social.fields.url_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="icon_class_name">{{ trans('cruds.social.fields.icon_class_name') }}</label>
                    <input class="form-control {{ $errors->has('icon_class_name') ? 'is-invalid' : '' }}" type="text" name="icon_class_name" id="icon_class_name" value="{{ old('icon_class_name', '') }}" required>
                    @if($errors->has('icon_class_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('icon_class_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.social.fields.icon_class_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.social.fields.is_active') }}</label>
                    @foreach(App\Models\Social::IS_ACTIVE_RADIO as $key => $label)
                        <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="is_active_{{ $key }}" name="is_active" value="{{ $key }}" {{ old('is_active', '1') === (string) $key ? 'checked' : '' }} required>
                            <label class="form-check-label" for="is_active_{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                    @if($errors->has('is_active'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_active') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.social.fields.is_active_helper') }}</span>
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
