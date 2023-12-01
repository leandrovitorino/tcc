@extends('layout')

@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="row">
        @include('base.components.error')
    </div>

    <div class="login">
        <h1><b>Login</b></h1>
        <br>
        <form action="{{route('login.authenticate')}}" method="POST">
            @csrf
            <input type="text" name="email" required class="form-control" placeholder="Usuário/Email">
            <br>
            <input type="password" name="password" required class="form-control" placeholder="Senha">
            <br><br>
            <button>
                <i class="bi bi-unlock"></i> Entrar
            </button>
        </form>
    </div>
@endsection
