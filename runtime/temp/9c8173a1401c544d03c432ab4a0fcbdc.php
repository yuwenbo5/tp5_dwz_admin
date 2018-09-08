<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:77:"E:\xampp\htdocs\tenflyer\public/../application/index\view\product\import.html";i:1526631479;s:66:"E:\xampp\htdocs\tenflyer\application\index\view\public\header.html";i:1526628303;s:64:"E:\xampp\htdocs\tenflyer\application\index\view\public\menu.html";i:1526629284;s:66:"E:\xampp\htdocs\tenflyer\application\index\view\public\footer.html";i:1526627296;}*/ ?>
<!DOCTYPE HTML>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>腾辉供应商产品管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="tenflyer,腾辉电子商务有限公司">
    <script src="/tenflyer/public/static/common/js/jquery.min.js" type="text/javascript"></script>
    <script src="/tenflyer/public/static/index/js/charisma.js" type="text/javascript"></script>
    <!-- The styles -->
    <link id="bs-css" href="/tenflyer/public/static/index/css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="/tenflyer/public/static/index/css/charisma-app.css" rel="stylesheet">
    <!-- The fav icon -->
    <link rel="shortcut icon" href="/tenflyer/public/static/index/img/favicon.ico">
</head>

<body>
<!-- topbar starts -->
<div class="navbar navbar-default" role="navigation">

    <div class="navbar-inner" style="padding-left:80px;">
        <a class="navbar-brand" href="<?php echo url('index/index'); ?>" style="display:inline-block;width:300px;"> <img alt="Tenflyer Logo" src="/tenflyer/public/static/index/img/logo.png" class="hidden-xs" style="width:80px;"/>
            <span>Tenflyer</span>
        </a>

        <!-- user dropdown starts -->
        <div class="btn-group pull-right" style="padding-right:80px;">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"><?php echo \think\Request::instance()->session('nickname'); ?></span>
                <span class="caret"></span>
            </button>
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" onclick="logout();">
                <a href="javascript:;">退出登录</a>
                <span class="caret"></span>
            </button>
        </div>
    </div>
</div>
<script>
    //退出登录
    function logout(){
        window.location.href = "<?php echo url('Login/loginOut'); ?>";
    }
</script>
<!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        <!-- left menu starts -->

        <!--菜单栏-->
<div class="col-sm-2 col-lg-2">
    <div class="sidebar-nav" style="height:80%;">
        <div class="nav-canvas">
            <ul class="nav nav-pills nav-stacked main-menu">
                <li class="nav-header" style="height:40px;line-height:40px;">菜单列表</li>
                <li><a href="<?php echo url('index/index'); ?>"><i class="glyphicon glyphicon-home"></i><span>主页</span></a>
                </li>
                <li><a href="<?php echo url('product/index'); ?>"><i class="glyphicon glyphicon-list"></i><span>产品列表</span></a>
                </li>
                <li><a href="<?php echo url('product/add'); ?>"><i class="glyphicon glyphicon-plus"></i><span>产品添加</span></a>
                </li>
                <li><a href="<?php echo url('product/import'); ?>"><i class="	glyphicon glyphicon-open"></i><span>产品导入</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>



        <!-- left menu ends -->

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo url('index/index'); ?>">主页</a>
                    </li>
                    <li>
                        <a href="#">产品导入</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                            <h2>产品导入</h2>
                            <div class="box-icon" style="font-size:12px;width:150px;height:30px;">
                                <input type="button" class="btn-primary btn-xs" onclick="saveSubmit();" value="提交"/>
                                <input type="button" class="btn-primary btn-xs" onclick="location.href='<?php echo url('product/index'); ?>'" value="返回列表"/>
                            </div>
                        </div>
                        <form name="form1" action="<?php echo url('product/save'); ?>" method="post">
                            <input type="hidden" name="ActionId" value="product_import"/>
                            <div class="box-content">
                                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" style="font-size:12px;">
                                    <tr>
                                        <td colspan="4"><h5><i class="glyphicon glyphicon-edit"></i>导入模板</h5></td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">模板下载</td>
                                        <td colspan="3">
                                            <a href="#">点击下载模板</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><h5><i class="glyphicon glyphicon-edit"></i>产品导入</h5></td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">产品文件上传</td>
                                        <td colspan="3">
                                            <input type="file" name="product_file" value="请选择文件"/><span class="tip require_add"> *csv、xls、xlsx格式</span>
                                        </td>
                                    </tr>
                                </table>
                                <button type="button" class="btn btn-primary" onclick="saveSubmit();">提交保存</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/span-->

            </div><!--/row-->

            <!-- content ends -->
        </div>

    </div>
</div>

<script>
    $("table tr td").css('vertical-align','middle');
    //提交保存
    function saveSubmit(){
        //文件
        if($("input[type='file']").val() == ''){
            alert("请选择产品表格文件上传！");
            return false;
        }
        document.form1.submit();
    }
</script>

<!--底部-->
<p style="width:100%;height:40px;"></p>
<div  style="width:100%;height:40px;line-height:40px;position:fixed;bottom:0;left:0;background:#EAEAEA;border-top:1px solid #ABADB3;border-bottom:1px solid #ABADB3;text-align:center;">
    <footer class="row">
        <p class="col-md-12 col-sm-12 col-xs-12 copyright">&copy; <a href="javascript:;" onclick="window.location.reload();">Supply Of Tenflyer</a> 2018</p>
    </footer>
</div>
</body>
</html>
