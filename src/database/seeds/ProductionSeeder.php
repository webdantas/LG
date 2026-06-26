<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionSeeder extends Seeder
{
    public function run()
    {
        DB::table('productions')->truncate();

        $baseProduction = [

            'Geladeira' => 1050,

            'Máquina de Lavar' => 980,

            'TV' => 1120,

            'Ar-Condicionado' => 930,

        ];

        for ($day = 1; $day <= 31; $day++) {

            foreach ($baseProduction as $line => $base) {

                $produced = $base + ($day * 3);

                switch ($line) {

                    case 'Geladeira':

                        $defects = 8 + ($day % 4);

                        break;

                    case 'Máquina de Lavar':

                        $defects = 10 + ($day % 5);

                        break;

                    case 'TV':

                        $defects = 6 + ($day % 3);

                        break;

                    default:

                        $defects = 12 + ($day % 4);

                        break;

                }

                DB::table('productions')->insert([

                    'production_date' => sprintf(
                        '2026-01-%02d',
                        $day
                    ),

                    'product_line' => $line,

                    'produced_quantity' => $produced,

                    'defect_quantity' => $defects,

                    'created_at' => now(),

                    'updated_at' => now(),

                ]);

            }

        }

    }
}