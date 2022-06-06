<!DOCTYPE html> <?php include("root/db_connection.php");  ?>
<html lang="en-US">
<head>
     <link rel="stylesheet" type="text/css" href="stylesheets/sensible_style.css">
       

</head>

<?php include"header.php"; ?>
<!-- /navbar -->



<?php
	
	$id=str_replace("'","",$_REQUEST['id']);
?>

	  <?php  $headingQ=$db->query("SELECT id, 
       q_cat_title
      
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND id = $id") or die(""); 
		$headingQ_res=$headingQ->fetch(PDO::FETCH_ASSOC);
?>
	 
		
		 
 <div class="flat-page-header " style="background-color:#ccc;">
            <div class="container">
                <div class="row">
                    <div class="flat-wrapper">
                        <div class="page-header-title">
                            <h2 class="title"> <?php echo $headingQ_res['q_cat_title']; ?></h2>
                        </div>
                    </div><!-- /.flat-wrapper -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.page-header -->

        <!-- Page title -->
        <div class="page-title style1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">                    
                        <div class="page-title-heading">
                            <div class="breadcrumbs">
                                <ul class="trail-items">
                                    <li>You are here:</li>
                                    <li class="trail-item"><a href="index.html">Home</a></li>
                                    <li class="trail-item"><a href="about.html">Practise Test</a></li>
                                    <li class="trail-end"> <?php echo $headingQ_res['q_cat_title']; ?></li>
                                </ul>                   
                            </div>
                        </div><!-- /.page-title-captions -->                        
                    </div><!-- /.col-md-12 -->  
                </div><!-- /.row -->  
            </div><!-- /.container -->                      
        </div><!-- /.page-title -->





<div class="container" >

<div class="row" >

 <br>
<section class="col-md-8 col-sm-8">

 

<!---start question--->
<?php
 $total_rec_q=$db->query("SELECT id
       
FROM   question_master 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND Find_in_set('$id', que_cat_id) ") or die("");
 $total_rec=$total_rec_q->rowCount();
 
 $noOfRecPerPage=10;
 $totalNoOfPage=  ceil( $total_rec/$noOfRecPerPage);

	if(isset($_REQUEST["pgno"])==true)
	{
		$startPoint=($_REQUEST["pgno"]-1) * $noOfRecPerPage;
	}
	else
	{
		$startPoint=0;
	}

?>

<?php $que_Q=$db->query("SELECT id, 
       que_title, 
       optn_one, 
       optn_two, 
       optn_three, 
       optn_four, 
       optn_five, 
       ans_no, 
       que_solution, 
       que_priority 
FROM   question_master 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND Find_in_set('$id', que_cat_id) limit $startPoint, $noOfRecPerPage") or die(""); $i=0;
	   
	   if($que_Q->rowCount()==0){ 
	   ?>
		<div align="center">
			<h5 class="practice_h5_1">
			No Question in this Test Category <br> Please Select Another Test Category !...
			<br><br>
			<a href="practic_test_page.php"><button class="btn btn-sm btn-info">Test Category</button></a>
			</h5>
			
		</div>
	   <?php  } else { 
	   
while($que_Q_res=$que_Q->fetch(PDO::FETCH_ASSOC)){  $i++;
	?>
	<div class="col-right practice_right" >
	
<div class="practice_div2">
	<h5 class="practice_h5">
		<?php echo $que_Q_res['que_title']; ?>
	</h5>
	
	<ul class="question_sec">
		<li onClick="optn_no('<?php echo $que_Q_res['id']."-1"."-".$que_Q_res['ans_no']; ?>')">
			<a href="javascript:void(0);" id="<?php echo $que_Q_res['id']."-1"."-".$que_Q_res['ans_no']; ?>" >A</a> 
				<?php echo $que_Q_res['optn_one']; ?> </li>
		<li onClick="optn_no('<?php echo $que_Q_res['id']."-2"."-".$que_Q_res['ans_no']; ?>')">
			<a href="javascript:void(0);" id="<?php echo $que_Q_res['id']."-2"."-".$que_Q_res['ans_no']; ?>" >B</a> 
				<?php echo $que_Q_res['optn_two']; ?> 
		<li onClick="optn_no('<?php echo $que_Q_res['id']."-3"."-".$que_Q_res['ans_no']; ?>')">
			<a href="javascript:void(0);" id="<?php echo $que_Q_res['id']."-3"."-".$que_Q_res['ans_no']; ?>" >C</a> 
				<?php echo $que_Q_res['optn_three']; ?></li>
		<li onClick="optn_no('<?php echo $que_Q_res['id']."-4"."-".$que_Q_res['ans_no']; ?>')">
			<a href="javascript:void(0);" id="<?php echo $que_Q_res['id']."-4"."-".$que_Q_res['ans_no']; ?>" >D</a> 
				<?php echo $que_Q_res['optn_four']; ?></li>
		
		<?php if($que_Q_res['optn_five']=="" || $que_Q_res['optn_five']==NULL || $que_Q_res['optn_five']=="<p><br></p>"){ } else { ?>
		<li onClick="optn_no('<?php echo $que_Q_res['id']."-5"."-".$que_Q_res['ans_no']; ?>')">
			<a href="javascript:void(0);" id="<?php echo $que_Q_res['id']."-5"."-".$que_Q_res['ans_no']; ?>" >E</a> 
				<?php echo $que_Q_res['optn_five']; ?></li>
		<?php } ?>
		
	</ul>
	
	<ul class="bottom_footer">
		<li>
			<a href="javascript:void(0);" id="view_ans_<?php echo $que_Q_res['id']; ?>" class="view_ans_sec">
				<i class="fa fa-book"></i> View Answer
			</a>
		</li>
		<li>
			<span class="pull-right">
			<a href="javascript:void(0);" >Share This : </a> 
			<a title="Share this link on facebook" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><img src="https://www.quicksearch.in/images/fb-share.png" alt="Facebook-icon" width="31" height="32"></a>
			<a title="Share this business on google plus" onclick="window.open('https://plus.google.com/share?url=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><img src="https://www.quicksearch.in/images/g-share.png" alt="Google-plus-icon" width="31" height="32"></a>
			</span>
		</li>
	</ul>
				
						
	
	<div class="clear_both"></div>
	
	<div id="show_ans_<?php echo $que_Q_res['id']; ?>" class="show_ans_cls">
		<p align="justify" class="practice_p"><span class="practice_span">
			Answer:</span> Option <strong><?php if($que_Q_res['ans_no']=="1")
			{ $a="A"; } else if($que_Q_res['ans_no']=="2"){ $a="B"; } else if($que_Q_res['ans_no']=="3"){
			$a="C"; } else if($que_Q_res['ans_no']=="4"){ $a="D"; } else if($que_Q_res['ans_no']=="5"){ $a="E"; }	?><?php echo $a; ?></strong>
			
			<br><br>
			<span class="practice_span">
				Explanation:
			</span>
				<?php echo $que_Q_res['que_solution']; ?>
		</p>
	</div>
</div></div>
	   <?php } } $last_i=$i; ?>
<!---end question--->




<div class="text-center">
               <ul class="pagination">
			   <?php for($i=1;$i<=ceil($totalNoOfPage);$i++)
{
	?>
                  <!--  <li><a href="#">Prev</a></li>
                    <li class="active"><a href="#">1</a></li>--->
                    <li><a href="practic_test_final_page.php?id=<?php echo $id; ?>&pgno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php } ?>
                    <!--<li><a href="#">3</a></li>
                    <li><a href="#">Next</a></li>-->
              </ul>
          </div><!-- end pagination-->
		  

		 

<div class="clear_both"></div>

		
	
	
</section>

<aside  class="col-md-4 col-sm-4">

<?php include("practic_test_side_bar.php"); ?>

</aside>


  </div><!-- end row-->
  </div> <!-- end container-->
<?php include"footer.php"; ?>
  <script type="text/javascript" src="javascript/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>


    <script type="text/javascript" src="javascript/main.js"></script>
<?php include("quick_enq_modal.php"); ?>
    
  <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-117536454-1');
        </script>
        
<script>

function optn_no(id){
	var final_clr_id=id;
	var cur_id=id;
	cur_id=cur_id.split("-");
	var que_id=cur_id[0];
	var optn_id=cur_id[1];
	var ans_id=cur_id[2];
	//alert("optn"+optn_id);
	//alert(final_clr_id);
	
	if(optn_id==ans_id){
		$("#"+final_clr_id).css("color","green");
		var togglecur_id="view_ans_"+que_id;
		showCur=togglecur_id.replace("view_ans_","show_ans_");
		//alert(showCur);
		$("#"+showCur).toggle();
	}
	else{
		$("#"+final_clr_id).css("color","red");
	}
}

$(".view_ans_sec").on("click",function(e){
	var cur_id=$(this).attr('id');
	showCur=cur_id.replace("view_ans_","show_ans_");
	//alert(showCur);
	$("#"+showCur).toggle();
});
</script>
<!-- End footer-->
