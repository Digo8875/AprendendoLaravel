var Main = {
	
	troca_usuario : function (){

		var data = {
			id_usuario_troca: $('#usuario_contexto_id').val(),
		};

		$.ajax({
                type: 'POST',
                dataType: 'html',
                url: Url.base_url + 'index.php/usuario_atual/troca_usuario',
                async: true,
                data: {data},
                success: function(data) {
                	location.reload();
                }
        }).fail(function(){
        	console.log(data);
			alert('Falha no ajax! troca_usuario()');
		});
	}
};
