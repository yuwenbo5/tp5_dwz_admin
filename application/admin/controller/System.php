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
        $data = array(
            'status' => $user_group->STATUS_ARR,
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
            //菜单名不能重复
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
        $user_auth_list = Db::name('user_group')->select();
        $user_group = new UserGroup();
        $data = array(
            'user_group_list' => $user_auth_list,
            'status' => $user_group->STATUS_ARR,
        );

        return $this->fetch('user_group_list',$data);
    }

}