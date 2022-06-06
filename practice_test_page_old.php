<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">   
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <title></title>
	
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117536454-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-117536454-1');
</script>


</head>
<?php include"header.php"; ?>

<!-- /navbar -->

<div class="container" >
<style>
.blog_body {
    margin-bottom: 20px;
    padding: 20px;
    border: 1px solid #cdcdcd;
    box-shadow: 0 1px 5px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    border-radius: 4px;
	width:320px;
	
}
</style>
<div class="row" >
<br>
 <div class="col-lg-12" > 
 
 <div >
		<h2>&nbsp; 
<i class="fa fa-laptop"></i> Free Practice Test and Solution :- </h2>

</div>

 
 <br>
 
<?php $testQ=$db->query("SELECT id, 
       q_cat_title ,q_cat_img       
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND q_cat_parent = 0 
ORDER  BY q_cat_priority ASC ") or die(""); 
$i=0;
while($testQ_res=$testQ->fetch(PDO::FETCH_ASSOC)){ $i++; $cat_id=$testQ_res['id'];  ?> 
   <div class="col-lg-4 blog_body" style="margin-bottom:30px; margin-right:20px;">
   
		<div class="p_test_heading" style="border-top-left-radius:5px;  border-top-right-radius:5px;">
			<h5 style="margin:0px; font-size:16px; font-weight:300;"> <?php echo $testQ_res['q_cat_title']; ?></h5>
		</div>
		<div style=" border: 1px solid #e0eaf0; border-bottom-left-radius:5px;  border-bottom-right-radius:5px;">
		<div style="width:30%;  padding:15px;  float:left;">
			<img src="test_cat_image/<?php echo $testQ_res['id'].".".$testQ_res['q_cat_img']; ?>" style="width:100%;" >
		</div>
		<div style="width:70%; float:left;">
			<div class="p_test">
			<ul style="list-style:none;">		
			<?php $childQ=$db->query("SELECT id, 
       q_cat_title        
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND q_cat_parent = $cat_id 
ORDER  BY q_cat_priority ASC") or die("");

		$j=0;
					while($childQ_res=$childQ->fetch(PDO::FETCH_ASSOC)){ $j++; ?>
					<li><a href="practic_test_sub_page.php?id=<?php echo $childQ_res['id']; ?>">
							<i class="fa fa-chevron-right" style="font-size:12px; color:gray;"></i> <?php echo $childQ_res['q_cat_title']; ?></a></li>
					<?php if($j>4){ ?>
						<li><a href="#" style="color:blue;" class="pull-right r_m_cls" id="<?php echo $cat_id; ?>"><strong><u> Read More..</u></strong></a></li>
						
					<?php break;  } else { } ?>
				<?php } ?>
				<!---<li><a href="#"><i class="icon icon-check"></i> Online Aptitude Test</a></li>--->				
				<div style="clear:both;"></div>
			</ul>
		</div>	
		</div>
		<div style="clear:both;"></div>
	</div>	
			
   </div>
   <?php if($i==3){ ?><div class="col-lg-12"></div> <?php } else { } ?>
<?php } ?>   
  
   
  </div>
   <br>

<!-- =========================Start Col left section ============================= -->

 


  </div><!-- end row-->
  </div> <!-- end container-->
<?php include"footer.php"; ?>
<script>
function click_prac(id){
	//alert(id);
	window.location.replace("practic_test_sub_page.php?id="+id);
}
</script>


<!--start modal--->
<script>
$(".r_m_cls").on("click",function(e){
	$("#sel_Res").html("");	
	$("#r_m_popup").modal("show");
	var cur_id=$(this).attr('id');
	$("#res_loader").css("display","block");
	$.ajax({
		type:"POST",
		url:"fetch_sub_practic_list.php",
		data:{cur_id:cur_id},
		success:function(r_data){
			//alert(r_data);	
			$("#res_loader").css("display","none");
			$("#sel_Res").html(r_data);	
			
		},error:function(err){
		location.reload();
		}
	});
	
});
</script>
<!-- Modal -->
<style>
#res_loader{
	display:none;
}
</style>
<div id="r_m_popup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      
	 <p align="center" id="res_loader">
	 <br><br>
		<img src="images/loading2.gif" style="width:65px; height:65px;">
	<br><br>
	 </p>
	<span id="sel_Res"></span>
      
    </div>

  </div>
</div>
<!---end modal--->
<!-- End footer-->
