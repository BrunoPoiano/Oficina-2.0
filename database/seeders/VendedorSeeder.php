<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendedors')->insert([
            'nome' =>'Bruno'
        ]);
        DB::table('vendedors')->insert([
            'nome' =>'Stephen King'
        ]);
        DB::table('vendedors')->insert([
            'nome' =>'George R. R. Martin'
        ]);
        DB::table('vendedors')->insert([
            'nome' =>'J. R. R. Tolkin'
        ]);
        DB::table('vendedors')->insert([
            'nome' =>'Bram Stoker'
        ]);

    }
}
