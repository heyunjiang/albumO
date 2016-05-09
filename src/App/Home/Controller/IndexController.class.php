<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$user = M('user');
    	$this->display();
    }
    public function myalbum(){
    	$user = M('user');
    	$this->display();
    }
}