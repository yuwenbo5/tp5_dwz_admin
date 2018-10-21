
//主菜单点击事件
function selectMenu(obj)
{
    $("#navMenu").find('li').removeClass('selected');
    $(obj).parent().addClass('selected');
    $("#menuMain").find('h2').html($(obj).find('span').html())
}
