<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\system\menu_list.html";i:1538995015;}*/ ?>
<form onsubmit="return navTabSearch(this);" action="" method="post" onreset="$(this).find('select.combox').comboxReset()">
    <div class="pageHeader">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        菜单名称：<input type="text" name="name" value="<?php echo \think\Request::instance()->post('name'); ?>"/>
                    </td>
                    <td>
                        <select class="combox" name="status">
                            <option value="">-状态-</option>
                            <?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): if( count($status)==0 ) : echo "" ;else: foreach($status as $key=>$val): if((\think\Request::instance()->post('status')!='') AND (\think\Request::instance()->post('status')==$key)): ?>
                                    <option value="<?php echo $key; ?>" selected><?php echo $val; ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                    <td>
                        <select class="combox" name="pid">
                            <option value="">-上级菜单-</option>
                            <?php if(is_array($parent_menu) || $parent_menu instanceof \think\Collection || $parent_menu instanceof \think\Paginator): if( count($parent_menu)==0 ) : echo "" ;else: foreach($parent_menu as $key=>$menu): if((\think\Request::instance()->post('pid')!='') AND (\think\Request::instance()->post('pid')==$menu['id'])): ?>
                                    <option value="<?php echo $menu['id']; ?>" selected><?php echo $menu['name']; ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $menu['id']; ?>"><?php echo $menu['name']; ?></option>
                                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                    <td class="dateRange">
                        添加日期:
                        <input name="create_time_start" class="date readonly" readonly="readonly" type="text" value="<?php echo \think\Request::instance()->post('create_time_start'); ?>">
                        <span class="limit">-</span>
                        <input name="create_time_end" class="date readonly" readonly="readonly" type="text" value="<?php echo \think\Request::instance()->post('create_time_end'); ?>">
                    </td>
                </tr>
            </table>
            <div class="subBar">
                <ul>
                    <li><div class="button"><div class="buttonContent"><button type="reset">重置</button></div></div></li>
                    <li><div class="buttonActive"><div class="buttonContent"><button type="submit">查询</button></div></div></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="pageContent">
        <div class="panelBar">
            <ul class="toolBar">
                <li><a class="add" href="<?php echo url('addMenu'); ?>" target="navTab"><span>添加菜单</span></a></li>
            </ul>
        </div>
        <table class="table" width="100%" layoutH="138">
            <thead>
            <tr>
                <th width="80" align="center">序号</th>
                <th width="200" align="center">菜单名称</th>
                <th width="200" align="center">菜单规则</th>
                <th width="150" align="center">菜单状态</th>
                <th width="80" align="center">排序</th>
                <th align="center">备注</th>
                <th width="240" align="center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): if( count($menu_list)==0 ) : echo "" ;else: foreach($menu_list as $k=>$menu): ?>
            <tr height="30">
                <td><?php echo ++$k; ?></td>
                <td align="left" style="text-align:left;">&nbsp;&nbsp;<?php echo $menu['name']; ?></td>
                <td><?php echo $menu['rule']; ?></td>
                <td><?php echo $status[$menu['status']]; ?></td>
                <td><?php echo $menu['sort']; ?></td>
                <td><?php echo $menu['remark']; ?></td>
                <td>
                    <div class="panelBar" style="text-align:center;background:none;border:none;">
                        <ul class="toolBar" style="display:inline-block;">
                            <li><a class="edit" href="<?php echo url('updateMenu'); ?>?id=<?php echo $menu['id']; ?>" target="navTab"><span>修改</span></a></li>
                            <li><a class="delete" href="<?php echo url('deleteMenu'); ?>?id=<?php echo $menu['id']; ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="panelBar">
            <div class="pages">
                <span>共<?php echo $total_menu; ?>条</span>
            </div>
            <p><?php echo $sql; ?></p>
        </div>
    </div>
</form>