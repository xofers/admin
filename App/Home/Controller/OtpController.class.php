<?php
namespace Home\Controller;
use Think\Controller;
class OtpController extends Controller {
	public function index() {
		$return = array('result'=>-100);
		if(IS_POST){
			$token = I("token");
			if(!I("token")){
				//未传入Token;
				$return["result"] = -2;
			}else{
				$arr = array("0.0.0.1");
				if(in_array(get_client_ip(), $arr)){
					$return["result"] = -1;
				}else{
					if(cookie("?token") && session("token") != $token){
						$return["result"] = -2;
					}else{
						$return["result"] = 0;
						$return["data"] = M("Member")->field("uid as userid,nickname,sex")->where(array("uid"=>is_login()))->find();
					}
				}
			}
		}
		$return["message"] = $this->statusText($return['result']);
		$this->ajaxReturn($return);
    }
	private function statusText($status){
		$statusText = "";
		switch ($status) {
			case 0:
				$statusText = "合法";
				break;
			case -1:
				$statusText = "IP不合法";
				break;
			case -2:
				$statusText = "Token验证错误";
				break;
			case -100:
				$statusText = "接口不存在";
				break;
		}
		return  $statusText;
	}
}
