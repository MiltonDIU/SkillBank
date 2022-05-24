<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Menu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArticlesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('article_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Article::with(['categories', 'menu'])->select(sprintf('%s.*', (new Article())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'article_show';
                $editGate = 'article_edit';
                $deleteGate = 'article_delete';
                $crudRoutePart = 'articles';

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
            $table->editColumn('summary', function ($row) {
                return $row->summary ? $row->summary : '';
            });
            $table->editColumn('feature_image', function ($row) {
                if ($photo = $row->feature_image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('category', function ($row) {
                $labels = [];
                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->title);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('menu_title', function ($row) {
                return $row->menu ? $row->menu->title : '';
            });

            $table->editColumn('is_status', function ($row) {
                return $row->is_status ? Article::IS_STATUS_SELECT[$row->is_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'feature_image', 'category', 'menu']);

            return $table->make(true);
        }

        return view('admin.articles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('article_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ArticleCategory::pluck('title', 'id');

        $menus = Menu::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.articles.create', compact('categories', 'menus'));
    }

    public function store(StoreArticleRequest $request)
    {
        $article = Article::create($request->all());
        if ($request->input('menu_id')!=null){
            $menu = Menu::find($request->input('menu_id'));
            $data['external_link']=null;
            $data['link_type']=2;
            $menu->update($data);
        }

        $article->categories()->sync($request->input('categories', []));
        if ($request->input('feature_image', false)) {
            $article->addMedia(storage_path('tmp/uploads/' . basename($request->input('feature_image'))))->toMediaCollection('feature_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $article->id]);
        }

        return redirect()->route('admin.articles.index');
    }

    public function edit(Article $article)
    {
        abort_if(Gate::denies('article_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ArticleCategory::pluck('title', 'id');

        $menus = Menu::pluck('title','id')->prepend(trans('global.preaseSelect'), '');

        $article->load('categories', 'menu');

        return view('admin.articles.edit', compact('article', 'categories', 'menus'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {

        $article->update($request->all());
        if ($request->input('menu_id')!=null){
            $menu = Menu::find($request->input('menu_id'));
            $data['external_link']=null;
            $data['link_type']=2;
            $menu->update($data);
        }
        $article->categories()->sync($request->input('categories', []));
        if ($request->input('feature_image', false)) {
            if (!$article->feature_image || $request->input('feature_image') !== $article->feature_image->file_name) {
                if ($article->feature_image) {
                    $article->feature_image->delete();
                }
                $article->addMedia(storage_path('tmp/uploads/' . basename($request->input('feature_image'))))->toMediaCollection('feature_image');
            }
        } elseif ($article->feature_image) {
            $article->feature_image->delete();
        }

        return redirect()->route('admin.articles.index');
    }

    public function show(Article $article)
    {
        abort_if(Gate::denies('article_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $article->load('categories', 'menu');

        return view('admin.articles.show', compact('article'));
    }

    public function destroy(Article $article)
    {
        abort_if(Gate::denies('article_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $article->delete();

        return back();
    }

    public function massDestroy(MassDestroyArticleRequest $request)
    {
        Article::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('article_create') && Gate::denies('article_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Article();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
