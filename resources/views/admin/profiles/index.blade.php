@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.profile.fields.avatar') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.profile.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.profile.fields.mobile') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $user->id ?? '' }}
                            </td>
                            <td>
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                @if($user->profile)
                                    @if($user->profile->avater)
                                    <a href="{{ url($user->profile->avatar->getUrl()) }}" target="_blank" style="display: inline-block">
                                        <img src="{{ url($user->profile->avatar->getUrl('thumb')) }}">
                                    </a>
                                 @endif
                                @endif
                            </td>
                            <td>
                                {{ $user->email ?? '' }}
                            </td>
                            <td>
                                {{ $user->profile->gender ?? '' }}
                            </td>
                            <td>
                                {{ $user->profile->mobile ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $user->verified ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                            </td>

                            <td>
                                <span style="display:none">{{ $user->approved ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                            </td>

                            <td>
                                @foreach($user->roles as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>

                                @can('profile_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.profiles.show', $user->id) }}">
                                        {{ trans('global.profile') }}
                                    </a>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)


            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection




