<!DOCTYPE html><?php include("root/db_connection.php");  ?>
<html lang="en-US">
<head>
  <link rel="stylesheet" type="text/css" href="stylesheets/sensible_style.css">

   


    </head>
<?php include"header.php"; ?>
<?php
	$id=str_replace("'","",$_REQUEST['id']);	
?>
 <?php  $headingQ=$db->query("SELECT id, 
       q_cat_title
      ,q_cat_short_descp
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

 <div class="bread_cls" align="center">

 </div> 
 
 <section class="col-md-8 col-sm-8">
 <div class="col-right"> 
 
 <div class="col-lg-12 practice_div" > 
 <a href="javascript:void(0);"> 
 <div class="practice_div1">
 
 
			
<div class="clear_both"></div>
	
	<p align="justify">
	<?php if($headingQ_res['q_cat_short_descp']=="" || $headingQ_res['q_cat_short_descp']==NULL ||  $headingQ_res['q_cat_short_descp']=="<p><br></p>"){
		
		?>
		<script>
			window.location.replace("practic_test_final_page.php?id=<?php echo $id; ?>");
		</script>
		<?php
		//header("location:practic_test_final_page.php?id=".$id);
	} ?>
		<?php echo $headingQ_res['q_cat_short_descp']; ?> 
</p>	 
		 </div>

	<div class="clear_both"></div>	 
		 <hr>
<p align="center">

	<a href="practic_test_final_page.php?id=<?php echo $id; ?>"><button class="btn btn-info">Start Practice Test</button></a>
</p>


</div>

<div class="clear_both"></div>
</div>
		
	
	
</section>

<aside  class="col-md-4 col-sm-4">


<?php include("practic_test_side_bar.php"); ?>
</aside>
 <script type="text/javascript" src="javascript/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>


    <script type="text/javascript" src="javascript/main.js"></script>
<?php include("quick_enq_modal.php"); ?>

  </div><!-- end row-->
  </div> <!-- end container-->
<?php include"footer.php"; ?>

<!-- End footer-->
