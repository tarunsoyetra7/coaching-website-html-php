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
                        <h4 align="center">Student Excel Report</h4>
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
                       
                           
                       <?php $excQ=$db->query("SELECT tmp_stud_excel.id,tmp_stud_excel.vari_status,tmp_stud_excel.institute_id,tmp_stud_excel.stud_excel,tmp_stud_excel.created_on,center_info_master.t_c_name FROM tmp_stud_excel,center_info_master WHERE tmp_stud_excel.flag='true' AND center_info_master.id=tmp_stud_excel.institute_id ORDER BY tmp_stud_excel.id desc") or die("");
					   
					   
										   
					   while($excQ_res=$excQ->fetch(PDO::FETCH_ASSOC)){
					  
					   
					    ?>     
                            <tr>
                           		
                                <td>New Excel Added By : - <strong><?php echo $excQ_res['t_c_name']; ?></strong> <sub> <?php echo $excQ_res['created_on']; ?></sub></td>
                                <td>
                                <?php if($excQ_res['vari_status']=='true'){ ?>
                                	<span style="padding:5px; border-radius:4px; background:green; color:#fff;">viewed</span>
                                <?php } else { ?>
                                <span style="padding:5px; border-radius:4px; background:#F00; color:#fff;">pending</span>
                                <?php } ?>
                                </td>
                                <td><a onClick="viewExcelDoc('<?php echo $excQ_res['id']; ?>')" target="_blank" download href="../../stud_documents/<?php echo $excQ_res['stud_excel']; ?>">Download</a></td>
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
