@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.country.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.countries.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="num_code">{{ trans('cruds.country.fields.num_code') }}</label>
                    <input class="form-control {{ $errors->has('num_code') ? 'is-invalid' : '' }}" type="text" name="num_code" id="num_code" value="{{ old('num_code', '') }}">
                    @if($errors->has('num_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('num_code') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.num_code_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="code_2">{{ trans('cruds.country.fields.code_2') }}</label>
                    <input class="form-control {{ $errors->has('code_2') ? 'is-invalid' : '' }}" type="text" name="code_2" id="code_2" value="{{ old('code_2', '') }}" required>
                    @if($errors->has('code_2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('code_2') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.code_2_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="code_3">{{ trans('cruds.country.fields.code_3') }}</label>
                    <input class="form-control {{ $errors->has('code_3') ? 'is-invalid' : '' }}" type="text" name="code_3" id="code_3" value="{{ old('code_3', '') }}">
                    @if($errors->has('code_3'))
                        <div class="invalid-feedback">
                            {{ $errors->first('code_3') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.code_3_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.country.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="nationality">{{ trans('cruds.country.fields.nationality') }}</label>
                    <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', '') }}" required>
                    @if($errors->has('nationality'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nationality') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.nationality_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.country.fields.is_active') }}</label>
                    @foreach(App\Models\Country::IS_ACTIVE_RADIO as $key => $label)
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
                    <span class="help-block">{{ trans('cruds.country.fields.is_active_helper') }}</span>
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
