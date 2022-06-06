<?php
	if(isset($_COOKIE['login'])){		
		$login_id= $_COOKIE['login'];
		require("../../root/db_connection.php");
		/*----query for login type---*/
		$loginTypeQ=$db->query("select login_type from user_infromation where user_id=$login_id") or die("");		
		$loginTypeQ_res=$loginTypeQ->fetch(PDO::FETCH_ASSOC);
		$login_type=$loginTypeQ_res['login_type'];		
		if($login_type=="sadmin"){
			$fetch_condition="";			
		}
		else{
			$fetch_condition="AND center_info_master.created_by=$login_id";
		}
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
     <link rel="stylesheet" href="css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">  
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/datatables/dataTables.buttons.min.js"></script>
    <script src="js/datatables/buttons.print.min.js"></script> 
</head>
<body>
    <div id="wrapper">
        <?php  include("header.php");  ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                     <div class="col-lg-12">
                        <h4 align="center"><strong>Training Institute Master</strong></h4><hr>
                       	<ol class="breadcrumb">
                             <li class="active">
                               <a href="training_institute_master.php">
                                    Add Institute
                               </a>
                            </li>
                            <li class="active">
                               <a href="manage_training_institute_master.php">
                                     Manage Institute
                               </a>
                            </li>
                            
                             <li class="active">
                               <a href="course_wise_center_list.php">
                                    <i class="fa fa-dashboard"></i>Course wise center list
                               </a>
                            </li>
                             
                        </ol>
                    </div>
                    <div class="col-lg-12">              
<table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">
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
			$centerID=$result['id'];
			$i++;											
			if($result['t_c_pro_img']=="" || $result['t_c_pro_img']==NULL){
				$proImgUrl="../../center_profile/default_image.jpg";				
			}
			else{
				$proImgUrl="../../center_profile/".$result['id'].".".$result['t_c_pro_img'];
			}
			?>
            
            <tr>
			   <td><?php echo $i; ?></td>
			   <td><?php echo $result['batch_name']; ?></td>
			   <td><img src="<?php echo $proImgUrl; ?>" id="profile_image"><strong>Name : </strong><?php echo $result['t_c_name']; ?><br><strong>Address : </strong><?php echo $result['t_cmp_add']; ?></td>														
				<td><?php //echo str_replace(",","<br>",$result['course_name']); ?>
                  <?php $c_ID=explode(",",$result['o_c_n_id']);
					$cNAME=explode(",",$result['course_name']);
				for($j=0; $j<count($c_ID); $j++){
					
					
					$totalStudQ=$db->query("select count(id) as total_student from student_master where institut_id=$centerID and course_id=".$c_ID[$j]." and flag='true'") or die("");	
					$totalStudQ_res=$totalStudQ->fetch(PDO::FETCH_ASSOC);
					echo $cNAME[$j]."&nbsp;{". $totalStudQ_res['total_student'] ."}<br>";
				}
					 ?>
                
                
                <br><br><span class="courseDetail" id="<?php echo $result['id'].'|'.$result['o_c_n_id']; ?>" >view</span></td>
				<td class="nowrap"><strong>Name : </strong><?php echo $result['o_f_name']." " . $result['o_l_name']; ?><br><strong>Contact : </strong><?php echo $result['o_m_no'].' <br> '.$result['o_email_id']; ?></td>
				<td><?php echo $result['user_name']; ?></td>		
				<td>
    <a id="edit_btn" href="training_institute_master.php?id=<?php echo $result['id']; ?>">Edit</a> <!--|   <span id="view_btn" onClick="clickToFetch('<?php //echo $result['id']; ?>')">View</span>-->
			    </td>
			</tr>
            
            
            <?php
		}
		?>
	</tbody>
    <!--<a  href="#" id="'.$result['id'].'-'.$result['user_id'].'" class="deleteTIM">Delete</a> |-->
	</table>
   </div></div> </div></div></div></div>
   
    
    
    




<script type="text/javascript">    
	$(function () {
	  
		$('#example1').DataTable({
		  "paging": true,
		  "lengthChange": true,
		   
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false,
		  dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf', 'print'
        ]
		});
	  });
</script>



<div id="courseModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Institute Name</h4>
      </div>
      <div class="modal-body">
      <span id="courseVariAttenRes"></span>
      </div>
    </div>
  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Institute Name</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover table-condensed table-striped">
        	<tbody id="center_detail_Res">
            </tbody>
        </table>
      </div>    
    </div>
    </div>
</div>
<script>
function clickToFetch(e){$("#center_detail_Res").html("");var e=e;$.ajax({type:"POST",url:"view_center_detail.php",data:{id:e},success:function(e){$("#center_detail_Res").html(e),$("#myModal").modal("show")},error:function(e){location.reload()}})}$(".deleteTIM").on("click",function(e){var t=$(this).attr("id"),a=confirm("Are you sure you really wana to delete !!...");1==a&&$.ajax({type:"POST",data:{del_id:t},url:"delete_training_institute_master.php",success:function(e){alert(e),location.reload()},error:function(e){location.reload()}})}),$(".courseDetail").on("click",function(e){var t=$(this).attr("id"),a=t.split("|"),o=a[0],r=a[1];$.ajax({type:"POST",data:{center_ID:o,center_course_id:r},url:"fetch_course_vari_attend_sheet.php",success:function(e){$("#courseModal").modal("show"),$("#courseVariAttenRes").html(e)},error:function(e){location.reload()}})});
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