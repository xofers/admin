var Fancybox = function () {
	var group = function(options){
		$("a[rel=group]").fancybox({'scrolling':'no'});
	}
    return {
    	group:function(options){
    		group(options);
    	},
		init:function(options){
			group(options);
        }
	};
}();