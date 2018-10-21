<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\system\user_list.html";i:1538835193;}*/ ?>
<form id="pagerForm" method="post" action="<?php echo url('user'); ?>">
    <input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo \think\Request::instance()->post('numPerPage'); ?>" />
    <input type="hidden" name="username" value="<?php echo \think\Request::instance()->post('username'); ?>" />
    <input type="hidden" name="nickname" value="<?php echo \think\Request::instance()->post('nickname'); ?>" />
    <input type="hidden" name="email" value="<?php echo \think\Request::instance()->post('email'); ?>" />
    <input type="hidden" name="main_group_id" value="<?php echo \think\Request::instance()->post('main_group_id'); ?>" />
    <input type="hidden" name="status" value="<?php echo \think\Request::instance()->post('status'); ?>" />
    <input type="hidden" name="register_time_start" value="<?php echo \think\Request::instance()->post('register_time_start'); ?>" />
    <input type="hidden" name="register_time_end" value="<?php echo \think\Request::instance()->post('register_time_end'); ?>" />
    <input type="hidden" name="orderField" value="<?php echo \think\Request::instance()->post('orderField'); ?>" />
    <input type="hidden" name="orderBy" value="<?php echo \think\Request::instance()->post('orderBy'); ?>" />
</form>

<form onsubmit="return navTabSearch(this);" id="pageList" action="" method="post" onreset="$(this).find('select.combox').comboxReset()">
    <div class="pageHeader">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        用户名：<input type="text" name="username" style="width:80px;"/>
                    </td>
                    <td>
                        昵称：<input type="text" name="nickname" style="width:80px;"/>
                    </td>
                    <td>
                        email：<input type="text" name="email" style="width:80px;"/>
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
                    <td>
                        <select class="combox" name="main_group_id" rel="pageForm">
                            <option value="">-所属分组-</option>
                            <?php if(is_array($group_list) || $group_list instanceof \think\Collection || $group_list instanceof \think\Paginator): if( count($group_list)==0 ) : echo "" ;else: foreach($group_list as $key=>$group): if((\think\Request::instance()->post('main_group_id')!='') AND (\think\Request::instance()->post('main_group_id')==$group['id'])): ?>
                            <option value="<?php echo $group['id']; ?>" selected><?php echo $group['name']; ?></option>
                            <?php else: ?>
                            <option value="<?php echo $group['id']; ?>"><?php echo $group['name']; ?></option>
                            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                    <td class="dateRange">
                        注册日期:
                        <input name="register_time_start" rel="pageForm" class="date readonly" readonly="readonly" type="text" value="<?php echo \think\Request::instance()->post('register_time_start'); ?>">
                        <span class="limit">-</span>
                        <input name="register_time_end" rel="pageForm" class="date readonly" readonly="readonly" type="text" value="<?php echo \think\Request::instance()->post('register_time_end'); ?>">
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
    <div class="pageContent">
        <div class="panelBar">
            <ul class="toolBar">
                <li><a class="add" href="<?php echo url('system/addUser'); ?>" target="navTab"><span>添加用户</span></a></li>
            </ul>
        </div>
        <table class="table" width="100%" layoutH="138">
            <thead>
            <tr>
                <th width="30" align="center">选项</th>
                <th width="30" align="center">序号</th>
                <th width="80" align="center">用户名</th>
                <th width="120" align="center">邮箱</th>
                <th width="100" align="center">昵称</th>
                <th width="60" align="center">状态</th>
                <th width="150" align="center">最后登录信息</th>
                <th width="80" align="center">主分组</th>
                <th width="100" align="center">附加分组</th>
                <th width="80" align="center">菜单列表</th>
                <th width="80" align="center">权限列表</th>
                <th width="80" align="center">注册时间</th>
                <th align="center">操作</th>
            </tr>
            </thead>
            <tbody class="table_list">
            <?php if(is_array($user_list) || $user_list instanceof \think\Collection || $user_list instanceof \think\Paginator): if( count($user_list)==0 ) : echo "" ;else: foreach($user_list as $k=>$user): ?>
            <tr height="30">
                <td><input type="checkbox" name="checkid[]" id="checkid<?php echo $user['id']; ?>" value="<?php echo $user['id']; ?>"/></td>
                <td><?php echo ++$k; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['nickname']; ?></td>
                <td><?php echo $status[$user['status']]; ?></td>
                <td><?php echo $user['last_login_time']; ?><br/><?php echo $user['last_login_ip']; ?></td>
                <td><?php echo $group_list[$user['main_group_id']]['name']; ?></td>
                <td><?php echo $user['sub_group_ids']; ?></td>
                <td><?php echo $user['menu_ids']; ?></td>
                <td><?php echo $user['auth_ids']; ?></td>
                <td><?php echo $user['register_time']; ?></td>
                <td>
                    <div class="panelBar" style="text-align:center;background:none;border:none;">
                        <ul class="toolBar" style="display:inline-block;">
                            <li><a class="edit" href="<?php echo url('updateUser'); ?>?id=<?php echo $user['id']; ?>" target="navTab"><span>修改</span></a></li>
                            <li><a class="delete" href="<?php echo url('deleteUser'); ?>?id=<?php echo $user['id']; ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
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
                <span>条，共<?php echo $user_list->total(); ?>条</span>
            </div>
            <div class="pagination" targetType="navTab" totalCount="<?php echo $user_list->total(); ?>" numPerPage="<?php echo \think\Request::instance()->post('numPerPage'); ?>" pageNumShown="<?php echo $user_list->lastPage(); ?>" currentPage="<?php echo $user_list->currentPage(); ?>"></div>

        </div>
    </div>
</form>
<script type="text/javascript" src="/tenflyer/public/static/admin/js/table.js"></script>