<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\system\add_user_group.html";i:1538827919;}*/ ?>
<h2 class="contentTitle">新增用户分组</h2>
<div class="pageContent">
    <form method="post" action="<?php echo url('system/saveUserGroup'); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this)">
        <input type="hidden" name="action" value="<?php echo !empty($id)?'update' : 'add'; ?>" />
        <div class="pageFormContent nowrap" layoutH="97" style="padding-left:60px;">

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
                    <!--<input type="checkbox" onclick="selectAllMenu(this);" class="select_all" value="all"/>全部-->
                    <hr/>
                    <ul class="tree treeFolder treeCheck expand" oncheck="test_check_tree" id="menu_list">
                        <?php if(is_array($menu_table_tree) || $menu_table_tree instanceof \think\Collection || $menu_table_tree instanceof \think\Paginator): if( count($menu_table_tree)==0 ) : echo "" ;else: foreach($menu_table_tree as $key=>$menu_table): ?>
                            <li>
                                <a tname="menu_ids[]" tvalue="<?php echo $menu_table['id']; ?>"><b><?php echo $menu_table['name']; ?></b></a>
                                <ul>
                                    <?php echo $menu_table['son_menu']; ?>
                                </ul>
                            </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <span class="info"></span>
                    </ul>
                </dd>
            </dl>

            <dl>
                <dt>分配权限：</dt>
                <dd>
                    <input type="checkbox" onclick="selectAllAuth(this);" class="select_all" value="all"/>全部
                    <div id="auth_list" style="list-style:none;color:#888;">
                        <?php echo $auth_menu_tree; ?>
                        <span class="info"></span>
                    </div>
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
<script type="text/javascript" src="/tenflyer/public/static/admin/js/form.js"></script>

