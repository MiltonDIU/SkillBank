@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.partner.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.partners.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="partner_name">{{ trans('cruds.partner.fields.partner_name') }}</label>
                    <input class="form-control {{ $errors->has('partner_name') ? 'is-invalid' : '' }}" type="text" name="partner_name" id="partner_name" value="{{ old('partner_name', '') }}" required>
                    @if($errors->has('partner_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('partner_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.partner.fields.partner_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="website_url">{{ trans('cruds.partner.fields.website_url') }}</label>
                    <input class="form-control {{ $errors->has('website_url') ? 'is-invalid' : '' }}" type="text" name="website_url" id="website_url" value="{{ old('website_url', '') }}">
                    @if($errors->has('website_url'))
                        <div class="invalid-feedback">
                            {{ $errors->first('website_url') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.partner.fields.website_url_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="partner_logo">{{ trans('cruds.partner.fields.partner_logo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('partner_logo') ? 'is-invalid' : '' }}" id="partner_logo-dropzone">
                    </div>
                    @if($errors->has('partner_logo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('partner_logo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.partner.fields.partner_logo_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.partner.fields.is_active') }}</label>
                    @foreach(App\Models\Partner::IS_ACTIVE_RADIO as $key => $label)
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
                    <span class="help-block">{{ trans('cruds.partner.fields.is_active_helper') }}</span>
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

@section('scripts')
    <script>
        Dropzone.options.partnerLogoDropzone = {
            url: '{{ route('admin.partners.storeMedia') }}',
            maxFilesize: 1, // MB
             acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 1,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="partner_logo"]').remove()
                $('form').append('<input type="hidden" name="partner_logo" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="partner_logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($partner) && $partner->partner_logo)
                var file = {!! json_encode($partner->partner_logo) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="partner_logo" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
