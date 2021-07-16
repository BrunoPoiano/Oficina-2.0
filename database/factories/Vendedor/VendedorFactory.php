<?php

namespace Database\Factories\Vendedor;

use App\Models\Vendedor\Vendedor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendedor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
