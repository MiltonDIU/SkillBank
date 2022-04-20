@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.slider.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.sliders.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.slider.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sub_title">{{ trans('cruds.slider.fields.sub_title') }}</label>
                    <input class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}" type="text" name="sub_title" id="sub_title" value="{{ old('sub_title', '') }}">
                    @if($errors->has('sub_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sub_title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.sub_title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="content">{{ trans('cruds.slider.fields.content') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content">{!! old('content') !!}</textarea>
                    @if($errors->has('content'))
                        <div class="invalid-feedback">
                            {{ $errors->first('content') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.content_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="get_started_text">{{ trans('cruds.slider.fields.get_started_text') }}</label>
                    <input class="form-control {{ $errors->has('get_started_text') ? 'is-invalid' : '' }}" type="text" name="get_started_text" id="get_started_text" value="{{ old('get_started_text', '') }}">
                    @if($errors->has('get_started_text'))
                        <div class="invalid-feedback">
                            {{ $errors->first('get_started_text') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.get_started_text_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="get_started_url">{{ trans('cruds.slider.fields.get_started_url') }}</label>
                    <input class="form-control {{ $errors->has('get_started_url') ? 'is-invalid' : '' }}" type="text" name="get_started_url" id="get_started_url" value="{{ old('get_started_url', '') }}">
                    @if($errors->has('get_started_url'))
                        <div class="invalid-feedback">
                            {{ $errors->first('get_started_url') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.get_started_url_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="learn_more_text">{{ trans('cruds.slider.fields.learn_more_text') }}</label>
                    <input class="form-control {{ $errors->has('learn_more_text') ? 'is-invalid' : '' }}" type="text" name="learn_more_text" id="learn_more_text" value="{{ old('learn_more_text', '') }}">
                    @if($errors->has('learn_more_text'))
                        <div class="invalid-feedback">
                            {{ $errors->first('learn_more_text') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.learn_more_text_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="learn_more_url">{{ trans('cruds.slider.fields.learn_more_url') }}</label>
                    <input class="form-control {{ $errors->has('learn_more_url') ? 'is-invalid' : '' }}" type="text" name="learn_more_url" id="learn_more_url" value="{{ old('learn_more_url', '') }}">
                    @if($errors->has('learn_more_url'))
                        <div class="invalid-feedback">
                            {{ $errors->first('learn_more_url') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.learn_more_url_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="slider_image">{{ trans('cruds.slider.fields.slider_image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('slider_image') ? 'is-invalid' : '' }}" id="slider_image-dropzone">
                    </div>
                    @if($errors->has('slider_image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('slider_image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.slider_image_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.slider.fields.is_active') }}</label>
                    @foreach(App\Models\Slider::IS_ACTIVE_RADIO as $key => $label)
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
                    <span class="help-block">{{ trans('cruds.slider.fields.is_active_helper') }}</span>
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
        $(document).ready(function () {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function (file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', '{{ route('admin.sliders.storeCKEditorImages') }}', true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() { reject(genericErrorText) });
                                        xhr.addEventListener('abort', function() { reject() });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                                            }

                                            $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                                            resolve({ default: response.url });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $slider->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>

    <script>
        Dropzone.options.sliderImageDropzone = {
            url: '{{ route('admin.sliders.storeMedia') }}',
            maxFilesize: 3, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 3,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="slider_image"]').remove()
                $('form').append('<input type="hidden" name="slider_image" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="slider_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($slider) && $slider->slider_image)
                var file = {!! json_encode($slider->slider_image) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="slider_image" value="' + file.file_name + '">')
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
