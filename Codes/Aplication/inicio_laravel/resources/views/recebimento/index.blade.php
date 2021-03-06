@extends('templates/geral_view')
  
@section('titulo')
Lista Recebimentos
@stop
  
@section('conteudo')
<html>
    <div class='col-lg-12'>
    	<div class='row'>
    		<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>Lista de Recebimentos</h1>
    		</div>
    		<div class='col-lg-2 titulo-tabela'>
    			<a class='btn btn-secondary' href='{{ url('/recebimento/create') }}'><span class='glyphicon glyphicon-plus'></span> Novo Recebimento</a>
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
			      <th>Data Registro</th>
			      <th>Ativo</th>
			      <th>Ações</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@if(count($lista_recebimentos) < 1)
			  		<tr>
						<td colspan='8'>{{ "Não há registros" }}</td>
					</tr>
			  	@else
				  	@for($i = 0; $i < count($lista_recebimentos); $i++)
						<tr>
							<td>{{ $i + 1 }}</td>
							<td>{{ $lista_recebimentos[$i]->id }}</td>
							<td>{{ $lista_recebimentos[$i]->nome_cliente }}</td>
							<td>{{ $lista_recebimentos[$i]->nome_produto }}</td>
							<td>{{ $lista_recebimentos[$i]->quantidade }}</td>
							<td>{{ $lista_recebimentos[$i]->data_registro }}</td>
							<td>{{ (($lista_recebimentos[$i]->ativo == 1) ? 'Sim' : 'Não') }}</td>
							<td>
								<a href='{{ url('/recebimento/'.$lista_recebimentos[$i]->id.'/edit') }}' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  
								<a href='{{ url('/recebimento/'.$lista_recebimentos[$i]->id.'') }}' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  
								<a href='{{ url('/recebimento/'.$lista_recebimentos[$i]->id.'/desativar') }}' title='Apagar' id='deletar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>

								{{-- O DELETE Não SERÁ UTILIZADO, já que deve se manter dados no sistema. Para isso foi criado uma rota 'desativar', acima, para alterar o "ativo"
								{{ Form::open(['url' => 'recebimento/' . $lista_recebimentos[$i]['id'], 'class' => 'pull-right']) }}
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