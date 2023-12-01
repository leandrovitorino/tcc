@extends('layout')

@section('title')
    {{$title}}
@endsection

@section('content')
    <form action="{{ route($route, ['test' => $test->id]) }}" method="POST">
        @if($route == 'test.update')
            @method('PUT')
        @endif
        @csrf
        <div class="form-group">
            <label for="testName">Teste:</label>
            <input class="form-control" type="text" id="testName" name="code" value="{{ $test->code }}" required>
            <input type="hidden" id="testId" name="id" value="{{ $test->id }}" readonly hidden>
        </div>

        <div class="form-group">
            <label for="teamId">Turma:</label>
            <select name="team_id" id="teamId" class="form-control" required>
                <option value="">Selecione uma turma</option>
                @foreach($teams as $team)
                    <option @if($test->team_id == $team->id) selected @endif value="{{$team->id}}">{{$team->code}} ({{$team->matter}})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <fieldset>
                <legend>Questões</legend>

                <div class="container">
                    <ul class="nav nav-tabs">
                        @foreach($topics as $topic)
                            <li class="nav-item"><a class="nav-link" style="background-color: #ffffff" data-toggle="tab" href="#menu{{$topic->id}}">{{$topic->name}}</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($topics as $topic)
                            <div class="tab-pane fade" id="menu{{$topic->id}}">
                                @foreach($topic->questions as $question)
                                    <br>
                                    <input type="checkbox" id="{{$question->id}}" name="questions[]" value="{{$question->id}}"
                                        @if(in_array($question->id, array_column($test->questions->toArray(), 'question_id')))
                                            checked
                                        @endif
                                    >
                                    <label style="background-color: #ffffff" for="{{$question->id}}">{{$question->body}}</label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </fieldset>
        </div>

        <button class="btn btn-primary btn-lg btn-block mt-4">Salvar</button>
    </form>
@endsection
