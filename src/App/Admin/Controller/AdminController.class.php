<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends BeforeController {
    public function admin(){
        parent::checkLogin();
    	$this->display();
    }
    public function albumAdd(){
        parent::checkLogin();
    	$this->display();
    }
    public function albumUp(){
        parent::checkLogin();
        if(I('get.ac_id')){
            $this->assign('ac_info',$this->getAc(I('get.ac_id')));
        }
        $this->display();
    }
    public function picAdd(){
        parent::checkLogin();
        $this->assign('ac_info',$this->getAc());
        if(I('get.status')){
            $this->assign('status',I('get.status'));
        }
    	$this->display();
    }
    public function picUp(){
        parent::checkLogin();
        if(I('get.status')){
            $this->assign('status',I('get.status'));
        }
        if(I('get.img_id')){
            $this->assign('img_info',$this->getImg(I('get.img_id')));
        }
        $this->display();
    }
    public function userAdd(){
        parent::checkLogin();
        if(I('get.status')){
            $this->assign('status',I('get.status'));
        }
    	$this->display();
    }
    public function userUp(){
        parent::checkLogin();
        if(I('get.status')){
            $this->assign('status',I('get.status'));
        }
        if(I('get.user_id')){
            $this->assign('user_info',$this->getUser(I('get.user_id')));
        }
        // dump($this->getUser(I('get.user_id')));
        $this->display();
    }
    public function album(){
        parent::checkLogin();
        $this->assign('ac_info',$this->getAc());
    	$this->display();
    }
    public function pic(){
        parent::checkLogin();
        $this->assign('ac_info',$this->getAc());
    	$this->display();
    }
    public function user(){
        parent::checkLogin();
        $this->assign('user_info',$this->getUser());
    	$this->display();
    }
    //return ac selectr info
    protected function getAc($ac_id){
        $table = M('albumcategory');
        $map = array();
        if($ac_id!=''){
            $map['ac_id'] = $ac_id;
            return $table->where($map)->find();
        }
        if(session('?power')&&session('power')==1){
            $map['user_id'] = session('user_id');
        }
        return $table->where($map)->select();
    }
    //return ac selectr info
    protected function getImg($img_id){
        $table = M('img');
        $map = array();
        $map['img_id'] = $img_id;
        return $table->where($map)->find();
        
    }
    //return ac selectr info ajax
    public function getAcInfo(){
        $this->ajaxReturn($this->getAc());
    }
    //return img select info ajax
    public function getImgInfo(){
        $table = M('img');
        $map = array();
        if(I('get.ac_id')){
            $map['ac_id'] = I('get.ac_id');
            $img_info = $table->where($map)->select();
            $this->ajaxReturn($img_info);
        }else {
            $this->ajaxReturn(0);
        }
    }
    //return user select info
    protected function getUser($user_id){
        if(session('?power')&&session('power')==2){
            $table = M('user');
            if($user_id!=''){
                $map = array();
                $map['user_id'] = $user_id;
                return $table->where($map)->find();
            }
            return $table->select();
        }
    }

    public function addCtr(){
        parent::checkLogin();
        $table = '';
        $map = array();
        switch (I('post.type')) {
            case "add_ac":
                $table = M('albumcategory');
                $map['ac_name'] = I('post.ac_name');
                $map['ac_description'] = I('post.ac_description');
                $map['user_id'] = session('user_id');
                $map['ac_add_time'] = date('y-m-d h:i:s',time());
                $result = $table->add($map);
                if($result) {
                    $this->ajaxReturn(1);
                }else {
                    $this->ajaxReturn(0);
                }
                break;
            case "add_img":
                $table = M('img');
                $map['ac_id'] = I('post.ac_id');
                $map['img_name'] = I('post.img_name');
                $map['img_description'] = I('post.img_description');
                $map['img_add_time'] = date('y-m-d h:i:s',time());
                if($_FILES['imgurl']['name']){
                    $upload = new \Think\Upload();
                    $upload->rootPath  =     '.';
                    $upload->maxSize   =     20971520;
                    $upload->exts      =     array('jpg', 'png', 'jpeg');
                    $upload->savePath  =      '/Public/img/pic/';
                    $upload->saveName  =     'head'.time();
                    $upload->replace   =     true;
                    $upload->autoSub   =     false;
                    $info   =   $upload->uploadOne($_FILES['imgurl']);
                    if(!$info) {
                        header("Location: picAdd.html?status=1");
                        exit;
                    }else{
                        $map['img_url'] = $info['savepath'].$info['savename'];
                    }
                }
                $result = $table->add($map);
                if($result) {
                    header("Location: picAdd.html?status=2");
                }else {
                    header("Location: picAdd.html?status=1");
                }
                exit;
                break;
            case "add_user":
                $table = M('user');
                $map['email'] = I('post.email');
                $map['password'] = I('post.password');
                $map['nickname'] = I('post.nickname');
                $map['sex'] = I('post.sex');
                $map['power'] = I('post.power')?I('post.power'):1;
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
                        header("Location: userUp.html?status=1");
                        exit;
                    }else{
                        $map['headurl'] = $info['savepath'].$info['savename'];
                    }
                }
                $result = $table->add($map);
                if($result) {
                    header("Location: userAdd.html?status=2");
                }else {
                    header("Location: userAdd.html?status=1");
                }
                exit;
                break;
            default:
                # code...
                break;
        }
    }
    public function up(){
        parent::checkLogin();
        $table = '';
        $map = array();
        switch (I('post.type')) {
            case "up_ac":
                $table = M('albumcategory');
                $map['ac_name'] = I('post.ac_name');
                $map['ac_description'] = I('post.ac_description');
                $map['user_id'] = session('user_id');
                $map['ac_add_time'] = date('y-m-d h:i:s',time());
                $result = $table->save($map);
                if($result) {
                    $this->ajaxReturn(1);
                }else {
                    $this->ajaxReturn(0);
                }
                break;
            case "up_user":
                $table = M('user');
                $map['email'] = I('post.email');
                $map['password'] = I('post.password');
                $map['nickname'] = I('post.nickname');
                $map['sex'] = I('post.sex');
                $map['user_id'] = I('post.user_id');
                $map['power'] = I('post.power')?I('post.power'):1;
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
                        header("Location: userUp.html?status=1");
                        exit;
                    }else{
                        $map['headurl'] = $info['savepath'].$info['savename'];
                    }
                }
                $result = $table->save($map);
                if($result) {
                    header("Location: userUp.html?status=2");
                }else {
                    header("Location: userUp.html?status=1");
                }
                exit;
                break;
            case "up_img":
                $table = M('img');
                $map['img_id'] = I('post.img_id');
                $map['ac_id'] = I('post.ac_id');
                $map['img_name'] = I('post.img_name');
                $map['img_description'] = I('post.img_description');
                $map['img_main'] = I('post.img_main');
                $map['img_add_time'] = date('y-m-d h:i:s',time());
                if($_FILES['imgurl']['name']){
                    $upload = new \Think\Upload();
                    $upload->rootPath  =     '.';
                    $upload->maxSize   =     20971520;
                    $upload->exts      =     array('jpg', 'png', 'jpeg');
                    $upload->savePath  =      '/Public/img/pic/';
                    $upload->saveName  =     'head'.time();
                    $upload->replace   =     true;
                    $upload->autoSub   =     false;
                    $info   =   $upload->uploadOne($_FILES['imgurl']);
                    if(!$info) {
                        header("Location: picUp.html?status=1");
                        exit;
                    }else{
                        $map['img_url'] = $info['savepath'].$info['savename'];
                    }
                }
                $result = $table->save($map);
                if($result) {
                    header("Location: picUp.html?status=2");
                }else {
                    header("Location: picUp.html?status=1");
                }
                exit;
                break;
            default:
                # code...
                break;
        }
    }
    //get type id
    public function del(){
        parent::checkLogin();
        $table = '';
        $map = array();
        switch (I('get.type')) {
            case 'del_ac':
                $table = M('albumcategory');
                $map['ac_id'] = I('get.ac_id');
                break;
            case 'del_img':
                $table = M('img');
                $map['img_id'] = I('get.img_id');
                break;
            case 'del_user':
                $table = M('user');
                $map['user_id'] = I('get.user_id');
                break;
            default:
                # code...
                break;
        }
        $result = $table->where($map)->delete(); 
        if($result) {
            $this->ajaxReturn(1);
        }else {
            $this->ajaxReturn(0);
        }
    }
}