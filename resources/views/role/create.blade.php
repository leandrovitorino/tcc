@extends('layout')

@section('title')
    {{$title}}
@endsection

@section('content')
    <form action="{{ route($route, ['role' => $role->id]) }}" method="POST">
        @if($route == 'role.update')
            @method('PUT')
        @endif
        @csrf
        <div class="form-group">
            <label for="roleName">Nome:</label>
            <input class="form-control" type="text" id="roleName" name="roleName" value="{{ $role->name }}">
            <input type="hidden" id="roleId" name="roleId" value="{{ $role->id }}" readonly hidden>
        </div>
        <div class="row mt-3">
            <div class="col-sm-4">
                @foreach ($permissions as $permission)
                    @foreach ($role->permissions as $role_permission)
                        @if ($permission->name == $role_permission->name)
                            @php
                                $permission->checked = 'checked'
                            @endphp
                        @endif
                    @endforeach
                    <ul>
                        <input type="checkbox" id="{{ $permission->id }}" value="{{ $permission->id }}" {{ $permission->checked }} name="permissions[]">
                        <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                    </ul>
                @endforeach
            </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block mt-4">Salvar</button>
    </form>
@endsection
