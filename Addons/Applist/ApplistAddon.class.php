<?php
namespace Addons\Applist;
use Think\Db;
use OT\Database;
use Common\Controller\Addon;

/**
 * 获取APK列表插件
 * @author 游川江
 */

    class ApplistAddon extends Addon{

        public $info = array(
            'name'=>'Applist',
            'title'=>'获取APK列表',
            'description'=>'统计安装成功的情况',
            'status'=>1,
            'author'=>'LOVE.YOU',
            'version'=>'0.1'
        );

        public function install(){
        	$db_prefix = C('DB_PREFIX');
            $table_name = "{$db_prefix}applist";
            $sql=<<<SQL
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `admin_applist`;
CREATE TABLE IF NOT EXISTS `{$table_name}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `apkid` int(11) NOT NULL,
  `pakurl` varchar(255) NOT NULL COMMENT '安装链接',
  `pname` varchar(100) NOT NULL COMMENT '安装名称',
  `sb_channel` varchar(100) NOT NULL COMMENT '渠道',
  `addTime` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `stopTime` int(11) NOT NULL,
  `localname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
SQL;
            D()->execute($sql);
            if(count(M()->query("SHOW TABLES LIKE '{$table_name}'")) != 1){
                session('addons_install_error', ',applist表未创建成功，请手动检查插件中的sql，修复后重新安装');
                return false;
            }
            return true;
        }

        public function uninstall(){
        	$db_prefix = C('DB_PREFIX');
			
			$path = C('DATA_BACKUP_PATH');
			echo F('Addons://Applist@config');
			return false;

            if(!is_dir($path)){
                mkdir($path, 0755, true);
            }
            //读取备份配置
            $config = array(
                'path'     => realpath($path) . DIRECTORY_SEPARATOR,
                'part'     => C('DATA_BACKUP_PART_SIZE'),
                'compress' => C('DATA_BACKUP_COMPRESS'),
                'level'    => C('DATA_BACKUP_COMPRESS_LEVEL'),
            );

            //检查是否有正在执行的任务
            $lock = "{$config['path']}backup.lock";
            if(is_file($lock)){
                $this->error('检测到有一个备份任务正在执行，请稍后再试！');
            } else {
                //创建锁文件
                file_put_contents($lock, NOW_TIME);
            }
			
            $sql = "DROP TABLE IF EXISTS `{$db_prefix}applist`;";
            D()->execute($sql);
            return true;
        }

        //实现的AdminIndex钩子方法
        public function AdminIndex($param){
			$config = $this->getConfig();
	        $this->assign('addons_config', $config);
	        if($config['display']){
	        	foreach($param as $key=>$val){
	        		if($val == ""){
	        			unset($param[$key]);
	        		}
	        	}
				$list       =   M("applist")->where($param)->order("sb_channel asc")->select();
		        $request    =   (array)I('request.');
		        $total      =   $list? count($list) : 1 ;
		        $listRows   =   C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
				$page       =   new \Think\Lpage($total,$listRows,$request);
		        $voList     =   array_slice($list, $page->firstRow, $page->listRows);
				$p 			=   $page->show();
		        $this->assign('_list', $voList);
		        $this->assign('_page', $p? $p: '');
	            $this->display('list');
	        }
        }
    }