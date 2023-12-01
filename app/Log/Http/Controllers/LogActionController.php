<?php

namespace App\Log\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Base\Util\Filter\FiltersGetter;
use App\Log\Interfaces\LogActionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LogActionController extends Controller
{
    private LogActionRepositoryInterface $logActionRepository;

    public function __construct(LogActionRepositoryInterface $logActionRepository)
    {
        $this->logActionRepository = $logActionRepository;
    }

    public function index(Request $request): View
    {
        $filtersGetter = new FiltersGetter();
        $per_page = (int) $request->input('per_page') ?: 20;

        $filter = $filtersGetter->addFilters($request);
        $logs = $this->logActionRepository->search($per_page, $filter);

        $baseInfo = [
            'title' => 'Logs de Ações',
            'logs' => $logs,
            'filter' => $filter,
            'per_page' => $per_page
        ];

        return view('log.index', $baseInfo);
    }
}
