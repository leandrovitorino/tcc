@extends('layout')

@section('title')
    {{$title}}
@endsection

@section('content')
    <form action="{{ route($route) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="{{ $user->email }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" placeholder="Digite a sua senha" class="form-control">
        </div>

        @can('User Management')
            <div class="row mt-3">
                <div class="col-sm-4">
                    <p>Nível de Acesso:</p>
                    @foreach ($roles as $role)
                        @php
                            $checked = ''
                        @endphp
                        @if ($role->id == $user->role_id)
                            @php
                                $checked = 'checked'
                            @endphp
                        @endif
                        <ul>
                            <input type="radio" id="{{ $role->id }}" value="{{ $role->id }}" name="role_id" {{ $checked }}>
                            <label for="{{ $role->id }}">{{ $role->name }}</label><br>
                        </ul>
                    @endforeach
                </div>
            </div>
        @endcan
        <button class="btn btn-primary btn-lg btn-block mt-4" value="{{ $user->id }}">Salvar</button>
    </form>
@endsection
