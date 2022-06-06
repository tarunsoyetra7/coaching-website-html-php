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
	line-height:25px; 
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
                                            <h4 align="center"><strong>Menu  Detail</strong></h4>
                                            <hr>

                                            <ol class="breadcrumb">

                                                 <li class="active">
                                        <a href="vocab_express_master.php"><i class="fa fa-dashboard"></i> Add Vocab</a>
                                    </li>

                                    <li class="active">
                                        <a href="manage_vocab_master.php"><i class="fa fa-dashboard"></i> Manage Menu</a>
                                    </li>
									
									<li class="active">
                                        <a href="vocab_express_detail.php"><i class="fa fa-dashboard"></i> Add Detail</a>
                                    </li>
									
									<li class="active">
                                        <a href="manage_vocab_detail.php"><i class="fa fa-dashboard"></i> Manage Detail</a>
                                    </li>

                                            </ol>
                                        </div>

                                        <!--start --->
<?php if(isset($_REQUEST['id'])){
$edit_id=str_replace("'","",$_REQUEST['id']);
$editQ=$db->query("select id,m_title,m_cat_id,m_short_img,m_s_descp,m_doc,m_l_descp,m_key,
m_descp from vocab_express_detail where flag='true' and id=$edit_id") or die("");
$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
<form method="post" action="vocab_detail_do.php" enctype="multipart/form-data" id="txt_form">
                                            <div class="col-lg-8">

			<label>Title</label>
			<input id="txt_title" name="txt_title" type="text" class="form-control" placeholder="Title *" value="<?php echo $editQ_res['m_title']; ?>">
			<input type="hidden" name="txt_hide" id="txt_hide" value="<?php echo $editQ_res['id']; ?>">
			<br>
			<label>Short Description</label>
			<textarea rows="4" id="txt_short_description" id="txt_short_description" name="txt_short_description" class="form-control" placeholder="Short Description *"><?php echo $editQ_res['m_s_descp']; ?></textarea>
			<br>
			
			
			<label>Short Image</label>
			<input type="file" name="txt_short_img" id="txt_short_img" class="form-control">
			<?php if($editQ_res['m_short_img']=="" || $editQ_res['m_short_img']==NULL){ } else { ?>
			<img src="../../vocab_express_detail_short_img/<?php echo $editQ_res['id'].".".$editQ_res['m_short_img'];  ?>" style="width:30px; height:30px;">
			<?php } ?>
				<span class="pull-right">(file type : jpg, jpeg, png)</span>
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
                                                    <div id="editor"><?php echo $editQ_res['m_l_descp']; ?></div>
                                                </main>

                                                <script>
                                                    initSample();
                                                </script>
                                                <br>
			<input type="hidden" id="txt_long_descp" name="txt_long_descp">
			
			
			<hr>
			
			<strong class="text-danger">SEO Section:</strong>
			<br>
			<div class="col-lg-6" style="padding-left:0px;">
				<label>Keyword</label>
				
				<textarea class="form-control" id="txt_keyword" name="txt_keyword" placeholder="Keyword *" rows="4"><?php echo $editQ_res['m_key']; ?></textarea>
				<br>
			</div>
			<div class="col-lg-6" style="padding-right:0px;">
				<label>Description</label>
				<textarea class="form-control" id="txt_description" name="txt_description" placeholder="Description *" rows="4"><?php echo $editQ_res['m_descp']; ?></textarea>
				<br>
			</div>
                  
			

				  </div>
											

                                           <div class="col-lg-4">

                
<?php 
function parent_child($id){
	
	$db = new PDO('mysql:host=localhost;dbname=e_abhyas;charset=utf8mb4', 'root', '');
	$q2=$db->query("select id,m_title from vocab_express_master where m_parent_id=$id") or die("");
	while($r2=$q2->fetch(PDO::FETCH_ASSOC)){  $id=$r2['id'];
?>
	<ul>
		<li><span><input type="checkbox" id="<?php echo $id; ?>" class="check_cat"></span>
			<?php echo $r2['m_title']; ?>  
			<?php
				$count=$q2->rowCount();
				if($count!=0){			
				}		 
				else{									 
				}
			?>                                 				
			<span><?php $count=$q2->rowCount();
				if($count=0){
					break;
				}
				else{ 
					parent_child($id);
				}
				?>
			</span>
		</li>
	</ul>
<?php	
	}
	?>
	<?php
	}
?> 

                                               <div style="background:#333; color:#fff; padding:6px;"> <label>Category:</label></div>
                                               <div style="border:1px solid #333;">
											   
											   <ul class="list_category_list">
											   <input type="hidden" id="txtEditCatId" value="<?php echo $editQ_res['m_cat_id']; ?>">
											   
       <?php $q1=$db->query("select id,m_title from vocab_express_master where m_parent_id=0") or die("");
	  while($r1=$q1->fetch(PDO::FETCH_ASSOC)){ $m_id=$r1['id']; ?>
                                                       <li><span><input type="checkbox" id="<?php echo $m_id; ?>" class="check_cat"></span> 
                                                    <?php echo $r1['m_title']; ?><span> </span>

                                                    <?php 
													 parent_child($m_id);
					?>

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
                                        <form method="post" action="vocab_detail_do.php" enctype="multipart/form-data" id="txt_form">
                                            <div class="col-lg-8">

                                                <label>Title</label>
                                                <input id="txt_title" name="txt_title" type="text" class="form-control" placeholder="Title *">
                                                <input type="hidden" name="txt_hide" id="txt_hide">
                                                <br>
												
												
												
												
                                                <label>Short Description</label>
                                                <textarea rows="4" id="txt_short_description" id="txt_short_description" name="txt_short_description" class="form-control" placeholder="Short Description *"></textarea>
                                                
                                                <br>
												
												<label>Short Image</label>
                                                <input type="file" name="txt_short_img" id="txt_short_img" class="form-control">
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
                                                    <div id="editor"></div>
                                                </main>

                                                <script>
                                                    initSample();
                                                </script>
                                                <br>
												
                                                <input type="hidden" id="txt_long_descp" name="txt_long_descp">
												
												
												
                                                <hr><strong class="text-danger">SEO Section:</strong>
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
<ul id="treeview" class="hummingbird-base list_category_list">
	<?php 
		$q1=$db->query("select id,m_title from vocab_express_master where m_parent_id=0") or die("query");
		while($r1=$q1->fetch(PDO::FETCH_ASSOC)){ $m_id=$r1['id']; ?>
		<!--start level 1--->
		<li>
		<label><input type="checkbox" id="<?php echo $m_id; ?>" class="check_cat">
			<?php echo $r1['m_title']; ?></label>
			<ul>
				<?php
				$q2=$db->query("select id,m_title from vocab_express_master where m_parent_id=$m_id") or die("query");
				while($r2=$q2->fetch(PDO::FETCH_ASSOC)){ $m_id1=$r2['id'];
				?>
				<!---start level 2--->
				<li>
				<label><input type="checkbox" id="<?php echo $m_id."-".$m_id1; ?>" class="check_cat">
				<?php echo $r2['m_title']; ?></label> 
					<ul>
						<?php
						$q3=$db->query("select id,m_title from vocab_express_master where m_parent_id=$m_id1") or die("query");
						while($r3=$q3->fetch(PDO::FETCH_ASSOC)){ $m_id2=$r3['id'];
						?>
						<!---start level 3--->
						<li>
						<label><input type="checkbox" id="<?php echo $m_id."-".$m_id1."-".$m_id2; ?>" class="check_cat"> 
						<?php echo $r3['m_title']; ?> </label>
							<ul>
								<?php
								$q4=$db->query("select id,m_title from vocab_express_master where m_parent_id=$m_id2") or die("query");
								while($r4=$q4->fetch(PDO::FETCH_ASSOC)){ $m_id3=$r3['id'];
								?>
								<!---start level 4--->
								<li>
								<label><input type="checkbox" id="<?php echo $m_id."-".$m_id1."-".$m_id2."-".$m_id3; ?>" class="check_cat">
								<?php echo $r4['m_title']; ?> </label>
								</li>
								<!---end level 4--->
								<?php } ?>
							</ul>
						
						</li>
						<!---end level 3--->
						<?php } ?>
					</ul>
				</li>
				<!---end level 2---->
				<?php } ?>
			</ul>
		</li>
		<!--end level 1--->
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
				empty_cat=empty_cat.replace(/-/gi, ",");
				//alert(empty_cat);
				$("#txt_menu_cat_hide").val(empty_cat);
				
                if ($("#txt_title").val() == "" || $("#txt_title").val() == null) {
                    $("#txt_title").focus();
                
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

		
		<script src="hummingbird-treeview.js"></script>
    <script>
        $("#treeview").hummingbird();
		
		
		$('input:checkbox').change(function(){
		if($(this).is(":checked")){
			$(this).addClass("chk_cat"); }
		else{
			$(this).removeClass("chk_cat");}
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