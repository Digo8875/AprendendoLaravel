@extends('templates/geral_view')
  
@section('titulo')
Detalhes Produto
@stop
  
@section('conteudo')
<html>
	<div class='col-lg-12'>
		<div class='row'>
			<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>Detalhes do Produto</h1>
    		</div>
    		<div class='col-lg-1 titulo-tabela'>
    			<a href='javascript:window.history.go(-1)' class='btn btn-secondary' title='Voltar'>
					<span class='glyphicon glyphicon-arrow-left' style='font-size: 25px;'></span>
				</a>
    		</div>
		</div>

		<div class='row'>
			<table class='table table-striped rounded col-lg-12'>
				<thead class='rounded'>
				    <tr>
				      <th>Campo</th>
				      <th>Valor</th>
				  	</tr>
				</thead>
				<tbody>
					<tr>
						<td>Nome</td>
						<td>{{ $obj['nome'] }}</td>
					</tr>
					<tr>
						<td>Ativo</td>
						<td>{{ (($obj['ativo'] == 1) ? 'Sim' : 'Não') }}</td>
					</tr>
					<tr>
						<td>Data de registro</td>
						<td>{{ $obj['data_registro'] }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</html>
@stop