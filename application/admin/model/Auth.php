<?php
/**
 * @desc 权限Model
 * @author: ywb
 * @since: 2018/9/10 10:47
 */

namespace app\admin\model;
use think\Model;

class Auth extends Model
{
    protected $table = null;

    public $STATUS_YES = 1;
    public $STATUS_NO = 0;
    public $STATUS_ARR = array();

    //模型初始化
    protected function initialize(){

        //需要调用`Model`的`initialize`方法
        parent::initialize();

    }

    /**
     * 根据菜单id查权限
     */
    public function getAuthByMenu($menu_id)
    {
        $auth_list = self::all(function($query)use($menu_id){
            $query->where("menu_id",$menu_id)->order('id');
        });

        return $auth_list;
    }

    /**
     * 获取菜单treeData
     */
    public function getMenuTreeData()
    {
        $menu = new Menu();
        $menu_tree_data = $menu->getTreeData($menu->getValidMenu());

        return $menu_tree_data;
    }

    /**
     * 根据菜单生成权限tree
     * @param $treeData
     * @param int $pid
     */
    public function getAuthTree($treeData,$pid=0)
    {
        $authTree = '';
        foreach($treeData as $value){
            if($value['pid'] != $pid){
                continue;
            }
            $hr = '';
            if($value['pid'] == 0){
                $hr = '<hr/>';
            }
            $par_nums = (new Menu())->getParentMenuNums($value['id']);
            $margin_left = ($par_nums-1) * 30;
            if(isset($value['children']) && !empty($value['children'])){
                $authTree .= $hr.'<ul><h5 style="margin-left:'.$margin_left.'px;"><lable><input type="checkbox" value="'.$value['id'].'" onclick="selectAuthItem(this,1);"/>'.$value['name'].'</lable></h5>';
                $authTree .= $this->getAuthTree($value['children'],$value['id']);
            }else{
                //菜单对应的所有权限
                $menu_auth_list = $this->getAuthByMenu($value['id']);
                $auth_html = ' | <span style="color:#000;">';
                foreach($menu_auth_list as $val){
                    $auth_html .= '<lable title="'.$val['desc'].'"><input type="checkbox" value="'.$val['id'].'"/>'.$val['name'].'</lable>';
                }
                $auth_html .= '</span>';
                $authTree .= '<li style="list-style:none;margin-left:'.$margin_left.'px;"><lable><input type="checkbox" value="'.$value['id'].'" onclick="selectAuthItem(this,2);"/>'.$value['name'].$auth_html.'</lable></li>';
            }
        }

        $authTree .= '</ul>';

        return $authTree;

    }

}