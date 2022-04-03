<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyArticleCategoryRequest;
use App\Http\Requests\StoreArticleCategoryRequest;
use App\Http\Requests\UpdateArticleCategoryRequest;
use App\Models\ArticleCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArticleCategoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('article_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ArticleCategory::query()->select(sprintf('%s.*', (new ArticleCategory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'article_category_show';
                $editGate = 'article_category_edit';
                $deleteGate = 'article_category_delete';
                $crudRoutePart = 'article-categories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? ArticleCategory::IS_ACTIVE_RADIO[$row->is_active] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.articleCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('article_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.articleCategories.create');
    }

    public function store(StoreArticleCategoryRequest $request)
    {
        $articleCategory = ArticleCategory::create($request->all());

        return redirect()->route('admin.article-categories.index');
    }

    public function edit(ArticleCategory $articleCategory)
    {
        abort_if(Gate::denies('article_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.articleCategories.edit', compact('articleCategory'));
    }

    public function update(UpdateArticleCategoryRequest $request, ArticleCategory $articleCategory)
    {
        $articleCategory->update($request->all());

        return redirect()->route('admin.article-categories.index');
    }

    public function show(ArticleCategory $articleCategory)
    {
        abort_if(Gate::denies('article_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $articleCategory->load('categoryArticles');

        return view('admin.articleCategories.show', compact('articleCategory'));
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        abort_if(Gate::denies('article_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $articleCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyArticleCategoryRequest $request)
    {
        ArticleCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
