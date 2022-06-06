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

  
    
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>


    </head>

    <body>
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
        <div id="wrapper">
            <?php  include("header.php");  ?>
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 align="center"><strong>Ads Master</strong></h4>
                                <hr>

                                <ol class="breadcrumb">

                                   
                                                <li class="active">
                                        <a href="ads_master.php"><i class="fa fa-dashboard"></i> Add Ads</a>
                                    </li>
									
									 <li class="active">
                                        <a href="manage_ads_master.php"><i class="fa fa-dashboard"></i> Manage Ads</a>
                                    </li>

                                  
									
									
                                </ol>
                            </div>

<?php if(isset($_REQUEST['id'])){
	$edit_id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("select * from ads_master where flag='true' and id=$edit_id") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
 <form method="post" action="ads_master_do.php" enctype="multipart/form-data" id="txt_form">
							
<div class="col-lg-8">


		<label>Ads Title</label>
		<input  id="txt_title" value="<?php echo $editQ_res['a_title']; ?>" name="txt_title" type="text" class="form-control" placeholder="Title *">
		<input type="hidden" name="txt_hide" id="txt_hide" value="<?php echo $editQ_res['id']; ?>">
		<br>
		
		<label>Ads Image</label>
	   
		<input  id="txt_a_img" name="txt_a_img" type="file" class="form-control" > 
		<img src="../../ads_img/<?php echo $editQ_res['id'].".".$editQ_res['a_img']; ?>" class="pull-right" style="width:50px; height:50px;">
		<span>Width :270px</span>
		<br>
		
		 <label>Ads URL </label>
	   
		<input  id="txt_a_url" name="txt_a_url" value="<?php echo $editQ_res['a_url']; ?>" type="text" class="form-control" placeholder="URL *"> 
		<br>
		
	
		<label>Ads Priority </label>
	   
		<input  id="txt_a_priority" value="<?php echo $editQ_res['a_priority']; ?>" name="txt_a_priority" type="number" class="form-control" placeholder="URL *"> 
		<br>
		
												
												</div>

				<div class="col-lg-4">
<!--start-->
  <div style="background:#333; color:#fff; padding:6px;"> <label>Select Location to Show:</label></div>
      <div style="border:1px solid #333;">
	  
	   <ul class="list_category_list">
											   <input type="hidden" id="txtEditCatId" value="<?php echo $editQ_res['a_sel_loc']; ?>">
											   
       <?php $q1=$db->query("select id,s_loc_name from sel_loc_master") or die("");
	  while($r1=$q1->fetch(PDO::FETCH_ASSOC)){ $m_id=$r1['id']; ?>
                                                       <li><span><input type="checkbox" id="<?php echo $m_id; ?>" class="check_cat"></span> 
                                                    <?php echo $r1['s_loc_name']; ?><span> </span>

                                                        </li>

                                                        <?php } ?>
                                                </ul>
		
		<input type="hidden" name="txt_menu_cat_hide" id="txt_menu_cat_hide">
                                                </div>
<!---end--->
				
				</div>			
                                            
                                       
                             <div class="col-lg-12">
							 <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
							</div>
                                           
											
                                            <!---end--->

                                        </form>
<?php	} else { ?>
                            <form method="post" action="ads_master_do.php" enctype="multipart/form-data" id="txt_form">
							
<div class="col-lg-8">


                                                <label>Ads Title</label>
                                                <input  id="txt_title" name="txt_title" type="text" class="form-control" placeholder="Title *">
                                                <input type="hidden" name="txt_hide" id="txt_hide">
                                                <br>
												
                                                <label>Ads Image</label>
                                               
                                                <input  id="txt_a_img" name="txt_a_img" type="file" class="form-control" > 
												<span>Width :270px</span>
                                                <br>
												
												 <label>Ads URL </label>
                                               
                                                <input  id="txt_a_url" name="txt_a_url" type="text" class="form-control" placeholder="URL *"> 
                                                <br>
												
											
												<label>Ads Priority </label>
                                               
                                                <input  id="txt_a_priority" name="txt_a_priority" type="number" class="form-control" placeholder="URL *"> 
                                                <br>
												
												
												</div>

				<div class="col-lg-4">
<!--start-->
  <div style="background:#333; color:#fff; padding:6px;"> <label>Select Location to Show:</label></div>
      <div style="border:1px solid #333;">
		   <ul class="list_category_list">
       <?php $q1=$db->query("select id,s_loc_name from sel_loc_master") or die("");
	  while($r1=$q1->fetch(PDO::FETCH_ASSOC)){ $m_id=$r1['id']; ?>
                                                       <li><span><input type="checkbox" id="<?php echo $m_id; ?>" class="check_cat"></span> 
                                                    <?php echo $r1['s_loc_name']; ?><span> </span>

                                                        </li>

                                                        <?php } ?>
                                                </ul>
		<input type="hidden" name="txt_menu_cat_hide" id="txt_menu_cat_hide">
                                                </div>
<!---end--->
				
				</div>			
                                            
                                       
                             <div class="col-lg-12">
							 <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button>
							</div>
                                           
											
                                            <!---end--->

                                        </form>
                                        
                            <!---end--->
<?php } ?>



<div style="clear:both;"></div>
                    
					
					
					
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
	$('input:checkbox').change(function(){
		if($(this).is(":checked")){
			$(this).addClass("chk_cat"); }
		else{
			$(this).removeClass("chk_cat");}
	});
	



	$(".btn_submit").on("click",function(e){
		/*txt_title
		txt_a_img
		txt_a_priority
		txt_menu_cat_hide*/
		var empty_cat="";
				for(i=0; i<$(".list_category_list .chk_cat").length; i++){
					empty_cat=empty_cat+$(".list_category_list .chk_cat:eq("+i+")").attr('id');
					empty_cat=empty_cat+",";
				}
				empty_cat=empty_cat.slice(0,-1);
				//alert(empty_cat);
				$("#txt_menu_cat_hide").val(empty_cat);
				
		if($("#txt_title").val()=="" || $("#txt_title").val()==null){
			$("#txt_title").focus();
		}
		
		else if($("#txt_a_priority").val()=="" || $("#txt_a_priority").val()==null){
			$("#txt_a_priority").focus();
		}
		else if($("#txt_a_url").val()=="" || $("#txt_a_url").val()==null){
			$("#txt_a_url").focus();
		}
		
		else if($("#txt_menu_cat_hide").val()=="" || $("#txt_menu_cat_hide").val()==null){
			alert("Please Select Location !...");
		}
		else{
			alert("all ok");
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