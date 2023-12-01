<?php

namespace App\Role\Http\Controllers;

use App\Role\Models\Permission;
use App\Role\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoleController
{
    public function index(): View
    {
        $roles = Role::all();

        $baseInfo = array(
            'title' => 'Gerenciar Níveis de Acesso',
            'roles' => $roles
        );

        return view('role.index', $baseInfo);
    }

    public function create(): View
    {
        $baseInfo = array(
            'title' => 'Criar Nível de Acesso',
            'permissions' => Permission::all(),
            'role' => new Role(),
            'route' => 'role.store'
        );

        return view('role.create', $baseInfo);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'roleName' => 'required',
            'permissions' => 'required'
        ]);

        DB::beginTransaction();

        $lastRole = Role::create([
            'name' => $request->roleName
        ]);

        foreach ( $request->permissions as $permission)
        {
            $lastPermission = Permission::find($permission);
            $lastRole->allowTo($lastPermission);
        }

        DB::commit();

        return redirect()->route('role.index')->with('success', 'Cadastrada com sucesso!');
    }

    public function edit(int $roleid): View
    {
        $baseInfo = array(
            'title' => 'Editar Nível de Acesso',
            'role' => Role::find($roleid),
            'permissions' => Permission::all(),
            'route' => 'role.update'
        );

        return view('role.create', $baseInfo);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'roleName' => 'required',
            'permissions' => 'required'
        ]);

        DB::beginTransaction();

        $lastRole = Role::find($request->roleId);
        $lastRole->update(['name' => $request->roleName]);
        $lastRole->cleanPermissions();

        foreach ( $request->permissions as $permission)
        {
            $lastPermission = Permission::find($permission);
            $lastRole->allowTo($lastPermission);
        }

        DB::commit();

        return redirect()->route('role.index')->with('success', 'Alteração realizada com sucesso!');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if (count($role->user) == 0){
            $role->delete();
            return back()->with('success', 'Nível de acesso removido com sucesso');
        } else{
            return back()->withErrors('Não é possível realizar a remoção! Este nível de acesso está sendo utilizado');
        }
    }
}
