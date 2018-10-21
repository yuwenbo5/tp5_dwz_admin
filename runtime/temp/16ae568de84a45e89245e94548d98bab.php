<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\system\auth_list.html";i:1538729505;}*/ ?>
<form id="pagerForm" method="post" action="<?php echo url('auth'); ?>">
    <input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo \think\Request::instance()->post('numPerPage'); ?>" />
    <input type="hidden" name="name" value="<?php echo \think\Request::instance()->post('name'); ?>" />
    <input type="hidden" name="menu_id" value="<?php echo \think\Request::instance()->post('menu_id'); ?>" />
    <input type="hidden" name="operate_time_start" value="<?php echo \think\Request::instance()->post('operate_time_start'); ?>" />
    <input type="hidden" name="operate_time_end" value="<?php echo \think\Request::instance()->post('operate_time_end'); ?>" />
    <input type="hidden" name="orderField" value="<?php echo \think\Request::instance()->post('orderField'); ?>" />
    <input type="hidden" name="orderBy" value="<?php echo \think\Request::instance()->post('orderBy'); ?>" />
</form>

<form onsubmit="return navTabSearch(this);" id="pageList" action="" method="post" onreset="$(this).find('select.combox').comboxReset()">
    <div class="pageHeader">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        权限名称：<input type="text" name="name" />
                    </td>
                    <td>
                        <select class="combox" name="menu_id" rel="pageForm">
                            <option value="">-所属菜单-</option>
                            <?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): if( count($menu_list)==0 ) : echo "" ;else: foreach($menu_list as $key=>$menu): if((\think\Request::instance()->post('menu_id')!='') AND (\think\Request::instance()->post('menu_id')==$menu['id'])): ?>
                            <option value="<?php echo $menu['id']; ?>" selected><?php echo $menu['name']; ?></option>
                            <?php else: ?>
                            <option value="<?php echo $menu['id']; ?>"><?php echo $menu['name']; ?></option>
                            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                    <td class="dateRange">
                        更新日期:
                        <input name="operate_time_start" rel="pageForm" class="date readonly" readonly="readonly" type="text" value="<?php echo \think\Request::instance()->post('operate_time_start'); ?>">
                        <span class="limit">-</span>
                        <input name="operate_time_end" rel="pageForm" class="date readonly" readonly="readonly" type="text" value="<?php echo \think\Request::instance()->post('operate_time_end'); ?>">
                    </td>
                    <td class="dateRange">
                        <select class="combox" name="orderField" rel="pageForm">
                            <option value="">排序条件</option>
                            <?php if(is_array($orderField) || $orderField instanceof \think\Collection || $orderField instanceof \think\Paginator): if( count($orderField)==0 ) : echo "" ;else: foreach($orderField as $key=>$val): if((\think\Request::instance()->post('orderField')!='') AND (\think\Request::instance()->post('orderField')==$key)): ?>
                            <option value="<?php echo $key; ?>" selected><?php echo $val; ?></option>
                            <?php else: ?>
                            <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                    <td class="dateRange">
                        <select class="combox" name="orderBy" rel="pageForm">
                            <?php if(is_array($orderBy) || $orderBy instanceof \think\Collection || $orderBy instanceof \think\Paginator): if( count($orderBy)==0 ) : echo "" ;else: foreach($orderBy as $key=>$val): if((\think\Request::instance()->post('orderBy')!='') AND (\think\Request::instance()->post('orderBy')==$key)): ?>
                            <option value="<?php echo $key; ?>" selected><?php echo $val['name']; ?></option>
                            <?php else: if($val['is_default']==1): ?>
                            <option value="<?php echo $key; ?>" selected><?php echo $val['name']; ?></option>
                            <?php else: ?>
                            <option value="<?php echo $key; ?>"><?php echo $val['name']; ?></option>
                            <?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="subBar">
                <ul>
                    <li><div class="button"><div class="buttonContent"><button type="reset">重置</button></div></div></li>
                    <li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
                </ul>
            </div>
        </div>
    </div>

    <!--<p><?php echo $sql; ?></p>-->

    <div class="pageContent">
        <div class="panelBar">
            <ul class="toolBar">
                <li><a class="add" href="<?php echo url('system/addAuth'); ?>" target="navTab"><span>添加权限</span></a></li>
            </ul>
        </div>
        <table class="table" id="table_header" width="100%" layoutH="138">
            <thead>
            <tr>
                <th width="30" align="center">选项</th>
                <th width="40" align="center">序号</th>
                <th width="60" align="center">权限ID</th>
                <th width="120" align="center">权限名称</th>
                <th width="240" align="center">描述</th>
                <th width="150" align="center">所属菜单</th>
                <th width="120" align="center">更新人</th>
                <th width="140" align="center">更新时间</th>
                <th align="center">操作</th>
            </tr>
            </thead>
            <tbody class="table_list">
            <?php if(is_array($auth_list) || $auth_list instanceof \think\Collection || $auth_list instanceof \think\Paginator): if( count($auth_list)==0 ) : echo "" ;else: foreach($auth_list as $i=>$auth): ?>
            <tr height="30">
                <td><input type="checkbox" name="checkid[]" id="checkid<?php echo $auth['id']; ?>" value="<?php echo $auth['id']; ?>"/></td>
                <td><?php echo ++$i; ?></td>
                <td><?php echo $auth['id']; ?></td>
                <td><?php echo $auth['name']; ?></td>
                <td><?php echo $auth['desc']; ?></td>
                <td><?php echo $menu_name[$auth['menu_id']]; ?></td>
                <td><?php echo $user_name[$auth['operate_id']]; ?></td>
                <td><?php echo $auth['operate_time']; ?></td>
                <td>
                    <div class="panelBar" style="text-align:center;background:none;border:none;">
                        <ul class="toolBar" style="display:inline-block;">
                            <li><a class="edit" href="<?php echo url('updateAuth'); ?>?id=<?php echo $auth['id']; ?>" target="navTab"><span>修改</span></a></li>
                            <li><a class="delete" href="<?php echo url('deleteAuth'); ?>?id=<?php echo $auth['id']; ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="panelBar">
            <div class="pages">
                <span>显示</span>
                <select class="combox" name="numPerPage" rel="pageForm" onchange="navTabPageBreak({numPerPage:this.value})">
                    <?php if(is_array($page_list) || $page_list instanceof \think\Collection || $page_list instanceof \think\Paginator): if( count($page_list)==0 ) : echo "" ;else: foreach($page_list as $key=>$val): if(($numPerPage!='') AND ($numPerPage==$key)): ?>
                    <option value="<?php echo $key; ?>" selected><?php echo $val; ?></option>
                    <?php else: ?>
                    <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <span>条，共<?php echo $auth_list->total(); ?>条</span>
            </div>
            <div class="pagination" targetType="navTab" totalCount="<?php echo $auth_list->total(); ?>" numPerPage="<?php echo \think\Request::instance()->post('numPerPage'); ?>" pageNumShown="<?php echo $auth_list->lastPage(); ?>" currentPage="<?php echo $auth_list->currentPage(); ?>"></div>

        </div>
    </div>
</form>