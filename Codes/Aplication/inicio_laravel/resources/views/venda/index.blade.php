@extends('templates/geral_view')
  
@section('titulo')
Lista Vendas
@stop
  
@section('conteudo')
<html>
    <div class='col-lg-12'>
    	<div class='row'>
    		<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>Lista de Vendas</h1>
    		</div>
    		<div class='col-lg-2 titulo-tabela'>
    			<a class='btn btn-secondary' href='{{ url('/venda/create') }}'><span class='glyphicon glyphicon-plus'></span> Nova Venda</a>
    		</div>
    	</div>

    	<div class='row'>
	    	<table class='table table-striped rounded col-lg-12'>
			  <thead class='rounded'>
			    <tr>
			      <th>#</th>
			      <th>Id</th>
			      <th>Nome Ciente</th>
			      <th>Produto</th>
			      <th>Quantidade</th>
			      <th>Valor do Produto</th>
			      <th>Total da Venda</th>
			      <th>Data Registro</th>
			      <th>Ativo</th>
			      <th>Ações</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@if(count($lista_vendas) < 1)
			  		<tr>
						<td colspan='10'>{{ "Não há registros" }}</td>
					</tr>
			  	@else
				  	@for($i = 0; $i < count($lista_vendas); $i++)
						<tr>
							<td>{{ $i + 1 }}</td>
							<td>{{ $lista_vendas[$i]->id }}</td>
							<td>{{ $lista_vendas[$i]->nome_cliente }}</td>
							<td>{{ $lista_vendas[$i]->nome_produto }}</td>
							<td>{{ $lista_vendas[$i]->quantidade }}</td>
							<td>{{ $lista_vendas[$i]->valor }}</td>
							<td>{{ $lista_vendas[$i]->quantidade * $lista_vendas[$i]->valor }}</td>
							<td>{{ $lista_vendas[$i]->data_registro }}</td>
							<td>{{ (($lista_vendas[$i]->ativo == 1) ? 'Sim' : 'Não') }}</td>
							<td>
								<a href='{{ url('/venda/'.$lista_vendas[$i]->id.'/edit') }}' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  
								<a href='{{ url('/venda/'.$lista_vendas[$i]->id.'') }}' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  
								<a href='{{ url('/venda/'.$lista_vendas[$i]->id.'/desativar') }}' title='Apagar' id='deletar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>

								{{-- O DELETE Não SERÁ UTILIZADO, já que deve se manter dados no sistema. Para isso foi criado uma rota 'desativar', acima, para alterar o "ativo"
								{{ Form::open(['url' => 'venda/' . $lista_vendas[$i]['id'], 'class' => 'pull-right']) }}
									{{ Form::hidden('_method', 'DELETE') }}
									{{ Form::submit('Deletar', array('class' => 'btn btn-warning')) }}
								{{ Form::close() }}
								--}}
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