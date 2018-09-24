<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;

class Base extends Controller
{
    //每页记录数查询
    public $PAGE_LIST = array();

    //递增、递减排序
    public $ORDER_LIST = array();

    public function _initialize(){
        parent::_initialize();

        //检测登录
        $this->is_login();

        //检查操作权限
        $this->check_priv();


        $this->PAGE_LIST = array(
            '1' => '1/页',
            '20' => '20/页',
            '50' => '50/页',
            '100' => '100/页',
            '200' => '200/页',
            '500' => '500/页',
            '1000' => '1000/页',
        );

        $this->ORDER_LIST = array(
            'asc' => array(
                'name' => '递增',
                'is_default' => 0,
            ),
            'desc' => array(
                'name' => '递减',
                'is_default' => 1,
            ),
        );
    }

    /**
     * 定义要管理的模块
     */
    protected function getModule($type=0)
    {
        //可写入配置或者logic层
        $moduleList = array(
            0 => 'admin',
            1 => 'home',
        );

        return isset($moduleList[$type]) ? $moduleList[$type] : '';
    }

    //验证是否登录
    protected function is_login(){
        if(Session::get('expire_time') && Session::get('expire_time') < time()){
            session_destroy();
        }
        if(!Session::get('username') || Session::get('username') == ''){
            $this->redirect('login/login');
        }
    }

    /**
     * 检验用户权限
     * @return array
     */
    private function check_priv()
    {
        //获取操作的控制器和方法
        $ctl = CONTROLLER_NAME;
        $act = ACTION_NAME;

        //不需要检查的不检查
        $is_auth = $this->is_check_auth();
        if(!$is_auth){
            return true;
        }

        //开始验证
        $act_list = session('auth_list');
        $auth = Db::name('auth')->where("id", "in", $act_list)->select();
        $role_auth = '';
        foreach ($auth as $val){
            $role_auth .= $val['auth_code'].',';
        }
        $role_auth = explode(',', $role_auth);
        //检查是否拥有此操作权限
        if(!in_array($ctl.'@'.$act, $role_auth)){
            return ['status'=>-1,'msg'=>'您没有操作权限['.($ctl.'@'.$act).'],请联系超级管理员分配权限','url'=>url('Admin/Index/welcome')];
        }
    }

    /**
     * 是否需要检查权限
     * @return bool
     */
    protected function is_check_auth()
    {
        $flag = true;
        if(session('auth_list') == 'all'){
            //超级管理员不检测
            $flag = false;
        }

        //获取操作的控制器和方法
        $ctl = CONTROLLER_NAME;
        $act = ACTION_NAME;
        $is_has = Db::name('auth')->where('auth_code',$ctl.'@'.$act)->find();
        if(!$is_has){
            //没有设置权限不检测
            $flag = false;
        }

        return $flag;
    }

    /**
     * 其它操作
     * @param $searchArr
     * @return array
     */
    protected function getSearch($searchArr){
        $return_data = array(
            'pageNums' => 20,
            'order' => '',
            'where' => array(
                1,
            ),
        );

        if(!empty($searchArr)){
            unset($searchArr['searchsubmit']);
            $return_data['pageNums'] = $searchArr['pageNums'];
            unset($searchArr['pageNums']);
            $return_data['order'] = $searchArr['order'].' order by '.$searchArr['order_by'];
            unset($searchArr['order'],$searchArr['order_by']);
            foreach($searchArr as $key => $val){
                if($val != ''){
                    $return_data['where'][$key] = $val;
                }
            }
        }

        return $return_data;
    }

}