<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\public\success.html";i:1535792623;}*/ ?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
<title>页面提示</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv='Refresh' content='<?php echo $result['title']; ?>;URL=<?php echo $result['url']; ?>'>
<load href ="/Css/style.css" />
</head>
<body>
<div class="message">
<table class="message"  cellpadding=0 cellspacing=0 >
	<tr>
		<td height='5'  class="topTd" ></td>
	</tr>
	<tr class="row" >
		<th class="tCenter space"><?php echo $result['title']; ?></th>
	</tr>
	<present name="message" >
	<tr class="row">
		<td style="color:blue"><?php echo $result['msg']; ?></td>
	</tr>
	</present>
	<present name="closeWin" >
		<tr class="row">
		<td>系统将在 <span style="color:blue;font-weight:bold"><?php echo $result['wait']; ?></span> 秒后自动关闭，如果不想等待,直接点击 <a href="<?php echo $result['url']; ?>">这里</a> 关闭</td>
	</tr>
	</present>

	<tr>
		<td height='5' class="bottomTd"></td>
	</tr>
	</table>
</div>
</body>
</html>
