<?php
	if(isset($_COOKIE['login'])){
	require("../../root/db_connection.php");
	
	$ins_id=$_REQUEST['ins_id'];
	$c_id=$_REQUEST['c_id'];
	
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
                        <h4 align="center"><strong>Student  Master</strong></h4>                         
					   <hr>
                       
                       <ol class="breadcrumb">
                            <li class="active">
                               <a href="student_info_master.php">
                               		<i class="fa fa-dashboard"></i> Add Student
                               </a>
                            </li>
                            
                             <li class="active">
                               <a href="import_student_excel_master.php">
                               		<i class="fa fa-dashboard"></i> Import Excel 
                               </a>
                            </li>
                            
                           
                            <!-- <li class="active">
                               <a href="add_stud_profile_master.php">
                               		<i class="fa fa-dashboard"></i> Add Student Profile
                               </a>
                            </li>-->
                            
                            <li class="active">
                               <a href="manage_stud_info_master.php">
                               		<i class="fa fa-dashboard"></i> Manage Student
                               </a>
                            </li>
                            
                            
                        </ol>
                    </div>
               
                    
                    <div class="col-lg-12">
                    
                    <br><br>
                    
                    
                    

 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">



 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                                            <thead style="background:#6C7D87; color:#fff;">

                                                <tr>

                                                    <th>S. No.</th>

													<th>Student Name</th>
                                                    
                                                    <th>Fathers Name</th>
                                                    <th>Contact</th>

                                                    <th>Qualification</th>
                                                    
                                                    <th>Address</th>
<th>Adhaar</th>
                                                   <th>Option</th>

                                                </tr>

                                            </thead>

                                            <tbody id="stud_fetch_res">

                                                <?php


$q=$db->query("SELECT id,institut_id,
stud_name,stud_image,
stud_f_name,
stud_mo,
stud_occupation,stud_add,stud_aadhr

 FROM student_master  WHERE flag='true' AND institut_id=$ins_id and course_id=$c_id ORDER BY id desc") or die("");

                                             
$i=0;
$out="";
                                                while($result = $q->fetch(PDO::FETCH_ASSOC))

                                                {
													
												if($result['stud_image']=="" || $result['stud_image']==NULL){
													
													$imgURL="../../stud_documents/default_image.jpg";
													
												}
												else{
													$imgURL="../../stud_documents/".$result['stud_image'];
												}
													
													$i++;   $out.='



                                                    <tr>

                                                           <td>'.$i.'</td>
														   
														  				   

<td><img src="'.$imgURL.'" style="width:50px; height:50px; margin-right:5px;">'.$result['stud_name'].'</td>


  <td>'.$result['stud_f_name'].'</td>
  
  
  <td>'.$result['stud_mo'].'</td>
    <td>'.$result['stud_occupation'].'</td>
	  <td>'.$result['stud_add'].'</td>
	    <td>'.$result['stud_aadhr'].'</td>


 <td>
  <a href="student_info_master.php?id='.$result['id'].'"class="btn btn-sm btn-raised btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
  
 
                                                           
                                                            

                                                            </td>

                                                    </tr>';

                                                    }

                                                    echo $out;

                                                ?>

                                            </tbody>
<!-- <a href="#" onclick="return DeleteTIM('.$result['id'].')" class="btn btn-raised btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i></a>
-->
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
		  "autoWidth": false,
		   dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf', 'print'
        ]
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
		url:"delete_stud_master.php",
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
$("#txtSelTraingn").on("change",function(e){
	if($("#txtSelTraingn option:selected").val()=="s_i"){
		alert("please select training center !....");
		$("#txtSelTraingn").focus();
	}
	else{
		var cur_id=$("#txtSelTraingn option:selected").val();
		
		
		
		$.ajax({
			type:"POST",
			data:{id:cur_id},
			url:"fetch_center_detail.php",
			dataType:"json",
			cache:false,
			success: function(r_data){
				if(r_data.length==0){
					alert("no record found !...");
					$("#stud_fetch_res").html("");
				}
				else{
					var j=0;
					var empty_res="";
					for(i=0; i<r_data.length; i++){ j++;
					
					empty_res=empty_res+"<tr><td>"+j+"</td><td>"+r_data[i].id+"</td><td><img src='../../stud_documents/"+r_data[i].stud_image+"' style='width:50px; height:50px; margin-right:5px;'>"+r_data[i].stud_name+"</td><td>"+r_data[i].course_name+"</td><td class='nowrap'>"+r_data[i].institute_name+"<a href='training_institute_master.php?id="+r_data[i].institut_id+"'>view</a></td><td><strong>Father Name : </strong>"+r_data[i].stud_f_name+"<br><strong> Mother Name : </strong>"+r_data[i].stud_m_name+"</td><td>"+r_data[i].stud_mo+"</td><td><a href='student_info_master.php?id="+r_data[i].id+"' class='btn btn-sm btn-raised btn-info'><i class='glyphicon glyphicon-pencil'></i></a> | <a href='#' onclick='return DeleteTIM("+r_data[i].id+")' class='btn btn-raised btn-danger'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";

					}
					
					$("#stud_fetch_res").html(empty_res);
					
				}
			}
			,error:function(err){
				location.reload();
			}
		});
		
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