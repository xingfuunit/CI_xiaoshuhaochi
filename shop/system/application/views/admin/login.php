
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Fullscreen Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
         
        <link rel="stylesheet" href="/assets/css/reset.css">
        <link rel="stylesheet" href="/assets/css/supersized.css">
        <link rel="stylesheet" href="/assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="page-container">
            <h1>后台登陆</h1>
            <form action="" method="post">
                <input type="text" name="username" class="username" id="username" placeholder="用户名">
                <input type="password" name="password" class="password" id="password" placeholder="密码">
                <button type="submit" id="submit">登录</button> 
            </form> 
        </div> 
        <!-- Javascript -->
        <script src="/assets/js/jquery-1.8.2.min.js"></script>
        <script src="/assets/js/supersized.3.2.7.min.js"></script>
        <script src="/assets/js/supersized-init.js"></script> 
 
<script type="text/javascript">
$(function() {
	$('#submit').click(function(event) {
		event.stopPropagation();
		var $btn = $(this);
		if ($btn.hasClass("disabled")) {
			return false;
		}
		var $username = $('#username');
		var $password = $('#password');
		if (!$username.val()) {
			$username.focus();
			return false;
		}
		if (!$password.val()) {
			$password.focus();
			return false;
		}
		var login_param = {
			username : $username.val(),
			password : $password.val()
		};
		$btn.addClass("disabled");
		$.post("/admin/login", login_param, function(data) {
			if (data.success == 'yes') {
            	window.location.href="index";
            	 
			} else {
				$btn.removeClass("disabled");
				alert('用户名或密码错误！');
			}
		}, "json");
		return false;
	 });
	});
</script>	
</body>
</html>