var Index  = function () {
	var loginhtml='';
	var page = {};
	var reghtml='';
	var page_reg = {};
    return {
        init: function () {
            //ajax get请求
		    $('.ajax-get').click(function(){
		    	var that = this;
		        if($(this).attr("ajax-confirm")){
		        	layer.confirm($(this).attr("ajax-confirm"),function(){
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
		        	layer.confirm($(this).attr("ajax-confirm"),function(){
		        		Index.ajaxPost(that);
		        	});
		        }else{
		        	Index.ajaxPost(that);
		        }
		        return false;
		    });
		    
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
		success:function(msg='操作成功！',options){
			options = $.extend(true, {
                type: 0,
                title: ' ',
                area: ['auto', 'auto'],
                border: [0],
                shift: 'top',
                zIndex: 999,
                time:3,
                dialog: {
				    type: 1,
				    btns: 0,
				    msg: msg
				}
            }, options);
            $.layer(options);
		},
		error:function(msg='操作失败！',options){
			options = $.extend(true, {
                type: 0,
                title: ' ',
                area: ['auto', 'auto'],
                border: [0],
                shift: 'top',
                time:3,
                zIndex: 999,
                dialog: {
				    type: 5,
				    btns: 0,
				    msg: msg
				}
            }, options);
            $.layer(options);
		},
		info:function(msg='提示！',options){
			options = $.extend(true, {
                type: 0,
                title: ' ',
                area: ['auto', 'auto'],
                border: [0],
                shift: 'top',
                zIndex: 999,
                time:3,
                dialog: {
				    type: 9,
				    btns: 0,
				    msg: msg
				}
            }, options);
            $.layer(options);
		},
		warning:function(msg='注意！',options){
			options = $.extend(true, {
                type: 0,
                title: ' ',
                area: ['auto', 'auto'],
                border: [0],
                shift: 'top',
                zIndex: 999,
                time:3,
                dialog: {
				    type: 8,
				    btns: 0,
				    msg: msg
				}
            }, options);
            $.layer(options);
		},
		tips:function(msg='',dom='',options){
			options = $.extend(true, {
			    time: 3,
			    isGuide:true,
			    guide : 2,
            }, options);
			layer.tips(msg,dom,options);
		},
		tipsx:function(msg='',dom='',options){
			options = $.extend(true, {
                style: ['background-color:#78BA32; color:#fff', '#78BA32'],
			    time: 3,
			    isGuide:true,
			    guide : 2,
			    closeBtn:[0, true]
            }, options);
			layer.tips(msg,dom,options);
		},
		validation:function(){
			
		},
		login:function(url='',options){
			layer.closeAll();
			if(loginhtml){
		        page.html = loginhtml;
		    } else {
		        page.url = url;
		        page.ok = function(datas){
		            loginhtml = datas; //保存登录节点
		            Index.validation();
		        }
		    }
		    options = $.extend(true, {
                type: 1,
		        title: '用户登录',
		        offset: [($(window).height() - 290)/2+'px', ''],
		        border : [5, 0.5, '#666'],
		        area: ['450px','290px'],
		        shadeClose: true,
		        page: page
            }, options);
		    $.layer(options);
		},
		register:function(url='',options){
			layer.closeAll();
			if(reghtml){
		        page_reg.html = reghtml;
		    } else {
		        page_reg.url = url;
		        page_reg.ok = function(datas){
		            reghtml = datas; //保存登录节点
		            Index.validation();
		        }
		    }
		    options = $.extend(true, {
                type: 1,
		        title: '用户注册',
		        offset: [($(window).height() - 290)/2+'px', ''],
		        border : [5, 0.5, '#666'],
		        area: ['450px','350px'],
		        shadeClose: true,
		        page: page_reg
            }, options);
		    $.layer(options);
		},
		ajaxGet:function(that){
	    	var target;
	    	var that = that;
	    	if ( (target = $(that).attr('href')) || (target = $(that).attr('url')) ) {
	            $.get(that).success(function(data){
                	if (data.status==1) {
                        if (data.url) {
		                    layer.msg(data.info, 2, function(){
							    location.href = data.url;
							});
                        }else if($(that).hasClass('no-refresh')){
                            return false;
                        }else{
                        	layer.msg(data.info, 2, function(){
							    location.reload();
							});
                        }
	                }else{
                        if (data.url) {
                        	layer.msg(data.info, 2, function(){
							    location.href = data.url;
							});
                        }
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
		                if (data.url) {
		                    layer.msg(data.info, 2, function(){
							    location.href = data.url;
							});
                        }else if( $(that).hasClass('no-refresh')){
                            return false;
                        }else{
                        	layer.msg(data.info, 2, function(){
							    location.reload();
							});
                        }
		            }else{
		            	if (data.url) {
                        	layer.msg(data.info, 2, function(){
							    location.href = data.url;
							});
                        }
		            }
		        });
	        }
	        return false;
		}
	};
}();