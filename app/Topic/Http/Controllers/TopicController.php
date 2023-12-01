<?php

namespace App\Topic\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Topic\Interfaces\TopicRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TopicController extends Controller
{
    public function __construct
    (
        private TopicRepositoryInterface $topicRepository
    )
    {
    }

//    public function index(): View
//    {
//        $baseInfo = [
//            'title' => 'Gerenciar Tópicos',
//            'topics' => $this->topicRepository->getTopicsOrderBySubjectName()
//        ];
//
//        return view('topic.index', $baseInfo);
//    }

    public function destroy($topicId): RedirectResponse
    {
        try {
            $topic = $this->topicRepository->find((int) $topicId);

            if (count($this->topicRepository->getTopicsBySubjectId($topic->subject_id)) > 1) {
                $topic->delete();
                return back()->with('success', 'Tópico removido com sucesso');
            }else{
                return back()->withErrors('Não é possível remover o único tópico deste assunto');
            }

        } catch (Exception $exception){
            Log::channel('errors')->error('TopicController: ' . $exception->getMessage());
            return back()->withErrors('Ocorreu um erro: ' . $exception->getMessage());
        }
    }
}
