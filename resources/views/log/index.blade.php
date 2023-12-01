@extends('layout')

@section('title')
    {{$title}}
@endsection

@section('content')
    @include('base.components.error')
    <div class="align-middle">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="d-flex mt-2">
                        <form method="GET" action="{{ route('log.index') }} ">
                            <label for="per_page">Logs por páginas:</label>
                            <select onchange="this.form.submit()" class="form-select" name="per_page" id="per_page">
                                <option @if (app('request')->input('per_page') == "20" || app('request')->input('per_page') == null) {{ 'selected' }} @endif value="20">20</option>
                                <option @if (app('request')->input('per_page') == "50") {{ 'selected' }} @endif value="50">50</option>
                                <option @if (app('request')->input('per_page') == "100") {{ 'selected' }} @endif value="100">100</option>
                                <option @if (app('request')->input('per_page') == "200") {{ 'selected' }} @endif value="200">200</option>
                            </select>
                        </form>
                    </div>
                    <div class="d-flex">
                        @if (count($filter) > 1)
                            <div class="d-flex align-items-center">
                                <label for="filters" style="margin-right: 5px;">Filtro:</label>
                                <form action="{{ route('log.index') }} " method="GET">
                                    <button type="submit" class="btn btn-outline-danger mb-2">
                                        <i class="bi bi-x-circle-fill"></i>
                                        Limpar Filtro
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex text-right">
                        <form action="{{ route('log.index') }} " method="get">
                            @csrf
                            <div class="input-group mb-2">
                                <input type="hidden" name="per_page" value="{{ $per_page }}">
                                <input type="text" name="msg" @isset($filter['msg']) value=" {{ $filter['msg'] }} " @endisset class="form-control" placeholder="Filtrar">
                                <button type="submit" class="btn btn-outline-primary mb-2">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th class="col-3 w-15">Usuário</th>
                            <th class="w-15">LOG</th>
                            <th class="w-15">Data</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $log->user->name }}</td>
                                <td>{{ $log->msg }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Nenhum registro encontrado.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $logs->appends($filter)->links('base.components.pagination')}}
    </div>
@endsection
