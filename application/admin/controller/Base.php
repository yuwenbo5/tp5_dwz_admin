<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Request;

class Base extends Controller
{
    //不判断登录的白名单
    public $CHECK_LOGIN_WHITE = array();

    //不检测权限的白名单
    protected $CHECK_PRIV_WHITE = array();

    //每页记录数查询
    public $PAGE_LIST = array();

    //递增、递减排序
    public $ORDER_LIST = array();

    public function _initialize(){
        parent::_initialize();

        //不需要检测的登录的白名单
        $this->CHECK_LOGIN_WHITE = array(
            MODULE_NAME.'/'.CONTROLLER_NAME.'/sonmenu',
        );

        //检测登录
        $this->checkLogin();

        //检查操作权限
        $this->checkPriv();


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
    protected function checkLogin()
    {
        //是否需要检测登录
        if($this->isCheckLogin()){
            if(Session::get('expire_time') && Session::get('expire_time') < time()){
//                session_destroy();
                //登录超时
                $this->redirect('login/ajaxTimeout');
            }
            if(!Session::get('username') || Session::get('username') == ''){
                $this->redirect('login/login');
            }
        }
    }

    /**
     * 是否需要检测登录
     * $return bool
     */
    private function isCheckLogin()
    {
        //白名单不检测
        $model = MODULE_NAME;
        $ctl = CONTROLLER_NAME;
        $act = ACTION_NAME;
        $path = $model.'/'.$ctl.'/'.$act;
        if(in_array($path,$this->CHECK_LOGIN_WHITE)){
            return false;
        }

        return true;
    }

    /**
     * 检验用户权限
     * @return array
     */
    private function checkPriv()
    {
        //获取操作的模块、控制器和方法
        $model = MODULE_NAME;
        $ctl = CONTROLLER_NAME;
        $act = ACTION_NAME;

        //不需要检查的不检查
        $is_auth = $this->isCheckAuth();
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
        if(!in_array($model.'@'.$ctl.'@'.$act, $role_auth)){
            return ['status'=>-1,'msg'=>'您没有操作权限['.($model.'@'.$ctl.'@'.$act).'],请联系超级管理员分配权限','url'=>url('Admin/Index/index')];
        }
    }

    /**
     * 是否需要检查权限
     * @return bool
     */
    protected function isCheckAuth()
    {
        $flag = true;
        if(session('username') == 'admin'){
            //超级管理员不检测
            $flag = false;
        }

        //获取操作的模块、控制器和方法
        $model = MODULE_NAME;
        $ctl = CONTROLLER_NAME;
        $act = ACTION_NAME;

        //白名单不检测
        if(in_array($model.'@'.$ctl.'@'.$act,$this->CHECK_PRIV_WHITE)){
            return false;
        }


        $is_has = Db::name('auth')->where('auth_code',$model.'@'.$ctl.'@'.$act)->find();
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