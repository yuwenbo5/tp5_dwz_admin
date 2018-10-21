<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"E:\xampp\htdocs\tenflyer\public/../application/admin\view\login\login.html";i:1539053431;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo \think\Config::get('sitename'); ?></title>
<link rel="shortcut icon" href="/tenflyer/public/static/admin/img/favicon.ico" />
<link href="/tenflyer/public/static/dwz/themes/css/login.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]><script src="/tenflyer/public/static/dwz/js/speedup.js" type="text/javascript"></script><script src="/tenflyer/public/static/dwz/js/jquery-1.11.3.min.js" type="text/javascript"></script><![endif]-->
<!--[if gte IE 9]><!--><script src="/tenflyer/public/static/dwz/js/jquery-2.1.4.min.js" type="text/javascript"></script><!--<![endif]-->
<script language="JavaScript">
	$(function(){
	    //Enter登录
	    document.onkeypress = function(e){
	        var e = e || window.event;
	        if(e.keyCode == 13){
	            checkSubmit();
			}
		}
	});
	//登录验证
	function checkSubmit(){
	    var username = $("input[name='username']").val();
	    if(!username){
            $("#login_msg").html('用户名不能为空');
            $("input[name='username']").focus();
            return false;
		}
	    var password = $("input[name='password']").val();
        if(!password){
            $("#login_msg").html('密码不能为空');
            $("input[name='password']").focus();
            return false;
        }
	    var verify = $("input[name='verify']").val();
        if(!verify){
            $("#login_msg").html('请输入验证码');
            $("input[name='verify']").focus();
            return false;
        }

        //提交后台验证
	    $("#login_msg").html('login loading...');
        var jsonData = {
            'action' : 'loginVerify',
			'username' : username,
			'password' : password,
			'verify' : verify
		};
        $.ajax({
			url: 'login',
			type: 'post',
			data: jsonData,
			dataType: 'json',
			success: function(login_res){
				if(login_res.rs){
                    $("#login_msg").css('color','#313231');
                    $("#login_msg").html('登录成功');
                    window.location.href = "<?php echo url('index/index'); ?>";
				}else{
                    $("#login_msg").html(login_res.info);
				}
				//切换验证码
				$("#verifyImg").attr('src',"<?php echo url('admin/login/verify'); ?>?"+Math.random());
			},
			error: function(){
                $("#login_msg").html('抱歉,系统正在维护中...');
			}
		});
	}
</script>
</head>
<body>
<div id="login">
	<div id="login_header">
		<h1 class="login_logo">
			<a href="/tenflyer/public/admin/login"><img src="/tenflyer/public/static/admin/img/logo.png" /></a>
		</h1>
		<div class="login_headerContent">
			<div class="navList">
				<ul>
					<li><a href="#">设为首页</a></li>
					<li><a href="#">反馈</a></li>
					<li><a href="#">帮助</a></li>
				</ul>
			</div>
			<h2 class="login_title"><img src="/tenflyer/public/static/dwz/themes/default/images/login_title.png" /></h2>
		</div>
	</div>
	<div id="login_content">
		<div class="loginForm">
			<form method="post" action="login">
				<p>
					<label>帐号：</label>
					<input type="text" name="username" size="20" class="login_input" />
				</p>
				<p>
					<label>密码：</label>
					<input type="password" name="password" size="20" class="login_input" />
				</p>
				<p style="display:block;padding-left:8px;">
					验证码：
				</p>
				<p>
					<input class="code" name="verify" type="text" size="8" />
					<span><img id="verifyImg" SRC="<?php echo url('admin/login/verify'); ?>" onClick="this.src='<?php echo url('admin/login/verify'); ?>?'+Math.random();" border="0" alt="点击刷新验证码" style="cursor:pointer;border:1px solid #ccc;" align="absmiddle"></span>
				</p>
				<p id="login_msg" style="color:red;display:block;height:30px;line-height:30px;padding-left:8px;"></p>
				<div class="login_bar">
					<input class="sub" type="button" onclick="checkSubmit();" value=" " />
				</div>
			</form>
		</div>
		<div class="login_banner"><img src="/tenflyer/public/static/dwz/themes/default/images/login_banner.jpg" /></div>
		<div class="login_main">
			<div class="login_inner">
				<p>腾辉电子商务有限公司-供应商系统</p>
			</div>
		</div>
	</div>
	<div id="login_footer">
		Copyright &copy; 2018 <?php echo \think\Config::get('COMPANY'); ?>.
	</div>
</div>

</body>
</html>