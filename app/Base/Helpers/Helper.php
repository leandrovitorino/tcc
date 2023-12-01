<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

function getConfigValues(string $path): string
{
    if(!Schema::hasTable('configurations'))
        return '';

    $config = DB::table('configurations')->where('path', $path)->first();
    if ($config == null) {
        Log::channel('configurations')->info('Variável não encontrada: ' . $path);
        return '';
    }
    return $config->value;
}

function validateDocument($cpf): bool
{
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += (int) $cpf[$i] * (10 - $i);
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += (int) $cpf[$i] * (11 - $i);
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    if ($cpf[9] != $digito1 || $cpf[10] != $digito2) {
        return false;
    }

    return true;
}
