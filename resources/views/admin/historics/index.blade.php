@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
    {{ trans('global.list') }}  de {{ trans('cruds.historic.title') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.historic.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.historic.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.historic.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.historic.fields.last_login_at') }}
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
                    @foreach($historics as $key =>$historics)
                        <tr data-entry-id="{{$historics->id }}">
                            <td>

                            </td>
                            <td>
                                {{$historics->id ?? '' }}
                            </td>
                            <td>
                                {{$historics->name ?? '' }}
                            </td>
                            <td>
                                {{$historics->email ?? '' }}
                            </td>
                            <td>
                                {{$historics->last_login_at ?? '' }}
                            </td>
                            <td>
                                @foreach($historics->roles as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                 @can('user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.historics.show',$historics->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                <!-- 
                                @can('user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit',$historics->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan -->

                                <!-- @can('user_delete')
                                    <form action="{{ route('admin.users.destroy',$historics->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan -->

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
<!-- @section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection -->