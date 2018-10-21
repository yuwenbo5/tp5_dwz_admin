<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\system\user_group_list.html";i:1537801868;}*/ ?>
<form id="pagerForm" method="post" action="<?php echo url('userGroup'); ?>">
    <input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo \think\Request::instance()->post('numPerPage'); ?>" />
    <input type="hidden" name="name" value="<?php echo \think\Request::instance()->post('name'); ?>" />
    <input type="hidden" name="status" value="<?php echo \think\Request::instance()->post('status'); ?>" />
    <input type="hidden" name="create_time_start" value="<?php echo \think\Request::instance()->post('create_time_start'); ?>" />
    <input type="hidden" name="create_time_end" value="<?php echo \think\Request::instance()->post('create_time_end'); ?>" />
    <input type="hidden" name="orderField" value="<?php echo \think\Request::instance()->post('orderField'); ?>" />
    <input type="hidden" name="orderBy" value="<?php echo \think\Request::instance()->post('orderBy'); ?>" />
</form>

<form onsubmit="return navTabSearch(this);" action="" method="post" onreset="$(this).find('select.combox').comboxReset()">
    <div class="pageHeader">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        分组名称：<input type="text" name="name" value="<?php echo \think\Request::instance()->post('name'); ?>" rel="pageForm"/>
                    </td>
                    <td>
                        <select class="combox" name="status" rel="pageForm">
                            <option value="">-状态-</option>
                            <?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): if( count($status)==0 ) : echo "" ;else: foreach($status as $key=>$val): if((\think\Request::instance()->post('status')!='') AND (\think\Request::instance()->post('status')==$key)): ?>
                            <option value="<?php echo $key; ?>" selected><?php echo $val; ?></option>
                            <?php else: ?>
                            <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                    <td class="dateRange">
                        添加日期:
                        <input name="create_time_start" rel="pageForm" class="date readonly" readonly="readonly" type="text" value="<?php echo \think\Request::instance()->post('create_time_start'); ?>">
                        <span class="limit">-</span>
                        <input name="create_time_end" rel="pageForm" class="date readonly" readonly="readonly" type="text" value="<?php echo \think\Request::instance()->post('create_time_end'); ?>">
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
                <li><a class="add" href="<?php echo url('addUserGroup'); ?>" target="navTab"><span>添加分组</span></a></li>
            </ul>
        </div>
        <table class="table" width="100%" layoutH="138">
            <thead>
            <tr>
                <th width="30" align="center">序号</th>
                <th width="40" align="center">组ID</th>
                <th width="120" align="center">分组名称</th>
                <th width="80" align="center">状态</th>
                <th width="150" align="center">描述</th>
                <th width="150" align="center">所有菜单</th>
                <th width="150" align="center">所有权限</th>
                <th width="120" align="center">更新时间</th>
                <th align="center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($user_group_list) || $user_group_list instanceof \think\Collection || $user_group_list instanceof \think\Paginator): if( count($user_group_list)==0 ) : echo "" ;else: foreach($user_group_list as $k=>$user_group): ?>
            <tr height="30">
                <td><?php echo ++$k; ?></td>
                <td><?php echo $user_group['id']; ?></td>
                <td><?php echo $user_group['name']; ?></td>
                <td><?php echo $status[$user_group['status']]; ?></td>
                <td><?php echo $user_group['desc']; ?></td>
                <td><a href="<?php echo url('groupMenu'); ?>?id=<?php echo $user_group['id']; ?>" target="dialog" title="【<?php echo $user_group['name']; ?>】的所有菜单" width="580" height="360" rel="groupMenu">菜单列表</a></td>
                <td><a href="<?php echo url('groupAuth'); ?>?id=<?php echo $user_group['id']; ?>" target="dialog" title="【<?php echo $user_group['name']; ?>】的所有权限" width="580" height="360" rel="groupAuth">权限列表</a></td>
                <td><?php echo $user_group['operate_time']; ?></td>
                <td>
                    <div class="panelBar" style="text-align:center;background:none;border:none;">
                        <ul class="toolBar" style="display:inline-block;">
                            <li><a class="edit" href="<?php echo url('updateUserGroup'); ?>?id=<?php echo $user_group['id']; ?>" target="navTab"><span>修改</span></a></li>
                            <li><a class="delete" href="<?php echo url('deleteUserGroup'); ?>?id=<?php echo $user_group['id']; ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
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
                <span>条，共<?php echo $user_group_list->total(); ?>条</span>
            </div>
            <div class="pagination" targetType="navTab" totalCount="<?php echo $user_group_list->total(); ?>" numPerPage="<?php echo \think\Request::instance()->post('numPerPage'); ?>" pageNumShown="<?php echo $user_group_list->lastPage(); ?>" currentPage="<?php echo $user_group_list->currentPage(); ?>"></div>
        </div>
    </div>
</form>