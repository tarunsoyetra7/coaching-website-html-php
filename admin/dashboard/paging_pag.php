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
                        <h4 class="page-header">
                            Welcome 
                            	<small>
									<?php 
										$id=$_COOKIE['login']; $q=$db->query("select user_name from user_infromation where user_id=$id") or die("");
										$idRes=$q->fetch(PDO::FETCH_ASSOC); echo $idRes['user_name']; ?>
                                </small>
                        </h4>
                        <ol class="breadcrumb">
                            <li class="active">
                               <a href="index.php">
                               		<i class="fa fa-dashboard"></i> Dashboard
                               </a>
                            </li>
                        </ol>
  
                    </div> 
                    </div>
                    
                    
<div class="col-lg-12">
	<table class="table table-bordered table-responsive">
    	<thead>    
        <tr>    
            <th>S. No.</th>
            <th>Batch</th>
            <th>Center Detail</th>    
            <th>Courses</th>
            <th>Owner Detail</th>
            <th>Created By</th>
            <th>Option</th>    
        </tr>    
    </thead>
    
    
    <tbody>
	<?php
	
	$totalCountQ=$db->query("SELECT center_info_master.id, 
		user_infromation.user_id, 
			   user_infromation.user_name, 
			   batch_master.batch_name, 
			   center_info_master.o_f_name, 
			   center_info_master.o_l_name, 
			   center_info_master.o_c_n_id, 
			   center_info_master.o_m_no, 
			   center_info_master.created_by, 
			   center_info_master.o_email_id, 
			   center_info_master. t_c_batch, 
			   (SELECT GROUP_CONCAT(c_name) 
				FROM   course_master 
				WHERE  FIND_IN_SET(id, o_c_n_id))  AS course_name, 
			   center_info_master.o_c_n_name, 
			   center_info_master.t_c_pro_img, 
			   center_info_master.t_c_name, 
			   center_info_master.t_cmp_add, 
			   DATE_FORMAT(t_c_stdate, '%M %d %Y') AS t_c_stdate 
		FROM   center_info_master, 
			   batch_master, 
			   user_infromation 
		WHERE  center_info_master.flag = 'true' 
			   AND center_info_master.t_c_batch = batch_master.id 
			   AND center_info_master.created_by = user_infromation.user_id 
		ORDER  BY center_info_master.id DESC ") or die("");
		
		$totalLimit=$totalCountQ->rowCount();
		
		
		$q=$db->query("SELECT center_info_master.id, 
		user_infromation.user_id, 
			   user_infromation.user_name, 
			   batch_master.batch_name, 
			   center_info_master.o_f_name, 
			   center_info_master.o_l_name, 
			   center_info_master.o_c_n_id, 
			   center_info_master.o_m_no, 
			   center_info_master.created_by, 
			   center_info_master.o_email_id, 
			   center_info_master. t_c_batch, 
			   (SELECT GROUP_CONCAT(c_name) 
				FROM   course_master 
				WHERE  FIND_IN_SET(id, o_c_n_id))  AS course_name, 
			   center_info_master.o_c_n_name, 
			   center_info_master.t_c_pro_img, 
			   center_info_master.t_c_name, 
			   center_info_master.t_cmp_add, 
			   DATE_FORMAT(t_c_stdate, '%M %d %Y') AS t_c_stdate 
		FROM   center_info_master, 
			   batch_master, 
			   user_infromation 
		WHERE  center_info_master.flag = 'true' 
			   AND center_info_master.t_c_batch = batch_master.id 
			   AND center_info_master.created_by = user_infromation.user_id 
		ORDER  BY center_info_master.id DESC ") or die("");                                             
		$i=0;
		$out="";
        while($result = $q->fetch(PDO::FETCH_ASSOC))
		{											
			if($result['t_c_pro_img']=="" || $result['t_c_pro_img']==NULL){
				$proImgUrl="../../center_profile/default_image.jpg";				
			}
			else{
				$proImgUrl="../../center_profile/".$result['id'].".".$result['t_c_pro_img'];
			}
			$i++;   $out.='
			<tr>
			   <td>'.$i.'</td>
			   <td>'.$result['batch_name'].'</td>
			   <td><img src="'.$proImgUrl.'" id="profile_image"><strong>Name : </strong>'.$result['t_c_name'].'<br><strong>Address : </strong>'.$result['t_cmp_add'].'</td>														
				<td>'.str_replace(",","<br>",$result['course_name']).'<br><br><span class="courseDetail" id="'.$result['id'].'|'.$result['o_c_n_id'].'" >view</span></td>
				<td class="nowrap"><strong>Name : </strong> '.$result['o_f_name']." " . $result['o_l_name'].'<br><strong>Contact : </strong> '.$result['o_m_no'].' <br> '.$result['o_email_id'].'</td>
				<td>'.$result['user_name'].'</td>		
				<td><a id="edit_btn" href="training_institute_master.php?id='.$result['id'].'">Edit</a> |   <span id="view_btn" onClick="clickToFetch('.$result['id'].')">View</span>
			    </td>
			</tr>';
			}
			echo $out;
		?>
	</tbody>
    
    
    </table>
</div>

<style>
.pagging_class {
	list-style:none;
}
.pagging_class li{
	float:left; margin:2px;   border-radius:2px;
}
.pagging_class li a{
	text-decoration:none;
	 color:#495B79; 
}
</style>

<ul class="pagging_class">
<?php for($i=0; $i<=$totalLimit; $i++){ ?>
	<li><a href="#"><?php echo $i; ?></a></li>
    <?php } ?>
</ul>

                                       
                   </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    
    
</body>
</html>
<?php
}
else
{
	header("location:../index.php");	
}
?>