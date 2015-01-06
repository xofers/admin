var UINestable = function () {

    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target);
        if (window.JSON) {
			var obj_json =  eval(window.JSON.stringify(list.nestable('serialize')));
			var obj_length = obj_json.length;
			var sortVal = [];
			for(var i=0;i<obj_length;i++){
				sortVal.push(obj_json[i].mes);
			}
			$(".nestable-json").val(sortVal.join(','));
        } else {
        	Message.error({message:"您的浏览器不支持JSON操作!您将不能排序插件!"});
        }
    };
    return {
        init: function () {
            $('#nestable_list').nestable().on('change', updateOutput);
//          $('#nestable_list_menu').on('click', function (e) {
//              var target = $(e.target),
//                  action = target.data('action');
//              if (action === 'expand-all') {
//                  $('.dd').nestable('expandAll');
//              }
//              if (action === 'collapse-all') {
//                  $('.dd').nestable('collapseAll');
//              }
//          });
        }
    };
}();