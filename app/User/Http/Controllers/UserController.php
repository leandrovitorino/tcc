<?php

namespace App\User\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Role\Models\Role;
use App\User\Interfaces\UserRepositoryInterface;
use App\User\Models\User;
use Auth;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request): View
    {
        $users = $this->userRepository->all();
        $users = $this->userRepository->getNameRole($users);

        $baseInfo = array(
            'title' => 'Gerenciar Usuários',
            'users' => $users
        );

        return view('user.index', $baseInfo);
    }

    public function create(Request $request): View
    {
        $roles = Role::all();
        $user = new User;

        $baseInfo = array(
            'title' => 'Criar Usuário',
            'roles' => $roles,
            'user' => $user,
            'route' => 'user.create.store'
        );

        return view('user.edit', $baseInfo);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        DB::beginTransaction();

        $data = $request->except('_token', 'userId');
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        DB::commit();

        return redirect()->route('home')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function show(int $userid): View
    {
        $user = User::find($userid);
        $roles = Role::all();

        $baseInfo = array(
            'title' => 'Editar Usuário',
            'user' => $user,
            'roles' => $roles,
            'route' => 'user.edit.store'
        );

        return view('user.edit', $baseInfo);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        try {
            $lastUser = User::find($request->userId);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id ?? $lastUser->role_id,
                'password' => Hash::make($request->password) ?? $lastUser->password
            ];

            $this->userRepository->update($request->userId, $data);

            return redirect()->route('user.index')->with('success', 'Alteração realizada com sucesso!');
        } catch (\Exception $exception){
            return redirect()->back()->withErrors('Ocorreu um erro, tente novamente!');
        }
    }

    public function destroy(int $userid): RedirectResponse
    {
        try {
            User::find($userid)->delete();

            return redirect()->back()->with('info', 'O usuário foi removido com sucesso!');
        } catch (Exception $exception){
            Log::channel('users')->error($exception->getMessage());
            return redirect()->back()->withErrors("Não foi possível deletar o usuário");
        }
    }
}
