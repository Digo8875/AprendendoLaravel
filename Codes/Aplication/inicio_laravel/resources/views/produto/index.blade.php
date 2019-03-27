@extends('templates/geral_view')
  
@section('titulo')
Lista Produtos
@stop
  
@section('conteudo')
<html>
    <div class='col-lg-12'>
    	<div class='row'>
    		<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>Lista de Produtos</h1>
    		</div>
    		<div class='col-lg-2 titulo-tabela'>
    			<a class='btn btn-secondary' href='{{ url('/produto/create') }}'><span class='glyphicon glyphicon-plus'></span> Novo Produto</a>
    		</div>
    	</div>

    	<div class='row'>
	    	<table class='table table-striped rounded col-lg-12'>
			  <thead class='rounded'>
			    <tr>
			      <th>#</th>
			      <th>Id</th>
			      <th>Nome</th>
			      <th>Valor</th>
			      <th>Data Registro</th>
			      <th>Ativo</th>
			      <th>Ações</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@if(count($lista_produtos) < 1)
			  		<tr>
						<td colspan='7'>{{ "Não há registros" }}</td>
					</tr>
			  	@else
				  	@for($i = 0; $i < count($lista_produtos); $i++)
						<tr>
							<td>{{ $i + 1 }}</td>
							<td>{{ $lista_produtos[$i]->id }}</td>
							<td>{{ $lista_produtos[$i]->nome }}</td>
							<td>{{ $lista_produtos[$i]->valor }}</td>
							<td>{{ $lista_produtos[$i]->data_registro }}</td>
							<td>{{ (($lista_produtos[$i]->ativo == 1) ? 'Sim' : 'Não') }}</td>
							<td>
								<a href='{{ url('/produto/'.$lista_produtos[$i]->id.'/edit') }}' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  
								<a href='{{ url('/produto/'.$lista_produtos[$i]->id.'') }}' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  
								<a href='{{ url('/produto/'.$lista_produtos[$i]->id.'/desativar') }}' title='Apagar' id='deletar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>

								{{-- O DELETE Não SERÁ UTILIZADO, já que deve se manter dados no sistema. Para isso foi criado uma rota 'desativar', acima, para alterar o "ativo"
								{{ Form::open(['url' => 'produto/' . $lista_produtos[$i]['id'], 'class' => 'pull-right']) }}
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