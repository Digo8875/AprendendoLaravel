<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Produto_valor;
use App\Models\Vende_produto;

class VendaController extends Controller
{
    public function index()
    {
        $lista_vendas = Venda::get_venda(0);
        return view('venda.index',['lista_vendas' => $lista_vendas]);
    }
  
    public function create()
    {
    	$venda = new Venda;
        $lista_produtos = Produto::pluck('nome', 'id')->all();


        return view('venda.create_edit',['obj' => $venda, 'lista_produtos' => $lista_produtos]);
    }
  
    public function store(Request $request)
    {
        $obj_quant_recebe = Produto::get_quant_recebe_produto($request['produto_id']);
        $obj_quant_venda = Produto::get_quant_venda_produto($request['produto_id']);
        $quant_estoque = $obj_quant_recebe->quant_recebe - $obj_quant_venda->quant_venda;
        
        $this->validate($request, [
            'nome_cliente' => 'required|alpha',
            'produto_id' => 'required|numeric',
            'quantidade' => 'required|numeric|between:1,'.$quant_estoque
        ],[
            'nome_cliente.required' => 'Preencha o nome do cliente.',
            'nome_cliente.alpha' => 'O nome do cliente deve conter apenas letras.',
            'produto_id.required' => 'Selecione o produto.',
            'produto_id.numerio' => 'O id deve ser um número.',
            'quantidade.required' => 'Preencha a quantidade a ser vendida.',
            'quantidade.numeric' => 'A quantidade deve ser um número',
            'quantidade.between' => 'A quantidade deve haver em estoque: 1-'.$quant_estoque
        ]);

        $venda = new Venda;
        $venda->nome_cliente = $request['nome_cliente'];
        if($request['ativo'] == true)
        	$venda->ativo = 1;
        else
        	$venda->ativo = 0;

        $venda->save();
        $vend_id = $venda->id;

        $prod_val = Produto_valor::all()->where('produto_id', '=', $request['produto_id'])->sortByDesc('id')->first();

        $vende_produto = new Vende_produto;
        $vende_produto->quantidade = $request['quantidade'];
        $vende_produto->venda_id = $vend_id;
        $vende_produto->produto_valor_id = $prod_val->id;
        $vende_produto->save();

        return redirect()->route('venda.index');
    }
  
    public function show($id)
    {
        $venda = Venda::findOrFail($id);
        return view('venda.detalhes',['obj' => $venda]);
    }
  
    public function edit($id)
    {
        $venda = Venda::get_venda($id);
        $lista_produtos = Produto::pluck('nome', 'id')->all();

        return view('venda.create_edit',['obj' => $venda, 'lista_produtos' => $lista_produtos]);
    }
  
    public function update(Request $request, $id)
    {
        $obj_quant_recebe = Produto::get_quant_recebe_produto($request['produto_id']);
        $obj_quant_venda = Produto::get_quant_venda_produto($request['produto_id']);
        $quant_estoque = $obj_quant_recebe->quant_recebe - $obj_quant_venda->quant_venda;

        $this->validate($request, [
            'nome_cliente' => 'required|regex:/^[\pL\s\-]+$/u',
            'produto_id' => 'required|numeric',
            'quantidade' => 'required|numeric|between:1,'.$quant_estoque
        ],[
            'nome_cliente.required' => 'Preencha o nome do cliente.',
            'nome_cliente.regex' => 'O nome do cliente deve conter apenas letras.',
            'produto_id.required' => 'Selecione o produto.',
            'produto_id.numerio' => 'O id deve ser um número.',
            'quantidade.required' => 'Preencha a quantidade a ser vendida.',
            'quantidade.numeric' => 'A quantidade deve ser um número.',
            'quantidade.between' => 'A quantidade deve haver em estoque: 1-'.$quant_estoque
        ]);

        $venda = Venda::find($id);
        $venda->nome_cliente = $request['nome_cliente'];
        if($request['ativo'] == true)
        	$venda->ativo = 1;
        else
        	$venda->ativo = 0;

        $venda->save();
        $vend_id = $venda->id;
        $prod_val = Produto_valor::all()->where('produto_id', '=', $request['produto_id'])->sortByDesc('id')->first();

        //$vende_produto = Vende_produto::get_vende_produto_por_venda($vend_id);
        $vende_produto = Vende_produto::join('venda', 'venda.id', '=', 'vende_produto.venda_id')
                        ->select('vende_produto.*')
                        ->where('vende_produto.id', '=', $vend_id)
                        ->first();

        $vende_produto->quantidade = $request['quantidade'];
        $vende_produto->produto_valor_id = $prod_val->id;
        $vende_produto->save();

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
