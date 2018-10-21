<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\index\index.html";i:1539053515;s:64:"E:\xampp\htdocs\tenflyer\application\admin\view\public\menu.html";i:1538726020;s:65:"E:\xampp\htdocs\tenflyer\application\admin\view\index\myhome.html";i:1536499614;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo \think\Config::get('sitename'); ?></title>
    <link rel="shortcut icon" href="/tenflyer/public/static/admin/img/favicon.ico" />

    <link href="/tenflyer/public/static/dwz/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/tenflyer/public/static/dwz/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/tenflyer/public/static/dwz/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
    <link href="/tenflyer/public/static/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
    <style type="text/css">
        #header{height:85px;}
        #leftside, #container, #splitBar, #splitBarProxy{top:90px}
    </style>
    <!--[if IE]>
    <link href="/tenflyer/public/static/dwz/themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
    <![endif]-->

    <!--[if lt IE 9]><script src="/tenflyer/public/static/dwz/js/speedup.js" type="text/javascript"></script>
        <script src="/tenflyer/public/static/dwz/js/jquery-1.11.3.min.js" type="text/javascript"></script><![endif]-->
    <!--[if gte IE 9]><!--><script src="/tenflyer/public/static/dwz/js/jquery-2.1.4.min.js" type="text/javascript"></script><!--<![endif]-->

    <script src="/tenflyer/public/static/dwz/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="/tenflyer/public/static/dwz/js/jquery.validate.js" type="text/javascript"></script>
    <!--<script src="js/jquery.bgiframe.js" type="text/javascript"></script>-->
    <script src="/tenflyer/public/static/dwz/xheditor/xheditor-1.2.2.min.js" type="text/javascript"></script>
    <script src="/tenflyer/public/static/dwz/xheditor/xheditor_lang/zh-cn.js" type="text/javascript"></script>
    <script src="/tenflyer/public/static/dwz/uploadify/scripts/jquery.uploadify.js" type="text/javascript"></script>

    <script type="text/javascript" src="/tenflyer/public/static/dwz/chart/echarts.min.js"></script>

    <!-- 可以用dwz.min.js替换前面全部dwz.*.js (注意：替换时下面dwz.regional.zh.js还需要引入)-->
    <script src="/tenflyer/public/static/dwz/js/dwz.min.js?v=1.0.1" type="text/javascript"></script>
    <script src="/tenflyer/public/static/dwz/js/dwz.regional.zh.js" type="text/javascript"></script>

    <script type="text/javascript">
        //刷新验证码
        function refreshVerify(){
            $("#verifyImg").attr('src',"<?php echo url('admin/login/verify'); ?>?"+Math.random());
        }
        function dialogAjaxMenu(json){
            dialogAjaxDone(json);
            if (json.statusCode == DWZ.statusCode.ok){
                $("#sidebar").loadUrl("<?php echo url('index/menu'); ?>");
            }
        }
        function navTabAjaxMenu(json){
            navTabAjaxDone(json);
            if (json.statusCode == DWZ.statusCode.ok){
                $("#sidebar").loadUrl("<?php echo url('index/menu'); ?>");
            }
        }
        function checkTextareaFormSubmit(textarea) {
            if (window.event.keyCode == DWZ.keyCode.ENTER && window.event.ctrlKey) {
                $(textarea).parents('form:first').trigger("submit");
            }
        }
        $(function(){
            DWZ.init("/tenflyer/public/static/dwz.frag.xml", {
                statusCode:{ok:200, error:300, timeout:301}, //【可选】
                pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
                keys: {statusCode:"statusCode", message:"message"}, //【可选】
                ui:{hideMode:'offsets'}, //【可选】hideMode:navTab组件切换的隐藏方式，支持的值有’display’，’offsets’负数偏移位置的值，默认值为’display’
                debug:false,	// 调试模式 【true|false】
                callback:function(){
                    initEnv();
                    $("#themeList").theme({themeBase:"/tenflyer/public/static/dwz/themes"}); // themeBase 相对于index页面的主题base路径
                    // setTimeout(function() {$("#sidebar .toggleCollapse div").trigger("click");}, 10);
                }
            });
        });
    </script>
</head>

