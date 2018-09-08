<?php
namespace app\admin\controller;
use app\admin\model\Menu;
use app\admin\model\User;
use think\Db;
use think\Session;
use think\Request;

class Index extends Base
{
    public function index()
    {
        $menu = new Menu();
        $main_menu = $menu->getMainMenu();
        $current_main_menu = Db::name('menu')->where('name="个人中心" and pid=0')->order('sort','asc')->find();
        $data = array(
            'main_menu' => $main_menu,
            'current_main_menu' => $current_main_menu,
            'current_menu' => $this->sonMenu($current_main_menu['id']),
        );

        return view('index',$data);
    }

    //获取子菜单列表
    public function sonMenu($id)
    {
        $id = input('id') ? input('id') : $id;
        //查到所有子菜单
        $menu = new Menu();
        $menu_list = $menu->getValidMenu();
        $tree_data = $menu->getTreeData($menu_list,$id);
        $menu_html = $menu->getMenuFormat($tree_data,$id);
        $menu_html = '<div class="accordion" fillSpace="sidebar">'.$menu_html.'</div>';

        return $menu_html;
    }

    //系统消息
    public function main()
    {
        $info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            'ThinkPHP版本'=>THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
        );
        return view('main',['info' => $info]);
    }

    //修改资料页面
    public function profile()
    {
        $userInfo = User::get(['id' => Session::get('user_id')]);
        return $this->fetch('profile',['user' => $userInfo]);
    }

    //修改密码页面
    public function password()
    {
        return view('password',['id' => Session::get('user_id')]);
    }

    // 更换密码结果
    public function changePwd()
    {
        $result = array(
            'statusCode' => 300,
            'message' => '修改失败',
        );
        $callbackType = Request::instance()->get('callbackType');

        //对表单提交处理进行处理或者增加非表单数据
        $request = Request::instance();
        if($request->isPost()){
            $data = $request->post();
            $id = $data['id'];

            //验证码校验
            $verifyCode = $data['verify'];
            if(!captcha_check($verifyCode)) {
                // 校验失败
                $result['message'] = '验证码错误';
                $result['callbackType'] = 'refreshVerify';
                return json($result);
            }

            //两次密码相同验证
            if($data['password'] != $data['repassword']){
                $result['message'] = '两次密码输入不一致';
                $result['callbackType'] = 'refreshVerify';
                return json($result);
            }

            //原密码验证
            $userInfo = User::get(['id' => $id]);
//            var_dump(md5($data['oldpassword']));die;
            if($userInfo['password'] != md5($data['oldpassword'])){
                $result['message'] = '原密码输入错误';
                $result['callbackType'] = 'refreshVerify';
                return json($result);
            }

            //新旧密码不能相同
            if($userInfo['password'] == md5($data['password'])){
                $result['message'] = '新密码不能与原密码相同';
                $result['callbackType'] = 'refreshVerify';
                return json($result);
            }

            //验证后更新数据
            $update_data = array(
                'password' => md5($data['password']),
            );
            if(User::where('id',$id)->update($update_data)){
                $result['statusCode'] = 200;
                $result['message'] = '密码修改成功('.$data['password'].')请牢记!';
                $result['callbackType'] = $callbackType;
                session(null);
            }

            return json($result);
        }

    }

    // 修改资料结果
    public function change()
    {
        $request = Request::instance();
        $data = $request->post();
        $id = $data['id'];
        $result = array(
            'statusCode' => 300,
            'message' => '修改失败',
        );
        //更新操作
        $update_user = array(
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'remark' => $data['remark'],
        );
//        dump($update_user);die;
        if(User::where('id',$id)->update($update_user)){
            $callbackType = Request::instance()->get('callbackType');
            $result['statusCode'] = 200;
            $result['message'] = '修改成功';
            $result['callbackType'] = $callbackType;
        }

        return json($result);
    }

    //我的主页
    public function myhome()
    {
        return view();
    }

    //系统通知
    public function notice()
    {
        return view();
    }

    public function row_col()
    {
        return view('row-col');
    }
}
