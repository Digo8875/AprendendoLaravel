<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Valor;
use App\Models\Produto_valor;

class ProdutoController extends Controller
{
    public function index()
    {
        $lista_produtos = Produto::get_produto(0);
        
        return view('produto.index',['lista_produtos' => $lista_produtos]);
    }
  
    public function create()
    {
    	$produto = new Produto;

        return view('produto.create_edit',['obj' => $produto]);
    }
  
    public function store(Request $request)
    {
        $produto = new Produto;
        $produto->nome = $request['nome'];
        if($request['ativo'] == true)
        	$produto->ativo = 1;
        else
        	$produto->ativo = 0;

        $produto->save();
        $prod_id = $produto->id;

        $val = new Valor;
        $val->valor = $request['valor'];
        $val->save();
        $val_id = $val->id;

        $prod_val = new Produto_valor;
        $prod_val->produto_id = $prod_id;
        $prod_val->valor_id = $val_id;
        $prod_val->save();

        return redirect()->route('produto.index');
    }
  
    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produto.detalhes',['obj' => $produto]);
    }
  
    public function edit($id)
    {
        $produto = Produto::get_produto($id);

        return view('produto.create_edit',['obj' => $produto]);
    }
  
    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->nome = $request['nome'];
        if($request['ativo'] == true)
        	$produto->ativo = 1;
        else
        	$produto->ativo = 0;

        $produto->save();
        $prod_id = $produto->id;

        $val_aux = Valor::get_valor_por_produto($prod_id);
        $valor_antigo = Valor::findOrFail($val_aux->id);
        $valor_antigo->ativo = 0;
        $valor_antigo->save();

        $val_novo = new Valor;
        $val_novo->valor = $request['valor'];
        $val_novo->save();
        $val_id = $val_novo->id;

        $prod_val = new Produto_valor;
        $prod_val->produto_id = $prod_id;
        $prod_val->valor_id = $val_id;
        $prod_val->save();

        return redirect()->route('produto.index');
    }
  
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('produto.index');
    }

    public function desativar($id){

        $produto = Produto::findOrFail($id);
        $produto->ativo = 0;

        $produto->save();
        return redirect()->route('produto.index');
    }
}
