<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\index\password.html";i:1535938332;}*/ ?>
<div class="page">
	<div class="pageContent">
	
	<form method="post" action="<?php echo url('index/changePwd'); ?>?callbackType=closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="pageFormContent" layoutH="58">

			<div class="unit">
				<label>老密码</label>
				<input type="password" name="oldpassword" class="required alphanumeric" maxlength="20">
			</div>

			<div class="unit">
				<label>新密码</label>
				<input id="new_password" type="password" name="password" class="required alphanumeric" maxlength="20">
			</div>

			<div class="unit">
				<label>确认密码</label>
				<input type="password" name="repassword" class="required alphanumeric" maxlength="20">
			</div>

			<div class="unit">
				<label>验证码</label>
				<input type="text" class="required" name="verify">
				<img id="verifyImg" SRC="<?php echo url('admin/login/verify'); ?>" onClick="this.src='<?php echo url('admin/login/verify'); ?>?'+Math.random();" border="0" alt="点击刷新验证码" style="cursor:pointer;border:1px solid #ccc;" align="absmiddle">
			</div>
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">Submit</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">Cancel</button></div></div></li>
			</ul>
		</div>
	</form>
	</div>
</div>
