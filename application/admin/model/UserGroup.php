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

    /**
     * 获取所有分组
     */
    public function getAllUserGroup()
    {
        $group_list = self::all(function($query){
            $query->where('1=1')->order('id','asc');
        });

        $return_list = array();
        foreach($group_list as $val){
            $return_list[$val['id']] = $val;
        }

        return $return_list;
    }

    /**
     * 获取所有可用分组
     */
    public function getAllValidGroup()
    {
        $group_list = self::all(function($query){
            $query->where('status=1')->order('id','asc');
        });

        return $group_list;
    }
}