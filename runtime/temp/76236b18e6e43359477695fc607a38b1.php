<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"E:\xampp\htdocs\tenflyer\public/../application/index\view\product\list.html";i:1526708431;s:66:"E:\xampp\htdocs\tenflyer\application\index\view\public\header.html";i:1526628303;s:64:"E:\xampp\htdocs\tenflyer\application\index\view\public\menu.html";i:1526629284;s:66:"E:\xampp\htdocs\tenflyer\application\index\view\public\footer.html";i:1526627296;}*/ ?>
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
                        <a href="<?php echo url('product/index'); ?>">产品列表</a>
                    </li>
                </ul>
            </div>
            <form name="form1" id="checkForm" action="<?php echo url('product/index'); ?>" method="post">
                <div class="row">
                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div style="font-size:12px;margin-top:10px;padding-left:10px;">
                                <label>
                                    <input type="text" class="form-control" placeholder="产品编号" name="sku" title="精确查询" value="">
                                </label>
                                <label>
                                    <input type="text" class="form-control" placeholder="产品名称" name="ctitle" title="支持模糊查询" value="">
                                </label>
                                <label>
                                    审核状态：<select name="audit_status" style="border-color:#DDD;border-radius:3px;">
                                    <option value="">不限</option>
                                    <?php if(is_array($audit_status) || $audit_status instanceof \think\Collection || $audit_status instanceof \think\Paginator): if( count($audit_status)==0 ) : echo "" ;else: foreach($audit_status as $key=>$value): ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                </label>
                                <label>
                                    分页：<select name="pageNums" style="border-color:#DDD;border-radius:3px;">
                                    <?php if(is_array($page_list) || $page_list instanceof \think\Collection || $page_list instanceof \think\Paginator): if( count($page_list)==0 ) : echo "" ;else: foreach($page_list as $key=>$value): ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                </label>
                                <label>
                                    <select name="order" style="border-color:#DDD;border-radius:3px;">
                                        <?php 
                                            foreach($order_arr as $key => $value){
                                                if($value['is_default'] == 1){
                                                     ?>
                                                    <option value="<?php echo $key; ?>" selected><?php echo $value['name']; ?></option>
                                                    <?php 
                                                }else{
                                                     ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value['name']; ?></option>
                                                    <?php 
                                                }
                                            }
                                         ?>
                                    </select>
                                </label>
                                <label>
                                    <select name="order_by" style="border-color:#DDD;border-radius:3px;">
                                    <?php 
                                        foreach($order_list as $key => $value){
                                            if($value['is_default'] == 1){
                                                 ?>
                                                <option value="<?php echo $key; ?>" selected><?php echo $value['name']; ?></option>
                                                <?php 
                                            }else{
                                                 ?>
                                                <option value="<?php echo $key; ?>"><?php echo $value['name']; ?></option>
                                                <?php 
                                            }
                                        }
                                     ?>
                                    </select>
                                </label>
                                <input type="submit" class="btn btn-primary" name="searchsubmit" value="查询">
                            </div>
                            <div class="box-header well" data-original-title="">
                                <h2>产品列表</h2>
                                <div class="box-icon" style="font-size:12px;width:150px;height:30px;">
                                    <input type="button" class="btn btn-primary btn-xs" onclick="ActionTo('update',1,'<?php echo url('product/edit'); ?>',0);" value="修改"/>
                                    <input type="button" class="btn btn-primary btn-xs" onclick="ActionTo('delete',2,'<?php echo url('product/del_product'); ?>',1);" value="删除"/>
                                </div>
                            </div>
                            <div class="box-content">
                                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" style="font-size:12px;">
                                    <thead>
                                    <tr>
                                        <th style="width:20px;">选项</th>
                                        <th style="width:20px;">序号</th>
                                        <th style="width:80px;">产品编号</th>
                                        <th style="width:80px;">新分类</th>
                                        <th style="width:120px;">中文名称</th>
                                        <th style="width:40px;">成本(CNY)</th>
                                        <th style="width:40px;">重量(g)</th>
                                        <th>产品描述</th>
                                        <th style="width:30px;">长(CM)</th>
                                        <th style="width:30px;">宽(CM)</th>
                                        <th style="width:30px;">高(CM)</th>
                                        <th style="width:50px;">中文链接</th>
                                        <th style="width:50px;">英文链接</th>
                                        <th style="width:70px;">审核状态</th>
                                        <th style="width:80px;">添加时间</th>
                                        <th style="width:70px;">对接开发</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($product_list) || $product_list instanceof \think\Collection || $product_list instanceof \think\Paginator): if( count($product_list)==0 ) : echo "" ;else: foreach($product_list as $key=>$value): ?>
                                        <tr class="trLine">
                                            <td class="center"><input type="checkbox" name="checkid[]" value="<?php echo $value['id']; ?>"/></td>
                                            <td class="center"><?php echo $key; ?></td>
                                            <td class="center" style="width:80px;"><?php echo $value['sku']; ?></td>
                                            <td class="center"><?php echo $value['cat_id']; ?></td>
                                            <td class="center" style="width:140px;"><?php echo $value['ctitle']; ?></td>
                                            <td class="center"><?php echo $value['cost']; ?></td>
                                            <td class="center"><?php echo $value['ship_weight']; ?></td>
                                            <!--显示中文描述-->
                                            <td class="center" style="width:40px;">
                                                <div style="position:relative;" onmouseover="showDesc(this);" onmouseout="hideDesc(this);">
                                                    <img border=0 src="/tenflyer/public/static/index/img/list.gif"><div class="col-md-3 col-sm-3 col-xs-6" style="width:200px;min-height:50px;position:absolute;left:50%;top:40%;z-index:999;display:none;"><a data-toggle="tooltip" title="" class="well top-block" href="#"  style="background:#E4EEFC;"><div style="background:#E4EEFC;font-size:12px;font-weight:300;"><?php echo $value['goods_description']; ?></div></a>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="center"><?php echo $value['package_length']; ?></td>
                                            <td class="center"><?php echo $value['package_width']; ?></td>
                                            <td class="center"><?php echo $value['package_height']; ?></td>
                                            <td class="center"><a href="<?php echo $value['cn_url']; ?>" target="_blank" title="<?php echo $value['cn_url']; ?>">中文链接</a></td>
                                            <td class="center"><a href="<?php echo $value['en_url']; ?>" target="_blank" title="<?php echo $value['en_url']; ?>">英文链接</a></td>
                                            <!--显示审核备注-->
                                            <td class="center">
                                                <div style="position:relative;" onmouseover="showNote(this);" onmouseout="hideNote(this);">
                                                    <?php echo $value['is_audit']; ?>
                                                    <div class="col-md-3 col-sm-3 col-xs-6" style="width:140px;min-height:50px;position:absolute;left:65%;top:40%;z-index:999;display:none;"><a data-toggle="tooltip" title="" class="well top-block" href="#"  style="background:#E4EEFC;"><div style="background:#E4EEFC;font-size:12px;font-weight:300;"><?php echo $value['note']; ?></div></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="center" style="width:80px;"><?php echo $value['create_date']; ?></td>
                                            <td class="center"><?php echo $value['pended_id']; ?></td>
                                        </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                                <!-- 分页显示 -->
                                <ul class="pagination pagination-centered">
                                    <li><a href="javascript:;" onclick="pageToPage(-1);">Prev</a></li>
                                    <li>
                                        <a href="javascript:;">
                                            <select name="topage" style="border:none;" onchange="javascript:document.form1.submit();">

                                            </select>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;" onclick="pageToPage(1);">Next</a></li>
                                    <li><a href="javascript:;"><span style="padding-left:5px;" id="total_pages" name="">条记录,共页</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
            </form>
        </div><!--/row-->

    </div>
</div>
<script>
    $("table tr th").css('text-align','center');
    $("table tr td").css('text-align','center');
    $("table tr th").css('vertical-align','middle');
    $("table tr td").css('vertical-align','middle');
    $("tr.trLine").click(function(){
        if($(this).find("input[name='checkid[]']").attr('checked')){
            $(this).find("input[name='checkid[]']").attr('checked',false);
        }else{
            $(this).find("input[name='checkid[]']").attr('checked',true);
        }
    });
    $("tr.trLine").find("input[type='checkbox']").click(function(){
        if($(this).attr('checked')){
            $(this).attr('checked',false);
        }else{
            $(this).attr('checked',true);
        }
    });
    //上下页翻页
    function pageToPage(num){
        var page = $("select[name='topage']").val();
        var total_pages = $("#total_pages").attr('name');
        if(num == -1){
            page = parseInt(page) -1;
            if(page < 1){
                page = 1;
            }
        }
        if(num == 1){
            page = parseInt(page) + 1;
            if(page > total_pages){
                page = total_pages;
            }
        }
        $("select[name='topage']").val(page);
        document.form1.submit();
    }

    //显示描述
    function showDesc(obj){
        $(obj).find('img').next().show();
    }
    //影藏描述
    function hideDesc(obj){
        $(obj).find('img').next().hide();
    }
    //显示备注
    function showNote(obj){
        $(obj).find('div').show();
    }
    //影藏备注
    function hideNote(obj){
        $(obj).find('div').hide();
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
