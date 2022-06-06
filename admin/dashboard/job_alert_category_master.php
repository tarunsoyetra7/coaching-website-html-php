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
                                <h4 align="center"><strong>Job Altert Category  Master</strong></h4>
                                <hr>

                                <ol class="breadcrumb">

                                    <li class="active">
                                        <a href="job_alert_category_master.php"><i class="fa fa-dashboard"></i> Add Job Alert Category</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_job_alert_category_master.php"><i class="fa fa-dashboard"></i> Manage Job Alert Category</a>
                                    </li>
									
									<li class="active">
                                        <a href="job_alert_detail_master.php"><i class="fa fa-dashboard"></i> Add Job Alert Detail</a>
                                    </li>
									
									<li class="active">
                                        <a href="manage_job_alert_detail_master.php"><i class="fa fa-dashboard"></i> Manage Job Alert Detail</a>
                                    </li>
                                </ol>
                            </div>

<?php if(isset($_REQUEST['id'])){
	$id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("select * from job_alert_category_master where id=$id") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);
	//echo $editQ_res['id'];
	?>
	<form name="" method="post" enctype="multipart/form-data" action="job_alert_category_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label> Title</label>
                                    <input value="<?php echo $editQ_res['cat_title']; ?>" id="txt_menu_title"  name="txt_menu_title" type="text" class="form-control" placeholder="Title *">
									<input type="hidden" name="txt_hide" value="<?php echo $editQ_res['id']; ?>" id="txt_hide">
                                    <br>
                                </div>


                                <div class="col-lg-6">

                                    <label>Select Parent</label>
                                    <select class="form-control" name="txt_sel_parent" id="txt_sel_parent">
 
 <option value="0">---Select Parent---</option>
  
										<?php $m_Q=$db->query("
SELECT
node.id,
    node.cat_parent_id,
    CONCAT(IFNULL(up3.cat_title, ''), IFNULL(CONCAT(up2.cat_title, ' --> '), ''), IFNULL(CONCAT(up1.cat_title, ' --> '), ''), node.cat_title) AS cat_title
FROM job_alert_category_master AS node
LEFT OUTER JOIN job_alert_category_master AS up1
ON up1.id = node.cat_parent_id
LEFT OUTER JOIN job_alert_category_master AS up2
ON up2.id = up1.cat_parent_id
LEFT OUTER JOIN job_alert_category_master AS up3
ON up3.id = up2.cat_parent_id
WHERE node.flag = 'true' 
ORDER BY node.id DESC") or die("");

 while($m_Q_res=$m_Q->fetch(PDO::FETCH_ASSOC)){

		
if($editQ_res['cat_parent_id']==$m_Q_res['id']){
						?>
						<option selected value="<?php echo $m_Q_res['id']; ?>"><?php echo $m_Q_res['cat_title']; ?></option>
						<?php
							}else{
							 ?>
			<option value="<?php echo $m_Q_res['id']; ?>"><?php echo $m_Q_res['cat_title']; ?></option>				
						<?php }  ?>
														
  <?php } ?>					
                                    </select>
                                    <br>
                                </div>

                                <div class="col-lg-6">
                                    <strong class="text-danger">Main Section:</strong>
                                    <hr>

                                    <label>Image</label>
                                    <input type="file" name="txt_image" id="txt_image" class="form-control">
                                    <span class="pull-right">(Width :150px Height : 150px)  (file type : jpg, jpeg, png)</span>
									<?php if($editQ_res['cat_img']==""  || $editQ_res['cat_img']==NULL){ } else { ?> 
									<img src="../../job_alert_cat_img/<?php echo $editQ_res['id'].".".$editQ_res['cat_img']; ?>" style="width:30px; height:30px;">
									<?php } ?>
                                    <br>

                                    <label>Short Description</label>
                                    <textarea id="txt_short_description"  name="txt_short_description" type="text" class="form-control" placeholder="Description " rows="5"><?php echo $editQ_res['cat_short_descp']; ?></textarea>

                                    <br>
									
									<label>Priority</label>
									 <input value="<?php echo $editQ_res['cat_priority']; ?>" type="number" name="txt_priority" id="txt_priority" class="form-control" placeholder="Priority *">
									 <br>
                                </div>

                                <div class="col-lg-6">

                                    <strong class="text-success">SEO Section :</strong>
                                    <hr>

                                    <label>Keyword</label>
                                    <textarea id="txt_keyword"  name="txt_keyword" type="text" class="form-control" rows="4" placeholder="Keyword *"><?php echo $editQ_res['cat_keyword']; ?></textarea>

                                    <br>

                                    <label>Description</label>
                                    <textarea id="txt_description"  name="txt_description" type="text" rows="6" class="form-control" placeholder="Description *"><?php echo $editQ_res['cat_descp']; ?></textarea>

                                    <br>
                                </div>

								
								
								
								
                                <div class="col-lg-12">

                                    <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
                                </div>

                            </form>
	<?php
}
else{ 	?>
                            <!--start --->
                            <form name="" method="post" enctype="multipart/form-data" action="job_alert_category_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label> Title</label>
                                    <input id="txt_menu_title"  name="txt_menu_title" type="text" class="form-control" placeholder="Title *">
									<input type="hidden" name="txt_hide" id="txt_hide">
                                    <br>
                                </div>


                                <div class="col-lg-6">

                                    <label>Select Parent</label>
                                    <select class="form-control" name="txt_sel_parent" id="txt_sel_parent">
                                        <option value="0">---Select Parent---</option>
										<?php $m_Q=$db->query("
SELECT
node.id,
    node.cat_parent_id,
    CONCAT(IFNULL(up3.cat_title, ''), IFNULL(CONCAT(up2.cat_title, ' --> '), ''), IFNULL(CONCAT(up1.cat_title, ' --> '), ''), node.cat_title) AS cat_title
FROM job_alert_category_master AS node
LEFT OUTER JOIN job_alert_category_master AS up1
ON up1.id = node.cat_parent_id
LEFT OUTER JOIN job_alert_category_master AS up2
ON up2.id = up1.cat_parent_id
LEFT OUTER JOIN job_alert_category_master AS up3
ON up3.id = up2.cat_parent_id
WHERE node.flag = 'true' 
ORDER BY node.id DESC") or die(""); while($m_Q_res=$m_Q->fetch(PDO::FETCH_ASSOC)){ ?>
		<option value="<?php echo $m_Q_res['id']; ?>"><?php echo $m_Q_res['cat_title']; ?></option>
<?php } ?>
                                    </select>
                                    <br>
                                </div>

                                <div class="col-lg-6">
                                    <strong class="text-danger">Main Section:</strong>
                                    <hr>

                                    <label>Image</label>
                                    <input type="file" name="txt_image" id="txt_image" class="form-control">
                                    <span class="pull-right">(Width :150px Height : 150px)   (file type : jpg, jpeg, png)</span>
                                    <br>

                                    <label>Short Description</label>
                                    <textarea id="txt_short_description"  name="txt_short_description" type="text" class="form-control" placeholder="Description " rows="5"></textarea>

                                    <br>
									
									<label>Priority</label>
									 <input type="number" name="txt_priority" id="txt_priority" class="form-control" placeholder="Priority *">
									 <br>
                                </div>

                                <div class="col-lg-6">

                                    <strong class="text-success">SEO Section :</strong>
                                    <hr>

                                    <label>Keyword</label>
                                    <textarea id="txt_keyword"  name="txt_keyword" type="text" class="form-control" rows="4" placeholder="Keyword *"></textarea>

                                    <br>

                                    <label>Description</label>
                                    <textarea id="txt_description"  name="txt_description" type="text" rows="6" class="form-control" placeholder="Description *"></textarea>

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
	/*txt_menu_title
txt_hide
txt_sel_parent
txt_image
txt_short_description
txt_keyword
txt_description */
	if($("#txt_menu_title").val()=="" || $("#txt_menu_title").val()==null){
		$("#txt_menu_title").focus();
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