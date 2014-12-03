var Dialog = function () {
    return {
		alert:function(message,callback){
			message?message:message="确认删除嘛?";
            bootbox.alert(message,function(){
            	if(callback){
	            	callback();
            	}
            });
        },
        confirm:function(message,url,callback){
        	var results = '';
        	message?message:message="确认删除嘛?";
			bootbox.confirm(message,function(result){
			$(".bootbox,.modal-backdrop").remove();
				if(result){
					if(callback){
						callback(url);
					}else{
						if(url){
							window.location.href=url;
						}
					}
				}
				results = result;
			});
			return results;
		},
		prompt:function(message,url,callback){
			message?message:message="确认删除嘛?";
			bootbox.prompt(message, function(result) {
                if (result !== null) {
                	if(!url){
	                	callback(result,url);
                	}
                }
            });
            return false;
		},
		dialog:function(title,message,success,options){
			options = $.extend(true, {
//				success: {
//				    label: "成功",
//					className: "green",
//					callback: function(){
//						
//					}
//				}
            }, options);
			bootbox.dialog({
                message: message,
                title: title,
                buttons: options
            });
		}
	};
}();