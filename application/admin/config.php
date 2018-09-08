<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 应用调试模式
    'app_debug'              => true,

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'admin',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],


    // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__ADMIN__' => '/tenflyer/public/static/admin',
        '__COMMON__' => '/tenflyer/public/static/common',
        '__STATIC__' => '/tenflyer/public/static',
    ],

    //验证码配置
    'captcha' => [
        'codeSet' => '234567890',
        'fontSize' => 10,
        'userCurve' => true,//混淆曲线
        'useNoise' => false,
        'imageH' => 24,
        'imageW' => 75,
        'length' => 4,
        'reset' => true,
    ],

];
