<?php
namespace app\admin\model;
use think\Model;
// 用户模型
class User extends Model
{

    protected $table = null;

    //模型初始化
    protected function initialize(){

        //需要调用`Model`的`initialize`方法
        parent::initialize();

    }
}
?>