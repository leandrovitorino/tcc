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
            <h1 class="mt-3 mb-3">{{$title}}</h1>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <div class="btn-group">
                        <a href="{{ route('question.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Nova Questão</a>
                    </div>
                </div>
                <div class="d-flex">
                    @if (count($filters) > 0)
                        <div class="d-flex align-items-center">
                            <label for="filters" style="margin-right: 5px;">Filtros:</label>
                            <form action="{{ route('question.index') }} " method="GET">
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

                            <button type="submit" class="btn btn-success">
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
                                    <th class="w-5">Assunto</th>
                                    <th class="w-15">Tópico</th>
                                    <th class="w-15">Questão</th>
                                    <th class="w-25">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($questions as $question)
                                    <tr id="conteudo">
                                        <td>{{$question->topic->subject->name}}</td>
                                        <td>{{$question->topic->name}}</td>
                                        <td>{{$question->body}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <a href="{{ route('question.edit', ['question' => $question->id]) }}" class="btn btn-success">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="d-flex ml-1">
                                                    <form action="{{ route('question.destroy', ['question' => $question]) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja remover essa questão?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhuma questão encontrada.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{$questions->appends($filters)->links('base.components.pagination')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