<body scroll="no">
<div id="layout">
    <div id="header">
        <div class="headerNav">
            <a class="logo" href="<?php echo url('index/index'); ?>">Logo</a>
            <ul class="nav">
                <li><a href="<?php echo url('index/main'); ?>" target="dialog" width="580" height="360" rel="sysInfo">系统消息</a></li>
                <li><a href="<?php echo url('index/password'); ?>" target="dialog" mask="true">修改密码</a></li>
                <li><a href="<?php echo url('index/profile'); ?>" target="dialog" mask="true">修改资料</a></li>
                <li><a href="<?php echo url('login/loginOut'); ?>">退出</a></li>
            </ul>
            <ul class="themeList" id="themeList">
                <li theme="default"><div class="selected">蓝色</div></li>
                <li theme="green"><div>绿色</div></li>
                <li theme="purple"><div>紫色</div></li>
                <li theme="silver"><div>银色</div></li>
                <li theme="azure"><div>天蓝</div></li>
            </ul>
        </div>

        <!-- navMenu -->
        <div id="navMenu">
            <ul>
                <li class="selected"><a href="<?php echo url('index/sonMenu'); ?>?id=<?php echo $current_main_menu['id']; ?>"><span><?php echo $current_main_menu['name']; ?></span></a></li>
                <?php if(is_array($main_menu) || $main_menu instanceof \think\Collection || $main_menu instanceof \think\Paginator): if( count($main_menu)==0 ) : echo "" ;else: foreach($main_menu as $key=>$value): ?>
                    <li><a href="<?php echo url('index/sonMenu'); ?>?id=<?php echo $value['id']; ?>" onclick="selectMenu(this);"><span><?php echo $value['name']; ?></span></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <p style='clear:both;' class='clear'></p>
    </div>

    <!-- 左侧菜单 -->
    <div id="leftside">
        <div id="sidebar_s">
            <div class="collapse">
                <div class="toggleCollapse"><div></div></div>
            </div>
        </div>
        <div id="sidebar">
            <div class="toggleCollapse" id="menuMain"><h2><?php echo $current_main_menu['name']; ?></h2><div>收缩</div></div>
            <!--<div class="accordion" fillSpace="sidebar">
    <div class="accordionHeader">
        <h2><span>Folder</span>个人中心</h2>
    </div>
    <div class="accordionContent">
        <ul class="tree treeFolder">
            <li><a href="<?php echo url('myhome'); ?>" target="navTab" rel="main">我的主页</a></li>
        </ul>
    </div>

    <div class="accordionHeader">
        <h2><span>Folder</span>资讯管理</h2>
    </div>
    <div class="accordionContent">
        <ul class="tree treeFolder">
            <li><a href="<?php echo url('notice'); ?>" target="navTab" rel="notice">系统公告</a></li>
        </ul>
    </div>

    <div class="accordionHeader">
        <h2><span>Folder</span>产品管理</h2>
    </div>
    <div class="accordionContent">
        <ul class="tree treeFolder">
            <li><a href="main.html" target="navTab" rel="main">产品列表</a></li>
            <li><a href="main.html" target="navTab" rel="main">添加产品</a></li>
            <li><a href="main.html" target="navTab" rel="main">产品回收站</a></li>
        </ul>
    </div>

    <div class="accordionHeader">
        <h2><span>Folder</span>菜单管理</h2>
    </div>
    <div class="accordionContent">
        <ul class="tree treeFolder">
            <li><a href="<?php echo url('system/menu'); ?>" target="navTab" rel="menu">菜单列表</a></li>
            <li><a href="<?php echo url('system/addmenu'); ?>" target="navTab" rel="addmenu">添加菜单</a></li>
        </ul>
    </div>

    <div class="accordionHeader">
        <h2><span>Folder</span>服务管理</h2>
    </div>
    <div class="accordionContent">
        <ul class="tree treeFolder">
            <li><a href="main.html" target="navTab" rel="main">我的主页</a></li>
            <li><a href="main.html" target="navTab" rel="main">我的主页</a></li>
        </ul>
    </div>

    <div class="accordionHeader">
        <h2><span>Folder</span>界面组件</h2>
    </div>
    <div class="accordionContent">
        <ul class="tree treeFolder">
            <li><a href="tabsPage.html" target="navTab">主框架面板</a>
                <ul>
                    <li><a href="main.html" target="navTab" rel="main">我的主页</a></li>
                    <li><a href="<?php echo url('index/row_col'); ?>" target="navTab" rel="row-col">栅格系统(Bootstrap)</a></li>
                    <li><a href="http://www.baidu.com" target="navTab" rel="page1">页面一(外部链接)</a></li>
                    <li><a href="demo/baidu_map_iframe.html" target="navTab" rel="bmap" external="true" title="需要设置external属性为true">地图(external iframe方式)</a></li>
                    <li><a href="demo/baidu_map.html" target="navTab" rel="bmap">地图(直接嵌入方式)</a></li>
                    <li><a href="demo_page1.html" target="navTab" rel="page1" fresh="false">替换页面一</a></li>
                    <li><a href="demo_page2.html" target="navTab" rel="page2">页面二</a></li>
                    <li><a href="demo_page4.html" target="navTab" rel="page3" title="页面三（自定义标签名）">页面三</a></li>
                    <li><a href="demo_page4.html" target="navTab" rel="page4" fresh="false">测试页面(fresh="false")</a></li>
                    <li><a href="w_editor.html" target="navTab">表单提交会话超时</a></li>
                    <li><a href="demo/common/ajaxTimeout.html" target="navTab">navTab会话超时</a></li>
                    <li><a href="demo/common/ajaxTimeout.html" target="dialog">dialog会话超时</a></li>
                    <li><a href="demo/common/ajaxDone_loadPage_error.html" target="navTab">navTab加载页面验证失败</a></li>
                    <li><a href="demo/common/ajaxDone_loadPage_error.html" target="dialog">dialog加载页面验证失败</a></li>
                    <li><a href="index_menu.html" target="_blank">横向导航条</a></li>
                    <li><a href="miscDragScreen1.html" target="_blank">屏幕拖拽配制示例</a></li>
                </ul>
            </li>

            <li><a>常用组件</a>
                <ul>
                    <li><a href="w_panel.html" target="navTab" rel="w_panel">面板</a></li>
                    <li><a href="w_tabs.html" target="navTab" rel="w_tabs">选项卡面板</a></li>
                    <li><a href="w_dialog.html" target="navTab" rel="w_dialog">弹出窗口</a></li>
                    <li><a href="w_alert.html" target="navTab" rel="w_alert">提示窗口</a></li>
                    <li><a href="w_list.html" target="navTab" rel="w_list">CSS表格容器</a></li>
                    <li><a href="demo_page1.html" target="navTab" rel="w_table">表格容器</a></li>
                    <li><a href="w_removeSelected.html" target="navTab" rel="w_table">表格数据库排序+批量删除</a></li>
                    <li><a href="w_tree.html" target="navTab" rel="w_tree">树形菜单</a></li>
                    <li><a href="w_accordion.html" target="navTab" rel="w_accordion">滑动菜单</a></li>
                    <li><a href="w_editor.html" target="navTab" rel="w_editor">编辑器</a></li>
                    <li><a href="w_datepicker.html" target="navTab" rel="w_datepicker">日期控件</a></li>
                    <li><a href="demo/database/db_widget.html" target="navTab" rel="db">suggest+lookup+主从结构</a></li>
                    <li><a href="demo/database/treeBringBack.html" target="navTab" rel="db">tree查找带回</a></li>
                    <li><a href="demo/sortDrag/1.html" target="navTab" rel="sortDrag">单个sortDrag示例</a></li>
                    <li><a href="demo/sortDrag/2.html" target="navTab" rel="sortDrag">多个sortDrag示例</a></li>
                    <li><a href="demo/sortDrag/form.html" target="navTab" rel="sortDrag">可拖动表单示例</a></li>
                </ul>
            </li>

            <li><a>表单组件</a>
                <ul>
                    <li><a href="w_validation.html" target="navTab" rel="w_validation">表单验证</a></li>
                    <li><a href="w_button.html" target="navTab" rel="w_button">按钮</a></li>
                    <li><a href="w_textInput.html" target="navTab" rel="w_textInput">文本框/文本域</a></li>
                    <li><a href="w_combox.html" target="navTab" rel="w_combox">下拉菜单</a></li>
                    <li><a href="w_checkbox.html" target="navTab" rel="w_checkbox">多选框/单选框</a></li>
                    <li><a href="demo_upload.html" target="navTab" rel="demo_upload">iframeCallback表单提交</a></li>
                    <li><a href="w_uploadify.html" target="navTab" rel="w_uploadify">uploadify多文件上传</a></li>
                    <li><a href="w_html5_upload.html" target="navTab" rel="html5_upload">html5文件上传</a></li>
                </ul>
            </li>
            <li><a>组合应用</a>
                <ul>
                    <li><a href="demo/pagination/layout1.html" target="navTab" rel="pagination1">局部刷新分页1</a></li>
                    <li><a href="demo/pagination/layout2.html" target="navTab" rel="pagination2">局部刷新分页2</a></li>
                </ul>
            </li>
            <li><a>echarts图表</a>
                <ul>
                    <li><a href="chart/test/barchart.html" target="navTab" rel="chart">柱状图(垂直)</a></li>
                    <li><a href="chart/test/hbarchart.html" target="navTab" rel="chart">柱状图(水平)</a></li>
                    <li><a href="chart/test/linechart.html" target="navTab" rel="chart">折线图</a></li>
                    <li><a href="chart/test/linechart2.html" target="navTab" rel="chart">曲线图</a></li>
                    <li><a href="chart/test/piechart.html" target="navTab" rel="chart">饼图</a></li>
                </ul>
            </li>
            <li><a href="dwz.frag.xml" target="navTab" external="true">dwz.frag.xml</a></li>
        </ul>
    </div>
    <div class="accordionHeader">
        <h2><span>Folder</span>典型页面</h2>
    </div>
    <div class="accordionContent">
        <ul class="tree treeFolder treeCheck">
            <li><a href="demo_page1.html" target="navTab" rel="demo_page1">查询我的客户</a></li>
            <li><a href="demo_page1.html" target="navTab" rel="demo_page2">表单查询页面</a></li>
            <li><a href="demo_page4.html" target="navTab" rel="demo_page4">表单录入页面</a></li>
            <li><a href="demo_page5.html" target="navTab" rel="demo_page5">有文本输入的表单</a></li>
            <li><a href="javascript:;">有提示的表单输入页面</a>
                <ul>
                    <li><a href="javascript:;">页面一</a></li>
                    <li><a href="javascript:;">页面二</a></li>
                </ul>
            </li>
            <li><a href="javascript:;">选项卡和图形的页面</a>
                <ul>
                    <li><a href="javascript:;">页面一</a></li>
                    <li><a href="javascript:;">页面二</a></li>
                </ul>
            </li>
            <li><a href="javascript:;">选项卡和图形切换的页面</a></li>
            <li><a href="javascript:;">左右两个互动的页面</a></li>
            <li><a href="javascript:;">列表输入的页面</a></li>
            <li><a href="javascript:;">双层栏目列表的页面</a></li>
        </ul>
    </div>
    <div class="accordionHeader">
        <h2><span>Folder</span>流程演示</h2>
    </div>
    <div class="accordionContent">
        <ul class="tree">
            <li><a href="newPage1.html" target="dialog" rel="dlg_page">列表</a></li>
            <li><a href="newPage1.html" target="dialog" rel="dlg_page2">列表</a></li>
        </ul>
    </div>
