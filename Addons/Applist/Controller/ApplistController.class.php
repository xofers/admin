<?php

namespace Addons\Applist\Controller;
use Home\Controller\AddonsController;

class ApplistController extends AddonsController{

	//获取安装成功列表
	public function getList(){
		
	}
	//添加
	public function add(){
		$url  = "http://115.29.175.83/cd/op.php?channel=5";
		$url .= "&sb_channel=".I("sb_channel");
		$url .= "&pakurl=".I("pakurl");
		$url .= "&pname=".I("pname");
		$url .= "&actMethod=add";
		$urlData   = file_get_contents($url);
		$getData   = json_decode($urlData,true);
		
		$data      = M("applist")->field("apkid,pakurl,pname")->where(array("sb_channel"=>I("sb_channel")))->select();
		
		$lists     = array();
		
		foreach($getData as $key=>$val){
			if(!in_array($val, $data)){
				$val["sb_channel"] = I("sb_channel");
				$val["addTime"] = time();
				$val["localname"] = I("localname");
				$lists[] = $val;
			}
		}
		
		if(M("applist")->addAll($lists)){
			$this->success('添加成功');
		}else{
			$this->error('添加失败');
		}
	}
	//删除
	public function del(){
		$url  = "http://115.29.175.83/cd/op.php?channel=5";
		$url .= "&sb_channel=".I("sb_channel");
		$url .= "&pakurl=".I("pakurl");
		$url .= "&pname=".I("pname");
		$url .= "&actMethod=del";
		$urlData   = file_get_contents($url);
		$getData   = json_decode($urlData,true);
		
		$data      = M("applist")->field("apkid,pakurl,pname")->where(array("sb_channel"=>I("sb_channel")))->select();
		
		$lists     = array();
		
		foreach($data as $key=>$val){
			if(!in_array($val, $getData)){
				$lists[] = $val;
			}
		}
		
		foreach($lists as $key=>$val){
			if($val['status'] == 0){
				M("applist")->where($val)->save(array("status"=>1,"stopTime"=>time()));
			}
		}
		
		$this->success('操作成功');
	}
	public function turn_on(){
		$urlData   = file_get_contents("http://115.29.175.83/cd/op_time.php?actControl=true");
		$getData   = json_decode($urlData,true);
		
		$config    = get_addon_config("Applist");
		$config["actControl"] = 1;
        $flag = M('Addons')->where(array("name"=>"Applist"))->setField('config',json_encode($config));
        if($flag !== false){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
	}
	public function turn_off(){
		$urlData   = file_get_contents("http://115.29.175.83/cd/op_time.php?actControl=false");
		$getData   = json_decode($urlData,true);
		
		$config    = get_addon_config("Applist");
		$config["actControl"] = 0;
        $flag = M('Addons')->where(array("name"=>"Applist"))->setField('config',json_encode($config));
        if($flag !== false){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
	}
}
