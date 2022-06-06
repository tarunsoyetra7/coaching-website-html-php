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
                                <h4 align="center"><strong>Portfolio  Master</strong></h4>
                                <hr>

                                <ol class="breadcrumb">

                                    <li class="active">
                                        <a href="portfolio_master.php"><i class="fa fa-dashboard"></i> Portfolio Master</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_portfolio_master.php"><i class="fa fa-dashboard"></i> Manage Portfolio</a>
                                    </li>
									
									
                                </ol>
                            </div>

<?php if(isset($_REQUEST['id'])){
	$edit_id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("select * from portfolio_master where flag='true' and id=$edit_id") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
 <form name="" method="post" enctype="multipart/form-data" action="portfolio_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                     
                                    <label>Title</label>
                                    <input id="txt_title"  name="txt_title" type="text" class="form-control" placeholder="Enter Title *" value="<?php echo $editQ_res['pf_title']; ?>">
									<input type="hidden" name="txt_hide" id="txt_hide" value="<?php echo $editQ_res['id']; ?>">
                                    <br>
                                    <label>Document</label>
                                    <input type="file" name="txt_doc" id="txt_doc" class="form-control"><br>
                                    <span>
                                    <img src="../../portfolio_master_img/<?php echo $editQ_res['id'].".".$editQ_res['pf_file']; ?>" style="width:30px; height:30px;">
                                    </span>
<label>Url</label>
                                    <input id="txt_url"  name="txt_url" type="text" class="form-control" placeholder="Enter Url *" value="<?php echo $editQ_res['pf_link']; ?>">
                               
                                    <br>
                                </div>

								
                                <div class="col-lg-12">
<br>
                                    <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button><br><br>
                                </div>

								
								 
								 
							
                            </form>
<?php	} else { ?>
                            <!--start --->
                            <form name="" method="post" enctype="multipart/form-data" action="portfolio_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label>Title</label>
                                    <input id="txt_title"  name="txt_title" type="text" class="form-control" placeholder="Enter Title *">
									<input type="hidden" name="txt_hide" id="txt_hide">
                                    <br>
                                    <label>Image</label>
                                    <input type="file" name="txt_doc" id="txt_doc" class="form-control"><br>
<label>Url</label>
                                    <input id="txt_url"  name="txt_url" type="text" class="form-control" placeholder="Enter Url *">
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
		$("#txt_title").focus();
	}
	
	else if($("#txt_url").val()=="" || $("#txt_url").val()==null){
			$("#txt_url").focus();
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