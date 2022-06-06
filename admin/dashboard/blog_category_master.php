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
                                <h4 align="center"><strong>Blog Category  Master</strong></h4>
                                <hr>

                                <ol class="breadcrumb">

                                    <li class="active">
                                        <a href="blog_category_master.php"><i class="fa fa-dashboard"></i> Add Blog Category</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_blog_category_master.php"><i class="fa fa-dashboard"></i> Manage Blog Category</a>
                                    </li>
									
									<li class="active">
                                        <a href="blog_category_detail.php"><i class="fa fa-dashboard"></i> Add Blog Detail</a>
                                    </li>
									
									<li class="active">
                                        <a href="manage_blog_category_detail.php"><i class="fa fa-dashboard"></i> Manage Blog Detail</a>
                                    </li>
                                </ol>
                            </div>

<?php if(isset($_REQUEST['id'])){
	$edit_id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("select * from blog_category_master where flag='true' and id=$edit_id") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
 <form name="" method="post" enctype="multipart/form-data" action="blog_category_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label>Blog Category Title</label>
                                    <input id="txt_b_cat_title" value="<?php echo $editQ_res['b_cat_title']; ?>"  name="txt_b_cat_title" type="text" class="form-control" placeholder="Enter Title *">
									<input type="hidden" name="txt_hide" id="txt_hide" value="<?php echo $editQ_res['id']; ?>">
                                    <br>
                                </div>


                                <div class="col-lg-4">

                                    <label>Priority</label>
									 <input value="<?php echo $editQ_res['b_cat_priority']; ?>" type="number" name="txt_priority" id="txt_priority" class="form-control" placeholder="Priority *">
									
                                    <br>
                                </div>

                                <div class="col-lg-2">
									 <label>Post Enable/ Disable</label>
									
									 <select class="form-control" name="txtEnableDisable">
									 <?php if($editQ_res['e_d_optn']=="true"){ $sela="selected"; } else { $sela=""; } ?>
									 <?php if($editQ_res['e_d_optn']=="false"){ $selb="selected"; } else { $selb=""; } ?>
										<option <?php echo $selb; ?> value="false">No</option>
										<option <?php echo $sela; ?> value="true">Yes</option>
									 </select>
									 <br>
								</div>

                                <div class="col-lg-12">

                                    <strong class="text-success">SEO Section :</strong>
                                    <hr>
</div>
<div class="col-lg-6">
                                    <label>Keyword</label>
                                    <textarea id="txt_keyword"  name="txt_keyword" type="text" class="form-control" rows="4" placeholder="Keyword *"><?php echo $editQ_res['b_cat_key']; ?></textarea>

                                    <br>
</div>

<div class="col-lg-6">
                                    <label>Description</label>
                                    <textarea id="txt_description"  name="txt_description" type="text" rows="4" class="form-control" placeholder="Description *"><?php echo $editQ_res['b_cat_descp']; ?></textarea>

                                    <br>
                                </div>

								
                                <div class="col-lg-12">

                                    <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button><br><br>
                                </div>

								
								 
								 
							
                            </form>
<?php	} else { ?>
                            <!--start --->
                            <form name="" method="post" enctype="multipart/form-data" action="blog_category_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label>Blog Category Title</label>
                                    <input id="txt_b_cat_title"  name="txt_b_cat_title" type="text" class="form-control" placeholder="Enter Title *">
									<input type="hidden" name="txt_hide" id="txt_hide">
                                    <br>
                                </div>


                                <div class="col-lg-4">

                                    <label>Priority</label>
									 <input type="number" name="txt_priority" id="txt_priority" class="form-control" placeholder="Priority *">
									
                                    <br>
                                </div>

                                <div class="col-lg-2">
									 <label>Post Enable/ Disable</label>
									 <select class="form-control" name="txtEnableDisable">
										<option value="false">No</option>
										<option value="true">Yes</option>
									 </select>
									 <br>
								</div>

                                <div class="col-lg-12">

                                    <strong class="text-success">SEO Section :</strong>
                                    <hr>
</div>
<div class="col-lg-6">
                                    <label>Keyword</label>
                                    <textarea id="txt_keyword"  name="txt_keyword" type="text" class="form-control" rows="4" placeholder="Keyword *"></textarea>

                                    <br>
</div>

<div class="col-lg-6">
                                    <label>Description</label>
                                    <textarea id="txt_description"  name="txt_description" type="text" rows="4" class="form-control" placeholder="Description *"></textarea>

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
	if($("#txt_b_cat_title").val()=="" || $("#txt_b_cat_title").val()==null){
		$("#txt_b_cat_title").focus();
	}
	else if($("#txt_priority").val()=="" || $("#txt_priority").val()==null){
			$("#txt_priority").focus();
	}
	else if($("#txt_keyword").val()=="" || $("#txt_keyword").val()==null){
			$("#txt_keyword").focus();
	}
	else if($("#txt_description").val()=="" || $("#txt_description").val()==null){
			$("#txt_description").focus();
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