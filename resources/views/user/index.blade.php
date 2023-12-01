@extends('layout')

@section('title')
    {{$title}}
@endsection

@section('content')
    @include('base.components.error')

    @can('User Management')
        <div class="btn-group mb-4">
            <a href="{{ route('user.create') }}" class="btn btn-success"><i class="bi bi-person-plus"></i> Criar Usuário</a>
        </div>
    @endcan

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="w-5">Usuário</th>
                            <th scope="col" class="w-15">Nível de Acesso</th>
                            <th scope="col" class="w-25">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            @if((Auth::User()->can('User Management')) || (Auth::User()->id == $user->id))
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->role_name }}
                                    </td>
                                    <td>
                                        <a href="/user/{{ $user->id }}" class="btn btn-info">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        @can('User Management')
                                            <a href="/user/destroy/{{ $user->id }}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja remover o usuário?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
