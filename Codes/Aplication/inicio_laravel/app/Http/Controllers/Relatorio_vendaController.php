<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Venda;
use Khill\Lavacharts\Lavacharts;

class Relatorio_vendaController extends Controller
{
    public function index()
    {
        $lista_produtos = Produto::get_produto(0);
        $lista_quant_recebe = Produto::get_quant_recebe_produto(0);
        $lista_quant_venda = Produto::get_quant_venda_produto(0);
        $lista_vendas = Venda::get_venda(0);
        $valor_venda = 0;

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

        $grafico_quant_vendas = $lava->DataTable();
        $grafico_valor_vendas = $lava->DataTable();

        $grafico_quant_vendas->addStringColumn('Numero de produtos')
                            ->addNumberColumn('Porcentagem');

        $grafico_valor_vendas->addStringColumn('Valor em vendas')
                            ->addNumberColumn('Porcentagem');

        for($i=0; $i < count($lista_produtos); $i++)
        { 
        	$grafico_quant_vendas->addRow([$lista_produtos[$i]->nome, $lista_quant_venda[$i]->quant_venda]);

        	$valor_venda = 0;
        	for($j=0; $j < count($lista_vendas);  $j++)
        	{ 
        		if($lista_vendas[$j]->produto_id == $lista_produtos[$i]->id)
        		{
        			$valor_venda += $lista_vendas[$j]->quantidade * $lista_vendas[$j]->valor;
        		}
        	}

        	$grafico_valor_vendas->addRow([$lista_produtos[$i]->nome, $valor_venda]);
        }

        $lava->PieChart('QuantVendas', $grafico_quant_vendas, [
		    'title'  => 'Quantidade de produtos vendidos',
		    'is3D'   => true,
		    'slices' => [
		        ['offset' => 0.2],
		        ['offset' => 0.25],
		        ['offset' => 0.3]
		    ]
		]);

		$lava->PieChart('ValorVendas', $grafico_valor_vendas, [
		    'title'  => 'Valor das vendas por produto',
		    'is3D'   => true,
		    'slices' => [
		        ['offset' => 0.2],
		        ['offset' => 0.25],
		        ['offset' => 0.3]
		    ]
		]);

        return view('relatorio_venda.index',['lista_produtos' => $lista_produtos, 'Lava' => $lava]);
    }
  
}