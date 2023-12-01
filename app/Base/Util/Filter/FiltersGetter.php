<?php

namespace App\Base\Util\Filter;

use Illuminate\Http\Request;

class FiltersGetter
{
    public function addFilters(Request $request): array
    {
        $filter = [];

        foreach ($request->except(['_token', 'page']) as $key => $item){
            is_null($item) ?: $filter[$key] = $item;
        }

        return $filter;
    }

    public function pdfFilters(Request $request): array
    {
        $filter = [];

        foreach ($request->except(['_token', 'page']) as $key => $item){
            is_null($item) ?: $filter[$key] = $item;
        }

        return $filter['filters'] ?? [];
    }
}
