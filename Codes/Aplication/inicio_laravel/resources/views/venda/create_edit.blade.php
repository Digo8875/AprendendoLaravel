@extends('./templates/geral_view')
  
@section('titulo')
Criar/Editar Venda
@stop
  
@section('conteudo')
<html>
	<div class='col-lg-12'>
		<div class='row'>
			<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>
    			    {{((isset($obj['id'])) ? 'Editar Venda' : 'Nova Venda')}}
    			</h1>
    		</div>
    		<div class='col-lg-1 titulo-tabela'>
    			<a href='javascript:window.history.go(-1)' class='btn btn-secondary' title='Voltar'>
					<span class='glyphicon glyphicon-arrow-left' style='font-size: 25px;'></span>
				</a>
    		</div>
		</div>
		<div class='row'>
			<div class='col-lg-12 rounded fundo-divs'>
				@if(!(isset($obj['id'])))
				{{ Form::open(['url' => 'venda', 'method' => 'POST']) }}
				@else
				{{ Form::open(['url' => 'venda/'.$obj['id'].'', 'method' => 'PATCH']) }}
				@endif

					{{ Form::hidden('id', $obj['id']) }}

				 	<div class='form-group col-lg-4' style='margin-top: 15px'>
					    {{ Form::label('nome_cliente', 'Nome do Cliente:') }}
						{{ Form::text('nome_cliente', $obj['nome_cliente'], ['class' => 'form-control']) }}
				  	</div>

				  	<div class="form-group col-lg-4">
				  		<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
							@php
								$checked = false;
								if($obj['ativo'] == 1 or !(isset($obj['id'])))
									$checked = true;
							@endphp
							
							{{ Form::label('ativo', 'Venda Ativa') }}
							{{ Form::checkbox('ativo', Input::old('ativo'),  $checked) }}
						</div>
					</div>

					@if(!isset($obj['id']))
						{!! Form::submit('Cadastrar', ['class' => 'btn btn-digo btn-block col-lg-2 offset-lg-1']) !!}
					@else
						{!! Form::submit('Atualizar', ['class' => 'btn btn-digo btn-block col-lg-2 offset-lg-1']) !!}
					@endif
				{{ Form::close() }}

			</div>
		</div>
	</div>
</html>
@stop