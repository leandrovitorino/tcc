<?php

namespace App\Subject\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Util\Filter\FiltersGetter;
use App\Subject\Interfaces\SubjectRepositoryInterface;
use App\Subject\Models\Subject;
use App\Topic\Models\Topic;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class SubjectController extends Controller
{
    private SubjectRepositoryInterface $subjectRepository;
    private FiltersGetter $filtersGetter;

    public function __construct
    (
        SubjectRepositoryInterface $subjectRepository,
        FiltersGetter $filtersGetter
    )
    {
        $this->subjectRepository = $subjectRepository;
        $this->filtersGetter = $filtersGetter;
    }

    public function index(Request $request): View
    {
        $filters = $this->filtersGetter->addFilters($request);
        $baseInfo = [
            'title' => 'Gerenciar Assuntos',
            'subjects' => $this->subjectRepository->search($filters),
            'filters' => $filters
        ];

        return view('subject.index', $baseInfo);
    }

    public function create(): View
    {
        $baseInfo = [
            'title' => 'Novo Assunto',
            'subject' => new Subject(),
            'route' => 'subject.store',
            'required' => 'required'
        ];

        return view('subject.create', $baseInfo);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate(['name' => 'required']);

            $subject = new Subject($data);
            $this->subjectRepository->save($subject);

            $topic = new Topic();
            $topic->name = $request->new_topic;
            $subject->topics()->save($topic);

            return redirect()->route('subject.index')->with('success', 'Assunto adicionado com sucesso.');
        } catch (Exception $exception){
            Log::channel('questions')->error('Ocorreu um erro: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro, tente novamente.');
        }
    }

    public function edit(Subject $subject): View
    {
        $baseInfo = [
            'title' => 'Novo Assunto',
            'subject' => $subject,
            'route' => 'subject.update',
            'required' => ''
        ];

        return view('subject.create', $baseInfo);
    }

    public function update(Request $request, Subject $subject): RedirectResponse
    {
        $request->validate(['name' => 'required']);
        $subject->name = $request->name;
        $subject->save();

        if (isset($request->new_topic)){
            $topic = new Topic();
            $topic->name = $request->new_topic;
            $subject->topics()->save($topic);
        }

        return redirect()->route('subject.index')->with('success', 'Assunto atualizado com sucesso.');
    }
}
