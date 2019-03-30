<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recebimento;
use App\Models\Produto;
use App\Models\Recebe_produto;

class RecebimentoController extends Controller
{
    public function index()
    {
        $lista_recebimentos = Recebimento::get_recebimento(0);
        return view('recebimento.index',['lista_recebimentos' => $lista_recebimentos]);
    }
  
    public function create()
    {
    	$recebimento = new Recebimento;
        $lista_produtos = Produto::pluck('nome', 'id')->all();

        return view('recebimento.create_edit',['obj' => $recebimento, 'lista_produtos' => $lista_produtos]);
    }
  
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome_cliente' => 'required|regex:/^[\pL\s\-]+$/u',
            'produto_id' => 'required|numeric',
            'quantidade' => 'required|numeric|min:1'
        ],[
            'nome_cliente.required' => 'Preencha o nome do cliente.',
            'nome_cliente.regex' => 'O nome do cliente deve conter apenas letras.',
            'produto_id.required' => 'Selecione o produto.',
            'produto_id.numerio' => 'O id deve ser um número.',
            'quantidade.required' => 'Preencha a quantidade a ser estocada.',
            'quantidade.numeric' => 'A quantidade deve ser um número.',
            'quantidade.min' => 'A quantidade deve ser maior do que zero.'
        ]);

        $recebimento = new Recebimento;
        $recebimento->nome_cliente = $request['nome_cliente'];
        if($request['ativo'] == true)
        	$recebimento->ativo = 1;
        else
        	$recebimento->ativo = 0;

        $recebimento->save();
        $rec_id = $recebimento->id;

        $recebe_produto = new Recebe_produto;
        $recebe_produto->quantidade = $request['quantidade'];
        $recebe_produto->recebimento_id = $rec_id;
        $recebe_produto->produto_id = $request['produto_id'];
        $recebe_produto->save();

        return redirect()->route('recebimento.index');
    }
  
    public function show($id)
    {
        $recebimento = Recebimento::findOrFail($id);
        return view('recebimento.detalhes',['obj' => $recebimento]);
    }
  
    public function edit($id)
    {
        $recebimento = Recebimento::get_recebimento($id);
        $lista_produtos = Produto::pluck('nome', 'id')->all();

        return view('recebimento.create_edit',['obj' => $recebimento, 'lista_produtos' => $lista_produtos]);
    }
  
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome_cliente' => 'required|regex:/^[\pL\s\-]+$/u',
            'produto_id' => 'required|numeric',
            'quantidade' => 'required|numeric|min:1'
        ],[
            'nome_cliente.required' => 'Preencha o nome do cliente.',
            'nome_cliente.regex' => 'O nome do cliente deve conter apenas letras.',
            'produto_id.required' => 'Selecione o produto.',
            'produto_id.numerio' => 'O id deve ser um número.',
            'quantidade.required' => 'Preencha a quantidade a ser estocada.',
            'quantidade.numeric' => 'A quantidade deve ser um número.',
            'quantidade.min' => 'A quantidade deve ser maior do que zero.'
        ]);

        $recebimento = Recebimento::find($id);
        $recebimento->nome_cliente = $request['nome_cliente'];
        if($request['ativo'] == true)
        	$recebimento->ativo = 1;
        else
        	$recebimento->ativo = 0;

        $recebimento->save();
        return redirect()->route('recebimento.index');
    }
  
    public function destroy($id)
    {
        $recebimento = Recebimento::findOrFail($id);
        $recebimento->delete();

        return redirect()->route('recebimento.index');
    }

    public function desativar($id){

        $recebimento = Recebimento::findOrFail($id);
        $recebimento->ativo = 0;

        $recebimento->save();
        return redirect()->route('recebimento.index');
    }
}
