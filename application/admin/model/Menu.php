<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3
 * Time: 14:10
 */

namespace app\admin\model;
use think\Model;
use think\Session;

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
            $query->where('pid=0 and name<>"个人中心"')->order('sort','asc');
        });

        return $main_menu;
    }

    /**
     * 获取当前用户所有顶级菜单
     */
    public function getUserMainMenu()
    {
        if(Session::get('username') == 'admin'){
            return $this->getMainMenu();
        }else{
            $user_menu_list = Session::get('menu_list');
            $main_menu = self::all(function($query)use($user_menu_list){
                $query->where('pid=0 and name<>"个人中心" and id in ('.simplode($user_menu_list).')')->order('sort','asc');
            });

            return $main_menu;
        }

    }

    /**
     * 获取所有可用的菜单
     */
    public function getValidMenu($where='1=1')
    {
        $where .= ' and name<>"个人中心"';
        $menu_list = self::all(function($query)use($where){
            $query->where($where)->order('sort','asc');
        });

        return $menu_list;
    }

    /**
     * 获取所有菜单键值对
     * @return $menu_name
     */
    public function getAllMenu($where='1=1')
    {
        $menu_collections = $this->getValidMenu($where);

        $menu_list = array();
        foreach($menu_collections as $menu){
            $menu_list[$menu['id']] = $menu['name'];
        }

        return $menu_list;
    }

    /**
     * 获取当前用户所有可用菜单
     */
    public function getUserValidMenu()
    {
        if(Session::get('username') == 'admin'){
            return $this->getValidMenu();
        }else{
            $user_menu_list = Session::get('menu_list');
            $menu_list = self::all(function($query)use($user_menu_list){
                $query->where("id in (".simplode($user_menu_list).")")->order('sort','asc');
            });
            return $menu_list;
        }
    }


    /**
     * 根据顶级菜单获取下级菜单
     * @param $id
     */
    public function getSonMenu($id)
    {
        $son_menu = self::all(function($query)use($id){
            $query->where('pid="'.$id.'"')->order('sort','asc');
        });

        return $son_menu;
    }

    /**
     * 菜单组织成树状结构数组
     */
    public function getTreeData($allMenu,$pid=0)
    {
        $treeData = array();

        static $number = 1;

        foreach ($allMenu as $v) {
            if ($v['pid'] == $pid) {
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
     * 根据菜单id获取上级菜单个数(包含上上级)
     */
    public function getParentMenuNums($menu_id)
    {
        $nums = 0;
        $menu = $this->where('id',$menu_id)->find();
        if($menu['pid'] == 0){
            $nums ++;
        }else{
            $nums ++;
            $nums += $this->getParentMenuNums($menu['pid']);
        }

        return $nums;
    }

    /**
     * 生成option选项
     */
    public function getMenuTreeOpt($treeData,$pid=0)
    {
        $optTree = '';
        foreach($treeData as $value){
            if($value['pid'] != $pid){
                continue;
            }
            $par_nums = $this->getParentMenuNums($value['id']);
            $background = $par_nums == 1 ? '#AFCDD0' : '#E4EEEF';
            $weight = 900 - $par_nums * 150;
            $rgb = 45 * $par_nums;
            $color = 'rgb('.$rgb.','.$rgb.','.$rgb.','.')';
            $prix_str = '';
            for($i=0; $i<$par_nums; $i++){
                $prix_str .= '+';
            }
            if(isset($value['children']) && !empty($value['children'])){
                $optTree .= '<option style="font-weight:'.$weight.';font-size:12px;background:'.$background.';color:'.$color.';" value="'.$value['id'].'">|'.$prix_str.$value['name'].'</option>';
                $optTree .= $this->getMenuTreeOpt($value['children'],$value['id']);
            }else{
                $optTree .= '<option style="font-weight:'.$weight.';font-size:12px;background:'.$background.';color:'.$color.';" value="'.$value['id'].'">|'.$prix_str.$value['name'].'</option>';
            }
        }

        return $optTree;
    }

    /**
     * 生成html菜单节点
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

    /**
     * 生成table_tree
     */
    public function getMenuTableTree($treeData,$pid=0,$oldMenu=array())
    {
        $tableTree = '';
        foreach($treeData as $value){
            if($value['pid'] != $pid){
                continue;
            }
            $hr = '';
            if($value['pid'] == 0){
                $hr = '<hr/>';
            }
            $checked = '';
            if(in_array($value['id'],$oldMenu)){
                $checked = 'checked';
            }
            $par_nums = $this->getParentMenuNums($value['id']);
            $margin_left = ($par_nums-1) * 30;
            if(isset($value['children']) && !empty($value['children'])){
                $tableTree .= $hr.'<ul><h5 style="margin-left:'.$margin_left.'px;"><label><input type="checkbox" '.$checked.' name="menu_ids[]" value="'.$value['id'].'"/>'.$value['name'].'</label></h5>';
                $tableTree .= $this->getMenuTableTree($value['children'],$value['id']);
            }else{
                $tableTree .= '<li style="list-style:none;margin-left:'.$margin_left.'px;"><label><input type="checkbox" '.$checked.' name="menu_ids[]" value="'.$value['id'].'"/>'.$value['name'].'</label></li>';
            }
        }

        $tableTree .= '</ul>';

        return $tableTree;
    }

    /**
     * 生成列表tree
     */
    public function getMenuListTree($treeData,$pid=0)
    {
        $listTree = array();

        foreach($treeData as $value){
            if($value['pid'] != $pid){
                continue;
            }

            if($value['pid'] == 0){
                $listTree[] = $value;
                if(isset($value['children']) && !empty($value['children'])){

                    $listTree = array_merge($listTree,$this->getMenuListTree($value['children'],$value['id']));
                }
            }else{
                $par_nums = $this->getParentMenuNums($value['id']);
                $prix_str = '';
                for($i=1; $i<$par_nums; $i++){
                    $prix_str .= '│&nbsp;&nbsp;&nbsp;';
                }

                $value['name'] = $prix_str.'└─'.$value['name'];
                $listTree[] = $value;
                if(isset($value['children']) && !empty($value['children'])){

                    $listTree = array_merge($listTree,$this->getMenuListTree($value['children'],$value['id']));
                }
            }

        }

        return $listTree;
    }

}