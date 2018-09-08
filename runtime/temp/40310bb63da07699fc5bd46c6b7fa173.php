<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"E:\xampp\htdocs\tenflyer\public/../application/index\view\login\login.html";i:1526626288;}*/ ?>
<!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>供应商用户登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="tenflyer">
    <script src="/tenflyer/public/static/common/js/jquery.min.js" type="text/javascript"></script>
    <!-- The styles -->
    <link id="bs-css" href="/tenflyer/public/static/index/css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="/tenflyer/public/static/index/css/charisma-app.css" rel="stylesheet">
    <!-- The fav icon -->
    <link rel="shortcut icon" href="/tenflyer/public/static/index/img/favicon.ico">
</head>
<body style="background:#F4F4F4 url(/tenflyer/public/static/index/img/bg.gif) repeat top left;">
<div class="htmleaf-container">
    <div class="row">

        <div class="row">
            <div class="col-md-12 center login-header">
                <h2>Welcome to Tenflyer</h2>
            </div>
            <!--/span-->
        </div><!--/row-->

        <div class="row">
            <div class="well col-md-5 center login-box">
                <div class="alert alert-info">
                    Please login with your Username and Password.
                </div>
                <form class="form-horizontal" id="checkForm" action="" method="post">
                    <input type="hidden" name="loginSubmit" value="true"/>
                    <fieldset>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Username" value="">
                        </div>
                        <div class="clearfix"></div><br>

                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Password" value="">
                        </div>
                        <div class="clearfix"></div>

                        <p class="center col-md-5">
                            <button type="button" class="btn btn-primary" onclick="checkLogin();" id="login">Login</button>
                        </p>

                        <p style="font-size:12px;text-align:center;color:red;padding:10px;" id="login_tip"></p>
                    </fieldset>
                </form>
            </div>
            <!--/span-->
        </div><!--/row-->
    </div><!--/fluid-row-->
</div>

<script>
    $(function(){
        $('body').keypress(function(e){
            var e = e || window.event;
            if(e.keyCode == 13){
                $("#login").click();
            }
        });
    });
    //验证并登录
    function checkLogin(){
        var username = $("input[name='username']").val();
        var password = $("input[name='password']").val();
        if(username == ''){
            $("#login_tip").html('用户名不能为空！');
            return false;
        }
        if(password == ''){
            $("#login_tip").html('登录密码不能为空！');
            return false;
        }
        $("#login").html('Login loading...');
        $("#login_tip").html('<img width="20" height="20" src="/tenflyer/public/static/index/img/loading.gif" alt="登录中..."/>');
        setTimeout(function(){
            $.ajax({
                url : "<?php echo url('/index/login/login'); ?>",
                type : 'post',
                data : {'action':'checkLogin','username':username,'password':password},
                dataType : 'json',
                success : function(msg){
                    console.log(msg)
                    if(msg.rs == 1){
                        $("#login_tip").html(msg.info);
                        window.location.href = "<?php echo url('index/index'); ?>";
                    }else{
                        $("#login").html('Login');
                        $("#login_tip").html(msg.info);
                    }
                },
                error : function(){
                    alert('Ajax error!');
                }
            });
        },1100);
    }
</script>
</body>
</html>