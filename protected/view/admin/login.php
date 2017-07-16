
    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 300px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        }

        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }

        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
        }
    </style>  
<div class="container">
    <form class="form-signin" method="post" action="<?php echo url('main', 'login')?>">
        <h2 class="form-signin-heading ">登录系统</h2>
        <input type="text" name="username" id="username" class="input-block-level" placeholder="账号">
        <input type="password" name="password" id="password" class="input-block-level" placeholder="密码">
        	<input type="hidden" name="passwords" id="passwords" class="input-block-level" placeholder="密码">
        <p><button class="btn btn-large btn-primary" type="submit">登录</button></p>
    </form>
</div>

<script type="text/javascript" src="/i/js/md5.js"></script>
<SCRIPT type="text/javascript">  
	$(document).keypress(function(evt){
		if(evt.keyCode==13)
		{
			$("form").submit();
		}
	})
	
$(function(){	
 	$.get("<?php echo url('main', 'code') ?>",function(data){codestr=data
		$("form").append("<input id=\"codeName\"  type=\"hidden\" value='"+data+"' name=\"codeName\"/>");
	});
	//提交时候处理
	$("form").submit(function(){
		sendData();
	});
})


function sendData(){
	var passa=$("#password").val().trim();
	var username=$("#username").val().trim();
	if (username.length<3){
		alert("帐号过短");
		return false;	
	}
	if (passa.length<6){
		alert("密码长度应大于6");
		return false;
	}
	var passb= $("#codeName").val().trim();
	var passwords=hex_md5(hex_md5(passa)+passb);
	$("#passwords").val(passwords);
}
	
</SCRIPT>