<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySocialRequest;
use App\Http\Requests\StoreSocialRequest;
use App\Http\Requests\UpdateSocialRequest;
use App\Models\Social;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SocialsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('social_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Social::query()->select(sprintf('%s.*', (new Social())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'social_show';
                $editGate = 'social_edit';
                $deleteGate = 'social_delete';
                $crudRoutePart = 'socials';

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
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : '';
            });
            $table->editColumn('icon_class_name', function ($row) {
                return $row->icon_class_name ? $row->icon_class_name : '';
            });
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? Social::IS_ACTIVE_RADIO[$row->is_active] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.socials.index');
    }

    public function create()
    {
        abort_if(Gate::denies('social_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socials.create');
    }

    public function store(StoreSocialRequest $request)
    {
        $social = Social::create($request->all());

        return redirect()->route('admin.socials.index');
    }

    public function edit(Social $social)
    {
        abort_if(Gate::denies('social_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socials.edit', compact('social'));
    }

    public function update(UpdateSocialRequest $request, Social $social)
    {
        $social->update($request->all());

        return redirect()->route('admin.socials.index');
    }

    public function show(Social $social)
    {
        abort_if(Gate::denies('social_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socials.show', compact('social'));
    }

    public function destroy(Social $social)
    {
        abort_if(Gate::denies('social_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $social->delete();

        return back();
    }

    public function massDestroy(MassDestroySocialRequest $request)
    {
        Social::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
