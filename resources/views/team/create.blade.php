@extends('layout')

@section('title')
    {{$title}}
@endsection

@section('content')
    <form action="{{ route($route, ['team' => $team->id]) }}" method="POST">
        @if($route == 'team.update')
            @method('PUT')
        @endif
        @csrf
        <div class="form-group">
            <label for="teamName">Turma:</label>
            <input class="form-control" type="text" id="teamName" name="code" value="{{ $team->code }}" required>
            <input type="hidden" id="teamId" name="id" value="{{ $team->id }}" readonly hidden>
        </div>

        <div class="form-group">
            <label for="teamName">Turno:</label>
            <select name="shift" id="teamName" class="custom-select" required>
                <option value="" hidden>Selecione um turno</option>
                <option @if($team->shift == 1) selected @endif value="1">Manhã</option>
                <option @if($team->shift == 2) selected @endif value="2">Noite</option>
            </select>
        </div>

        <div class="form-group">
            <label for="teamName">Matéria:</label>
            <input class="form-control" type="text" id="teamName" name="matter" value="{{ $team->matter }}" required>
        </div>

        <button class="btn btn-primary btn-lg btn-block mt-4">Salvar</button>
    </form>
@endsection
