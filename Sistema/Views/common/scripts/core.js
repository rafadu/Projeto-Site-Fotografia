var core = null;

var Core = function(){
	
	this.IsAppleDevice = function(){
		return navigator.userAgent.match(/iPhone/i) ||
             navigator.userAgent.match(/iPad/i) ||
             navigator.userAgent.match(/iPod/i);
	}

	this.convertToJSON = function(obj){
        return $.parseJSON(obj);
    }

    this.ajaxRequisition = function(verb,address,parameters,successMethod){
        $.ajax({
            type: verb,
            url: address,
            data: parameters,
            success: successMethod,
            error: function(o){
                alert("deu erro");
                console.log(o);
            }
        });
    }
	
}

$(document).ready(function(){
	core = new Core();
});