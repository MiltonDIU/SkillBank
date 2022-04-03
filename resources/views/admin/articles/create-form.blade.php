
        <div class="form-group">
            <label class="required" for="title">{{ trans('cruds.article.fields.title') }}</label>
            <input class="form-control {{ $errors->has('article_title') ? 'is-invalid' : '' }}" type="text" name="article_title" id="article_title" value="{{ old('article_title', '') }}" required>
            @if($errors->has('article_title'))
                <div class="invalid-feedback">
                    {{ $errors->first('article_title') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.article.fields.title_helper') }}</span>
        </div>
        <div class="form-group">
            <label class="required" for="slug">{{ trans('cruds.article.fields.slug') }}</label>
            <input class="form-control {{ $errors->has('article_slug') ? 'is-invalid' : '' }}" type="text" name="article_slug" id="article_slug" value="{{ old('article_slug', '') }}" required>
            @if($errors->has('article_slug'))
                <div class="invalid-feedback">
                    {{ $errors->first('article_slug') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.article.fields.slug_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="summary">{{ trans('cruds.article.fields.summary') }}</label>
            <textarea class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}" name="summary" id="summary">{{ old('summary') }}</textarea>
            @if($errors->has('summary'))
                <div class="invalid-feedback">
                    {{ $errors->first('summary') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.article.fields.summary_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="content">{{ trans('cruds.article.fields.content') }}</label>
            <textarea class="form-control ckeditor {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content">{!! old('content') !!}</textarea>
            @if($errors->has('content'))
                <div class="invalid-feedback">
                    {{ $errors->first('content') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.article.fields.content_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="feature_image">{{ trans('cruds.article.fields.feature_image') }}</label>
            <div class="needsclick dropzone {{ $errors->has('feature_image') ? 'is-invalid' : '' }}" id="feature_image-dropzone">
            </div>
            @if($errors->has('feature_image'))
                <div class="invalid-feedback">
                    {{ $errors->first('feature_image') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.article.fields.feature_image_helper') }}</span>
        </div>
        <div class="form-group">
            <label for="categories">{{ trans('cruds.article.fields.category') }}</label>
            <div style="padding-bottom: 4px">
                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
            </div>
            <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                @foreach($categories as $id => $category)
                    <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
            @if($errors->has('categories'))
                <div class="invalid-feedback">
                    {{ $errors->first('categories') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.article.fields.category_helper') }}</span>
        </div>

        <div class="form-group">
            <label class="required">{{ trans('cruds.article.fields.is_status') }}</label>
            <select class="form-control {{ $errors->has('is_status') ? 'is-invalid' : '' }}" name="is_status" id="is_status" required>
                <option value disabled {{ old('is_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                @foreach(App\Models\Article::IS_STATUS_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('is_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @if($errors->has('is_status'))
                <div class="invalid-feedback">
                    {{ $errors->first('is_status') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.article.fields.is_status_helper') }}</span>
        </div>


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
                                        xhr.open('POST', '{{ route('admin.articles.storeCKEditorImages') }}', true);
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
                                        data.append('crud_id', '{{ $article->id ?? 0 }}');
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
        Dropzone.options.featureImageDropzone = {
            url: '{{ route('admin.articles.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="feature_image"]').remove()
                $('form').append('<input type="hidden" name="feature_image" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="feature_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($article) && $article->feature_image)
                var file = {!! json_encode($article->feature_image) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="feature_image" value="' + file.file_name + '">')
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
