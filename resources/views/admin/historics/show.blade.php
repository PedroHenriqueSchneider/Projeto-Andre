@extends('layouts.admin')
@section('content')

<!-- View responsável pela parte de histórico dos usuários -->

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
                            {{ trans('Usuário') }}
                        </th>
                        <th width="10">
                            {{ trans('Email') }}
                        </th>
                        <th width="10">
                            {{ trans('Ultimo Login') }}
                        </th>
                        
                    </tr>
                </thead>
                <tbody>
                   @foreach($logado as $log)
                        <tr data-entry-id="{{ $log['name'] }}">
                            <td>
                                {{ $log['name'] }}
                            </td>
                            <td>
                                {{ $log['email'] }}
                            </td>
                            <td>
                                {{ $log['last_login_at'] }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
