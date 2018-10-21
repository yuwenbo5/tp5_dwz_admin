/**
 * form表单的js内容
 * 注意：只能使用函数式编程
 */


/**
 * 添加分组的菜单全选
 * @param obj
 */
function selectAllMenu(obj){
    var is_checked = $(obj).prop('checked');
    $("#menu_list").find("input[type='checkbox']").prop('checked',is_checked);

    if(is_checked){
        $("#menu_list").find('.ckbox').removeClass('unchecked').addClass('checked');
    }else{
        $("#menu_list").find('.ckbox').removeClass('checked').addClass('unchecked');
    }
}

/**
 * 添加分组的主菜单下全选
 * @param obj
 */
function selectItemMenu(obj){
    var is_checked = $(obj).prop('checked');
    $(obj).parent().find("input[type='checkbox']").prop('checked',is_checked);

    var all_checked = $(".select_all").prop('checked');
    if(all_checked && !is_checked){
        $(".select_all").prop('checked',false);
    }
}

/**
 * 权限全选
 * @param obj
 */
function selectAllAuth(obj){
    var is_checked = $(obj).prop('checked');
    $("#auth_list").find("input[type='checkbox']").prop('checked',is_checked);
}

/**
 * 各级权限选择
 * @param obj
 * @param type
 */
function selectAuthItem(obj,type){
    var is_checked = $(obj).prop('checked');

    if(type == 1){
        $(obj).parent().parent().parent().find("input[type='checkbox']").prop('checked',is_checked);
    }
    if(type == 2){
        $(obj).parent().parent().find("input[type='checkbox']").prop('checked',is_checked);
    }
}