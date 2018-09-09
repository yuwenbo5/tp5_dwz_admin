<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3
 * Time: 13:56
 */

namespace app\admin\controller;
use app\admin\model\Menu;
use app\admin\model\UserGroup;
use think\console\command\make\Model;
use think\Db;
use think\Request;
use think\Session;

class System extends Base
{

    //菜单列表
    public function menu()
    {
        $menu = new Menu();
        $menu_list = $menu->getValidMenu();
        $data = array(
            'menu_list' => $menu_list,

        );

        return $this->fetch('menu_list',$data);
    }


    //添加菜单
    public function addmenu()
    {
        $menu = new Menu();
        $menu_list = $menu->getValidMenu();
        $data = array(
            'status' => $menu->STATUS_ARR,
            'menu_list' => $menu_list,
            'menu' => $menu->getTreeData($menu_list),
        );
        return $this->fetch('add_menu',$data);
    }

    //保存菜单
    public function savemenu()
    {
        $request = Request::instance();
        $result = array(
            'statusCode' => 300,
            'message' => 'error',
        );
        if($request->post('action') == 'add'){
            $input = $request->post();
            $data = array(
                'name' => $input['name'],
                'rule' => $input['rule'],
                'status' => $input['status'],
                'pid' => $input['pid'],
                'sort' => $input['sort'],
                'rel' => trim(str_replace('/','_',$input['rule']),'_'),
                'remark' => $input['remark'],
                'create_id' => Session::get('username'),
                'create_time' => date('Y-m-d H:i:s'),
            );
            //菜单名不能重复
            $exist = Db::name('menu')->where('name',$data['name'])->find();
            if(!empty($exist)){
                $result['message'] = '菜单名重复';
                return json($result);
            }
            $insertId = Db::name('menu')->insertGetId($data);
            if($insertId){
                $result['statusCode'] = 200;
                $result['message'] = '菜单添加成功！';
            }else{
                $result['message'] = '菜单添加失败';
            }
            return json($result);
        }
    }

    //用户分组列表
    public function userGroup()
    {
        $user_group_list = Db::name('user_group')->select();
        $user_group = new UserGroup();
        $data = array(
            'user_group_list' => $user_group_list,
            'status' => $user_group->STATUS_ARR,
        );

        return $this->fetch('user_group_list',$data);
    }

    //用户分组添加页面
    public function addUserGroup()
    {
        $user_group = new UserGroup();
        $menu = new Menu();

        //菜单列表
        $main_menu = $menu->getMainMenu();
        $menu_list = $menu->getValidMenu();
        $menu_table_tree = array();
        foreach($main_menu as $main){
            $son_menu_tree = $menu->getTreeData($menu_list,$main['id']);
            $menu_table_tree[$main['id']] = $main;
            $menu_table_tree[$main['id']]['son_menu'] = $menu->getMenuTableTree($son_menu_tree,$main['id']);
        }

        //权限列表

        $data = array(
            'status' => $user_group->STATUS_ARR,
            'menu_table_tree' => $menu_table_tree,
        );
        return $this->fetch('add_user_group',$data);
    }

    //保存用户分组
    public function saveUserGroup()
    {
        $request = Request::instance();
        $result = array(
            'statusCode' => 300,
            'message' => 'error',
        );
        if($request->post('action') == 'add'){
            $input = $request->post();
            $data = array(
                'name' => $input['name'],
                'desc' => $input['desc'],
                'status' => $input['status'],
                'menu_ids' => '',
                'auth_ids' => '',
                'operate_id' => Session::get('username'),
                'operate_time' => date('Y-m-d H:i:s'),
            );
            //分组名不能重复
            $exist = Db::name('user_group')->where('name',$data['name'])->find();
            if(!empty($exist)){
                $result['message'] = '分组名重复';
                return json($result);
            }
            $insertId = Db::name('user_group')->insertGetId($data);
            if($insertId){
                $result['statusCode'] = 200;
                $result['message'] = '分组添加成功！';
            }else{
                $result['message'] = '分组添加失败';
            }
            return json($result);
        }
    }

    //用户权限列表
    public function auth()
    {
        $auth_list = Db::name('auth')->select();
        $data = array(
            'auth_list' => $auth_list,
        );

        return $this->fetch('auth_list',$data);
    }

    //用户权限添加页面
    public function addAuth()
    {
        $menu = new Menu();
        $menu_tree = $menu->getMenuTreeOpt($menu->getTreeData($menu->getValidMenu()));

        //取所有控制器
        $controllerPath = APP_PATH.$this->getModule(input('type',0)).'/controller';
        $controllerList = array();
        $dirRes   = opendir($controllerPath);
        while($dir = readdir($dirRes))
        {
            if(!in_array($dir,array('.','..','.svn','.git','.idea')))
            {
                $controllerList[] = basename($dir,'.php');
            }
        }

        $data = array(
            'menu_tree' => $menu_tree,
            'controller_list' => $controllerList,
        );

        return $this->fetch('add_auth',$data);
    }

    //保存用权限
    public function saveAuth()
    {
        $request = Request::instance();
        $result = array(
            'statusCode' => 300,
            'message' => 'error',
        );
        if($request->post('action') == 'add'){
            $input = $request->post();
            $auth_code = implode(',',$input['auth']);
            $data = array(
                'name' => $input['name'],
                'desc' => $input['desc'],
                'menu_id' => $input['menu_id'],
                'auth_code' => $auth_code,
                'operate_id' => Session::get('username'),
                'operate_time' => date('Y-m-d H:i:s'),
            );
            //权限名不能重复
            $exist = Db::name('auth')->where('name',$data['name'])->find();
            if(!empty($exist)){
                $result['message'] = '权限名重复';
                return json($result);
            }
            $insertId = Db::name('auth')->insertGetId($data);
            if($insertId){
                $result['statusCode'] = 200;
                $result['message'] = '权限添加成功！';
            }else{
                $result['message'] = '权限添加失败';
            }
            return json($result);
        }
    }



    /**
     * ajax获取控制器下的所有方法
     */
    public function ajaxGetAction()
    {
        $control = input('controller');
        $type = input('type',0);


        $module = $this->getModule($type);
        if (!$module) {
            exit('模块不存在或不可见');
        }

        $selectControl = [];
        $className = "app\\".$module."\\controller\\".$control;
        $methods = (new \ReflectionClass($className))->getMethods(\ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $method) {
            if ($method->class == $className) {
                if ($method->name != '__construct' && $method->name != '_initialize') {
                    $selectControl[] = $method->name;
                }
            }
        }

        $html = '';
        foreach ($selectControl as $val){
            $html .= "<li><label><input class='checkbox' name='act_list' value=".$val." type='checkbox'>".$val."</label></li>";
            if($val && strlen($val)> 18){
                $html .= "<li></li>";
            }
        }
        exit($html);
    }

}