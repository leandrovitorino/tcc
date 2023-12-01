@extends('layout')

@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="row">
        @include('base.components.error')
    </div>

    <h1 class="mb-3">{{$title}}</h1>

    <form action="{{ route($route, ['subject' => $subject]) }}" method="POST">
        @csrf
        @if($route == 'subject.update')
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Assunto:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$subject->name}}" required>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="w-5">Tópicos</th>
                            <th scope="col" class="w-15">Ação</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @if($route == 'subject.update')
                            @foreach($subject->topics as $topic)
                                <tr id="{{$topic->id}}">
                                    <td class="text-nowrap">
                                        <input class="form-control" type="text" name="topic[{{$topic->id}}]" value="{{$topic->name}}">
                                    </td>
                                    <td>
                                        <a href="/subject/topic/destroy/{{ $topic->id }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja remover esse tópico?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tbody>
                        <tr>
                            <td colspan="2" class="text-center">
                                <div class="form-group">
                                    <label for="topic"></label>
                                    <input type="text" id="topic" name="new_topic" class="form-control" {{$required}} placeholder="Novo tópico relacionado a esse assunto">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <button class="btn btn-primary btn-lg btn-block mt-4">
            <i class="bi bi-save"></i> Salvar
        </button>
    </form>
@endsection
