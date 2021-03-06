(function(){
	
	//作用域定义
	var hidoger = typeof this.hidoger == 'function' ? this.hidoger : function(){};
	
	this.hidoger = hidoger;
	
	var x = hidoger;
	
	x.fileManager = (function(){
		
		var $layer, $frame, $title, 
		
			//所有类型
			types = {'Files' : 'Files', 'Images' : 'Images', 'Flash' : 'Flash'},
			
			typesSets = {},
			
			//默认类型
			defType = 'Files',
			
			//链接配置项
			url = {
				
				type : defType
				
			};
		
		typesSets.Files = {name : '文件', exp : /.+\.*/i, type : '*'};
		
		typesSets.Images = {name : '图片', exp : /.+\.gif|jpg|png|jpeg|bmp/i, type : 'gif,jpg,png,jpeg,bmp'};
		
		typesSets.Flash = {name : 'flash', exp : /.+\.swf/i, type : 'swf'};
		
		//初始化文件管理器
		function _init(){
			
			var str = '<div class="file-manager" style="width:850px;height:570px;">'
						
					+ '<div class="top"><h2 class="title">文件选择</h2><a class="close">×</a></div>'
					   
					+ '<ul class="tabs"><li class="tab">本地</li><li class="tab">网络</li></ul>'

					+ '<div class="files-area location-files"><iframe width="100%" height="500px" frameborder="0" scrolling="yes"></iframe></div>'
					   
					+ '<div class="files-area net-files"><p class="tips"></p><input class="url-text" type="text" /><a class="btn">确定</a></div>'
					
					+ '</div>';
			
			$layer = $(str).appendTo('body');

			if(x.DragBox) new x.DragBox({$box : $layer, $drag : $layer.find('div.top')});

			$frame = $layer.find('iframe');

			$title = $layer.find('h2.title');

			$layer.find('div.top a.close').click(function(){
			
				fm.hide();
			
			});
			
			$layer.find('ul.tabs > li.tab').each(function(i){
				
				var $this = $(this), cls = 'tab-checked',
				
					$area = i ? $layer.find('div.net-files') : $layer.find('div.location-files');
				
				$this.click(function(){
					
					if($this.hasClass(cls)) return;
					
					$this.parent().find('li.' + cls).removeClass(cls);
					
					$this.addClass(cls);
					
					$this.parents().find('div.files-area').hide();

					$area.show();
					
				});
				
			});
			

			$layer.find('div.net-files a.btn').click(function(){

				var val = $layer.find('div.net-files input.url-text').val();
				
				if(typesSets[url.type].exp.test(val)){
				
					fm.fileActive(val);

				}else alert('请填写正确的' + typesSets[url.type].name + '地址');

			});			
			
			_change();
			
		}

		//改变链接状态
		function _change(){
//			$frame.attr('src', 'frame.php?type=' + url.type);
			$frame.attr('src', hidoger.tpurl);
		}
		
		var fm = {

			//设置文件显示的类型
			setType : function(type){

				if(!types[type]) type = defType;
				
				url.type = type;

				if($frame) _change();

			},

			setTitle : function(str){
			
				if($title) $title.text(str);
			
			},

			//显示
			show : function(o){
				
				if(!$layer) _init();

				o = o || {};

				if(o.title) this.setTitle(o.title);

				this.setConfig(o);

				var left = (parseInt(screen.availWidth) - parseInt($layer.width())) / 2,
					
					top = (parseInt(screen.availHeight) - parseInt($layer.height())) / 2;
				
				$layer.find('li.tab:eq(0)').click();
				
				$layer.find('p.tips').text('请输入外部文件的URL地址(文件类型: ' + typesSets[url.type].type + ')');
				
				$layer.css({left : left + 'px', top : top + 'px'}).fadeIn('fast');

			},

			setConfig : function(o){
				
				if(o.type) this.setType(o.type);
				

				if(o.callback) this.callback = o.callback;
				
				if(o.additionalData) this.additionalData = o.additionalData;

				if(o.complete) this.selectActionFunction = o.complete;
				
			},

			//隐藏
			hide : function(){
				
				if($layer) $layer.fadeOut('fast');

			},
			
			//文件的回调
			fileActive : function(fileUrl, data, allFiles){

				if(this.callback instanceof Function) this.callback(fileUrl, data, allFiles);
				
			},

			//上传完成
			complete : function(file){
				
				 if(this.selectActionFunction instanceof Function) this.selectActionFunction(file);
			
			},

			//销毁
			destroy : function(){
				
				if($frame){
					
					$frame.remove();
				
					$layer.remove();
					
					$layer = null;
					
					$frame = null;

				}

			}

		};
		
		return fm;
		
	})();
	
})();