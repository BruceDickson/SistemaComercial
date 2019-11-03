$(function(){
	$.ajax({
		type:'get',		//Definimos o método HTTP usado
		dataType: 'json',	//Definimos o tipo de retorno
		url: 'http://localhost/ApiSC/public/enderecos',//Definindo o arquivo onde serão buscados os dados
		success: function(data){
			console.log(data);
			for(i=0; i<data.length; i++){				
				$('#endereco').append('<option value="'+data[i].id+'">'+data[i].rua+'</option>');
			}
		}
	});

	$('#btnCadastrar').click(function(){
		var Nempresa = $('#Nempresa').val();
		var telefone = $('#telefone');val();			
		var endereco = $('#endereco').val();		
		var cnpj = $('#cnpj').val();	
		
		
		if(Nempresa != null || Nempresa != ""){				
			$.ajax({
				url: 'http://localhost/ApiSC/public/fornecedor',
				type: 'post',
				data: {
					nome: Nempresa,
					telefone: telefone,
					cnpj: cnpj,					
					ENDERECO_id: endereco
				},
				success: function( data, textStatus, jQxhr ){
					alert(data);
				},
				error: function( jqXhr, textStatus, errorThrown ){
					console.log( errorThrown );
				}
			});
		}else{
			alert('O campo Nome do Fornecedor precisa ser preenchido');
			$('#Nempresa').focus();				
		}
	});
});




