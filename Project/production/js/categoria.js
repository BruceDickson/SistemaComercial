$(function(){
	$.ajax({
		type:'get',		//Definimos o método HTTP usado
		dataType: 'json',	//Definimos o tipo de retorno
		url: 'http://localhost/ApiSC/public/categorias',//Definindo o arquivo onde serão buscados os dados
		success: function(data){
			for(i=0; i<data.length; i++){
				$('#categoria').append('<option value="'+data[i].id+'">'+data[i].nomeCategoria+'</option>');
			}
		}
	});


});




