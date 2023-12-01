@extends('layout')

@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="row">
        @include('base.components.error')
    </div>

    <div class="align-middle">
        <div class="col-12">
            <h1 class="mb-3">{{$title}}</h1>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <div class="btn-group">
                        <a href="{{ route('subject.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Novo Assunto</a>
                    </div>
                </div>
                <div class="d-flex">
                    @if (count($filters) > 0)
                        <div class="d-flex align-items-center">
                            <label for="filters" style="margin-right: 5px;">Filtros:</label>
                            <form action="{{ route('subject.index') }} " method="GET">
                                <button type="submit" class="btn btn-outline-danger mb-2">
                                    <i class="bi bi-x-circle-fill"></i>
                                    Limpar Filtro
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="d-flex">
                    <form method="get">
                        @csrf
                        <div class="input-group">
                            <label for="search" class="mt-1">Filtrar:</label>
                            <input id="search" type="text" name="search" @isset($filters['search']) value="{{$filters['search']}}" @endisset  class="form-control ml-2">

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="align-middle mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th class="w-5">Nome</th>
                                    <th class="w-25">Tópicos</th>
                                    <th class="w-25 text-center">Editar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($subjects as $subject)
                                    <tr>
                                        <td>{{$subject->name}}</td>
                                        <td>{{count($subject->topics)}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <a href="{{ route('subject.edit', ['subject' => $subject->id]) }}" class="btn btn-info">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Nenhum usuário encontrado.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{$subjects->appends($filters)->links('base.components.pagination')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
