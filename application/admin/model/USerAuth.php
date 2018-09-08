<?php
/**
 * @desc 用户权限model
 * @author: ywb
 * @since: 2018/9/6 16:16
 */

namespace app\admin\model;
use think\Model;

class USerAuth extends Model
{
    protected $table = null;


    //模型初始化
    protected function initialize(){

        //需要调用`Model`的`initialize`方法
        parent::initialize();

    }
}