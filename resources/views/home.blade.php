@extends('layout')

@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="row">
        @include('base.components.error')
    </div>

    <div class="page-content page-container mt-3">
        <div class="padding mb-4">
            <div class="d-flex justify-content-between mb-4">
                <div class="flex-fill mr-4">
                    <a href="{{route('subject.index')}}" style="text-decoration: none; color:#000">
                        <div class="card">
                            <div class="card-header">Assuntos</div>
                            <div class="card-body" style="height: 100px">
                                <h1 style="text-align: center">{{$subject}}</h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex-fill">
                    <a href="{{route('subject.index')}}" style="text-decoration: none; color:#000">
                        <div class="card">
                            <div class="card-header">Tópicos</div>
                            <div class="card-body" style="height: 100px">
                                <h1 style="text-align: center">{{$topic}}</h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex-fill ml-4">
                    <a href="{{route('question.index')}}" style="text-decoration: none; color:#000">
                        <div class="card">
                            <div class="card-header">Perguntas</div>
                            <div class="card-body" style="height: 100px">
                                <h1 style="text-align: center">{{$question}}</h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="flex-fill mr-4">
                    <a href="{{route('team.index')}}" style="text-decoration: none; color:#000">
                        <div class="card">
                            <div class="card-header">Turmas</div>
                            <div class="card-body" style="height: 100px">
                                <h1 style="text-align: center">{{$team}}</h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex-fill">
                    <a href="{{route('test.index')}}" style="text-decoration: none; color:#000">
                        <div class="card">
                            <div class="card-header">Testes</div>
                            <div class="card-body" style="height: 100px">
                                <h1 style="text-align: center">{{$test}}</h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
