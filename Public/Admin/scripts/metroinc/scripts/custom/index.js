var Index = function () {
    return {
        init: function () {
            App.addResponsiveHandler(function () {
            	
            });
            
            //ajax get请求
		    $('.ajax-get').click(function(){
		    	var that = this;
		        if($(this).attr("ajax-confirm")){
		        	Dialog.confirm($(this).attr("ajax-confirm"),'',function(url){
				        Index.ajaxGet(that);
		        	});
		        }else{
		        	Index.ajaxGet(that);
		        }
		        return false;
		    });
		    
		    //ajax post submit请求
		    $('.ajax-post').click(function(){
		    	var that = this;
		    	if($(this).attr("ajax-confirm")){
		        	Dialog.confirm($(this).attr("ajax-confirm"),'',function(url){
				        Index.ajaxPost(that);
		        	});
		        }else{
		        	Index.ajaxPost(that);
		        }
		        return false;
		    });
		    
        },
		initNowTime: function () {
		    setInterval(function(){
		    	var d = new Date();
		    	$('#dashboard-report-range span').html(d.toLocaleFormat());
				$('#dashboard-report-range').show();
			},1000);
		},
		checkAll: function(dom,name){
		$('input[name="'+name+'"]').attr("checked",$(dom).is(":checked"));
		var $subBox = $('input[name="'+name+'"]');
			$subBox.click(function(){
			    $(dom).attr("checked",$subBox.length == $("input[name='"+name+"']:checked").length ? true : false);
			});
		},
		ajaxGet:function(that){
	    	var target;
	    	var that = that;
	    	if ( (target = $(that).attr('href')) || (target = $(that).attr('url')) ) {
	            $.get(that).success(function(data){
                	if (data.status==1) {
	                    Message.success({message:data.info});
	                    setTimeout(function(){
	                        if (data.url) {
	                        	Message.info({message:"页面正在跳转中......"});
	                            location.href=data.url;
	                        }else if( $(that).hasClass('no-refresh')){
	                            return false;
	                        }else{
	                        	Message.info({message:"页面正在跳转中......"});
	                            location.reload();
	                        }
	                    },1500);
	                }else{
	                    Message.error({message:data.info});
	                    setTimeout(function(){
	                        if (data.url) {
	                        	Message.info({message:"页面正在跳转中......"});
	                            location.href=data.url;
	                        }else{
	                        	return false;
	                        }
	                    },1500);
	                }
	            });
	        }
		},
		ajaxPost:function(that){
	    	var target,query,form;
	        var target_form = $(that).attr('target-form');
	        var that = that;
	        var nead_confirm=false;
	        if( ($(that).attr('type')=='submit') || (target = $(that).attr('href')) || (target = $(that).attr('url')) ){
		        form = $('.'+target_form);
		        console.log(form);
		        if ($(that).attr('hide-data') === 'true'){//无数据时也可以使用的功能
		        	form = $('.hide-data');
		        	query = form.serialize();
		        }else if (form.get(0)==undefined){
		        	return false;
		        }else if ( form.get(0).nodeName=='FORM' ){
		            if ( $(that).hasClass('confirm') ) {
		                if(!confirm('确认要执行该操作吗?')){
		                    return false;
		                }
		            }
		            if($(that).attr('url') !== undefined){
		            	target = $(that).attr('url');
		            }else{
		            	target = form.get(0).action;
		            }
		            query = form.serialize();
		        }else if( form.get(0).nodeName=='INPUT' || form.get(0).nodeName=='SELECT' || form.get(0).nodeName=='TEXTAREA') {
		            form.each(function(k,v){
		                if(v.type=='checkbox' && v.checked==true){
		                    nead_confirm = true;
		                }
		            })
		            if ( nead_confirm && $(that).hasClass('confirm') ) {
		                if(!confirm('确认要执行该操作吗?')){
		                    return false;
		                }
		            }
		            query = form.serialize();
		        }else{
		            if ( $(that).hasClass('confirm') ) {
		                if(!confirm('确认要执行该操作吗?')){
		                    return false;
		                }
		            }
		            query = form.find('input,select,textarea').serialize();
		        }
		        $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
		        $.post(target,query).success(function(data){
		            if (data.status==1) {
		                Message.success({message:data.info});
		                setTimeout(function(){
		                	$(that).removeClass('disabled').prop('disabled',false);
		                    if (data.url) {
		                    	Message.info({message:"页面正在跳转中......"});
		                        location.href=data.url;
		                    }else if( $(that).hasClass('no-refresh')){
		                        return false;
		                    }else{
		                    	Message.info({message:"页面正在跳转中......"});
		                        location.reload();
		                    }
		                },1500);
		            }else{
		            	Message.error({message:data.info});
		                setTimeout(function(){
		                	$(that).removeClass('disabled').prop('disabled',false);
		                    if (data.url) {
		                    	Message.info({message:"页面正在跳转中......"});
		                        location.href=data.url;
		                    }else{
		                        return false;
		                    }
		                },1500);
		            }
		        });
	        }
	        return false;
		}
	};
}();