<?php

namespace Tests\Feature;

use App\Models\Orcamento\Orcamento;
use Tests\TestCase;

class OrcamentoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreOrcamento()
    {
        $data = [
            'cliente' => 'Machado de Assis',
            'vendedor' => 2,
            'valor' => 200,
            'descricao' => 'Compra de Livros',
        ];

        $this->post('orcamento', $data)
            ->assertStatus(200);
    }

    public function testDeleteOrcamento()
    {
        $orcamento = Orcamento::factory()->create();
        $this->delete('orcamento/' . $orcamento->id)
            ->assertStatus(200);
    }

    public function testUpdateOrcamento()
    {
        $orcamento = Orcamento::factory()->create();

        $data = [
            'cliente' => 'Cliente Update Teste',
            'vendedor' => 2,
            'valor' => 200,
            'descricao' => 'Descricao Update Teste',
        ];

        $this->put('orcamento/' . $orcamento->id, $data)
            ->assertStatus(200);
    }
}
