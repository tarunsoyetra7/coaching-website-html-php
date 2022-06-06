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
                                <h4 align="center"><strong>Testimonial  Master</strong></h4>
                                <hr>

                                <ol class="breadcrumb">

                                    <li class="active">
                                        <a href="testimonial_master.php"><i class="fa fa-dashboard"></i> Testimonial</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_testimonial_master.php"><i class="fa fa-dashboard"></i> Manage Testimonial</a>
                                    </li>
									
									
                                </ol>
                            </div>

<?php if(isset($_REQUEST['id'])){
	$edit_id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("select * from testimonial_master where flag='true' and id=$edit_id") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
<form name="" method="post" enctype="multipart/form-data" action="testimonial_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label>Client Name</label>
                                    <input id="txt_title"  name="txt_title" type="text" class="form-control" placeholder="Enter Title *" value="<?php echo $editQ_res['t_client_name']; ?>">
									<input type="hidden" name="txt_hide" id="txt_hide" value="<?php echo $editQ_res['id']; ?>">
                                    <br>
                                    
                                     <label>Client Name</label>
                                    <input id="txt_emailadd"  name="txt_emailadd" type="text" class="form-control" value="<?php echo $editQ_res['t_email']; ?>">
								
                                    <br>
                                    
                                    
                                    <label>Image</label>
                                    <input type="file" name="txt_img" id="txt_img" class="form-control">
                                    <?php if($editQ_res['t_img']=="" || $editQ_res['t_img']==NULL){ } else { ?>
			<img src="../../testimonial_img/<?php echo $editQ_res['id'].".".$editQ_res['t_img'];  ?>" style="width:30px; height:30px;">
			<?php } ?>
				<span class="pull-right">(file type : jpg, jpeg, png)</span>
                                    <br>
                                    <label>Testimonial</label>
                                    <textarea id="txt_testimonial"  name="txt_testimonial" type="text" rows="4" class="form-control" placeholder="Description *" ><?php echo $editQ_res['t_testimonial']; ?></textarea>
                                    <br>
                                    
                                </div>


                               
								
                                <div class="col-lg-12">

                                    <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button><br><br>
                                </div>

								
								 
								 
							
                            </form>
								 
							
                            </form>
<?php	} else { ?>
                            <!--start --->
                            <form name="" method="post" enctype="multipart/form-data" action="testimonial_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label>Client Name</label>
                                    <input id="txt_title"  name="txt_title" type="text" class="form-control" placeholder="Enter Title *">
									<input type="hidden" name="txt_hide" id="txt_hide">
                                    <br>
                                    
                                     <label>Client Name</label>
                                    <input id="txt_emailadd"  name="txt_emailadd" type="text" class="form-control" >
								
                                    <br>
                                    
                                    
                                    
                                    <label>Image</label>
                                    <input type="file" name="txt_img" id="txt_img" class="form-control"><span class="pull-right">(file type : jpg, jpeg, png)</span>
                                    <br>
                                    <label>Testimonial</label>
                                    <textarea id="txt_testimonial"  name="txt_testimonial" type="text" rows="4" class="form-control" placeholder="Description *"></textarea>
                                    <br>
                                    
                                </div>


                               
								
                                <div class="col-lg-12">

                                    <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button><br><br>
                                </div>

								
								 
								 
							
                            </form>
                            <!---end--->
<?php } ?>
                        </div>

                    </div>
                </div>
        </div>
<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	<script>
$(".btn_submit").on("click",function(e){
	/*txt_b_cat_title
txt_hide
txt_priority
txtEnableDisable
txt_keyword
txt_description */
	if($("#txt_title").val()=="" || $("#txt_title").val()==null){
		$("#txt_b_cat_title").focus();
	}
	else if($("#txt_testimonial").val()=="" || $("#txt_testimonial").val()==null){
			$("#txt_priority").focus();
	}
	
	else{
			$("#txt_form").submit();
	}

});	
	</script>
    </body>

    </html>
    <?php
}
else
{
	header("location:../index.php");	
}
?>