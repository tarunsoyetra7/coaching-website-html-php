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
<style>
li{
	list-style:none;
}
</style><style>
.list_category_list{
	padding-left:15px;
}
.list_category_list li{
	line-height:30px; 
}
</style>
    </head>

    <body>

        <div id="wrapper">
            <?php  include("header.php");  ?>

                            <div id="page-wrapper">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 align="center"><strong>Blog Detail</strong></h4>
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

                                        <!--start --->
<?php if(isset($_REQUEST['id'])){
$edit_id=str_replace("'","",$_REQUEST['id']);
$editQ=$db->query("select id,b_title,b_cat_id,b_short_img,b_s_descp,b_l_descp,b_key,
b_descp,e_d_optn from blog_category_detail where flag='true' and id=$edit_id") or die("");
$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
<form method="post" action="blog_category_detail_do.php" enctype="multipart/form-data" id="txt_form">
                                            <div class="col-lg-8">

			<label>Title</label>
			<input id="txt_title" name="txt_title" type="text" class="form-control" placeholder="Title *" value="<?php echo $editQ_res['b_title']; ?>">
			<input type="hidden" name="txt_hide" id="txt_hide" value="<?php echo $editQ_res['id']; ?>">
			<br>
			<label>Short Description</label>
			<textarea rows="4" id="txt_short_description" id="txt_short_description" name="txt_short_description" class="form-control" placeholder="Short Description *"><?php echo $editQ_res['b_s_descp']; ?></textarea>
			<br>
			
			
			<label>Short Image</label>
			<input type="file" name="txt_short_img" id="txt_short_img" class="form-control">
			<?php if($editQ_res['b_short_img']=="" || $editQ_res['b_short_img']==NULL){ } else { ?>
			<img src="../../blog_detail_short_img/<?php echo $editQ_res['id'].".".$editQ_res['b_short_img'];  ?>" style="width:30px; height:30px;">
			<?php } ?>
				<span class="pull-right">(size :240px X 152px | file type : jpg, jpeg, png)</span>
				<div style="clear:both;"></div>
			<br>
												
												
			<strong>Long Description:</strong>
			<br>
			
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
                                                    <div id="editor"><?php echo $editQ_res['b_l_descp']; ?></div>
                                                </main>

                                                <script>
                                                    initSample();
                                                </script>
                                                <br>
			<input type="hidden" id="txt_long_descp" name="txt_long_descp">
			<br>
			
			 <div class="col-lg-12" style="padding:0px;">
									 <label>Post Enable/ Disable</label>
									
									 <select class="form-control" name="txtEnableDisable">
									 <?php if($editQ_res['e_d_optn']=="true"){ $sela="selected"; } else { $sela=""; } ?>
									 <?php if($editQ_res['e_d_optn']=="false"){ $selb="selected"; } else { $selb=""; } ?>
										<option <?php echo $selb; ?> value="false">No</option>
										<option <?php echo $sela; ?> value="true">Yes</option>
									 </select>
									 <br>
								</div>

								
								
			
			<strong class="text-danger">SEO Section:</strong>
			<br>
			<div class="col-lg-6" style="padding-left:0px;">
				<label>Keyword</label>
				
				<textarea class="form-control" id="txt_keyword" name="txt_keyword" placeholder="Keyword *" rows="4"><?php echo $editQ_res['b_key']; ?></textarea>
				<br>
			</div>
			<div class="col-lg-6" style="padding-right:0px;">
				<label>Description</label>
				<textarea class="form-control" id="txt_description" name="txt_description" placeholder="Description *" rows="4"><?php echo $editQ_res['b_descp']; ?></textarea>
				<br>
			</div>
                  
			

				  </div>
											

                                           <div class="col-lg-4">

  

                                               <div style="background:#333; color:#fff; padding:6px;"> <label>Blog Category:</label></div>
                                               <div style="border:1px solid #333;">
											   
											   <ul class="list_category_list">
											   <input type="hidden" id="txtEditCatId" value="<?php echo $editQ_res['b_cat_id']; ?>">
											   
       <?php $q1=$db->query("select id,b_cat_title from blog_category_master 
	   where e_d_optn='true' and flag='true' order by id desc
") or die("");
	  while($r1=$q1->fetch(PDO::FETCH_ASSOC)){ $m_id=$r1['id']; ?>
                                                       <li><span><input type="checkbox" id="<?php echo $m_id; ?>" class="check_cat"></span> 
                                                    <?php echo $r1['b_cat_title']; ?><span> </span>

                                                        </li>

                                                        <?php } ?>
                                                </ul>
		<input type="hidden" name="txt_menu_cat_hide" id="txt_menu_cat_hide">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
                                            <br><br>
											</div>
                                            <!---end--->

                                        </form>
<?php } else { ?>										
                                        <!---editor--->
                                        <form method="post" action="blog_category_detail_do.php" enctype="multipart/form-data" id="txt_form">
                                            <div class="col-lg-8">

                                                <label>Blog Title</label>
                                                <input id="txt_title" name="txt_title" type="text" class="form-control" placeholder="Title *">
                                                <input type="hidden" name="txt_hide" id="txt_hide">
                                                <br>
												
												
												
												
                                                <label>Blog Short Description</label>
                                                <textarea rows="4" id="txt_short_description" id="txt_short_description" name="txt_short_description" class="form-control" placeholder="Short Description *"></textarea>
                                                
                                                <br>
												
												
												
												<label>Blog Short Image</label>
                                                <input type="file" name="txt_short_img" id="txt_short_img" class="form-control">
												<span class="pull-right">(size :240px X 152px | file type : jpg, jpeg, png)</span>
                                                <br>
												
												
												
                                                <strong>Blog Long Description:</strong>
                                                <br>
												
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
                                                <br>
												
                                                <input type="hidden" id="txt_long_descp" name="txt_long_descp">
										

<div class="col-lg-12" style="padding:0px;">
									 <label>Post Enable/ Disable</label>
									 <select class="form-control" name="txtEnableDisable" id="txtEnableDisable">
										<option value="false">No</option>
										<option value="true">Yes</option>
									 </select>
									 <br>
								</div>


								
												<br><strong class="text-danger">SEO Section:</strong>
                                                <br>
												<div class="col-lg-6" style="padding-left:0px;">
												
                                                <label>Keyword</label>
                                               
                                                <textarea class="form-control" id="txt_keyword" name="txt_keyword" placeholder="Keyword *" rows="4"></textarea>
                                                <br>
												</div>
                                                <div class="col-lg-6" style="padding-right:0px;">
                                                <label>Description</label>
                                                <textarea class="form-control" id="txt_description" name="txt_description" placeholder="Description *" rows="4"></textarea>
                                                <br>
												</div>
                                            </div>
											

                                           <div class="col-lg-4">

                                               <div style="background:#333; color:#fff; padding:6px;"> <label>Category:</label></div>
                                               <div style="border:1px solid #333;">
											   <ul class="list_category_list">
       <?php $q1=$db->query("select id,b_cat_title from blog_category_master 
	   where e_d_optn='true' and flag='true' order by id desc
") or die("");
	  while($r1=$q1->fetch(PDO::FETCH_ASSOC)){ $m_id=$r1['id']; ?>
                                                       <li><span><input type="checkbox" id="<?php echo $m_id; ?>" class="check_cat"></span> 
                                                    <?php echo $r1['b_cat_title']; ?><span> </span>

                                                        </li>

                                                        <?php } ?>
                                                </ul>
		<input type="hidden" name="txt_menu_cat_hide" id="txt_menu_cat_hide">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
                                            <br><br>
											</div>
                                            <!---end--->

                                        </form>
										<?php } ?>
                                    </div>

                                </div>
                            </div>
        </div>

<script>
	$('input:checkbox').change(function(){
		if($(this).is(":checked")){
			$(this).addClass("chk_cat"); }
		else{
			$(this).removeClass("chk_cat");}
	});
</script>

<?php if(isset($_REQUEST['id'])){
?>
<script>
var empty_list="";
		var e_list=$("#txtEditCatId").val();
		e_list=e_list.split(",");
for(i=0; i<$(".list_category_list .check_cat").length; i++){
	empty_list=empty_list+$(".list_category_list .check_cat:eq("+i+")").attr('id');
	
	for(j=0; j<e_list.length; j++){
		if(i==j){
			console.log("Y---"+e_list[j]);
			$("#"+e_list[j]).addClass("chk_cat");
			$("#"+e_list[j]).prop('checked', true);
	}
	else{
		console.log("N");
	}
	}
	
	empty_list=empty_list+",";
}
empty_list=empty_list.slice(0,-1);
</script>
<?php } else { } ?>	
	
        <script>
		
//alert(empty_list);



            $(".btn_submit").on("click", function(e) {
				
				/*txt_title
				txt_hide
				txt_short_description
				img_doc
				txt_long_descp
				txt_keyword
				txt_description
				txt_menu_cat_hide*/

				
				var empty_cat="";
				for(i=0; i<$(".list_category_list .chk_cat").length; i++){
					empty_cat=empty_cat+$(".list_category_list .chk_cat:eq("+i+")").attr('id');
					empty_cat=empty_cat+",";
				}
				empty_cat=empty_cat.slice(0,-1);
				//alert(empty_cat);
				$("#txt_menu_cat_hide").val(empty_cat);
				
                if ($("#txt_title").val() == "" || $("#txt_title").val() == null) {
                    $("#txt_title").focus();
                } else if ($("#txt_short_description").val() == "" || $("#txt_short_description").val() == null) {
                    $("#txt_short_description").focus();
                } else if ($("#txt_keyword").val() == "" || $("#txt_keyword").val() == null) {
                    $("#txt_keyword").focus();
                } else if ($("#txt_description").val() == "" || $("#txt_description").val() == null) {
                    $("#txt_description").focus();
                } else {
					
					if($("#txt_menu_cat_hide").val()=="" || $("#txt_menu_cat_hide").val()==null){
						alert("Please Select Menu Category !...");
					}
					else{
						var Descp = $('#cke_1_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
						//alert(Descp);
						$("#txt_long_descp").val(Descp);
						$("#txt_form").submit();
					}
                    
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