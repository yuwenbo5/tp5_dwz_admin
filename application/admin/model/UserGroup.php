<?php
/**
 * @desc Created by PhpStorm.
 * @author: ywb
 * @since: 2018/9/6 14:16
 */

namespace app\admin\model;
use think\Model;

class UserGroup extends Model
{
    protected $table = null;

    public $STATUS_YES = 1;
    public $STATUS_NO = 0;
    public $STATUS_ARR = array();

    //模型初始化
    protected function initialize(){

        //需要调用`Model`的`initialize`方法
        parent::initialize();

        $this->STATUS_ARR = array(
            $this->STATUS_YES => '可用',
            $this->STATUS_NO => '禁用',
        );
    }
}