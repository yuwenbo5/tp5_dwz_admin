<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\system\add_user_group.html";i:1536218208;}*/ ?>
<h2 class="contentTitle">新增用户分组</h2>
<div class="pageContent">

    <form method="post" action="<?php echo url('system/saveUserGroup'); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this)">
        <input type="hidden" name="action" value="<?php echo !empty($id)?'update' : 'add'; ?>" />
        <div class="pageFormContent nowrap" layoutH="97">

            <dl>
                <dt>分组名称：</dt>
                <dd>
                    <input type="text" name="name" maxlength="30" class="required" />
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>分组状态：</dt>
                <dd>
                    <select class="required" name="status">
                        <option value="all">请选择</option>
                        <?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): if( count($status)==0 ) : echo "" ;else: foreach($status as $key=>$val): ?>
                        <option value="<?php echo $key; ?>" <?php if(!empty($key)) echo "selected"; ?>><?php echo $val; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>分组描述：</dt>
                <dd>
                    <textarea name="desc" rows="3" cols="50"></textarea>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>分配菜单：</dt>
                <dd>
                    <select name="pid">
                        <option value="0">请选择</option>

                    </select>
                    <span class="info"></span>
                </dd>
            </dl>

            <dl>
                <dt>分配权限：</dt>
                <dd>
                    <input type="text" name="sort" maxlength="30" class="required" alt="排序号"/>
                    <span class="info"></span>
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

