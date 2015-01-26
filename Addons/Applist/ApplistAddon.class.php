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
INSERT INTO `admin`.`admin_applist` (`id`, `apkid`, `pakurl`, `pname`, `sb_channel`, `addTime`, `status`, `stopTime`, `localname`) VALUES ('1', '50010101', 'http://dl.iwenyue.com/app/TianQi2345_sc-wenyue_wap_hj_3_2.apk', 'TianQi2345_sc-wenyue_wap_hj_3_2.apk', '001', '1420456032', '1', '1421981895', '2345天气');
INSERT INTO `admin`.`admin_applist` (`id`, `apkid`, `pakurl`, `pname`, `sb_channel`, `addTime`, `status`, `stopTime`, `localname`) VALUES ('2', '50010101', 'http://down.jizhufu.cn/UCBrowser_V10.1.0.527_android_pf145_bi800_(Build150107104243).apk', 'com.UCMobile', '001', '1421981852', '0', '0', '');
INSERT INTO `admin`.`admin_applist` (`id`, `apkid`, `pakurl`, `pname`, `sb_channel`, `addTime`, `status`, `stopTime`, `localname`) VALUES ('3', '50010102', 'http://down.jizhufu.cn/ninegame_v3.1.0_build_1412251844_release_1479039_104716bcb9d6.apk', 'cn.ninegame.gamemanager', '001', '1421981917', '0', '0', '');
INSERT INTO `admin`.`admin_applist` (`id`, `apkid`, `pakurl`, `pname`, `sb_channel`, `addTime`, `status`, `stopTime`, `localname`) VALUES ('4', '50010103', 'http://down.jizhufu.cn/BYDR3JJB_HWP_27_20150119_1.0.0.1.apk', 'com.you2game.fish.qy', '001', '1421981938', '0', '0', '');
INSERT INTO `admin`.`admin_applist` (`id`, `apkid`, `pakurl`, `pname`, `sb_channel`, `addTime`, `status`, `stopTime`, `localname`) VALUES ('5', '50010104', 'http://down.jizhufu.cn/QMJSDZKDB_HWP_14_20150112_1.0.0.2.apk', 'yy.gameqy.jslr', '001', '1421982004', '0', '0', '');
INSERT INTO `admin`.`admin_applist` (`id`, `apkid`, `pakurl`, `pname`, `sb_channel`, `addTime`, `status`, `stopTime`, `localname`) VALUES ('6', '50010105', 'http://down.jizhufu.cn/TTKPZXBWTK_HWP_803_20141126_3.0.0.3.apk', 'com.ttkp.bbd.wtk', '001', '1421982022', '0', '0', '');
INSERT INTO `admin`.`admin_applist` (`id`, `apkid`, `pakurl`, `pname`, `sb_channel`, `addTime`, `status`, `stopTime`, `localname`) VALUES ('8', '50010106', 'http://appcdn.ppcool.com.cn/video/appstore1/0115/tecool_common_f000001027.apk', 'com.sm.a39video', '001', '1422007780', '0', '0', '');
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