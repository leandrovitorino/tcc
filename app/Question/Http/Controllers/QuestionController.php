<?php

namespace App\Question\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Util\Filter\FiltersGetter;
use App\Option\Interfaces\OptionRepositoryInterface;
use App\Option\Models\Option;
use App\Question\Interfaces\QuestionRepositoryInterface;
use App\Question\Models\Question;
use App\Topic\Interfaces\TopicRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class QuestionController extends Controller
{
    private QuestionRepositoryInterface $questionRepository;
    private TopicRepositoryInterface $topicRepository;
    private FiltersGetter $filtersGetter;
    private OptionRepositoryInterface $optionRepository;
    private string $_path;

    public function __construct
    (
        QuestionRepositoryInterface $questionRepository,
        TopicRepositoryInterface $topicRepository,
        FiltersGetter $filtersGetter,
        OptionRepositoryInterface $optionRepository
    )
    {
        $this->questionRepository = $questionRepository;
        $this->topicRepository = $topicRepository;
        $this->filtersGetter = $filtersGetter;
        $this->optionRepository = $optionRepository;

        $this->_path = public_path() . '/images/questions/';
    }

    public function index(Request $request): View
    {
        $filters = $this->filtersGetter->addFilters($request);

        $baseInfo = [
            'title' => 'Gerenciar Questões',
            'questions' => $this->questionRepository->getQuestionsOrderByTopicName(),
            'filters' => $filters
        ];

        return view('question.index', $baseInfo);
    }

    public function create(): View
    {
        $baseInfo = [
            'title' => 'Nova Questão',
            'topics' => $this->topicRepository->getTopicsOrderByName(),
            'route' => 'question.store',
            'question' => new Question(),
            'options' => []
        ];

        return view('question.create', $baseInfo);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->validate([
                'body' => 'required',
                'age' => 'required',
                'topic_id' => 'required'
            ]);

            $question = new Question($data);
            $question->save();

            if (isset($request->image)){
                $file_path = $this->_path . $question->id . '.png';
                file_put_contents($file_path, $request->image->getContent());

                $question->image = $file_path;
                $question->save();
            }

            foreach ($request->options as $key => $option){
                $new_option = new Option();
                $new_option->response = $option;
                $key != $request->correct ?: $new_option->correct = 1;
                $question->options()->save($new_option);
            }

            return redirect()->route('question.index')->with('success', 'Pergunta adicionada com sucesso.');
        } catch (Exception $exception){
            Log::channel('errors')->error('Ocorreu um erro: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro, entre em contato com o administrador');
        }
    }

    public function edit(Question $question): View
    {
        $baseInfo = [
            'title' => 'Editar a Questão',
            'topics' => $this->topicRepository->getTopicsOrderByName(),
            'route' => 'question.update',
            'question' => $question,
            'options' => $question->options
        ];

        return view('question.create', $baseInfo);
    }

    public function update(Request $request, Question $question): RedirectResponse
    {
        try {
            $data = $request->validate([
                'body' => 'required',
                'age' => 'required',
                'topic_id' => 'required'
            ]);
            $file_path = $this->_path . $question->id . '.png';

            if (isset($request->image)) {
                if ($question->images != NULL) {
                    unlink($file_path);
                }

                rename($file_path, $request->image);
                $data['image'] = $file_path;
            } else if ($request->remove_image) {
                unlink($file_path);
                $data['image'] = NULL;
            }

            $this->questionRepository->update($question->id, $data);

            foreach ($question->options as $option) {
                $resp = [
                    'response' => $request->options[$option->id],
                    'correct' => $option->id == $request->correct ? 1 : 0
                ];
                $this->optionRepository->update($option->id, $resp);
            }

            return back()->with('success', 'Questão atualizada com sucesso.');
        } catch (Exception $exception){
            Log::channel('errors')->error('Ocorreu um erro: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro: ' . $exception->getMessage());
        }
    }

    public function destroy(Question $question): RedirectResponse
    {
        try {
            foreach ($question->options as $option) {
                $option->delete();
            }
            $question->delete();

            return back()->with('warning', 'Questão removida com sucesso.');
        } catch (Exception $exception){
            Log::channel('errors')->error('Ocorreu um erro: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro: ' . $exception->getMessage());
        }
    }
}
