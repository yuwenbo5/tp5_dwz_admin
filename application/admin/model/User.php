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

    /**
     * 获取所有user
     */
    public function getAllUser($where='1=1')
    {
        $user_collections = self::all(function($query)use($where){
            $query->where($where)->order('register_time','asc');
        });

        $user_list = array();
        foreach($user_collections as $user){
            $user_list[$user['username']] = $user['nickname'] ? $user['nickname'] : $user['username'];
        }

        return $user_list;
    }
}
?>