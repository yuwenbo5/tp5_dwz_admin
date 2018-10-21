<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\index\profile.html";i:1535791393;}*/ ?>
<div class="page">
	<div class="pageContent">
	
	<form method="post" action="<?php echo url('index/change'); ?>?callbackType=closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
		<div class="pageFormContent" layoutH="58">
		
	<div class="unit">
		<label>Nickname：</label>
		<input type="text" class="required"  name="nickname" value="<?php echo $user['nickname']; ?>"/>
	</div>
	
	<div class="unit">
		<label>Email：</label>
		<input type="text" class="required email"  name="email" value="<?php echo $user['email']; ?>"/>
	</div>
	
	<div class="unit">
		<label>Remark：</label>
		<textarea class="required"  name="remark"  rows="5" cols="57" ><?php echo !empty($user['remark'])?$user['remark'] : ''; ?></textarea>
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
