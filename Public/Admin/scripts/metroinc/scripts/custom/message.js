var Message = function () {
    return {
        alert:function(options){
        	options = $.extend(true, {
                container: '', // 父级容器(".xx"或者"#xx"形式)
                place: '', // 在何处加载(append或prepend)
                type: '', //弹出框类型(css样式决定)
                message: "",  // 弹出框信息
                close: 1, // 显示关闭按钮
                reset: 1, // 关闭其他的弹出框
                focus: 1, // 显示时是否设为焦点
                closeInSeconds: 1, // 多少秒后自动关闭
                icon: "", // 图标
                width: $(".breadcrumb").parent().width(),//宽度
                height: "auto",//高度
                position: "fixed",//定位方式
                zindex: "999"//层级
            }, options);
        	App.alert(options);
        },
        success:function(options){
        	options = $.extend(true, {
                type: 'success',
                message: "",
                icon: "check-circle",
            }, options);
        	this.alert(options);
        },
        error:function(options){
        	options = $.extend(true, {
                type: 'danger',  
                message: "", 
                icon: "times-circle",
            }, options);
        	this.alert(options);
        },
        info:function(options){
        	options = $.extend(true, {
                type: 'info',  
                message: "", 
                icon: "info-circle",
            }, options);
        	this.alert(options);
        },
        warning:function(options){
        	options = $.extend(true, {
                type: 'warning',  
                message: "", 
                icon: "times-circle",
            }, options);
        	this.alert(options);
        }
	};
}();