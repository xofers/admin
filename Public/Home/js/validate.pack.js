function checkForm(form){
	var isSubmit = true;
	$(form).find("input").each(function(){
		if(!validate($(this))){
			isSubmit = false;
		}
	});
	if(isSubmit){
		$.post($(form).attr("action"),$(form).serialize(),function(data){
			if(data.status){
				location.reload();
			}else{
				$(form).find(".tips").html(data.info).show();
			}
		},"json");
	}
	return false;
}

function logout(dom){
	$.get($(dom).attr("href"),function(data){
		if(data.status){
			location.reload();
		}else{
			alert(data.info);
		}
	},"json");
	return false;
}

function checkRegForm(form){
	var isSubmit = true;
	$(form).find("input").each(function(){
		if(!validate($(this))){
			isSubmit = false;
		}
	});
	if(isSubmit){
		$.post($(form).attr("action"),$(form).serialize(),function(data){
			if(data.status){
				location.reload();
			}else{
				$(form).find(".tips").html(data.info).show();
			}
		},"json");
	}
	return false;
}

function checkInput(dom){
	validate($(dom));
}

function validate(obj){
	var regtip = new RegExp(obj.attr("regtip"));
	var objValue = obj.attr("value");
	var tipObj = obj.nextAll("[look='easyTip']").eq(0);
	tipObj.removeClass();
	if(!regtip.test(objValue)){
		tipObj.addClass("onError");
		return false;
	}else{
		tipObj.addClass("onCorrect");
		return true;
	}
}
/*弹出*/
$(document).ready(function() {
	function showLogin(){
		$(".regID").hide();
		tipsWindown("","class:loginID","804","546","false","","true");
	}
	
	function showReg(){
		$(".loginID").hide();
		tipsWindown("","class:regID","804","546","false","","true")
	}

});
