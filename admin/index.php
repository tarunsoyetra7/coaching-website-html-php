<?php
if(isset($_COOKIE['login'])){	
	header("location:dashboard/index.php"); }
else {
?>
<html>
	<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
		@import url(https://fonts.googleapis.com/css?family=Roboto:300);
		.login-page{
			padding: 5% 5% 0;
			float:right; }
		.form{
			position: relative;
			z-index: 1;
			background: #FFFFFF; 
			padding: 15px;
			text-align: center;	}
		.form input{
			font-family: "Roboto", sans-serif;
			outline: 0;
			background: #f2f2f2;
			width: 100%;
			border: 0;
			margin: 0 0 15px;
			padding: 10px;
			box-sizing: border-box;
			font-size: 16px; }
		.form #submitBtn{  
			text-transform: uppercase;
			outline: 0;
			background: #0177D7;
			width: 100%;
			border: 0;
			padding: 10px;
			color: #FFFFFF; 
			font-size: 16px;
			-webkit-transition: all 0.3 ease;
			transition: all 0.3 ease;
			cursor: pointer;}
		.form button:hover,.form button:active,.form button:focus{
			background: #43A047; }
		body{
			background: #222222; /* fallback for old browsers */
			}
		.error_cls{
			border:1px solid red; }
		#loading_img{
			margin:0px; display:none; }
	</style>
</head>
<body>
	<div class="login-page">
		<div class="form">
			<input type="text" autofocus placeholder="User Name"  id="user_name"/>
			<input type="password" placeholder="Password"  id="user_pass"/>
			<input id="submitBtn" type="button"  value="SUBMIT">
			<p align="center" id="loading_img">
				<img src="loading2.gif" style="width:50px; height:50px;">
			</p>   
		</div>
	</div>
</body>
<script src="jquery.min.js"></script>
<script>
	$("#user_name").on("keyup",function(e){
		$("#user_name").css("border","none");
	});
	$("#user_pass").on("keyup",function(e){
		$("#user_pass").css("border","none");
	});
	$("#submitBtn").on("click",function(e){
		if($("#user_name").val()=="" || $("#user_name").val()==null)
		{
			$("#user_name").focus();
			$("#user_name").css("border","1px solid red");
		}
		else if($("#user_pass").val()=="" || $("#user_pass").val()==null)
		{
			$("#user_pass").focus();
			$("#user_pass").css("border","1px solid red");
		}
		else
		{
			
					var u_name=$("#user_name").val();
					var u_pass=$("#user_pass").val();
					$("#loading_img").css("display","block");
					$.ajax({
						type:"POST",
						data:{u_name:u_name,u_pass:u_pass},
						url:"login-do.php",
						success: function(reciveData){
							reciveData=reciveData.trim();	
							if(reciveData=="err"){
								$("#loading_img").css("display","none");							
								$("#user_name").focus();
								$("#user_name").css("border","1px solid red");
								$("#user_pass").css("border","1px solid red");
							}
							else{
								$("#loading_img").css("display","none");
								alert("Sucessfully Login");
								window.location.replace('dashboard/index.php');
							}
						}
					});
			
				
		}
	});
</script>
</html>
<?php }?>