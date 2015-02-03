<?php
namespace Home\Controller;
use Think\Controller;
class BulletinController extends HomeController {
	public function index() {
		$this->display();
    }
	
	public function detailed(){
		$this->display();
	}
	
}
