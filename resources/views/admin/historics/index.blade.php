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

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
