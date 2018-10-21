<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\system\add_user.html";i:1538836217;}*/ ?>
<h2 class="contentTitle">新增用户</h2>
<div class="pageContent">
    <form method="post" action="<?php echo url('system/saveUser'); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this)">
        <input type="hidden" name="action" value="<?php echo !empty($id)?'update' : 'add'; ?>" />
        <div class="pageFormContent nowrap" layoutH="97">
            <dl>
                <dt>用户(登录)名：</dt>
                <dd>
                    <input type="text" name="username" maxlength="30" class="required" size="30"/>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>昵称：</dt>
                <dd>
                    <input type="text" name="nickname" maxlength="30" class="required" size="30"/>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>email：</dt>
                <dd>
                    <input type="text" name="email" maxlength="32" size="30"/>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>用户状态：</dt>
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
                <dt>主分组：</dt>
                <dd>
                    <select class="required" name="main_group_id" style="width:100px;">
                        <option value="all">请选择</option>
                        <?php if(is_array($group_list) || $group_list instanceof \think\Collection || $group_list instanceof \think\Paginator): if( count($group_list)==0 ) : echo "" ;else: foreach($group_list as $key=>$group): ?>
                        <option value="<?php echo $group['name']; ?>"><?php echo $group['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>附加分组：</dt>
                <dd>
                    <ul style="border:1px dashed #ccc;padding:10px 0 10px 0;width:550px;">
                        <?php if(is_array($group_list) || $group_list instanceof \think\Collection || $group_list instanceof \think\Paginator): if( count($group_list)==0 ) : echo "" ;else: foreach($group_list as $key=>$group): ?>
                        <li>
                            <label><input class='checkbox' name='sub_group_ids' value='<?php echo $group['id']; ?>' type='checkbox'><?php echo $group['name']; ?></label>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <li style="clear:both;"></li>
                    </ul>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>用户备注：</dt>
                <dd>
                    <textarea name="remark" rows="3" cols="50"></textarea>
                    <span class="info"></span>
                </dd>
            </dl>
            <dl>
                <dt>分配菜单：</dt>
                <dd style="border:1px solid #ccc;">
                    <!--<input type="checkbox" onclick="selectAllMenu(this);" class="select_all" value="all"/>全部-->
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
                <dd style="border:1px solid #ccc;">
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

