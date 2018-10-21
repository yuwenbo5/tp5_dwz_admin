<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\system\group_menu.html";i:1537801868;}*/ ?>
<div class="page">
    <div class="pageContent pageForm">
        <div class="pageFormContent" layoutH="58">
            <div id="menu_list" style="list-style:none;">
                <?php if(is_array($group_menu_list) || $group_menu_list instanceof \think\Collection || $group_menu_list instanceof \think\Paginator): if( count($group_menu_list)==0 ) : echo "" ;else: foreach($group_menu_list as $key=>$menu_table): ?>
                    <li class="menu_item" style="float:left;list-style:none;padding:8px;">
                        <input type="checkbox" onclick="selectItemMenu(this);" value="li_all"/>全选
                        <h3 style="color:#333;font-size:14px;"><input type="checkbox" name="menu_ids[]" value="<?php echo $menu_table['id']; ?>"/><?php echo $menu_table['name']; ?></h3>
                        <?php echo $menu_table['son_menu']; ?>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <li style="clear:both;list-style:none;"></li>
            </div>
        </div>
        <div class="formBar">
            <ul>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">关闭</button></div></div></li>
            </ul>
        </div>
    </div>
</div>