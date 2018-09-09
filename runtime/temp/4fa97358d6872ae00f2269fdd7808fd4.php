<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"E:\phpStudy\WWW\tenflyer\public/../application/admin\view\system\add_auth.html";i:1536402786;}*/ ?>
<h2 class="contentTitle">添加权限</h2>
<div class="pageContent">

    <form method="post" action="<?php echo url('system/saveAuth'); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this)">
        <input type="hidden" name="action" value="<?php echo !empty($id)?'update' : 'add'; ?>" />
        <div class="pageFormContent nowrap" layoutH="97">

            <dl>
                <dt>权限名称：</dt>
                <dd>
                    <input type="text" name="name" maxlength="30" class="required" />
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>权限描述：</dt>
                <dd>
                    <textarea name="desc" rows="3" cols="50"></textarea>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>所属菜单：</dt>
                <dd>
                    <select name="menu_id">
                        <option value="0">请选择</option>
                        <?php echo $menu_tree; ?>
                    </select>
                    <span class="info"></span>
                </dd>
            </dl>

            <dl>
                <dt>添加权限码：</dt>
                <dd>
                    <select onchange="getActList(this)" id="controller">
                        <option value="0">选择控制器</option>
                        <?php if(is_array($controller_list) || $controller_list instanceof \think\Collection || $controller_list instanceof \think\Paginator): if( count($controller_list)==0 ) : echo "" ;else: foreach($controller_list as $key=>$controller): ?>
                        <option value="<?php echo $controller; ?>"><?php echo $controller; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <span class="info"></span>
                    <ul id="act_list">
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt>权限码：</dt>
                <dd>
                    <table>
                        <tbody>
                        <tr><th style="width:80%">权限码</th><th style="width: 50px;text-align: center;">操作</th></tr>
                        </tbody>
                        <tbody id="rightList">
                        </tbody>
                    </table>
                </dd>
            </dl>
        </div>
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
<script>
    function chkboxBind(){
        $('input:checkbox').change(function () {
            var is_check = $(this).prop('checked');
            var ncode = $('#controller').val();
            var row_id = ncode+'_'+ $(this).val();
            if(is_check){
                var a = [];
                $('#rightList .form-control').each(function(i,o){
                    if($(o).val() != ''){
                        a.push($(o).val());
                    }
                });
                if(ncode !== ''){
                    var temp = ncode+'@'+ $(this).val();
                    if($.inArray(temp,a) != -1){
                        return ;
                    }
                }else{
                    layer.alert("请选择控制器" , {icon:2,time:1000});
                    return;
                }
                var strtr = "<tr id="+row_id+">";
                if(ncode!= ''){
                    strtr += '<td><input type="text" name="auth[]" value="'+ncode+'@'+ $(this).val()+'" class="form-control" style="width:300px;"></td>';
                }else{
                    strtr += '<td><input type="text" name="auth[]" value="" class="form-control" style="width:300px;"></td>';
                }
                strtr += '<td style="text-align: center;"><a href="javascript:;" class="ncap-btn" onclick="$(this).parent().parent().remove();">删除</a></td>';
                $('#rightList').append(strtr);
            }else{
                $("#"+row_id).remove();
            }
        });
    }
    chkboxBind();
    function getActList(obj){
        var controller = $(obj).val();
        $.ajax({
            url: "<?php echo url('system/ajaxGetAction'); ?>",
            type:'post',
            data: {'type':0,'controller':controller},
            dataType:'html',
            success:function(res){
                $('#act_list').empty().append(res);
                chkboxBind();
                updateActCheck();
            }
        });
    }
    function updateActCheck() {
        var acts = $('input.form-control');
        var controller = $('#controller').val();
        $('input:checkbox').each(function(){
            var act = controller +'@'+ $(this).val();
            for (var i = 0; i < acts.length; i++) {
                if ($(acts[i]).val() === act) {
                    $(this).attr('checked', true);
                    break;
                }
            }
        });
    }
</script>

