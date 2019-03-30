<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Khill\Lavacharts\Lavacharts;

class Relatorio_estoqueController extends Controller
{
    public function index()
    {
        $lista_produtos = Produto::get_produto(0);
        $lista_quant_recebe = Produto::get_quant_recebe_produto(0);
        $lista_quant_venda = Produto::get_quant_venda_produto(0);

        for($i=0; $i < count($lista_produtos); $i++)
        { 
        	if(is_null($lista_quant_recebe[$i]->quant_recebe))
        	{
	            $lista_produtos[$i]->quant_recebe = 0;
	        }
	        else
            {
                $lista_produtos[$i]->quant_recebe = $lista_quant_recebe[$i]->quant_recebe;
            }

			if(is_null($lista_quant_venda[$i]->quant_venda))
	        {
	            $lista_produtos[$i]->quant_venda = 0;
	        }
	        else
        	{
            	$lista_produtos[$i]->quant_venda = $lista_quant_venda[$i]->quant_venda;
            }
        }

        $lava = new Lavacharts;

        $grafico_quant_estoque = $lava->DataTable();
        $grafico_valor_estoque = $lava->DataTable();

        $grafico_quant_estoque->addStringColumn('Numero de produtos')
                            ->addNumberColumn('Porcentagem');

        $grafico_valor_estoque->addStringColumn('Valor em estoque')
                            ->addNumberColumn('Porcentagem');

        for($i=0; $i < count($lista_produtos); $i++)
        { 
            $quant_estoque = $lista_quant_recebe[$i]->quant_recebe - $lista_quant_venda[$i]->quant_venda;

            $grafico_quant_estoque->addRow([$lista_produtos[$i]->nome, $quant_estoque]);

            $valor_estoque = $quant_estoque * $lista_produtos[$i]->valor;

            $grafico_valor_estoque->addRow([$lista_produtos[$i]->nome, $valor_estoque]);
        }

        $lava->PieChart('QuantEstoque', $grafico_quant_estoque, [
            'title'  => 'Quantidade de produtos em estoque',
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.25],
                ['offset' => 0.3]
            ],
        ]);

        $lava->PieChart('ValorEstoque', $grafico_valor_estoque, [
            'title'  => 'Valor em estoque por produto',
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.25],
                ['offset' => 0.3]
            ]
        ]);

        return view('relatorio_estoque.index',['lista_produtos' => $lista_produtos, 'Lava' => $lava]);
    }
  
}