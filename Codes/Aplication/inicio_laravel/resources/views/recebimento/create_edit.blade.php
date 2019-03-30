@extends('./templates/geral_view')
  
@section('titulo')
Criar/Editar Recebimento
@stop
  
@section('conteudo')
<html>
	<div class='col-lg-12'>
		<div class='row'>
			<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>
    			    {{((isset($obj->id)) ? 'Editar Recebimento' : 'Novo Recebimento')}}
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
				@if(!(isset($obj->id)))
				{{ Form::open(['url' => 'recebimento', 'method' => 'POST']) }}
				@else
				{{ Form::open(['url' => 'recebimento/'.$obj->id.'', 'method' => 'PATCH']) }}
				@endif

					{!! Form::token() !!}

					{{ Form::hidden('id', $obj->id) }}

				 	<div class='form-group col-lg-4' style='margin-top: 15px'>
					    {{ Form::label('nome_cliente', 'Nome do Cliente:') }}
						{{ Form::text('nome_cliente', $obj->nome_cliente, ['class' => 'form-control']) }}

						<div class='row col-lg-12'>
							@if($errors->has('nome_cliente'))
								<span class='alert alert-danger'>{{ $errors->first('nome_cliente') }}</span>
							@endif
						</div>
				  	</div>

				  	<div class='form-group col-lg-4' style='margin-top: 15px'>
					    {{ Form::label('produto', 'Selecione o Produto:') }}
						{{ Form::select('produto_id', $lista_produtos) }}

						<div class='row col-lg-12'>
							@if($errors->has('produto_id'))
								<span class='alert alert-danger'>{{ $errors->first('produto_id') }}</span>
							@endif
						</div>
				  	</div>

				  	<div class='form-group col-lg-4' style='margin-top: 15px'>
					    {{ Form::label('quantidade', 'Quantidade do Produto:') }}
						{{ Form::number('quantidade', $obj->quantidade, ['class' => 'form-control']) }}

						<div class='row col-lg-12'>
							@if($errors->has('quantidade'))
								<span class='alert alert-danger'>{{ $errors->first('quantidade') }}</span>
							@endif
						</div>
				  	</div>

				  	<div class="form-group col-lg-4">
				  		<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
							@php
								$checked = false;
								if($obj->ativo == 1 or !(isset($obj->id)))
									$checked = true;
							@endphp
							
							{{ Form::label('ativo', 'Recebimento Ativo') }}
							{{ Form::checkbox('ativo', Input::old('ativo'),  $checked) }}
						</div>
					</div>

					@if(!isset($obj->id))
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