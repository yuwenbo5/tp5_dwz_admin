<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"E:\xampp\htdocs\tenflyer\public/../application/index\view\product\add.html";i:1526692666;s:66:"E:\xampp\htdocs\tenflyer\application\index\view\public\header.html";i:1526628303;s:64:"E:\xampp\htdocs\tenflyer\application\index\view\public\menu.html";i:1526629284;s:66:"E:\xampp\htdocs\tenflyer\application\index\view\public\footer.html";i:1526627296;}*/ ?>
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
                        <a href="#">产品添加</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                            <h2></h2>
                            <div class="box-icon" style="font-size:12px;width:150px;height:30px;">
                                <input type="button" class="btn-primary btn-xs" onclick="saveSubmit();" value="保存"/>
                                <input type="button" class="btn-primary btn-xs" onclick="location.href='<?php echo url('product/index'); ?>'" value="返回列表"/>
                            </div>
                        </div>
                        <form name="form1" action="<?php echo url('product/save'); ?>" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="ActionId" value=""/>
                            <input type="hidden" name="id" value=""/>
                            <div class="box-content">
                                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" style="font-size:12px;">
                                    <tr>
                                        <td colspan="4"><h5><i class="glyphicon glyphicon-edit"></i>基本信息</h5></td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">供应商产品编号</td>
                                        <td colspan="3">
                                            <input type="text" style="width:200px;" name="sku" value="">
                                            <span class="tip_span not_require_add"> *选填</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">产品分类</td>
                                        <td colspan="3">
                                            <label>
                                                一级分类:
                                                <select name="new_id1" id="new_id1" style="font-weight:200;" onchange="getCateList(this,1);">
                                                    <option value=""> -- </option>
                                                    <?php if(is_array($newClass) || $newClass instanceof \think\Collection || $newClass instanceof \think\Paginator): if( count($newClass)==0 ) : echo "" ;else: foreach($newClass as $key=>$value): ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </label>
                                            <label>
                                                二级分类:
                                                <select name="new_id2" id="new_id2" style="font-weight:200;" onchange="getCateList(this,2);">
                                                    <option value=""> -- </option>

                                                </select>
                                            </label>
                                            <label>
                                                三级分类:
                                                <select name="new_id3" id="new_id3" style="font-weight:200;">
                                                    <option value=""> -- </option>

                                                </select>
                                            </label>
                                            <span class="tip_span require_add"> *必选</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">中文名称</td>
                                        <td colspan="3">
                                            <input type="text" name="ctitle" value="" style="width:500px;"/>
                                            <span class="tip_span require_add"> *必填</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">英文名称</td>
                                        <td colspan="3">
                                            <input type="text" name="etitle" value="" style="width:500px;"/>
                                            <span class="tip_span not_require_add"> *选填</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">产品基本描述</td>
                                        <td colspan="3">
                                            <textarea name="goods_description" rows="3" style="width:500px;resize:none;"></textarea>
                                            <span class="tip_span require_add"> *必填</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">中文链接</td>
                                        <td colspan="3">
                                            <input type="text" name="cn_url" value="" style="width:500px;"/>
                                            <span class="tip_span not_require_add"> *选填</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">英文参考链接</td>
                                        <td colspan="3">
                                            <input type="text" name="en_url" value="" style="width:500px;"/>
                                            <span class="tip_span not_require_add"> *选填</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">成本及重量</td>
                                        <td colspan="3">
                                            <label>成本:<input type="text" name="cost" value="" style="width:100px;"/></label>
                                            <span class="tip_span require_add" style="margin-right:20px;"> *(CNY)</span>
                                            <label>重量:<input type="text" name="ship_weight" value="" style="width:100px;"/></label>
                                            <span class="tip_span require_add"> *必填(g)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">尺寸（CM）</td>
                                        <td colspan="3">
                                            <label>长:<input type="text" name="package_length" value="" style="width:70px;"/></label>
                                            <span style="margin-right:30px;"></span>
                                            <label>宽:<input type="text" name="package_width" value="" style="width:70px;"/></label>
                                            <span style="margin-right:30px;"></span>
                                            <label>高:<input type="text" name="package_height" value="" style="width:70px;"/></label>
                                            <span class="tip_span require_add" style="margin-left:20px;"> *必填</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><h5><i class="glyphicon glyphicon-edit"></i>产品多属性</h5></td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">是否多属性</td>
                                        <td colspan="3">
                                            <label>
                                                <input type="radio" style='height:13px; vertical-align:text-top;margin-top:0' name="multi" onclick="isMulti();" value="1" />是
                                            </label>
                                            <span style="margin-right:50px;"></span>
                                            <label>
                                                <input type="radio" style='height:13px; vertical-align:text-top;margin-top:0' name="multi" onclick="isMulti();" value="0" />否
                                            </label>
                                        </td>
                                    </tr>
                                    <tr class="multi_check">
                                        <td align="center" width="16%">多属性选项</td>
                                        <td colspan="3">
                                            <label>
                                                <input type="checkbox" style='height:13px; vertical-align:text-top;margin-top:0;' disabled id="color" onclick="showMultiInput(this);"/>color
                                            </label>
                                            <span style="margin-right:30px;"></span>
                                            <label>
                                                <input type="checkbox" style='height:13px; vertical-align:text-top;margin-top:0'  disabled id="size" onclick="showMultiInput(this);"/>size
                                            </label>
                                            <span style="margin-right:30px;"></span>
                                            <label>
                                                <input type="checkbox" style='height:13px; vertical-align:text-top;margin-top:0' disabled id="style" onclick="showMultiInput(this);"/>style
                                            </label>
                                        </td>
                                    </tr>
                                    <tr class="multi_input">
                                        <td align="center" width="16%">多属性值</td>
                                        <td colspan="3">

                                            <p>
                                                <span class="multi_con">
                                                <label>color:<input type="text" name="color[]" value="" style="width:70px;" disabled/></label>
                                                <span style="margin-right:30px;"></span>
                                                <label>size:<input type="text" name="size[]" value="" style="width:70px;" disabled/></label>
                                                <span style="margin-right:30px;"></span>
                                                <label>style:<input type="text" name="style[]" value="" style="width:70px;" disabled/></label>
                                                <span style="margin-right:30px;"></span>
                                                </span>
                                                <input type="button" onclick="addLine(this);" disabled value="增加一行"/>
                                            </p>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><h5><i class="glyphicon glyphicon-edit"></i>产品图片资料</h5></td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">图片上传</td>
                                        <td colspan="3">
                                            <label><input type="file" name='img[]' title='点击选择图片' multiple="multiple"/></label>
                                            <span class="tip_span not_require_add" style="margin-left:20px;"> *可选(可多张上传)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><h5><i class="glyphicon glyphicon-edit"></i>产品其它信息</h5></td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">发货周期</td>
                                        <td colspan="3">
                                            <select class="form-control" name="delivery_cycle" id="delivery_cycle" style="font-weight:200;width:200px;font-size:12px;">
                                                <option value="">--选择发货周期--</option>

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">对应腾辉开发人员</td>
                                        <td colspan="3">
                                            <select class="form-control" name="pended_id" id="pended_id" style="font-weight:200;width:200px;font-size:12px;">
                                                <option value="">--选择开发人员--</option>

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="16%">备注信息</td>
                                        <td colspan="3">
                                            <textarea name="note" rows="3" style="width:500px;resize:none;"></textarea>
                                            <span class="tip_span not_require_add"> *选填</span>
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

    //获取分类列表
    function getCateList(obj,num){
        var cID = $(obj).val();
        var option = '';
        if(cID != ''){
            $.ajax({
                type: "post",
                url: "<?php echo url('product/ajax'); ?>",
                async: false,
                data: {action:'getCateOption',cID:cID},
                dataType:'json',
                success: function(msg) {
                    option = msg.info;
                }
            });
            if(num == 1){
                $("#new_id2").html('<option value=""> -- </option>');
                $("#new_id2").append(option);
                $("#new_id3").html('<option value=""> -- </option>');
            }else if(num == 2){
                $("#new_id3").html('<option value=""> -- </option>');
                $("#new_id3").append(option);
            }
        }else{
            $("select[name^='new_id']").each(function(){
                num = num +1;
                $("#new_id"+num).html('<option value=""> -- </option>');
                $("#new_id"+num).append(option);
            });
        }
    }

    //多属性选择
    function isMulti(){
        if($("input[type='radio']:checked").val() == 1){
            $(".multi_check").find("input[type='checkbox']").attr('disabled',false);
            $(".multi_input").find("input[type='button']").attr('disabled',false);
        }else if($("input[type='radio']:checked").val() == 0){
            $(".multi_check").find("input[type='checkbox']").attr('checked',false);
            $(".multi_check").find("input[type='checkbox']").attr('disabled','disabled');
            $(".multi_input").find("input[type='text']").val('');
            $(".multi_input").find("input[type='text']").attr('disabled',true);
            $(".multi_input").find("input[type='button']").attr('disabled',true);
            $(".multi_input").find("p.add_line").remove();
        }
    }
    //多属性输入
    function showMultiInput(obj){
        var id_attr = $(obj).attr('id');
        if($(obj).attr('checked')){
            $(".multi_input").find("input[name^='"+id_attr+"']").attr('disabled',false);
        }else{
            $(".multi_input").find("input[name^='"+id_attr+"']").val('');
            $(".multi_input").find("input[name^='"+id_attr+"']").attr('disabled',true);
        }
    }
    //多属性增加一行
    function addLine(obj){
        var html = $(obj).prev().html();
        html = '<p class="add_line"><span class="multi_con">' + html + '</span><input type="button" onclick="deleteLine(this);" value="删除"/></p>';
        $(obj).parents('td').append(html);
    }
    //增加行删除
    function deleteLine(obj){
        $(obj).parents("p.add_line").remove();
    }

    //提交保存
    function saveSubmit(){
        //分类选择
        if($("#new_id1").val() == '' && $("#new_id2").val() == '' && $("#new_id3").val() == ''){
            $("#new_id3").focus();
            alert("请选择产品分类！");
            return false;
        }
        //产品中名
        if($.trim($("input[name='ctitle']").val()) == ''){
            $("input[name='ctitle']").focus();
            alert("请填写产品中文名称！");
            return false;
        }else{
            if($.trim($("input[name='ctitle']").val()).length < 3){
                $("input[name='ctitle']").focus();
                alert("中文名称不能少于3个字符！");
                return false;
            }
        }
        //产品描述
        if($.trim($("textarea[name='goods_description']").val()) == ''){
            $("textarea[name='goods_description']").focus();
            alert("请填写产品基本描述！");
            return false;
        }else{
            if($.trim($("textarea[name='goods_description']").val()).length < 3){
                $("textarea[name='goods_description']").focus();
                alert("产品描述不能少于15个字符！");
                return false;
            }
        }
        //成本及重量
        var cost = $.trim($("input[name='cost']").val());
        var ship_weight = $.trim($("input[name='ship_weight']").val());
        if(cost == '' || ship_weight == ''){
            alert("请填写产品成本及重量！");
            return false;
        }
        if(isNaN(cost) || isNaN(ship_weight)){
            alert("成本和重量只能填写数字!");
            return false;
        }
        if(cost <= 0 || ship_weight <= 0){
            alert("成本和重量的值必须大于0！");
            return false;
        }

        //长宽高
        var length = $.trim($("input[name='package_length']").val());
        var width = $.trim($("input[name='package_width']").val());
        var height = $.trim($("input[name='package_height']").val());
        if(length == '' || width == '' || height == ''){
            alert("请填写产品长宽高尺寸！");
            return false;
        }
        if(isNaN(length) || isNaN(width) || isNaN(height)){
            alert("产品长宽高只能填写数字!");
            return false;
        }
        if(length <= 0 || width <= 0 || height <= 0){
            alert("产品长宽高的值必须大于0！");
            return false;
        }
        //多属性勾选后必须填写
        if($("input[type='radio']:checked").val() == 1){
            var color_len = 0;
            var size_len = 0;
            var style_len = 0;
            $(".multi_input").find("input[name='color[]']").each(function(){
                if($(this).val() != ''){
                    color_len ++;
                }
            });
            $(".multi_input").find("input[name='size[]']").each(function(){
                if($(this).val() != ''){
                    size_len ++;
                }
            });
            $(".multi_input").find("input[name='style[]']").each(function(){
                if($(this).val() != '') {
                    style_len++;
                }
            });
            if(color_len == 0 && size_len == 0 && style_len == 0){
                alert("多属性产品必须填写多属性值！");
                return false;
            }
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
