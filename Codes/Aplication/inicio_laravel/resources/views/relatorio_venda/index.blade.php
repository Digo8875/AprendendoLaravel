@extends('templates/geral_view')
  
@section('titulo')
Relatorio Vendas
@stop
  
@section('conteudo')
<html>
    <div class='col-lg-12'>
    	<div class='row'>
    		<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>Relatório de Vendas</h1>
    		</div>
    	</div>

		</br>
    	<div class='row'>
    		<div class='col-lg-4 rounded offset-lg-2' style='height: 400px;'>
    			<div id='grafico_quant_div'></div>
    		</div>
			<?= $Lava->render('PieChart', 'QuantVendas', 'grafico_quant_div') ?>

			<div class='col-lg-4 rounded' style='height: 400px;'>
    			<div id='grafico_valor_div'></div>
    		</div>
			<?= $Lava->render('PieChart', 'ValorVendas', 'grafico_valor_div') ?>
    	</div>

    	</br>
	</div>
</html>
@stop