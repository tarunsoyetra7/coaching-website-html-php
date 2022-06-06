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
                                <h4 align="center"><strong>Course Master</strong></h4>
                                <hr>

                                <ol class="breadcrumb">

                                    <li class="active">
                                        <a href="course_master.php"><i class="fa fa-dashboard"></i> Course Master</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_course.php"><i class="fa fa-dashboard"></i> Manage Course</a>
                                    </li>
									
									
									
                                </ol>
                            </div>

<?php if(isset($_REQUEST['id'])){
	$id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("SELECT id,c_title,c_img,c_duration,c_fees,c_s_descp,c_l_descp,c_priority FROM course_master where id=$id and flag='true'") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
<form name="" method="post" enctype="multipart/form-data" action="course_master_do.php" id="txt_form">
                               <div class="col-lg-6">
                                    <label>Course Title</label>
                                    <input value="<?php  echo "$editQ_res[c_title]"; ?>" id="txt_title"  name="txt_title" type="text" class="form-control" placeholder="Title *">
									<input type="hidden" name="txt_hide" value="<?php  echo "$editQ_res[id]"; ?>" id="txt_hide">
                                    <br>
                                </div>


                               

                                <div class="col-lg-6">
                                   

                                    <label>Image</label>
                   <input type="file" name="txt_image" id="txt_image" class="form-control">
                                    <span class="pull-right">(file type : jpg, jpeg, png)</span>
									<?php if($editQ_res['c_img']==""  || $editQ_res['c_img']==NULL){ } else { ?> 
									<img src="../../course_master/<?php echo $editQ_res['id'].".".$editQ_res['c_img']; ?>" style="width:30px; height:30px;">
									<?php } ?>
                                    </div>
									<div class="col-lg-6">
                                    <label>Duration</label>
									 <input value="<?php  echo "$editQ_res[c_duration]"; ?>" type="text" name="txt_duration" id="txt_duration" class="form-control" placeholder="Duration *">
                                    
                                    </div>
                                    <div class="col-lg-6">
                                    <label>Fees</label>
									 <input value="<?php  echo "$editQ_res[c_fees]"; ?>" type="number" name="txt_fees" id="txt_fees" class="form-control" placeholder="Fees *">
                        
                                    </div>
                                    
								
								
								<div class="col-lg-12"><br>
								<label>Long Descprition : </label>
								<!---start--->
								 <script src="ckeditor.js"></script>
                                                <script src="samples/js/sample.js"></script>

                                                <link rel="stylesheet" href="samples/toolbarconfigurator/lib/codemirror/neo.css">
                                                <script src="js/jquery.min.js"></script>
                                                <style>
                                                    #cke_1_contents {
                                                        height: 300px !important;
                                                    }
                                                </style>
                                                <main>
                                                    <div id="editor"><?php  echo "$editQ_res[c_l_descp]"; ?></div>
                                                </main>

                                                <script>
                                                    initSample();
                                                </script>
								<!---end--->
								
								<input type="hidden" id="txt_long_descp"  name="txt_long_descp" >
								<br>
								</div>
                                <div class="col-lg-12">

                                  <label>Short Description</label>
                                    <textarea id="txt_shrt_description"  name="txt_shrt_description" type="text" rows="6" class="form-control" placeholder="Description *"><?php  echo "$editQ_res[c_s_descp]"; ?></textarea>

                                    <br>
                                </div>
                                <div class="col-lg-6">
                                <label>Priority</label>
									 <input value="<?php  echo "$editQ_res[c_priority]"; ?>" type="number" name="txt_priority" id="txt_priority" class="form-control" placeholder="Priority *">
									
                                  <br>
                               </div>

                                

                                <div class="col-lg-12">

             <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
                                </div>


                            </form>
<?php

	} else {  ?>
	<form name="" method="post" enctype="multipart/form-data" action="course_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label>Course Title</label>
                                    <input value="" id="txt_title"  name="txt_title" type="text" class="form-control" placeholder="Title *">
									<input type="hidden" name="txt_hide" value="" id="txt_hide">
                                    <br>
                                </div>


                               

                                <div class="col-lg-6">
                                   

                                    <label>Image</label>
                                    <input type="file" name="txt_image" id="txt_image" class="form-control">
                                    <span class="pull-right">(file type : jpg, jpeg, png)</span>
									<br>
                                    </div>
									<div class="col-lg-6">
                                    <label>Duration</label>
									 <input value="" type="text" name="txt_duration" id="txt_duration" class="form-control" placeholder="Duration *">
                                    
                                    </div>
                                    <div class="col-lg-6">
                                    <label>Fees</label>
									 <input value="" type="number" name="txt_fees" id="txt_fees" class="form-control" placeholder="Fees *">
                        
                                    </div>
                                    
								
								
								<div class="col-lg-12"><br>
								<label>Long Descprition : </label>
								<!---start--->
								 <script src="ckeditor.js"></script>
                                                <script src="samples/js/sample.js"></script>

                                                <link rel="stylesheet" href="samples/toolbarconfigurator/lib/codemirror/neo.css">
                                                <script src="js/jquery.min.js"></script>
                                                <style>
                                                    #cke_1_contents {
                                                        height: 300px !important;
                                                    }
                                                </style>
                                                <main>
                                                    <div id="editor"></div>
                                                </main>

                                                <script>
                                                    initSample();
                                                </script>
								<!---end--->
								
								<input type="hidden" id="txt_long_descp"  name="txt_long_descp" >
								<br>
								</div>
                                <div class="col-lg-12">

                                  <label>Short Description</label>
                                    <textarea id="txt_shrt_description"  name="txt_shrt_description" type="text" rows="6" class="form-control" placeholder="Description *"></textarea>

                                    <br>
                                </div>
                                <div class="col-lg-6">
                                <label>Priority</label>
									 <input value="" type="number" name="txt_priority" id="txt_priority" class="form-control" placeholder="Priority *">
									
                                  <br>
                               </div>

                                

                                <div class="col-lg-12">

             <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
                                </div>

                            </form>
<?php } ?>
                           
                            <!---end--->
                        </div>

                    </div>
                </div>
        </div>
<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	<script>
$(".btn_submit").on("click",function(e){
	/*txt_test_title
txt_hide
txt_sel_parent
txt_image  
txt_priority 
txt_keyword 
txt_short_descp  
txt_description  
 */
	if($("#txt_title").val()=="" || $("#txt_title").val()==null){
		$("#txt_title").focus();
	}
	else if($("#txt_priority").val()=="" || $("#txt_priority").val()==null){
			$("#txt_priority").focus();
	}
	else if($("#txt_duration").val()=="" || $("#txt_duration").val()==null){
			$("#txt_duration").focus();
	}
	else if($("#txt_shrt_description").val()=="" || $("#txt_shrt_description").val()==null){
			$("#txt_shrt_description").focus();
	}
	else{
		var Descp = $('#cke_1_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
		$("#txt_long_descp").val(Descp);
		//alert(Descp);
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