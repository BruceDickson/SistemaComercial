$(function(){	
	$.ajax({
		type:'get',		//Definimos o método HTTP usado
		dataType: 'json',	//Definimos o tipo de retorno
		url: 'http://localhost/ApiSC/public/lastproduto',//Definindo o arquivo onde serão buscados os dados
		success: function(data){							
			document.getElementById('cod').value = data[0].id;
		}
	});

	$('#btnCadastrar').click(function(){
		var Nproduto = $('#Nproduto').val();
		var Pcompra = $('#Pcompra').val();			
		var Pvenda = $('#Pvenda').val();		
		var categoria = $('#categoria').val();			

		if(Nproduto.length != 0){				
			$.ajax({
				url: 'http://localhost/ApiSC/public/produto',
				type: 'post',
				data: {
					nome: Nproduto,
					qtd: "0",
					precoVenda: Pvenda,
					precoCompra: Pcompra,
					CATEGORIA_id: categoria
				},
				success: function( data, textStatus, jQxhr ){
					alert(data);
				},
				error: function( jqXhr, textStatus, errorThrown ){
					console.log( errorThrown );
				}
			});
		}else{
			alert('O campo Nome Do Produto precisa ser preenchido');
			$('#Nproduto').focus();			
		}
	});
});