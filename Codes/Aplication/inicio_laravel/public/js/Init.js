$(document).ready(
  //inicializa o html adicionando os envetos js especificados abaixo
  function() {
	
    $('#usuario_contexto_id').change(function(){
			event.preventDefault();
			
			Main.troca_usuario();
		});
	
  }
);