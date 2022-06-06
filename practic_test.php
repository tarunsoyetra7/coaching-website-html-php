<!DOCTYPE html> <?php include("root/db_connection.php");  ?>
<html lang="en-US">
<head>
        <link rel="stylesheet" type="text/css" href="stylesheets/sensible_style.css">
      

</head>
<?php include("header.php");
 ?>

      <div class="flat-page-header " style="background-color:#ccc;">
            <div class="container">
                <div class="row">
                    <div class="flat-wrapper">
                        <div class="page-header-title">
                            <h2 class="title"><i class="fa fa-laptop"></i> Free Practice Test and Solution :-</h2>
                        </div>
                    </div><!-- /.flat-wrapper -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.page-header -->
		
		   <div class="page-title style1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">                    
                        <div class="page-title-heading">
                            <div class="breadcrumbs">
                                <ul class="trail-items">
                                    <li>You are here:</li>
                                    <li class="trail-item"><a href="index.html">Home</a></li>
                                
                                    <li class="trail-end">Practise Test</li>
                                </ul>                   
                            </div>
                        </div><!-- /.page-title-captions -->                        
                    </div><!-- /.col-md-12 -->  
                </div><!-- /.row -->  
            </div><!-- /.container -->                      
        </div><!-- /.page-title -->
	  
<!-- /navbar -->

<div class="container" >

<div class="row" >
<br>
 <div class="col-lg-12" > 
 
 
 <br>
 
<?php $testQ=$db->query("SELECT id, 
       q_cat_title ,q_cat_img       
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND q_cat_parent = 0 
ORDER  BY q_cat_priority desc ") or die(""); 
$i=0;
while($testQ_res=$testQ->fetch(PDO::FETCH_ASSOC)){ $i++; $cat_id=$testQ_res['id'];  ?> 
   <div class="col-lg-4 blog_body practice_div3" >
   
		<div class="p_test_heading practice_div4">
			<h5 class="practice_h51"> <?php echo $testQ_res['q_cat_title']; ?></h5>
		</div>
		<div class="practice_div5">
		<div class="practice_div6">
			<img src="test_cat_image/<?php echo $testQ_res['id'].".".$testQ_res['q_cat_img']; ?>" class="practice_img2" >
		</div>
		<div class="practice_div7">
			<div class="p_test">
			<ul class="practice_ul">		
			<?php 
			
		
			
			$childQ=$db->query("SELECT id, 
       q_cat_title        
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND q_cat_parent = $cat_id 
ORDER  BY q_cat_priority desc") or die("");

		$j=0;
					while($childQ_res=$childQ->fetch(PDO::FETCH_ASSOC)){ $j++; ?>
					<li><a href="practic_test_sub_page.php?id=<?php echo $childQ_res['id']; ?>">
							<i class="fa fa-chevron-right practice_li" ></i> <?php echo $childQ_res['q_cat_title']; ?></a></li>
					<?php if($j>4){ ?>
						<li><a href="#"  class="pull-right r_m_cls practice_read" id="<?php echo $cat_id; ?>"><strong><u> Read More..</u></strong></a></li>
						
					<?php break;  } else { } ?>
				<?php } ?>
				<!---<li><a href="#"><i class="icon icon-check"></i> Online Aptitude Test</a></li>--->				
				<div class="clear_both"></div>
			</ul>
		</div>	
		</div>
		<div class="clear_both"></div>
	</div>	
			
   </div>
   <?php if($i==3){ ?><div class="col-lg-12"></div> <?php } else { } ?>
<?php } ?>   
  
   
  </div>
   <br>

<!-- =========================Start Col left section ============================= -->

 


  </div><!-- end row-->
  </div> <!-- end container-->
<?php include("footer.php"); ?>
 
 <script type="text/javascript" src="javascript/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>


    <script type="text/javascript" src="javascript/main.js"></script>
	<?php include("quick_enq_modal.php"); ?>
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

<div id="r_m_popup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      
	 <p align="center" id="res_loader">
	 <br><br>
		<img src="images/loading2.gif" class="practice_img">
	<br><br>
	 </p>
	<span id="sel_Res"></span>
      
    </div>

  </div>
</div>
<!---end modal--->
<!-- End footer-->
