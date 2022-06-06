<?php
	if(isset($_COOKIE['login'])){

		$login_id= $_COOKIE['login'];
		require("../../root/db_connection.php");

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sb-admin.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div id="wrapper">
            <?php  include("header.php");  ?>
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="page-header">
                            Welcome 
                            	<small>
									<?php 
										$id=$_COOKIE['login']; $q=$db->query("select user_name from user_infromation where user_id=$id") or die("");
										$idRes=$q->fetch(PDO::FETCH_ASSOC); echo $idRes['user_name']; ?>
                                </small>
                        </h4>
                                <ol class="breadcrumb">
                                    <li class="active">
                                        <a href="index.php">
                                            <i class="fa fa-dashboard"></i> Dashboard
                                        </a>
                                    </li>
                                </ol>
                            </div>

							
							<div class="col-lg-4">
                                <div class="panel panel-default" style="border-color: #337AB7;">
                                    <div class="panel-heading" style="color: #fff; background-color: #337AB7;  border-color: #337AB7;">
                                        <i class="fa fa-bell fa-fw"></i> Notification
                                    </div>
                                   
                                    <div style="width:100%; height:210px; overflow:auto;">
                                        <div class="panel-body">
                                            <div class="list-group">

											<?php $regQ=$db->query("SELECT u_name,(SELECT c_title FROM course_master WHERE id=course_name) AS course_name,DATE_FORMAT(created_date,'%d %M %Y') AS created_date 
											FROM req_req WHERE flag='true'ORDER BY id desc") or die("");

					while($regQ_res=$regQ->fetch(PDO::FETCH_ASSOC)){
											?>
                                                <a href="all_course_reg_req.php" class="list-group-item">
                                                    <i class="fa fa-tasks fa-fw"></i> 
													<strong><?php echo $regQ_res['u_name']; ?></strong> sended new registration request for <span style="color:red;"><?php echo $regQ_res['course_name']; ?></span>
                                                    <br><span class="text-muted small"><em><?php echo $regQ_res['created_date']; ?></em>
                                            </span>
                                                    <br>
                                                    <br>

                                                    <span style="padding:5px; border-radius:4px; font-size:12px; background:green; color:#fff;">view detail</span>

                                                </a>
					<?php } ?>			


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
							
							
							
							
							
							
							<div class="col-lg-4">
                                <div class="panel panel-default" style="border-color: #243A45;">
                                    <div class="panel-heading" style="color: #fff; background-color: #243A45;  border-color: #243A45;">
                                        <i class="fa fa-bell fa-fw"></i> Quick Enquiry !
                                    </div>
                                   
                                    <div style="width:100%; height:210px; overflow:auto;">
                                        <div class="panel-body">
                                            <div class="list-group">

											<?php $regQ=$db->query("SELECT id,u_name ,u_mo ,u_email ,created_on 
							FROM quick_enquiry_master ORDER BY id desc limit 30") or die("");

					while($regQ_res=$regQ->fetch(PDO::FETCH_ASSOC)){
											?>
                                                <a href="quick_enquiry_request.php" class="list-group-item">
                                                    <i class="fa fa-tasks fa-fw"></i> New Quick Enquiry Sended by 
													<strong><?php echo $regQ_res['u_name']; ?></strong> | <span ><?php echo $regQ_res['u_email']; ?>
													 | <span ><?php echo $regQ_res['u_mo']; ?></span>
                                                    <br><span class="text-muted small"><em><?php echo $regQ_res['created_on']; ?></em>
                                            </span>
                                                    <br>
                                                    <br>

                                                    <span style="padding:5px; border-radius:4px; font-size:12px; background:green; color:#fff;">view detail</span>

                                                </a>
					<?php } ?>			


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
							
							
                       <!---     <div class="col-lg-4">
                                <div class="panel panel-default" style="border-color: #337AB7;">
                                    <div class="panel-heading" style="color: #fff; background-color: #337AB7;  border-color: #337AB7;">
                                        <i class="fa fa-bell fa-fw"></i> Notification
                                    </div>
                                   
                                    <div style="width:100%; height:180px; overflow:auto;">
                                        <div class="panel-body">
                                            <div class="list-group">

                                                <a href="#" class="list-group-item">
                                                    <i class="fa fa-tasks fa-fw"></i> <strong>Prateek Chandrakar</strong> changed his detail
                                                    <span class="text-muted small"><em>12-02-2018</em>
                                            </span>
                                                    <br>
                                                    <br>

                                                    <span style="padding:5px; border-radius:4px; font-size:12px; background:green; color:#fff;">viewed</span>

                                                    <span style="padding:5px; margin-top:30px; border-radius:4px; font-size:12px; background:#F00; color:#fff;">pending</span>

                                                </a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
---->
                        </div>

                    </div>
                </div>
        </div>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>

    </html>
    <?php
}
else
{
	header("location:../index.php");	
}
?>