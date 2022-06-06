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
                        <h4 align="center">Institute Report</h4>
                      <hr>
                    </div>
                    
                    <div class="col-lg-12">
                   
                       <div style="width:100%; height:500px; overflow:auto;"        >
                    	<table class="table table-bordered table-condensed table-responsive">
                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	
                                    <th>Reuquest Detail</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                           <tbody>
                           <?php
						   
						   
						    $req1_q=$db->query("SELECT id,institute_id,varif_status,t_c_name,created_on from tmp_center_info_master where   flag='true' order by id desc") or die(""); 
						   	while($req1_q_res=$req1_q->fetch(PDO::FETCH_ASSOC)){ 
						   ?>
                           
                           <tr>
                           		
                                <td><strong><?php echo $req1_q_res['t_c_name']; ?></strong> changed his detail <sub><?php echo $req1_q_res['created_on']; ?></sub></td>
                                <td>
                                <?php if($req1_q_res['varif_status']=='true'){ ?>
                                
                                <span style="padding:5px; border-radius:4px; background:green; color:#fff;">viewed</span>
                                <?php } else { ?>
                                  <span style="padding:5px; border-radius:4px; background:#F00; color:#fff;">pending</span> 
                                <?php } ?>
                                
                                </td>
                                <td><a href="view_training_insti_changes_req_by_admin.php?id=<?php echo $req1_q_res['institute_id']; ?>">View Detail</a> | <span id="<?php echo $req1_q_res['institute_id']; ?>" class="btnClearDetail">Delete</span></td>
                           </tr>
                           
                           		
                                <?php } ?>
                                
                                
                          <?php $studQ=$db->query("SELECT id,req_type,created_on,institut_id FROM tmp_student_master WHERE flag='true' AND vari_status='false'") or die("");
						 
						  	while($studQ_res=$studQ->fetch(PDO::FETCH_ASSOC)){ 
							$insID=$studQ_res['institut_id'];
							
								if($studQ_res['req_type']=='add_new'){
									$req_type="Add New Student ";
									
									$chnageURL="<a href='view_add_new_stud_req_by_admin.php?id=".$studQ_res['id']."'>View Detail</a> | <a href='delete_add_new_stud_req_by_admin.php?id=".$studQ_res['id']."'>Delete</a>";
									
								}
								else{
									$req_type="Update Student  Record ";
									$chnageURL="<a href='update_stud'>View Detail</a>";
								}
							
						   ?>      
                                
                                <tr>
                           		<?php $insQuery=$db->query("SELECT t_c_name FROM center_info_master WHERE id=$insID") or die("");
								$insQuery_res=$insQuery->fetch(PDO::FETCH_ASSOC);
								 ?>
                                <td><strong><?php echo $insQuery_res['t_c_name']; ?></strong> <?php echo $req_type; ?> <sub><?php echo $studQ_res['created_on']; ?></sub></td>
                                <td><span style="padding:5px; border-radius:4px; background:#F00; color:#fff;">pending</span></td>
                                <td><?php echo $chnageURL; ?></td>
                           </tr>
                           <?php } ?>
                           
                      
                              
                           </tbody>
                            
                        </table>
                     </div>
             
                    </div>
                 
                 <style>
				 .read_c_req{
					 cursor:pointer;
				 }
				 </style>                       
                   </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script>
	$(".read_c_req").on("click",function(e){
		var id=$(this).attr('id');
		alert(id);
		
		$.ajax({
			type:"POST",
			data:{id:id},
			url:"accept_req_by_admin.php",
			success: function(r_data){
				$("#u_r_"+id).html('readed');
				$("#u_r_"+id).css('color','green');
			},
			error: function(err){
				location.reload();
			}
		});
		
	});
	</script>
    
    
    <script>
	function viewExcelDoc(id){
		//alert(id);
		
		$.ajax({
			type:"POST",
			data:{id:id},
			url:"view_download_doc_of_stud_by_admin.php",
			success: function(r_data){
				alert(r_data);
				location.reload();				
			},
			error:function(e){
				location.reload();	
			}
		});
		
	}
	</script>
    
    
    
    
  <script>
   $(".btnClearDetail").on("click",function(e){
		var del_id=$(this).attr('id');
		$.ajax({
			type:"POST",
			data:{id:del_id},
			url:"delete_training_insti_changes_req_by_admin.php",
			success: function(r_data){
				alert(r_data);
				window.location.replace("report_page.php");
			},
			error: function(err){
				location.reload();
			}
		});
		
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
