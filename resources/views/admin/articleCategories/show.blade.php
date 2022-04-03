@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.articleCategory.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.article-categories.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.articleCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $articleCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.articleCategory.fields.title') }}
                        </th>
                        <td>
                            {{ $articleCategory->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.articleCategory.fields.slug') }}
                        </th>
                        <td>
                            {{ $articleCategory->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.articleCategory.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\ArticleCategory::IS_ACTIVE_RADIO[$articleCategory->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.article-categories.index') }}">
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
                <a class="nav-link" href="#category_articles" role="tab" data-toggle="tab">
                    {{ trans('cruds.article.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="category_articles">
                @includeIf('admin.articleCategories.relationships.categoryArticles', ['articles' => $articleCategory->categoryArticles])
            </div>
        </div>
    </div>

@endsection
