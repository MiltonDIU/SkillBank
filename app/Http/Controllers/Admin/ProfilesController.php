<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Country;
use App\Models\Profile;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProfilesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('profile_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::with(['profile'])->get();
        return view('admin.profiles.index', compact('users'));
    }

    public function show($id)
    {

        abort_if(Gate::denies('profile_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::find($id);
        return view('admin.profiles.show', compact('user'));

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('profile_create') && Gate::denies('profile_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Profile();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function edit(Profile $edit){
        abort_if(Gate::denies('profile_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all()->pluck('nationality', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.profiles.edit',compact('countries'));
    }
    public function update(UpdateProfileRequest $request){
       $user = User::find(auth()->id());
        $user->update($request->only('name','if_notification'));
        $profile = Profile::where('user_id',auth()->id())->get()->first();
        if ($profile==null){
            $data  = $request->all();
            array_push($data,$data['user_id']=auth()->id());
            $profile = Profile::create($data);
            if ($request->input('avatar', false)) {
                $profile->addMedia(storage_path('tmp/uploads/' . $request->input('avatar')))->toMediaCollection('avatar');
            }
            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $profile->id]);
            }
            $message ="Your profile create successfully";
        }else{

            $profile->update($request->all());
            if ($request->input('avatar', false)) {
                if (!$profile->avatar || $request->input('avatar') !== $profile->avatar->file_name) {
                    if ($profile->avatar) {
                        $profile->avatar->delete();
                    }
                    $profile->addMedia(storage_path('tmp/uploads/' . $request->input('avatar')))->toMediaCollection('avatar');
                }
            } elseif ($profile->avatar) {
                $profile->avatar->delete();
            }
            $message ="Your profile update successfully";
        }
//        return redirect()->route('profile.my-profile.edit')->with('message', $message);
        return redirect()->back()->with('message', $message);

    }
}
