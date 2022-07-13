@extends('layouts.admin')
@section('content')

<!-- View responsável pela parte de histórico dos usuários em geral -->

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
                

                   @foreach($logado as $log => $logado)
                    @if($logado['name'] == $nominho)
                        <tr>
                            <td>
                                {{ $logado['name'] }}
                            </td>
                            <td>
                                {{ $logado['email'] }}
                            </td>
                            <td>
                                {{ $logado['last_login_at'] }}
                            </td>

                        </tr>
                        
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
