<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\index\myhome.html";i:1536499614;}*/ ?>
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