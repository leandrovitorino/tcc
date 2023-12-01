<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    public function run()
    {
        $configurations = [];

        DB::table('configurations')->insert($configurations);
    }
}
