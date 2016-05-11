<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller
{

    public function index ()
    {
        $this->assign('MESSAGE_LANG', C('MESSAGE_LANG'));
        $this->assign('uploadhead',0);
    }
    // 返回查询结果
    public function checkExist($table,$mainKey,$value){
        $currentTable = M($table);
        $map[$mainKey] = $value;
        return $currentTable->where($map)->find();
    }
    public function checkLogin(){
        if(!session('?user_id')){
            header("Location: index.html?uploadhead=4");
        }
    }
}
    
    
