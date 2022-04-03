<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMenuRequest;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Menu;
use App\Models\Position;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MenusController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('menu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Menu::with(['positions'])->select(sprintf('%s.*', (new Menu())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'menu_show';
                $editGate = 'menu_edit';
                $deleteGate = 'menu_delete';
                $crudRoutePart = 'menus';

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
            $table->editColumn('link_type', function ($row) {
                return $row->link_type ? Menu::LINK_TYPE_SELECT[$row->link_type] : '';
            });
            $table->editColumn('external_link', function ($row) {
                return $row->external_link ? $row->external_link : '';
            });
            $table->editColumn('serial', function ($row) {
                return $row->serial ? $row->serial : '';
            });
            $table->editColumn('parent', function ($row) {
                return $row->parent ? $row->parent : '';
            });
            $table->editColumn('position', function ($row) {
                $labels = [];
                foreach ($row->positions as $position) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $position->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? Menu::IS_ACTIVE_RADIO[$row->is_active] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'position']);

            return $table->make(true);
        }

        return view('admin.menus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('menu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = ArticleCategory::pluck('title', 'id');
        $menus = Menu::where('is_active',1)->where('parent',0)->get();
        $positions = Position::pluck('title', 'id');
        $articles = Article::where('is_status','1')->pluck('title', 'id');

        return view('admin.menus.create', compact('positions','categories','menus','articles'));
    }

    public function store(StoreMenuRequest $request)
    {
       // dd($request);
        $menu = Menu::create($request->all());
        if ($request->input('link_type')=='2'){
            $data['external_link']=null;
            $article = Article::find($request->input('article_id'));
            $adata['menu_id'] =$menu->id;
            $article->update($adata);
            $menu->update($data);
        }
        $menu->positions()->sync($request->input('positions', []));

        return redirect()->route('admin.menus.index');
    }

    public function edit(Menu $menu)
    {
        abort_if(Gate::denies('menu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $positions = Position::pluck('title', 'id');

        $menu->load('positions');
        $menus = Menu::where('is_active',1)->where('parent',0)->get();
        $articles = Article::where('is_status','1')->get();
        return view('admin.menus.edit', compact('menu', 'positions','menus','articles'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {

        $data =$request->all();

        if ($request->input('link_type')=='2'){
            $data['external_link']=null;
            $article = Article::find($request->input('article_id'));
            $adata['menu_id'] =$menu->id;
            $article->update($adata);
        }

        $menu->update($data);

        $menu->positions()->sync($request->input('positions', []));
        return redirect()->route('admin.menus.index');
    }

    public function show(Menu $menu)
    {
        abort_if(Gate::denies('menu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu->load('positions');

        return view('admin.menus.show', compact('menu'));
    }

    public function destroy(Menu $menu)
    {
        abort_if(Gate::denies('menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuRequest $request)
    {
        Menu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
