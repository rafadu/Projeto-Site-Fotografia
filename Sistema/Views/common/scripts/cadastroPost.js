var cadastroPost = null;

var CadastroPost = function(){
	var that = this;

	var _constructor = function(){
		var buttonAdd = $("#add");
		buttonAdd.bind("click",addField);
		if(core.getUrlVar("acao")==1)
			$("#status").hide();

		
	}

	var addField = function(){
		var id = $(".img").last().attr("name");
		id = id.replace("img_","");
		id *= 1;
		id +=1;
		$("#imagens").append("<input type='file' class='img' accept='image/*' name='img_"+ id +"' id='img_"+ id +"'/>");
	}

	_constructor();

}

$(document).ready(function(){
	cadastroPost = new CadastroPost();
});