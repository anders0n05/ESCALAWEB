$(function () {
   
    $("#addevent").submit(function () {
        var data = $(this).serializeArray();

		$('#loader').removeAttr('style');
       
		$.ajax({
            url: "../../model/tarefa/ManterAgenda.php",
            method: "POST",
            dataType: 'JSON',
            data: data,
			success: function (retorno) {
                $('#loader').hide();                
				swal({
                    title: "Sucesso!",
                    text: "Seu evento foi criado com sucesso.",
                    icon: "success",
                    timer: 3000,
                    button: false
                }).then(function () {                    					
					location.reload();
                });
            },
            error: function (retorno) {
                $('#loader').hide();
                
				swal({
                    title: "Oopss!",
                    text: "Não foi possível cadastrar o seu evento: " + retorno.responseJSON.message,
                    icon: "error",
                    timer: 3000,
                    button: false
                });
            }			
        });
		
		return false;
    });
	
    $("#cancelar").click(function(){
		var handle = $("#handle").val();		
		var data = {"handle": handle, "cancelar":true};
		
		swal({
			buttons: true,
			buttons: ["Não", "Sim"],
			dangerMode: false,
			icon: "warning",
			text: "O evento da agenda será cancelado.",
			title: "Deseja cancelar o evento?"			
		}).then(function (permissao) {
			
			if (permissao) {            
				
				$('#loader').removeAttr('style');

				$.ajax({
					url: "../../model/tarefa/ManterAgenda.php",
					method: "POST",
					dataType: 'JSON',
					data: data,
					success: function (retorno) {
						$('#loader').hide();                
						swal({
							title: "Sucesso!",
							text: "Seu evento foi cancelado com sucesso.",
							icon: "success",
							timer: 3000,
							button: false
						}).then(function () {                    					
							location.reload();
						});
					},
					error: function (retorno) {
						$('#loader').hide();
						
						swal({
							title: "Oopss!",
							text: "Não foi possível cancelar o seu evento: " + retorno.responseJSON.message,
							icon: "error",
							timer: 3000,
							button: false
						});
					}			
				});
            
			}
		});	
    });	
	
	$("#editar").click(function(){
		$("#gravar").show();
		$("#editar").hide();
		$("#cancelar").hide();
		
		$('#adicionarEvento #assunto').prop("disabled", false);
		$('#adicionarEvento #tipo').prop("disabled", false);
		$('#adicionarEvento #tipo').show();
		$('#adicionarEvento #tipoDescricao').hide();
		$('#adicionarEvento #previsao').prop("disabled", false);
		$('#adicionarEvento #inicio').prop("disabled", false);
		$('#adicionarEvento #termino').prop("disabled", false);	
		$('#adicionarEvento #observacao').prop("disabled", false);		
	});
});