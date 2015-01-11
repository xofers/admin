<?php

namespace Addons\Fancybox;
use Common\Controller\Addon;

/**
 * Fancybox插件
 * @author 游川江
 */

    class FancyboxAddon extends Addon{

        public $info = array(
            'name'=>'Fancybox',
            'title'=>'Fancybox',
            'description'=>'可以加载DIV，图片、图片集、Ajax数据，还能加载SWF影片，iframe页面',
            'status'=>1,
            'author'=>'游川江',
            'version'=>'0.1'
        );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

        //实现的Fancybox钩子方法
        public function Fancybox($param){
			 $config = $this->getConfig();
			 $this->assign('addons_config', $config);
             if($config['display']){
                $this->display('widget');
             }
        }

    }