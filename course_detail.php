<!DOCTYPE html>
<html lang="en-US">
<?php include("root/db_connection.php"); 

?>
<head>

 <link rel="stylesheet" type="text/css" href="stylesheets/sensible_style.css">
</head>
<?php include("header.php"); 

if(isset($_REQUEST['id']))
{
			$id=$_REQUEST['id'];			
							$query=$db->query("SELECT id,c_title,c_img,c_duration,c_fees,c_s_descp,c_l_descp FROM course_master where id=$id  ");
$result=$query->fetch(PDO::FETCH_ASSOC);


?>

    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="../">Home</a></li>
            <li><a href="our-courses">Courses</a></li>
            <li class="active"><b><?php echo $result['c_title'];?></b></li>
        </ol>
    </div>
    
<style>
#main_div_123{
	background:#E8E5C3 !important; 
	padding-top:15px  !important; 
	padding-bottom:15px  !important;
	border-radius:4px  !important;
}
.c_title_name{
font-size:27px !important;

}
</style>
    
    <div id="page-content">
        <div class="container">
            <div class="row">
    
                <div id="main_div_123">
<div class="col-lg-4">
	<img src="course_master/<?php echo $result['id'].".". $result['c_img'] ; ?>" alt="<?php echo $result['c_title'];?>" title="<?php echo $result['c_title'];?>" width="360" height="210">
	
</div>
<div class="col-lg-8">
	<h1  class="c_title_name"><?php echo $result['c_title'];?></h1>
	<p align="justify">
		<?php echo $result['c_s_descp'];?></p>
	
</div>
<div class="float_clear_both"></div>
</div>
<br>

<style>
</style>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lmcontact_box">
  <img src="image/clmlm.png" alt="Sensible Contact Quick Contact" title="Sensible Contact Quick Contact"> 
	<span class="text"> Call a Course Adviser for discussing <b>Curriculum Details</b> </span>
                          <span class="num"><img src="image/calllm.gif" alt="Sensible Computers Customer Care" title="Sensible Computers Customer Care"> 
                                                                        +91 93013-51989                                                                    </span>
                                                                </div>
												
<div class="float_clear_both"></div>
<br>


<div class="col-lg-8" style="padding-left:0px;">
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?php echo $result['c_title'];?></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><p><?php echo $result['c_l_descp'];?></p></div>
      </div>
    </div>
    </div></div>
<style>
.c_list{
	margin:0px; padding-left:15px; list-style:none; padding-right:15px;
}
.c_list li{
	line-height:30px; border-bottom:1px dotted #ccc;
}
.c_list li a{
	color:#032A51; font-size:15px;
}	
.side_heading{
padding-right:0px !important;
}
.side_heading_1{
	 border: 2px solid #e2e2e2 !important;
}
.panel-heading{
	background:#E8E5C3 !important;
    padding: 12px 8px !important;
}
</style>											
<div class="col-lg-4 side_heading">
<div  class="side_heading_1">
	<div class="panel-heading">
        <h4 class="panel-title">
          <a href="javascript:void(0);">More Courses</a>
        </h4>
      </div>
<ul class="c_list">
						<?php	
						
						function clean_url($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}



						$query=$db->query("SELECT id,c_title FROM course_master ");
while($result_c=$query->fetch((PDO::FETCH_ASSOC))){ ?>



	<li><a href="course-detail/<?php echo clean_url($result_c['c_title']); ?>/<?php echo $result_c['id']; ?>">
	<i class="fa fa-chevron-right" style="font-size:11px; color:gray;"></i>
	 <?php echo $result_c['c_title']  ?></a></li><?php } ?>
	 
	
</ul>	
	</div>
</div>

<br>


                
                
               
                                        <style>
										p{
								
    text-align: justify !important;

    color: #767676;
    line-height: 20px;
    margin-top: 0px;

    font-weight: 300;
    font-size: 16px;
    line-height: 30px !important;

    margin: 0 0 10px;
	
  
 
										}
										.ul_li li{
	  color: #767676;
  font-size:14px;
  list-style:none;
  }
                                        </style>
                                        
                                            
                              
               
            </div>
            
        </div><br>
        
    </div><?php }
	else{
		?>
		<h1>
        No Result Found
        </h1>
		<?php
		}
	?>
    
    <?php include("footer.php"); ?>