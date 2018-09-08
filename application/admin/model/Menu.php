<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3
 * Time: 14:10
 */

namespace app\admin\model;
use think\Model;

class Menu extends Model
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
     * 获取所有顶级菜单
     */
    public function getMainMenu()
    {
        $main_menu = self::all(function($query){
            $query->where('status=1 and pid=0 and name<>"个人中心"')->order('sort','asc');
        });

        return $main_menu;
    }

    /**
     * 根据顶级菜单获取下级菜单
     * @param $id
     */
    public function getSonMenu($id)
    {
        $son_menu = self::all(function($query)use($id){
            $query->where('status=1 and pid="'.$id.'"')->order('sort','asc');
        });

        return $son_menu;
    }

    /**
     * 获取所有可用的菜单
     */
    public function getValidMenu()
    {
        $menu_list = self::all(function($query){
            $query->where("status=1 and name<>'个人中心'")->order('sort','asc');
        });

        return $menu_list;
    }

    /**
     * 菜单组织成树状结构数组
     */
    public function getTreeData($allMenu,$parentId=0)
    {
        $treeData = array();

        static $number = 1;

        foreach ($allMenu as $v) {
            if ($v['pid'] == $parentId) {
                if ($v['pid'] == 0) {
                    $v['levels'] = 0;
                } else {
                    $v['levels'] = $number;
                    ++$number;
                }
                $v['children'] = $this->getTreeData($allMenu, $v['id']);
                $treeData[] = $v;
            } else {
                $number = 1;
            }
        }

        return $treeData;
    }

    /**
     * 生成html菜单
     */
    public function getMenuFormat($treeData,$pid=0)
    {
        $menuTree = '';
        foreach($treeData as $value){
            if($value['pid'] != $pid){
                continue;
            }
            if(isset($value['children']) && !empty($value['children'])){
                $menuTree .= '<div class="accordionHeader"><h2><span>Folder</span>'.$value['name'].'</h2></div><div class="accordionContent">';
                $menuTree .= $this->getMenuFormat($value['children'],$value['id']);
            }else{
                $menuTree .= '<ul class="tree treeFolder"><li><a href="'.url($value['rule']).'" target="navTab" rel="'.$value['rel'].'">'.$value['name'].'</a></li></ul>';
            }
        }

        $menuTree .= '</div>';

        return $menuTree;
    }
}