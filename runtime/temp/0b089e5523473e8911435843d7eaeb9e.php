<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"E:\phpStudy\WWW\tenflyer\public/../application/admin\view\system\auth_list.html";i:1536406968;}*/ ?>
<form onsubmit="return navTabSearch(this);" id="pageList" action="" method="post" onreset="$(this).find('select.combox').comboxReset()">
    <div class="pageHeader">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        权限名称：<input type="text" name="name" />
                    </td>
                    <td>
                        <select class="combox" name="province" ref="demo_combox_city" refUrl="demo/combox/city_{value}.html" reset-value="bj">
                            <option value="all">所有省市</option>
                            <option value="bj">北京</option>
                            <option value="sh">上海</option>
                            <option value="zj">浙江省</option>
                        </select>
                        <select class="combox" name="city" id="demo_combox_city" ref="demo_combox_region" refUrl="demo/combox/region_{value}.html">
                            <option value="all">所有城市</option>
                        </select>
                        <select class="combox" name="region" id="demo_combox_region">
                            <option value="all">所有区县</option>
                        </select>
                    </td>
                    <td>
                        <select class="combox" name="type">
                            <option value="all">所有等级</option>
                            <option value="1">1级</option>
                            <option value="2">2级</option>
                            <option value="3" selected>3级</option>
                        </select>
                    </td>
                    <td class="dateRange">
                        添加日期:
                        <input name="startDate" class="date readonly" readonly="readonly" type="text" value="">
                        <span class="limit">-</span>
                        <input name="endDate" class="date readonly" readonly="readonly" type="text" value="">
                    </td>
                </tr>
            </table>
            <div class="subBar">
                <ul>
                    <li><div class="button"><div class="buttonContent"><button type="reset">重置</button></div></div></li>
                    <li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
                    <li><a class="button" href="demo_page6.html" target="dialog" mask="true" title="查询框"><span>高级检索</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="pageContent">
        <div class="panelBar">
            <ul class="toolBar">
                <li><a class="add" href="<?php echo url('system/addAuth'); ?>" target="navTab"><span>添加</span></a></li>
                <li><a class="delete" href="<?php echo url('system/delete'); ?>?id={}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
                <li><a class="edit" href="demo_page4.html?uid={sid_user}" target="navTab"><span>修改</span></a></li>
                <li class="line">line</li>
                <li><a class="icon" href="javascript:;" target="dwzExport" targetType="navTab" title=""><span>导出EXCEL</span></a></li>
            </ul>
        </div>
        <table class="table" width="100%" layoutH="138">
            <thead>
            <tr>
                <th width="30" align="center">选项</th>
                <th width="80" align="center">序号</th>
                <th width="80" align="center">权限ID</th>
                <th width="120" align="center">权限名称</th>
                <th width="150" align="center">描述</th>
                <th width="150" align="center">所属菜单</th>
                <th width="150" align="center">更新人</th>
                <th width="80" align="center">更新时间</th>
            </tr>
            </thead>
            <tbody class="table_list">
            <?php if(is_array($auth_list) || $auth_list instanceof \think\Collection || $auth_list instanceof \think\Paginator): if( count($auth_list)==0 ) : echo "" ;else: foreach($auth_list as $key=>$auth): ?>
            <tr height="30">
                <td><input type="checkbox" name="checkid[]" id="checkid<?php echo $auth['id']; ?>" value="<?php echo $auth['id']; ?>"/></td>
                <td><?php echo $auth['id']; ?></td>
                <td><?php echo $auth['id']; ?></td>
                <td><?php echo $auth['name']; ?></td>
                <td><?php echo $auth['desc']; ?></td>
                <td><?php echo $auth['menu_id']; ?></td>
                <td><?php echo $auth['operate_id']; ?></td>
                <td><?php echo $auth['operate_time']; ?></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="panelBar">
            <div class="pages">
                <span>显示</span>
                <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
                <span>条，共${totalCount}条</span>
            </div>

            <div class="pagination" targetType="navTab" totalCount="200" numPerPage="20" pageNumShown="10" currentPage="1"></div>

        </div>
    </div>
</form>
<script type="text/javascript" src="/tenflyer/public/static/admin/js/form.js"></script>