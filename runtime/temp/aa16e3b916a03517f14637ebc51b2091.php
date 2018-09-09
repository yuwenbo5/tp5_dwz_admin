<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"E:\phpStudy\WWW\tenflyer\public/../application/admin\view\system\user_group_list.html";i:1536379567;}*/ ?>
<form id="pagerForm" method="post" action="demo_page1.html">
    <input type="hidden" name="status" value="${param.status}">
    <input type="hidden" name="keywords" value="${param.keywords}" />
    <input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="${model.numPerPage}" />
    <input type="hidden" name="orderField" value="${param.orderField}" />
</form>


<div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="" method="post" onreset="$(this).find('select.combox').comboxReset()">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        分组名称：<input type="text" name="name" />
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
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="demo_page4.html" target="navTab"><span>添加</span></a></li>
            <li><a class="delete" href="demo/common/ajaxDone.html?uid={sid_user}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li><a class="edit" href="demo_page4.html?uid={sid_user}" target="navTab"><span>修改</span></a></li>
            <li class="line">line</li>
            <li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="138">
        <thead>
        <tr>
            <th width="80" align="center">序号</th>
            <th width="80" align="center">分组ID</th>
            <th width="120" align="center">分组名称</th>
            <th width="80" align="center">状态</th>
            <th width="150" align="center">描述</th>
            <th width="150" align="center">所有菜单</th>
            <th width="150" align="center">所有权限</th>
            <th width="80" align="center">更新时间</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($user_group_list) || $user_group_list instanceof \think\Collection || $user_group_list instanceof \think\Paginator): if( count($user_group_list)==0 ) : echo "" ;else: foreach($user_group_list as $key=>$user_group): ?>
        <tr height="30">
            <td><?php echo $user_group['id']; ?></td>
            <td><?php echo $user_group['id']; ?></td>
            <td><?php echo $user_group['name']; ?></td>
            <td><?php echo $user_group['status']; ?></td>
            <td><?php echo $user_group['desc']; ?></td>
            <td><?php echo $user_group['menu_ids']; ?></td>
            <td><?php echo $user_group['auth_ids']; ?></td>
            <td><?php echo $user_group['operate_time']; ?></td>
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