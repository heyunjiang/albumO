<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        parent::index();
    	$user = M('user');
        $this->assign('uploadhead',I('get.uploadhead')?I('get.uploadhead'):0);
        $this->assign('ac_info',$this->getAcInfo());
    	$this->display();
    }
    public function myalbum(){
        parent::checkLogin();
        parent::index();
    	$user = M('user');
        $this->assign('ac_info',$this->getAcInfo(session('user_id')));
    	$this->display();
    }
    public function photos(){
        parent::index();
    	$user = M('user');
        if(!I('get.ac_id')) {
            header("Location: index.html");
            exit;
        }
        $this->assign('img_info',$this->getImgInfo(I('get.ac_id')));
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
                session('power',$data['power']);
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
            session('user_id',$result);
            session('name',$map['nickname']);
            session('power',$map['power']);
            header("Location: index.html?uploadhead=2");
        }
        
    }
    //return albumcategory infomation array
    protected function getAcInfo($user_id){
        $table = M('albumcategory');
        if($user_id != ''){
            $map['albumcategory.user_id'] = $user_id;
        }
        $map['img.img_main'] = '1';
        $ac_info = $table->join('img ON albumcategory.ac_id = img.ac_id')
                         ->join('user ON albumcategory.user_id = user.user_id')
                         ->where($map)
                         ->order('albumcategory.ac_add_time desc')
                         ->select();
        return $ac_info;
    }
    //return img information array
    protected function getImgInfo($ac_id){
        $table = M('img');
        $map = array();
        if($ac_id){
            $map['ac_id'] = $ac_id;
            return $table->where($map)->select();
        }else {
            return $map;
        }
    }
    //return one pic information for ajax
    public function getPicInfor(){
        if(I('get.img_id')){
            $table = M('img');
            $map = array();
            $map['img_id'] = I('get.img_id');
            $pic_info = $table->join('albumcategory ON albumcategory.ac_id = img.ac_id')
                         ->join('user ON albumcategory.user_id = user.user_id')
                         ->where($map)
                         ->select();
            $this->ajaxReturn($pic_info);
        }else {
            eader("Location: index.html");
            exit;
        }
    }
    //return message information for one pic ajax
    public function getMsgInfor(){
        if(I('get.img_id')){
            $table = M('message');
            $map = array();
            $map['img_id'] = I('get.img_id');
            $msg_info = $table->join('user ON message.user_id = user.user_id')
                         ->where($map)
                         ->select();
            $this->ajaxReturn($msg_info);
        }else {
            eader("Location: index.html");
            exit;
        }
    }
    //commit message for ajax
    public function addMsg(){
        if(I('post.img_id')&&I('post.m_content')){
            $table = M('message');
            $data['user_id'] = session('user_id');
            $data['img_id'] = I('post.img_id');
            $data['m_content'] = I('post.m_content');
            $result = $table->add($data);
            if($result) {
                $user = M('user');
                $map['user_id'] = session('user_id');
                $return_info = $user->where($map)->find();
                $this->ajaxReturn($return_info);
            }else{
                $this->ajaxReturn(0);
            }
        }else {
            $this->ajaxReturn(0);
        }
    }
    //commit click for ajax
    public function addClick(){
        if(I('post.img_id')){
            $table = M('img');
            $map['img_id'] = I('post.img_id');
            $result = $table->where($map)->setInc('img_click',1);
            if($result) {
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(0);
            }
        }else {
            $this->ajaxReturn(0);
        }
    }
}