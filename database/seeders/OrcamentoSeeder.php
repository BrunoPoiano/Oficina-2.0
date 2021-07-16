<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrcamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orcamentos')->insert([
            'cliente' => 'Lewis Carol',
            'vendedor_id' => 3,
            'valor' => 75,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('orcamentos')->insert([
            'cliente' => 'L. Frank Baum',
            'vendedor_id' => 1,
            'valor' => 40,
            'descricao' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('orcamentos')->insert([
            'cliente' => 'Antoine de Saint-Exupery',
            'vendedor_id' => 2,
            'valor' => 200,
            'descricao' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