</div>-->
            <div class="accordion dwz-accordion" fillSpace="sidebar">
                <?php echo $current_menu; ?>
            </div>
        </div>
    </div>

    <!-- 内容区域 -->
    <div id="container">
        <div id="navTab" class="tabsPage" style="text-align:left;">
            <div class="tabsPageHeader">
                <div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
                    <ul class="navTab-tab">
                        <li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
                    </ul>
                </div>
                <div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
                <div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
                <div class="tabsMore">more</div>
            </div>
            <ul class="tabsMoreList">
                <li><a href="javascript:;">我的主页</a></li>
            </ul>
            <div class="navTab-panel tabsPageContent layoutBox">
    <div class="page unitBox">
        <div class="accountInfo">
            <div class="alertInfo">
                <p><a href="https://gitee.com/dwzteam/dwz_jui/blob/master/doc/dwz-user-guide.pdf" target="_blank" style="line-height:19px"><span>DWZ框架使用手册</span></a></p>
            </div>
            <div class="right">
                <p style="color:red"><?=date('Y-m-d H:i')?></p>
            </div>
            <p><span>供应商系统</span></p>
            <p>Welcome <?php echo \think\Request::instance()->session('username'); ?>(<?php echo \think\Request::instance()->session('nickname'); ?>)</a></p>
        </div>
        <div class="pageFormContent" layoutH="80">
            <fieldset class="nowrap">
                <legend>我的工作台</legend>

            </fieldset>
        </div>
    </div>
</div>
        </div>
    </div>

</div>

<div id="footer">Copyright &copy; 2018 <a href="demo_page2.html" target="dialog">腾辉供应商系统</a></div>

</body>
<script type="text/javascript" src="/tenflyer/public/static/admin/js/admin.js?v=1.0.1"></script>
</html>