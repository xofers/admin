<?php
namespace Admin\Controller;
//use User\Api\UserApi as UserApi;

/**
 * 后台首页控制器
 * @author 游川江 <1518140867@qq.com>
 */
class IndexController extends AdminController {

    /**
     * 后台首页
     * @author 游川江 <1518140867@qq.com>
     */
    public function index(){
        $this->meta_title = '管理首页';
        $this->display();
    }

}
