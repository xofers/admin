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
		    
		    setInterval(function(){
		    	var dayNames = new Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
		    	$("#dashboard-report-range span").html(Index.dateformate(new Date(),"yyyy-MM-dd hh:mm:ss")+"&nbsp;"+dayNames[new Date().getDay()]);
		    },1000)
		    
        },
//      /* 设置表单的值 */
		setValue:function(name, value){
			var first = name.substr(0,1), input, i = 0, val;
			if(value === "") return;
			if("#" === first || "." === first){
				input = $(name);
			} else {
				input = $("[name='" + name + "']");
			}
	
			if(input.eq(0).is(":radio")) { //单选按钮
				input.filter("[value='" + value + "']").each(function(){this.checked = true});
			} else if(input.eq(0).is(":checkbox")) { //复选框
				if(!$.isArray(value)){
					val = new Array();
					val[0] = value;
				} else {
					val = value;
				}
				for(i = 0, len = val.length; i < len; i++){
					input.filter("[value='" + val[i] + "']").each(function(){this.checked = true});
				}
			} else {  //其他表单选项直接设置值
				input.val(value);
			}
		},
        dateformate:function(x,y) {
			var z = {M:x.getMonth()+1,d:x.getDate(),h:x.getHours(),m:x.getMinutes(),s:x.getSeconds()};
			y = y.replace(/(M+|d+|h+|m+|s+)/g,function(v) {return ((v.length>1?"0":"")+eval('z.'+v.slice(-1))).slice(-2)});
			return y.replace(/(y+)/g,function(v) {return x.getFullYear().toString().slice(-v.length)});
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
	            return false;
	        }
		},
		ajaxPost:function(that){
	    	var target,query,form;
	        var target_form = $(that).attr('target-form');
	        var that = that;
	        var nead_confirm=false;
	        if( ($(that).attr('type')=='submit') || (target = $(that).attr('href')) || (target = $(that).attr('url')) ){
		        form = $('.'+target_form);
		        if ($(that).attr('hide-data') === 'true'){//无数据时也可以使用的功能
		        	form = $('.hide-data');
		        	query = form.serialize();
		        }else if (form.get(0)==undefined){
		        	return false;
		        }else if ( form.get(0).nodeName=='FORM' ){
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
		            query = form.serialize();
		        }else{
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