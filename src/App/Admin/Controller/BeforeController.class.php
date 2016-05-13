<?php
namespace Admin\Controller;
use Think\Controller;
class BeforeController extends Controller {
    public function checkLogin(){
        if(!session('?user_id')){
            header("Location: ".__ROOT__."/Home/Index/index.html?uploadhead=4");
        }
    }
}