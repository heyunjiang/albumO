<?php
namespace Admin\Controller;
use Think\Controller;
class BeforeController extends Controller {
    public function checkLogin(){
        if(!session('?user_id')){
            header("Location: ".__ROOT__."/Home/Index/index.html?uploadhead=4");
        }
    }
    public function addTotal(){
    	$total = M('total');
        $total->where('t_id=0')->setInc('t_value',1); 
    }
}