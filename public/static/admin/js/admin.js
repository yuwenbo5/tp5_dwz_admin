//table的js内容

$("table[id=table_header]", $p).each(function() {

    $(this).click(function (event) {

        var $this = $(this);

        alert(13435);
    });
});


//主菜单点击事件
function selectMenu(obj)
{
    $("#navMenu").find('li').removeClass('selected');
    $(obj).parent().addClass('selected');
    $("#menuMain").find('h2').html($(obj).find('span').html())
}
