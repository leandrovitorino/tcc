<?php

namespace App\Login\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Question\Interfaces\QuestionRepositoryInterface;
use App\Subject\Interfaces\SubjectRepositoryInterface;
use App\Team\Interfaces\TeamRepositoryInterface;
use App\Test\Interfaces\TestRepositoryInterface;
use App\Topic\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct
    (
        private SubjectRepositoryInterface $subjectRepository,
        private TopicRepositoryInterface $topicRepository,
        private QuestionRepositoryInterface $questionRepository,
        private TeamRepositoryInterface $teamRepository,
        private TestRepositoryInterface $testRepository
    )
    {
    }

    public function index(): View | RedirectResponse
    {
        return auth()->check() ?
            redirect()->route('home') :
            view('login.index', ['title' => 'Login']);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Usuário conectado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->put('modal', 'close');
        Auth::logout();
        return redirect()->route('login');
    }

    public function home(): View
    {
        $baseInfo = [
            'title' => 'Home',
            'subject' => count($this->subjectRepository->all()),
            'topic' => count($this->topicRepository->all()),
            'question' => count($this->questionRepository->all()),
            'team' => count($this->teamRepository->all()),
            'test' => count($this->testRepository->all()),
        ];

        return view('home', $baseInfo);
    }
}
