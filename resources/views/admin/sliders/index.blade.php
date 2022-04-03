@extends('layouts.admin')
@section('content')
    @can('slider_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.sliders.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.slider.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.slider.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Slider">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.slider.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.slider.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.slider.fields.sub_title') }}
                    </th>
                    <th>
                        {{ trans('cruds.slider.fields.get_started_text') }}
                    </th>
                    <th>
                        {{ trans('cruds.slider.fields.get_started_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.slider.fields.learn_more_text') }}
                    </th>
                    <th>
                        {{ trans('cruds.slider.fields.learn_more_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.slider.fields.slider_image') }}
                    </th>
                    <th>
                        {{ trans('cruds.slider.fields.is_active') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('slider_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.sliders.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.sliders.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'sub_title', name: 'sub_title' },
                    { data: 'get_started_text', name: 'get_started_text' },
                    { data: 'get_started_url', name: 'get_started_url' },
                    { data: 'learn_more_text', name: 'learn_more_text' },
                    { data: 'learn_more_url', name: 'learn_more_url' },
                    { data: 'slider_image', name: 'slider_image', sortable: false, searchable: false },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-Slider').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
