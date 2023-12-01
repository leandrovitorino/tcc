<?php

namespace App\Team\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Util\Filter\FiltersGetter;
use App\Team\Interfaces\TeamRepositoryInterface;
use App\Team\Models\Team;
use App\Test\Services\DeleteQuestionService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TeamController extends Controller
{
    private TeamRepositoryInterface $teamRepository;
    private FiltersGetter $filtersGetter;
    private DeleteQuestionService $deleteQuestionService;

    public function __construct
    (
        TeamRepositoryInterface $teamRepository,
        FiltersGetter $filtersGetter,
        DeleteQuestionService $deleteQuestionService
    )
    {
        $this->teamRepository = $teamRepository;
        $this->filtersGetter = $filtersGetter;
        $this->deleteQuestionService = $deleteQuestionService;
    }

    public function index(Request $request): View
    {
        $filters = $this->filtersGetter->addFilters($request);

        $baseInfo = [
            'title' => 'Turmas',
            'filters' => $filters,
            'teams' => $this->teamRepository->getTeams($filters)
        ];

        return view('team.index', $baseInfo);
    }

    public function create(): View
    {
        $baseInfo = [
            'title' => 'Nova Turma',
            'route' => 'team.store',
            'team' => new Team()
        ];

        return view('team.create', $baseInfo);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
                'code' => 'required',
                'shift' => 'required',
                'matter' => 'required'
            ]);

            $team = new Team($data);
            $team->save();

            return redirect()->route('team.index')->with('success', 'Turma adicionada com sucesso.');
        } catch (Exception $exception){
            Log::channel('errors')->error('Ocorreu um erro: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro, entre em contato com o administrador');
        }
    }

    public function edit(Team $team): View
    {
        $baseInfo = [
            'title' => 'Editar a Turma',
            'route' => 'team.update',
            'team' => $team
        ];

        return view('team.create', $baseInfo);
    }

    public function update(Request $request, Team $team): RedirectResponse
    {
        try {
            $data = $request->validate([
                'code' => 'required',
                'shift' => 'required',
                'matter' => 'required'
            ]);

            $this->teamRepository->update($team->id, $data);
            return back()->with('success', 'Turma atualizada com sucesso.');
        } catch (Exception $exception){
            Log::channel('errors')->error('Ocorreu um erro: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro: ' . $exception->getMessage());
        }
    }

    public function destroy(Team $team): RedirectResponse
    {
        try {
            foreach ($team->tests as $test){
                $this->deleteQuestionService->remove($test);
                $test->delete();
            }

            $team->delete();

            return back()->with('warning', 'Turma removida com sucesso.');
        } catch (Exception $exception){
            Log::channel('errors')->error('Ocorreu um erro: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro: ' . $exception->getMessage());
        }
    }
}
