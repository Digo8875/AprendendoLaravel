<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;

class VendaController extends Controller
{
    public function index()
    {
        $lista_vendas = Venda::all();
        return view('venda.index',['lista_vendas' => $lista_vendas]);
    }
  
    public function create()
    {
    	$venda = new Venda;
        return view('venda.create_edit',['obj' => $venda]);
    }
  
    public function store(Request $request)
    {
        $venda = new Venda;
        $venda->nome_cliente = $request['nome_cliente'];
        if($request['ativo'] == true)
        	$venda->ativo = 1;
        else
        	$venda->ativo = 0;

        $venda->save();
        return redirect()->route('venda.index');
    }
  
    public function show($id)
    {
        $venda = Venda::findOrFail($id);
        return view('venda.detalhes',['obj' => $venda]);
    }
  
    public function edit($id)
    {
        $venda = Venda::findOrFail($id);
        return view('venda.create_edit',['obj' => $venda]);
    }
  
    public function update(Request $request, $id)
    {
        $venda = Venda::find($id);
        $venda->nome_cliente = $request['nome_cliente'];
        if($request['ativo'] == true)
        	$venda->ativo = 1;
        else
        	$venda->ativo = 0;

        $venda->save();
        return redirect()->route('venda.index');
    }
  
    public function destroy($id)
    {
        $venda = Venda::findOrFail($id);
        $venda->delete();

        return redirect()->route('venda.index');
    }

    public function desativar($id){

        $venda = Venda::findOrFail($id);
        $venda->ativo = 0;

        $venda->save();
        return redirect()->route('venda.index');
    }
}
