<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends BeforeController {
    //后台首页
    public function admin(){
        parent::checkLogin();
        $this->assign('userhead',$this->getUser(session('user_id')));
    	$this->display();
    }
    //添加相册页面
    public function albumAdd(){
        parent::checkLogin();
        $this->assign('userhead',$this->getUser(session('user_id')));
    	$this->display();
    }
    //更新相册页面
    public function albumUp(){
        parent::checkLogin();
        $this->assign('userhead',$this->getUser(session('user_id')));
        if(I('get.ac_id')){
            $this->assign('ac_info',$this->getAc(I('get.ac_id')));
        }
        $this->display();
    }
    //添加图片页面
    public function picAdd(){
        parent::checkLogin();
        $this->assign('userhead',$this->getUser(session('user_id')));
        $this->assign('ac_info',$this->getAc());
        if(I('get.status')){
            $this->assign('status',I('get.status'));
        }
    	$this->display();
    }
    //更新图片页面
    public function picUp(){
        parent::checkLogin();
        $this->assign('userhead',$this->getUser(session('user_id')));
        if(I('get.status')){
            $this->assign('status',I('get.status'));
        }
        if(I('get.img_id')){
            $img_info = $this->getImg(I('get.img_id'));
            $this->assign('ac_info',$this->getAc($img_info['ac_id']));
            $this->assign('img_info',$img_info);
        }
        $this->display();
    }
    //添加用户页面
    public function userAdd(){
        parent::checkLogin();
        $this->assign('userhead',$this->getUser(session('user_id')));
        if(I('get.status')){
            $this->assign('status',I('get.status'));
        }
    	$this->display();
    }
    //更新用户页面
    public function userUp(){
        parent::checkLogin();
        $this->assign('userhead',$this->getUser(session('user_id')));
        if(I('get.status')){
            $this->assign('status',I('get.status'));
        }
        if(I('get.user_id')){
            $this->assign('user_info',$this->getUser(I('get.user_id')));
        }
        $this->display();
    }
    //相册浏览页面
    public function album(){
        parent::checkLogin();
        $this->assign('userhead',$this->getUser(session('user_id')));
        $this->assign('ac_info',$this->getAc());
    	$this->display();
    }
    //图片浏览页面
    public function pic(){
        parent::checkLogin();
        $this->assign('userhead',$this->getUser(session('user_id')));
        $this->assign('ac_info',$this->getAc());
    	$this->display();
    }
    //用户信息浏览页面
    public function user(){
        parent::checkLogin();
        $this->assign('userhead',$this->getUser(session('user_id')));
        $this->assign('user_info',$this->getUser());
    	$this->display();
    }
    //返回相册信息
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
    //返回图片信息
    protected function getImg($img_id){
        $table = M('img');
        $map = array();
        $map['img_id'] = $img_id;
        return $table->where($map)->find();
        
    }
    //返回相册信息 ajax方法调用
    public function getAcInfo(){
        $this->ajaxReturn($this->getAc());
    }
    //发挥图片信息 ajax方法调用
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
    //返回用户信息
    protected function getUser($user_id){
        $table = M('user');
        if($user_id!=''){
            $map = array();
            $map['user_id'] = $user_id;
            return $table->where($map)->find();
        }
        if(session('?power')&&session('power')==2){
            return $table->select();
        }else{
            $map['user_id'] = session('user_id');
            return $table->where($map)->select();
        }
    }

    //设置相册封面 ajax方法调用
    public function pic_main(){
        if(I('get.ac_id')&&I('get.img_id')) {
            $table = M('img');
            $map_to_find['ac_id'] = I('get.ac_id');
            $map_to_find['img_main'] = '1';
            $result = $table->where($map_to_find)->find();
            if($result){
                $map_to_zero['img_id'] = $result['img_id'];
                $result1 = $table->where($map_to_zero)->setField('img_main','0');
            }
            $map['img_id'] = I('get.img_id');
            $result2 = $table->where($map)->setField('img_main','1');
            if($result2){
                $this->ajaxReturn(1);
            }else {
                $this->ajaxReturn(0);
            }
            
        }
    }
    //添加控制
    public function addCtr(){
        parent::checkLogin();
        $table = '';
        $map = array();
        switch (I('post.type')) {
            //添加相册控制
            case "add_ac":
                $table = M('albumcategory');
                $map['ac_name'] = I('post.ac_name');
                $map['ac_description'] = I('post.ac_description');
                $map['user_id'] = session('user_id');
                $map['ac_add_time'] = date('y-m-d',time());
                $result = $table->add($map);
                if($result) {
                    $this->ajaxReturn(1);
                }else {
                    $this->ajaxReturn(0);
                }
                break;
            //添加图片控制
            case "add_img":
                if(!I('post.ac_id')){
                    header("Location: picAdd.html?status=1");
                }
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
            //添加用户控制
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
    //更新控制
    public function up(){
        parent::checkLogin();
        $table = '';
        $map = array();
        switch (I('post.type')) {
            //更新相册信息
            case "up_ac":
                $table = M('albumcategory');
                $map['ac_id'] = I('post.ac_id');
                $map['ac_name'] = I('post.ac_name');
                $map['ac_description'] = I('post.ac_description');
                $map['ac_add_time'] = date('y-m-d h:i:s',time());
                $result = $table->save($map);
                if($result) {
                    $this->ajaxReturn(1);
                }else {
                    $this->ajaxReturn(0);
                }
                break;
            //更新用户信息
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
            //更新图片信息
            case "up_img":
                $table = M('img');
                $map['img_id'] = I('post.img_id');
                $map['img_name'] = I('post.img_name');
                $map['img_description'] = I('post.img_description');
                $map['img_add_time'] = date('y-m-d h:i:s',time());
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
    //删除控制 ajax方法调用
    public function del(){
        parent::checkLogin();
        $table = '';
        $map = array();
        switch (I('get.type')) {
            //删除相册
            case 'del_ac':
                $table = M('albumcategory');
                $map['ac_id'] = I('get.ac_id');
                break;
            //删除图片
            case 'del_img':
                $table = M('img');
                $map['img_id'] = I('get.img_id');
                break;
            //删除用户
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