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
                                <h4 align="center"><strong>Test Category Master</strong></h4>
                                <hr>

                                <ol class="breadcrumb">

                                    <li class="active">
                                        <a href="test_category_master.php"><i class="fa fa-dashboard"></i> Add Test Category</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_test_category_master.php"><i class="fa fa-dashboard"></i> Manage Test Category</a>
                                    </li>
									
									 <li class="active">
                                        <a href="test_question_master.php"><i class="fa fa-dashboard"></i> Question Master</a>
                                    </li>
									 <li class="active">
                                        <a href="manage_test_question_master.php"><i class="fa fa-dashboard"></i> Manage  Question Master</a>
                                    </li>
									
                                </ol>
                            </div>

<?php if(isset($_REQUEST['id'])){
	$id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("select id,q_cat_title,q_cat_parent,q_cat_img,q_cat_keyword,q_cat_descp,q_cat_priority,q_cat_short_descp from online_test_category where id=$id and flag='true'") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
<form name="" method="post" enctype="multipart/form-data" action="test_category_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label>Test Category Title</label>
                                    <input value="<?php echo $editQ_res['q_cat_title']; ?>" id="txt_test_title"  name="txt_test_title" type="text" class="form-control" placeholder="Title *">
									<input type="hidden" name="txt_hide" value="<?php echo $editQ_res['id']; ?>" id="txt_hide">
                                    <br>
                                </div>


                                <div class="col-lg-6">

                                    <label>Select Parent</label>
                                    <select class="form-control" name="txt_sel_parent" id="txt_sel_parent">
                                        <option value="0">---Select Parent---</option>
										<?php $m_Q=$db->query("SELECT
node.id,
    node.q_cat_parent,
    CONCAT(IFNULL(up3.q_cat_title, ''), IFNULL(CONCAT(up2.q_cat_title, ' --> '), ''), IFNULL(CONCAT(up1.q_cat_title, ' --> '), ''), node.q_cat_title) AS q_cat_title
FROM online_test_category AS node
LEFT OUTER JOIN online_test_category AS up1
ON up1.id = node.q_cat_parent
LEFT OUTER JOIN online_test_category AS up2
ON up2.id = up1.q_cat_parent
LEFT OUTER JOIN online_test_category AS up3
ON up3.id = up2.q_cat_parent
WHERE node.flag = 'true' 
ORDER BY node.id DESC") or die(""); 
while($m_Q_res=$m_Q->fetch(PDO::FETCH_ASSOC)){ ?>
<?php
		if($editQ_res['id']==$m_Q_res['id']){
																?>
                                                                <option selected value="<?php echo $editQ_res['q_cat_parent']; ?>"><?php echo $m_Q_res['q_cat_title']; ?></option>
                                                                <?php
															}else{
															 ?>
                            				<option value="<?php echo $m_Q_res['id']; ?>"><?php echo $m_Q_res['q_cat_title']; ?></option>				
<?php  } } ?>
                                    </select>
                                    <br>
                                </div>

                                <div class="col-lg-6">
                                   

                                    <label>Image</label>
                                    <input type="file" name="txt_image" id="txt_image" class="form-control">
									<?php if($editQ_res['q_cat_img']=="" || $editQ_res['q_cat_img']==NULL){ } else { ?>
									<img src="../../test_cat_image/<?php echo $editQ_res['id'].".".$editQ_res['q_cat_img']; ?>" style="width:40px; height:40px;">
									<?php } ?>
                                    <span class="pull-right">(file type : jpg, jpeg, png)</span>
									<br>
                                    </div>
									<div class="col-lg-6">

                                    
<label>Priority</label>
									 <input value="<?php echo $editQ_res['q_cat_priority']; ?>" type="number" name="txt_priority" id="txt_priority" class="form-control" placeholder="Priority *">
									 <br>
                                  

									
									
                                </div>
								
								
								<div class="col-lg-12">
								<label> Descprition : </label>
								
								
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
                                                    <div id="editor"><?php echo $editQ_res['q_cat_short_descp']; ?></div>
                                                </main>

                                                <script>
                                                    initSample();
                                                </script>
								<!---end--->
								
								<input type="hidden" id="txt_short_descp"  name="txt_short_descp" >
								
								
								<br>
								</div>

                                <div class="col-lg-6">

                                    <strong class="text-success">SEO Section :</strong>
                                  <br>

                                    <label>Keyword</label>
                                    <textarea id="txt_keyword"  name="txt_keyword" type="text" class="form-control" rows="6" placeholder="Keyword *"><?php echo $editQ_res['q_cat_keyword']; ?></textarea>

                                    <br></div>
                                    <div class="col-lg-6">
									<br>

                                    <label>Description</label>
                                    <textarea id="txt_seo_description"  name="txt_seo_description" type="text" rows="6" class="form-control" placeholder="Description *"><?php echo $editQ_res['q_cat_descp']; ?></textarea>

                                    <br>
                                </div>

                                <div class="col-lg-12">

                                    <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
                                </div>

                            </form>
<?php

	} else {  ?>
	<form name="" method="post" enctype="multipart/form-data" action="test_category_master_do.php" id="txt_form">
                                <div class="col-lg-6">
                                    <label>Test Category Title</label>
                                    <input value="" id="txt_test_title"  name="txt_test_title" type="text" class="form-control" placeholder="Title *">
									<input type="hidden" name="txt_hide" value="" id="txt_hide">
                                    <br>
                                </div>


                                <div class="col-lg-6">

                                    <label>Select Parent</label>
                                    <select class="form-control" name="txt_sel_parent" id="txt_sel_parent">
                                        <option value="0">---Select Parent---</option>
										<?php $m_Q=$db->query("SELECT
node.id,
    node.q_cat_parent,
    CONCAT(IFNULL(up3.q_cat_title, ''), IFNULL(CONCAT(up2.q_cat_title, ' --> '), ''), IFNULL(CONCAT(up1.q_cat_title, ' --> '), ''), node.q_cat_title) AS q_cat_title
FROM online_test_category AS node
LEFT OUTER JOIN online_test_category AS up1
ON up1.id = node.q_cat_parent
LEFT OUTER JOIN online_test_category AS up2
ON up2.id = up1.q_cat_parent
LEFT OUTER JOIN online_test_category AS up3
ON up3.id = up2.q_cat_parent
WHERE node.flag = 'true' 
ORDER BY node.id DESC") or die(""); while($m_Q_res=$m_Q->fetch(PDO::FETCH_ASSOC)){ ?>
		<option value="<?php echo $m_Q_res['id']; ?>"><?php echo $m_Q_res['q_cat_title']; ?></option>
<?php } ?>
                                    </select>
                                    <br>
                                </div>

                                <div class="col-lg-6">
                                   

                                    <label>Image</label>
                                    <input type="file" name="txt_image" id="txt_image" class="form-control">
                                    <span class="pull-right">(file type : jpg, jpeg, png)</span>
									<br>
                                    </div>
									<div class="col-lg-6">

                                    
<label>Priority</label>
									 <input value="" type="number" name="txt_priority" id="txt_priority" class="form-control" placeholder="Priority *">
									 <br>
                                  

									
									
                                </div>
								
								
								<div class="col-lg-12">
								<label>Descprition : </label>
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
								
								<input type="hidden" id="txt_short_descp"  name="txt_short_descp" >
								<br>
								</div>

                                <div class="col-lg-6">

                                    <strong class="text-success">SEO Section :</strong>
                                  <br>

                                    <label>Keyword</label>
                                    <textarea id="txt_keyword"  name="txt_keyword" type="text" class="form-control" rows="6" placeholder="Keyword *"></textarea>

                                    <br></div>
                                    <div class="col-lg-6">
									<br>

                                    <label>Description</label>
                                    <textarea id="txt_seo_description"  name="txt_seo_description" type="text" rows="6" class="form-control" placeholder="Description *"></textarea>

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
	if($("#txt_test_title").val()=="" || $("#txt_test_title").val()==null){
		$("#txt_test_title").focus();
	}
	else if($("#txt_priority").val()=="" || $("#txt_priority").val()==null){
			$("#txt_priority").focus();
	}
	else if($("#txt_keyword").val()=="" || $("#txt_keyword").val()==null){
			$("#txt_keyword").focus();
	}
	else if($("#txt_seo_description").val()=="" || $("#txt_seo_description").val()==null){
			$("#txt_seo_description").focus();
	}
	else{
		var Descp = $('#cke_1_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
		$("#txt_short_descp").val(Descp);
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