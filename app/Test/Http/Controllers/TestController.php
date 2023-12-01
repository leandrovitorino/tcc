<?php

namespace App\Test\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Util\Filter\FiltersGetter;
use App\Team\Interfaces\TeamRepositoryInterface;
use App\Test\Models\Test;
use App\Test\Interfaces\TestRepositoryInterface;
use App\Test\Models\TestQuestion;
use App\Test\Services\DeleteQuestionService;
use App\Topic\Interfaces\TopicRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TestController extends Controller
{
    private TestRepositoryInterface $testRepository;
    private TopicRepositoryInterface $topicRepository;
    private TeamRepositoryInterface $teamRepository;
    private FiltersGetter $filtersGetter;
    private DeleteQuestionService $deleteQuestionService;

    public function __construct
    (
        TestRepositoryInterface $testRepository,
        TopicRepositoryInterface $topicRepository,
        TeamRepositoryInterface $teamRepository,
        FiltersGetter $filtersGetter,
        DeleteQuestionService $deleteQuestionService
    )
    {
        $this->testRepository = $testRepository;
        $this->topicRepository = $topicRepository;
        $this->teamRepository = $teamRepository;
        $this->filtersGetter = $filtersGetter;
        $this->deleteQuestionService = $deleteQuestionService;
    }

    public function index(Request $request): View
    {
        $filters = $this->filtersGetter->addFilters($request);

        $baseInfo = [
            'title' => 'Testes',
            'filters' => $filters,
            'tests' => $this->testRepository->getTests($filters)
        ];

        return view('test.index', $baseInfo);
    }

    public function create(): View
    {
        $baseInfo = [
            'title' => 'Novo Teste',
            'route' => 'test.store',
            'topics' => $this->topicRepository->all(),
            'teams' => $this->teamRepository->all(),
            'test' => new Test()
        ];

        return view('test.create', $baseInfo);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
                'code' => 'required',
                'team_id' => 'required'
            ]);

            $test = new Test($data);
            $test->save();

            if (isset($request->questions)){
                foreach ($request->questions as $question){
                    $test_question = new TestQuestion();
                    $test_question->test_id = $test->id;
                    $test_question->question_id = (int)$question;
                    $test_question->save();
                }
            }

            return redirect()->route('test.index')->with('success', 'Teste adicionado com sucesso.');
        } catch (Exception $exception){
            Log::channel('errors')->error('Ocorreu um erro: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro, entre em contato com o administrador');
        }
    }

    public function edit(test $test): View
    {
        $baseInfo = [
            'title' => 'Editar o Teste',
            'route' => 'test.update',
            'test' => $test,
            'teams' => $this->teamRepository->all(),
            'topics' => $this->topicRepository->all()
        ];

        return view('test.create', $baseInfo);
    }

    public function update(Request $request, test $test): RedirectResponse
    {
        try {
            $data = $request->validate([
                'code' => 'required',
                'team_id' => 'required'
            ]);

            $this->testRepository->update($test->id, $data);
            $this->deleteQuestionService->remove($test);

            if (isset($request->questions)){
                foreach ($request->questions as $question){
                    $test_question = new TestQuestion();
                    $test_question->test_id = $test->id;
                    $test_question->question_id = (int)$question;
                    $test_question->save();
                }
            }

            return back()->with('success', 'Teste atualizado com sucesso.');
        } catch (Exception $exception){
            Log::channel('errors')->error('Ocorreu um erro: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro: ' . $exception->getMessage());
        }
    }

    public function destroy(test $test): RedirectResponse
    {
        try {
            $this->deleteQuestionService->remove($test);
            $test->delete();

            return back()->with('warning', 'Teste removido com sucesso.');
        } catch (Exception $exception){
            Log::channel('errors')->error('Ocorreu um erro: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro: ' . $exception->getMessage());
        }
    }
}
