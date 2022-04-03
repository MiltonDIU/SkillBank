@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.profile.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('profile.my-profile.update') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    @if($user->profile!=null)
                        <tr>
                            <th>
                                {{ trans('cruds.profile.fields.mobile') }}
                            </th>
                            <td>
                                {{ $user->profile->mobile }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.profile.fields.gender') }}
                            </th>
                            <td>
                                {{ App\Models\Profile::GENDER_RADIO[$user->profile->gender] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.profile.fields.country') }}
                            </th>
                            <td>
                                {{ $user->profile->country->nationality  }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.profile.fields.reference_name') }}
                            </th>
                            <td>
                                {{ $user->profile->reference_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.profile.fields.reference_mobile') }}
                            </th>
                            <td>
                                {{ $user->profile->reference_mobile }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.profile.fields.avatar') }}
                            </th>
                            <td>

                                @if($user->profile->avatar)
                                    <a href="{{ $user->profile->avatar->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $user->profile->avatar->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.profile.fields.about') }}
                            </th>
                            <td>
                                {!! $user->profile->about !!}
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.profiles.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
