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
                                <h4 align="center"><strong>Download  Master</strong></h4>
                                <hr>
                                <ol class="breadcrumb">
                                    <li class="active">
                                        <a href="download_master.php"><i class="fa fa-dashboard"></i> Download Master</a>
                                    </li>
                                    <li class="active">
                                        <a href="manage_download_master.php"><i class="fa fa-dashboard"></i> Manage Download</a>
                                    </li>
                                </ol>
                            </div>
<?php if(isset($_REQUEST['id'])){
	$edit_id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("select * from download_master where  id=$edit_id") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

$c_id=$editQ_res['dw_c_id'];
	
?>
 <form name="" method="post" enctype="multipart/form-data" action="download_master_do_1.php" id="txt_form">



 	 <div class="col-lg-6">
                                    <label>Select Course</label>
                                    <select class="form-control" name="txt_course" id="txt_course">
                                    		<option value="0">---select course---</option>
                                    		<?php $neqW=$db->query("SELECT id,c_title FROM `course_master`  order by id desc") or die("");
                                    		while($resNewQ=$neqW->fetch(PDO::FETCH_ASSOC)){

if($resNewQ['id']==$c_id){
	$selVal="selected";
}
else{
	$selVal="";
}

                                    			?>
<option value="<?php echo $resNewQ['id']; ?>" <?php echo $selVal; ?> ><?php echo $resNewQ['c_title']; ?></option>
                                    			<?php
                                    		} ?>
                                    </select><br>
                                </div>



                                <div class="col-lg-6">
                                     
                                    <label>Title</label>
                                    <input id="txt_title"  name="txt_title" type="text" class="form-control" placeholder="Enter Title *" value="<?php echo $editQ_res['dw_title']; ?>">
									<input type="hidden" name="txt_hide" id="txt_hide" value="<?php echo $editQ_res['id']; ?>">
                                    <br></div>

                                    <div class="col-lg-6">
                                    <label>Document</label>
                                    <input type="file" name="txt_doc" id="txt_doc" class="form-control">
									<span>File Type : jpg,png,pdf,xls,docx,zip,rar</span>
									<br>
                                    <span>
                                    <img src="../../download_master_doc/<?php echo $editQ_res['id'].".".$editQ_res['dw_file']; ?>" style="width:30px; height:30px;">
                                    </span>
                                </div>

                                <div class="col-lg-6">
<label>Url</label>
                                    <input id="txt_url"  name="txt_url" type="text" class="form-control" placeholder="Enter Url *" value="<?php echo $editQ_res['dw_link']; ?>">
                               
                                    <br>
                                </div>

								
                                <div class="col-lg-12">
<br>
                                    <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button><br><br>
                                </div>

								
								 
								 
							
                            </form>
<?php	} else { ?>
                            <!--start --->
                            <form name="" method="post" enctype="multipart/form-data" action="download_master_do_1.php" id="txt_form">

 <div class="col-lg-6">
                                    <label>Select Course</label>
                                    <select class="form-control" name="txt_course" id="txt_course">
                                    		<option value="0">---select course---</option>
                                    		<?php $neqW=$db->query("SELECT id,c_title FROM `course_master`  order by id desc") or die("");
                                    		while($resNewQ=$neqW->fetch(PDO::FETCH_ASSOC)){

                                    			?>
<option value="<?php echo $resNewQ['id']; ?>"><?php echo $resNewQ['c_title']; ?></option>
                                    			<?php
                                    		} ?>
                                    </select><br>
                                </div>


                                <div class="col-lg-6">
                                    <label>Title</label>
                                    <input id="txt_title"  name="txt_title" type="text" class="form-control" placeholder="Enter Title *">
									<input type="hidden" name="txt_hide" id="txt_hide">
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <label>Document</label>
                                    <input type="file" name="txt_doc" id="txt_doc" class="form-control">
									<span>File Type : jpg,png,pdf,xls,docx,zip,rar</span>
									<br></div>

                                    <div class="col-lg-6">
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
	else if($("#txt_course option:selected").val()==0){
		$("#txt_course").focus();
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