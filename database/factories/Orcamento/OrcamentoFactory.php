<?php

namespace Database\Factories\Orcamento;

use App\Models\Orcamento\Orcamento;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrcamentoFactory extends Factory
{
  
    protected $model = Orcamento::class;

  
    public function definition()
    {
        return [
            'cliente' => $this->faker->name(),
            'vendedor_id' => $this->faker->numberBetween(1,5),
            'valor' => $this->faker->numberBetween(50,200),
            'descricao' => $this->faker->text(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
