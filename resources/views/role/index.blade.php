@extends('layout')

@section('title')
    {{$title}}
@endsection

@section('content')
    @include('base.components.error')
    <div class="btn-group mb-4">
            <a href="{{ route('role.create') }}" class="btn btn-success">Criar Nível de Acesso</a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="w-15">Nível de Acesso</th>
                            <th class="w-15">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <a href="{{ route('role.edit', ['role' => $role->id]) }}" class="btn btn-info">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex ml-1">
                                            <form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
