<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendedor\VendedorRequest;
use App\Models\Vendedor\Vendedor;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    
    public function index()
    {
        return Vendedor::orderby('created_at','desc')->get();
    }


    public function create()
    {
        //
    }


    public function store(VendedorRequest $request)
    {
        if($request){
            
            $novoVendedor = new Vendedor([
                'nome'=> $request->vendedor,
            ]);
            $novoVendedor->save();
            return 'Vendedor Salvo com Sucesso';
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
