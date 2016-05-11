<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        parent::index();
    	$user = M('user');
        $this->assign('uploadhead',I('get.uploadhead')?I('get.uploadhead'):0);
    	$this->display();
    }
    public function myalbum(){
        parent::checkLogin();
        parent::index();
    	$user = M('user');
    	$this->display();
    }
    public function photos(){
        parent::index();
    	$user = M('user');
    	$this->display();
    }
    public function login(){
        if (I('post.email')&&I('post.password')) {
            $user = M('user');
            $map['email'] = I('post.email');
            $map['password'] = I('post.password');
            $data = $user->where($map)->find();
            if($data != null){
                session('user_id',$data['user_id']);
                session('name',$data['nickname']);
                $this->ajaxReturn(1);
            }else {
                $this->ajaxReturn(0);
            }
        }
    }
    public function login_out(){
        session(null);
        header("Location: index.html");
    }
    public function register(){
        $user = M('user');
        $map['email'] = I('post.email');
        $map['password'] = I('post.password');
        $map['nickname'] = I('post.nickname');
        $map['sex'] = I('post.sex');
        $map['power'] = 1;
        if($_FILES['headurl']['name']){
            $upload = new \Think\Upload();
            $upload->rootPath  =     '.';
            $upload->maxSize   =     2097152;
            $upload->exts      =     array('jpg', 'png', 'jpeg');
            $upload->savePath  =      '/Public/img/head/';
            $upload->saveName  =     'head'.time();
            $upload->replace   =     true;
            $upload->autoSub   =     false;
            $info   =   $upload->uploadOne($_FILES['headurl']);
            if(!$info) {
                header("Location: index.html?uploadhead=1");
                exit;
            }else{
                $map['headurl'] = $info['savepath'].$info['savename'];
            }
        }else {
            $map['headurl'] = "/Public/img/head/default.jpg";
        }

        $userResult = parent::checkExist('user','email',$map['email']);

        if($userResult){
            header("Location: index.html?uploadhead=3");
            exit;
        }

        $result = $user->add($map);
        if(!$result){
            header("Location: index.html?uploadhead=1");
            exit;
        }else {
            session('user_id',$userResult['user_id']);
            session('name',$map['nickname']);
            header("Location: index.html?uploadhead=2");
        }
        
    }
}