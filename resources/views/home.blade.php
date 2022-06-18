@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            @can('User')
            Sessão para o usuário
            @elsecan('Admin')
            Sessão para o admin
            @endcan
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection