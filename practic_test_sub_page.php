<!DOCTYPE html> <?php include("root/db_connection.php");  ?>
<html lang="en-US">
<head>
    
<link rel="stylesheet" type="text/css" href="stylesheets/sensible_style.css">



</head>
<?php include"header.php"; ?>
<!-- /navbar -->


<?php
	$id=str_replace("'","",$_REQUEST['id']);	?>
<div class="bread_cls" align="center">
 <?php  $headingQ=$db->query("SELECT id, 
       q_cat_title
      
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND id = $id") or die(""); 
		$headingQ_res=$headingQ->fetch(PDO::FETCH_ASSOC);
?>
 
 </div>
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

<!-- =========================Start Col left section ============================= -->


<br> 
<section class="col-md-8 col-sm-8">

<div class="col-right">
 
 
 
 <div class="col-lg-12 practice_div" >

 
 <a href="javascript:void(0);">

<div class="clear_both"></div>
<?php
 $subCatQ=$db->query("SELECT id, 
       q_cat_title       
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND q_cat_parent = $id 
ORDER  BY q_cat_priority ASC ") or die("");
 if($subCatQ->rowCount()==0){ ?><script>window.location.replace("practic_read_page.php?id=<?php echo $id; ?>");</script>  <?php } else { 
	 
		while($subCatQ_res=$subCatQ->fetch(PDO::FETCH_ASSOC)){
 ?>		 
<div class="col-lg-6 practice_test_div" >
	<div class="practice_test_div1">
	
	
	<!---href="practic_test_final_page.php?r_id=<?php //echo $id; ?>&id=<?php //echo $subCatQ_res['id'];  ?>"--->
	
<a class="contact_p" href="practic_read_page.php?id=<?php echo $subCatQ_res['id'];  ?>">
<i class="fa fa-folder-open"></i> 
<?php echo $subCatQ_res['q_cat_title']; ?></a></div></div>
	   <?php } } ?>
<!---
<div class="col-lg-6"><a href="#"><i class="icon icon-folder-open"></i> Decimal Fraction</a></div>--->



</div>

<div class="clear_both"></div>
</div>
		
	
	
</section>

<aside  class="col-md-4 col-sm-4">


<?php include("practic_test_side_bar.php"); ?>
</aside>


  </div><!-- end row-->
  </div> <!-- end container-->
<?php include"footer.php"; ?>

<!-- End footer-->
