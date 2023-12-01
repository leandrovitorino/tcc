@extends('layout')

@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="row">
        @include('base.components.error')
    </div>

    <h1 class="mb-3">{{$title}}</h1>

    <form action="{{ route($route, ['question' => $question]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($route == 'question.update')
            @method('PUT')
        @endif

        <div class="form-row mb-4">
            <div class="col-md-6 col-sm-12">
                <label for="topic_id">Tópico:</label>
                <select class="custom-select" name="topic_id" id="topic_id">
                    <option value="" selected hidden>Selecione o Tópico</option>
                    @foreach($topics as $topic)
                        <option value="{{$topic->id}}" @if($topic->id == $question->topic_id) selected @endif>{{$topic->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="age">Ano:</label>
                <input type="number" id="age" name="age" class="form-control" value="{{$question->age}}" min="1950" max="{{(int) date('Y')}}" required>
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="body">Questão:</label>
            <textarea name="body" id="body" cols="30" rows="5" class="form-control" required>{{$question->body}}</textarea>
        </div>

        <div class="form-group">
            @isset($question->image)
                <img src="{{asset('images/questions/'.$question->id.'.png')}}" alt="Imagem da Questão" width="150px"><br>
                <label class="mt-2" for="remove_image">Deseja remover a imagem?</label>
                <input id="remove_image" type="radio" name="remove_image" value="0" checked>Não
                <input id="remove_image" type="radio" name="remove_image" value="1">Sim<br>

                <label class="mt-2" for="image">Imagem (Caso deseje alterar):</label>
            @else
                <label for="image">Imagem (Opcional):</label>
            @endisset
            <input class="form-control" id="image" type="file" name="image">
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="w-5">Alternativas</th>
                                <th scope="col" class="text-center w-15">Gabarito</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($options as $option)
                                <tr>
                                    <th scope="col" class="w-5">
                                        <input type="text" class="form-control" name="options[{{$option->id}}]" value="{{$option->response}}">
                                    </th>
                                    <th scope="col" class="text-center w-15" style="vertical-align: middle">
                                        <input type="radio" name="correct" value="{{$option->id}}" @if($option->correct) checked @endif>
                                    </th>
                                </tr>
                            @empty
                                @for($x=0; $x<5; $x++)
                                    <tr>
                                        <th scope="col" class="w-5">
                                            <input class="form-control" type="text" name="options[{{$x}}]" placeholder="Alternativa {{$x+1}}" required>
                                        </th>
                                        <th scope="col" class="text-center w-15" style="vertical-align: middle">
                                            <input type="radio" name="correct" value="{{$x}}" title="Selecione a correta">
                                        </th>
                                    </tr>
                                @endfor
                            @endforelse
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
