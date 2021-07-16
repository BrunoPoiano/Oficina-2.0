<?php

namespace App\Http\Controllers\Orcamento;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orcamento\OrcamentoRequest;
use App\Http\Requests\Orcamento\PesquisarRequest;
use App\Models\Orcamento\Orcamento;
use App\Models\Vendedor\Vendedor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{

    public function index()
    {
        $orcamentos = Orcamento::join('vendedors', 'orcamentos.vendedor_id', 'vendedors.id')
            ->orderby('created_at', 'desc')->get(['orcamentos.*', 'vendedors.nome']);
        return $orcamentos;
    }

    public function create()
    {
        //
    }

    public function store(OrcamentoRequest $request)
    {
        if ($request) {

            $novoOrcamento = new Orcamento([
                'cliente' => $request->cliente,
                'vendedor_id' => $request->vendedor,
                "descricao" => $request->descricao,
                'valor' => $request->valor,
            ]);
            $novoOrcamento->save();
            return 'Salvo com Sucesso';
        }
        return 'Erro ao Receber Dados';
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(OrcamentoRequest $request, $id)
    {
        if ($request) {
            $editarOrcamento = Orcamento::find($id);
            $editarOrcamento->cliente = $request->cliente;
            $editarOrcamento->descricao = $request->descricao;
            $editarOrcamento->valor = $request->valor;
            $editarOrcamento->vendedor_id = $request->vendedor;
            $editarOrcamento->update();
            return 'Orcamento Atualizado com Sucesso';
        }
        return 'Erro ao Receber Dados';
    }

    public function destroy($id)
    {
        if ($id) {
            $delorcamento = Orcamento::find($id);
            if ($delorcamento) {
                $delorcamento->Delete();
                return 'Orçamento Deletado com Sucesso';
            }
            return 'Erro ao Encontrar Orçamento';
        }
        return 'Erro ao Receber Orçamento';
    }

    public function pesquisar(PesquisarRequest $request)
    {
        if ($request) {

            $request->validate([
                'vendedor' => 'numeric',
            ]);

            $dtini = new Carbon($request->datainicial . ' 00:00:00');
            $dtfim = new Carbon($request->datafinal . ' 23:59:59');
            $key = trim($request->get('cliente'));

            $orcamentos = Orcamento::join('vendedors', 'orcamentos.vendedor_id', 'vendedors.id')
                ->where('orcamentos.cliente', 'like', "%{$key}%")
                ->where('orcamentos.created_at', '>=', $dtini)
                ->where('orcamentos.created_at', '<=', $dtfim)
                ->orderby('orcamentos.created_at', 'Desc');

            if ($request->vendedor == 0) {
                return $orcamentos->get(['orcamentos.*', 'vendedors.nome']);
            }
            return $orcamentos->where('vendedors.id', $request->vendedor)
                ->get(['orcamentos.*', 'vendedors.nome']);

        }
        return 'Erro ao Receber Dados';
    }
}
