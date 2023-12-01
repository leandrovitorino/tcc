@extends('layout')

@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="row">
        @include('base.components.error')
    </div>
    <div>
        <div class="efeito mt-3">
            <div>
                <h3>Objetivo</h3>
                <p>Esse trabalho possui como objetivo criar um sistema que auxilie os professores a ter um melhor entendimento de como anda o aprendizado da turma.</p>
            </div>
            <br>
            <div>
                <h3>Linguagens utilizadas</h3>
                <p>HTML 5, PHP, SQL</p>
            </div>
            <br>
            <div>
                <h3>Frameworks utilizados</h3>
                <p>Laravel, Bootstrap</p>
            </div>
            <br>
            <div>
                <h3>Conclusão</h3>
                <p>
                    O sistema desenvolvido, utilizando HTML 5, PHP, e SQL com os frameworks Laravel e Bootstrap, o aplicativo não apenas simplifica as tarefas administrativas dos professores,
                    mas também eleva a qualidade do ensino ao proporcionar ao professor mais tempo para abordar as matérias com seus alunos.
                    Ao promover eficiência no gerenciamento do tempo e oferecer uma abordagem personalizada,
                    essa ferramenta emerge como uma aliada indispensável para educadores comprometidos com o progresso acadêmico.
                    Ao adotar essa tecnologia, os professores não apenas otimizam suas práticas, mas também abrem portas para um ensino mais eficaz e centrado no aluno.
                </p>
            </div>
            <br>
            <div>
                <h3>Alunos</h3>
                <p>Agda Loureiro e Leandro Vitorino</p>
            </div>
        </div>
    </div>
@endsection
