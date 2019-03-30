@extends('templates/geral_view')
  
@section('titulo')
Relatorio Estoque
@stop
  
@section('conteudo')
<html>
    <div class='col-lg-12'>
    	<div class='row'>
    		<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>Estoque atual de Produtos</h1>
    		</div>
    	</div>

    	</br>
    	<div class='row'>
    		<div class='col-lg-4 rounded offset-lg-2'>
    			<div id='grafico_quant_div'></div>
    		</div>
			<?= $Lava->render('PieChart', 'QuantEstoque', 'grafico_quant_div') ?>

			<div class='col-lg-4 rounded'>
    			<div id='grafico_valor_div'></div>
    		</div>
			<?= $Lava->render('PieChart', 'ValorEstoque', 'grafico_valor_div') ?>
    	</div>

    	</br>
    	<div class='row'>
	    	<table class='table table-striped rounded col-lg-12'>
			  <thead class='rounded'>
			    <tr>
			      <th>#</th>
			      <th>Id</th>
			      <th>Nome</th>
			      <th>Valor atual</th>
			      <th>Quantidade em estoque</th>
			      <th>Valor em estoque</th>
			      <th>Quantidade Recebida</th>
			      <th>Quantidade Vendida</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@if(count($lista_produtos) < 1)
			  		<tr>
						<td colspan='8'>{{ "Não há registros" }}</td>
					</tr>
			  	@else
				  	@for($i = 0; $i < count($lista_produtos); $i++)
						<tr>
							<td>{{ $i + 1 }}</td>
							<td>{{ $lista_produtos[$i]->id }}</td>
							<td>{{ $lista_produtos[$i]->nome }}</td>
							<td>R$ {{ $lista_produtos[$i]->valor }}</td>
							<td>{{ $lista_produtos[$i]->quant_recebe -  $lista_produtos[$i]->quant_venda }}</td>
							<td>R$ {{ ($lista_produtos[$i]->quant_recebe -  $lista_produtos[$i]->quant_venda) * $lista_produtos[$i]->valor }}</td>
							<td>{{ $lista_produtos[$i]->quant_recebe }}</td>
							<td>{{ $lista_produtos[$i]->quant_venda }}</td>
							</td>
						</tr>
					@endfor
				@endif
			  </tbody>
			</table>
		</div>
	</div>
</html>
@stop