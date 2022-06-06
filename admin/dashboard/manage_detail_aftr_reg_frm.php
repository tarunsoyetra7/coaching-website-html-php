<?php
	if(isset($_COOKIE['login'])){
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
                        <h4 align="center">
                            Manage Detail After Registration
                        </h4><hr>
                        <ol class="breadcrumb">
                            <li class="active">
                               <a href="center_exam_detail_page.php">
                               		<i class="fa fa-dashboard"></i> Add  Detail
                               </a>
                            </li>
                            
                             <li class="active">
                               <a href="manage_detail_aftr_reg_frm.php">
                               		<i class="fa fa-dashboard"></i> Manage Detail
                               </a>
                            </li>
                            
                        </ol>
                    </div> 
                    <div class="col-lg-12">
                    

 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">



 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                                            <thead style="background:#6C7D87; color:#fff;">

                                                <tr >

                                                    <th>S. No.</th>
													<th>Center Name</th>
                                                    
                                                    
                                                    <th>Date</th>
                                                    
                                                  
                                                    
                                                    
                                                    <th> Sheet</th>
													
                                                  
                                                    
                                                    

                                                   <th>Option</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php


$q=$db->query("SELECT detail_aftr_reg.id,institute_id,t_c_name ,cls_start_date ,cls_end_date ,exm_date ,stud_data_frm ,stud_vari_sheet ,stud_atten_sheet ,present_stud ,ass_fee_detail ,payment_descp FROM detail_aftr_reg,center_info_master WHERE detail_aftr_reg.flag='true' AND center_info_master.id=detail_aftr_reg.institute_id ORDER BY detail_aftr_reg.id desc") or die("");

                                             
$i=0;
$out="";
                                                while($result = $q->fetch(PDO::FETCH_ASSOC))

                                                {
													$i++;   $out.='

                                                    <tr>

                                                           <td>'.$i.'</td>
														   
														   
														   <td>'.$result['t_c_name'].'</td>
														   
														   
														   <td>
														   
														   <strong>Class Start Date : </strong>'.$result['cls_start_date'].'<br>
														   <strong>Class End Date : </strong>'.$result['cls_end_date'].'<br>
														   <strong>Final Exam Date : </strong>'.$result['exm_date'].'<br>
														   </td>
														   
														 
												<td>
												<strong>Student Data Form : </strong>'.$result['stud_data_frm'].'<br>
						<strong>Student Varification Sheet : </strong>'.$result['stud_vari_sheet'].'						
												
												
												</td>			
															
															
                                                            <td>
  <a style="margin-bottom:4px;" href="center_exam_detail_page.php?id='.$result['id'].'"class="btn btn-sm btn-raised btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
  
  
                 <a style="margin-bottom:4px;" href="#" onclick="return DeleteTIM('.$result['id'].')" class="btn btn-raised btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i></a>


   
  
   
                                             
                                                            

                                                            </td>

                                                    </tr>';

                                                    }

                                                    echo $out;

                                                ?>

                                            </tbody>

                                        </table>
                                      
                    </div>
                    
                    
                                        
                   </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    
    
    

<!-- data tables -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/datatables/dataTables.buttons.min.js"></script>
<script src="js/datatables/buttons.flash.min.js"></script>
<script src="js/datatables/jszip.min.js"></script>
<script src="js/datatables/pdfmake.min.js"></script>
<script src="js/datatables/vfs_fonts.js"></script>
<script src="js/datatables/buttons.html5.min.js"></script>
<script src="js/datatables/buttons.print.min.js"></script>


<script type="text/javascript">    
	$(function () {
	  
		$('#example1').DataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false
		 
		});
	  });
</script>


<script>
function DeleteTIM(value){
	//alert(value);

var r = confirm("Are you sure you really wana to delete !!...");
if (r == true) {	
    $.ajax({
		type:"POST",
		data:{del_id:value},
		url:"delete_training_institute_master.php",
		success: function(r_data){
			alert(r_data);
			location.reload();
		}
		,error:function(err){
			location.reload();
		}
	});	
} else {   
}		
}
</script>

<script>
function clickToFetch(id){
	
	$("#center_detail_Res").html("");
	
	//alert(id);
	var id=id;
	$.ajax({
		type:"POST",
		url:"view_center_detail.php",
		data:{id:id},		
		success: function(r_data){			
			$("#center_detail_Res").html(r_data);
			$("#myModal").modal("show");
			
		},error:function(err){
			location.reload();
		}
	});
	
	
}
</script>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" >

    <!-- Modal content-->
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


</body>
</html>
<?php
}
else
{
	header("location:../index.php");	
}
?>