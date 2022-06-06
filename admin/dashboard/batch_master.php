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
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <?php  include("header.php");  ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 align="center">Batch Master</h4><hr>
                        <ol class="breadcrumb">
                            <li class="active">
                               <a href="batch_master.php">
                               		<i class="fa fa-dashboard"></i> Add Batch
                               </a>
                            </li>
                        </ol>
                    </div> 

<?php if(isset($_REQUEST['id'])){
	
	$id=$_REQUEST['id'];
	
	$edit_q=$db->query("select * from batch_master where flag='true' and id=$id") or die("");
	$edit_q_res=$edit_q->fetch(PDO::FETCH_ASSOC);
	?>
    <form name="" method="post" action="batch_master_do.php" enctype="multipart/form-data">    
    <div class="col-lg-6">
    	<label>Enter Batch Name : </label>
    	<input type="text" value="<?php echo $edit_q_res['batch_name']; ?>" name="txtBatchName" autofocus class="form-control" placeholder="Batch Name *" required>
        <input type="hidden" value="<?php echo $edit_q_res['id']; ?>"  name="txtHide">
        <br>
    </div>
    <div class="col-lg-5">    
    	<label>Batch Start Date : </label>
    	<input type="date" name="txtStartDate" readonly value="<?php echo $edit_q_res['batch_start_date']; ?>" class="form-control"><br>
    </div>
    <div class="col-lg-1">
    	<br>
    	<button type="submit" style="margin-top:5px;" class="btn btn-sm btn-info">
        	Submit
        </button>
    </div> 
</form>
    <?php
}
else{
	?>                   
<form name="" method="post" action="batch_master_do.php" enctype="multipart/form-data">    
    <div class="col-lg-6">
    	<label>Enter Batch Name : </label>
    	<input type="text" name="txtBatchName" autofocus class="form-control" placeholder="Batch Name *" required>
        <input type="hidden" name="txtHide">
        <br>
    </div>
    <div class="col-lg-5">
    
    	<label>Batch Start Date : </label>
    	<input type="date" name="txtStartDate" readonly value="<?php echo date("Y-m-d"); ?>" class="form-control" ><br>
    </div>
    <div class="col-lg-1">
    	<br>
    	<button type="submit" style="margin-top:5px;" class="btn btn-sm btn-info">
        	Submit
        </button>
    </div> 
</form>
<?php } ?>

<div class="col-lg-12"><hr>
	<table class="table table-bordered table-responsive">
    	<thead style="background:#000; color:#fff;">
        	<tr>
            	<th>S No.</th>
                <th>Batch Name</th>
                <th>Start Date</th>
                <th>Option</th>
            </tr>
        </thead>
        
        <tbody>
        <?php $fetchQ=$db->query("select * from batch_master where flag='true' order by id desc") or die(""); $i=0;
				while($fetchQ_res=$fetchQ->fetch(PDO::FETCH_ASSOC)){ $i++;
		 ?>
        	<tr>
            	<td><?php echo $i; ?></td>
                <td><?php echo $fetchQ_res['batch_name']; ?></td>
                <td><?php echo $fetchQ_res['batch_start_date']; ?></td>
                <td>
                	<a href="batch_master.php?id=<?php  echo $fetchQ_res['id']; ?>"><strong>Edit</strong></a> 
                    	<!--| <a href="delete_batch_master.php?id=<?php //echo $fetchQ_res['id']; ?>"><strong>Delete</strong></a>-->
                </td>
            </tr>
        <?php } ?>
        </tbody>        
    </table>
</div>
                        
                        
                        
                        
                        
                    </div>
                    
                    
                    
                    
                    
                                       
                   </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    
    
  <script>
   $(".btnClearDetail").on("click",function(e){
		var del_id=$(this).attr('id');
		$.ajax({
			type:"POST",
			data:{id:del_id},
			url:"delete_training_insti_changes_req_by_admin.php",
			success: function(r_data){
				alert(r_data);
				window.location.replace("index.php");
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
  
  
 <script>
	function viewExcelDoc_1(id){
		//alert(id);
		
		$.ajax({
			type:"POST",
			data:{id:id},
			url:"view_download_profile_of_stud_by_admin.php",
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
  
    
</body>
</html>
<?php
}
else
{
	header("location:../index.php");	
}
?>