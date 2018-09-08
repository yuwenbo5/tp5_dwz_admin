<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\system\add_menu.html";i:1535962412;}*/ ?>
<h2 class="contentTitle">添加菜单</h2>
<div class="pageContent">

    <form method="post" action="<?php echo url('system/savemenu'); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this)">
        <input type="hidden" name="action" value="<?php echo !empty($id)?'update' : 'add'; ?>" />
        <div class="pageFormContent nowrap" layoutH="97">

            <dl>
                <dt>菜单名称：</dt>
                <dd>
                    <input type="text" name="name" maxlength="30" class="required" />
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>菜单规则：</dt>
                <dd>
                    <input type="text" name="rule" size="30"/>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>上级菜单：</dt>
                <dd>
                    <select name="pid">
                        <option value="0">请选择</option>
                        <?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): if( count($menu_list)==0 ) : echo "" ;else: foreach($menu_list as $key=>$val): ?>
                            <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>菜单状态：</dt>
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
                <dt>菜单排序：</dt>
                <dd>
                    <input type="text" name="sort" maxlength="30" class="required" alt="排序号"/>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>备注：</dt>
                <dd><textarea name="remark" cols="80" rows="2" class="textInput"></textarea></dd>
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

