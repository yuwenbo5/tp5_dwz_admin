<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class Login extends Controller
{
    public function login()
    {
        //登录验证
        $request = Request::instance();
        if($request->isAjax() && $request->post('action') == 'loginVerify'){
            $result = array('rs'=>0,'info'=>'系统正在维护中...');

            //验证码校验
            $verifyCode = $request->post('verify');
            if(!captcha_check($verifyCode)) {
                // 校验失败
                $result['info'] = '验证码错误';
                return json($result);
            }

            $username = addslashes(trim(strip_tags($request->post('username'))));
            if($username == ''){
                $result['info'] = '用户名不能为空！';
                return json($result);
            }
            $password = addslashes(trim(strip_tags($request->post('password'))));
            if($password == ''){
                $result['info'] = '密码不能为空！';
                return json($result);
            }

            $password = md5($password);

            $userInfo = db('user')->where(array('username'=>$username,'password'=>$password))->find();
            if($userInfo){
                if(!$userInfo['status']){
                    $result['info'] = '您的账户处于不可用状态,无法登录！';
                    return json($result);
                }
                Session::set('user_id',trim(strip_tags($userInfo['id'])));
                Session::set('username',trim(strip_tags($userInfo['username'])));
                Session::set('email', $userInfo['email']);
                Session::set('main_group_id',$userInfo['main_group_id']);
                Session::set('sub_group_ids',$userInfo['sub_group_ids']);

                //所有人员都拥有个人中心的主菜单
                $user_center = Db::name('menu')->where('name="个人中心" and pid=0')->find();
                $userInfo['menu_ids'] .= $user_center['id'];

                Session::set('menu_ids',$userInfo['menu_ids']);
                Session::set('auth_ids',$userInfo['auth_ids']);
                Session::set('nickname', trim(strip_tags($userInfo['nickname'])));
//                Session::set('expire_time', time() + 24 * 60 * 60);
                Session::set('expire_time', time() + 10);

                //菜单列表
                $this->setMenuSession();
                //保存用户拥有的权限
                $this->setAuthSession();

                $result['rs'] = 1;
                $result['info'] = '登录成功!';
                return json($result);
            }else{
                $result['info'] = '用户名或密码错误!';
                return json($result);
            }
        }

        //登录页面
        return view('login');
    }

    /**
     * 登录成功后菜单保存session
     */
    protected function setMenuSession()
    {
        if(session('username') == 'admin'){
            Session::set('auth_list',array('all'));
        }else{

            $menu_ids_arr = Session::get('menu_ids') ? explode(',',Session::get('menu_ids')) : array();
            $menu_ids_group = Session::get('main_group_id') ? Db::name('user_group')->where('id',Session::get('main_group_id'))->column('menu_ids') : array();
            $menu_ids_groups = Session::get('sub_group_ids') ? Db::name('user_group')->where('id','in',explode(',',Session::get('sub_group_ids')))->column('menu_ids') : array();

            $menu_ids_group_arr = array_merge($menu_ids_group,$menu_ids_groups);
            $menu_group_id = array();
            foreach($menu_ids_group_arr as $val){
                $tmp_menu = explode(',',$val);
                foreach($tmp_menu as $menu_id){
                    $menu_group_id[] = $menu_id;
                }
            }
            $menu_list = array_merge($menu_ids_arr,$menu_group_id);

            Session::set('menu_list',array_unique(array_filter($menu_list)));
        }


    }

    /**
     * 权限保存session
     */
    protected function setAuthSession()
    {
        if(session('username') == 'admin'){
            Session::set('auth_list',array('all'));
        }else{
            $auth_ids_arr = Session::get('auth_ids') ? explode(',',Session::get('auth_ids')) : array();
            $auth_ids_group = Session::get('main_group_id') ? Db::name('user_group')->where('id',Session::get('main_group_id'))->column('auth_ids') : array();
            $auth_ids_groups = Session::get('sub_group_ids') ? Db::name('user_group')->where('id','in',explode(',',Session::get('sub_group_ids')))->column('auth_ids') : array();

            $auth_ids_group_arr = array_merge($auth_ids_group,$auth_ids_groups);
            $auth_group_id = array();
            foreach($auth_ids_group_arr as $val){
                $tmp_auth = explode(',',$val);
                foreach($tmp_auth as $auth_id){
                    $auth_group_id[] = $auth_id;
                }
            }
            $auth_list = array_merge($auth_ids_arr,$auth_group_id);

            Session::set('auth_list',array_unique(array_filter($auth_list)));
        }

    }

    //生成验证码
    public function verify()
    {
        $config = config('captcha');
        $captcha = new \think\captcha\Captcha($config);
        return $captcha->entry();
    }

    //退出登录
    public function loginOut(){
        session(null);
        session_destroy();
        $this->redirect('index/index');
    }
}
