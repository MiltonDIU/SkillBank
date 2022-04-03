<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPositionRequest;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PositionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('position_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $positions = Position::with(['media'])->get();

        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        abort_if(Gate::denies('position_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.positions.create');
    }

    public function store(StorePositionRequest $request)
    {
        $position = Position::create($request->all());

        if ($request->input('image', false)) {
            $position->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $position->id]);
        }

        return redirect()->route('admin.positions.index');
    }

    public function edit(Position $position)
    {
        abort_if(Gate::denies('position_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.positions.edit', compact('position'));
    }

    public function update(UpdatePositionRequest $request, Position $position)
    {
        $position->update($request->all());

        if ($request->input('image', false)) {
            if (!$position->image || $request->input('image') !== $position->image->file_name) {
                if ($position->image) {
                    $position->image->delete();
                }
                $position->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($position->image) {
            $position->image->delete();
        }

        return redirect()->route('admin.positions.index');
    }

    public function show(Position $position)
    {
        abort_if(Gate::denies('position_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $position->load('positionMenus');

        return view('admin.positions.show', compact('position'));
    }

    public function destroy(Position $position)
    {
        abort_if(Gate::denies('position_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $position->delete();

        return back();
    }

    public function massDestroy(MassDestroyPositionRequest $request)
    {
        Position::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('position_create') && Gate::denies('position_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Position();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
