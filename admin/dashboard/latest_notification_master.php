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
     <link rel="stylesheet" href="css/buttons.dataTables.min.css">

  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  
    
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- data tables -->
    <script src="js/jquery.dataTables.min.js"></script>
    

</head>
<body>

    <div id="wrapper">
        <?php  include("header.php");  ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                     <div class="col-lg-12">
                        <h4 align="center"><strong>Latest Notification</strong></h4>                         
					   <hr>
                       
                       <ol class="breadcrumb">
					   

					   
                           <li class="active">
                                <a href="latest_notification_master.php"><i class="fa fa-dashboard"></i> Latest Notification</a>
                            </li>
							
							
							
                        </ol>
                    </div>
                  
                    
                  
         
                   
                    
                  
				   <form role="form" name="" method="post" enctype="multipart/form-data" id="l_noti_form" action="latest_notification_master_do.php">
                            
                            <?php if(isset($_REQUEST['id'])){
								
								$editID=$_REQUEST['id'];
								$editQ=$db->query("select * from latest_notification where id=$editID") or die("");
								$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);
								
								?>
                                 <div class="col-lg-6">
                            <label>Latest Notification</label>
                                        <textarea id="txt_notification"   name="txt_notification" class="form-control" placeholder="Notification *"><?php echo $editQ_res['l_notification']; ?></textarea>
                                        <input type="hidden" name="txtHide" id="txtHide" value="<?php echo $editQ_res['id']; ?>">
                                        <br>
                            
                            </div>
                            <div class="col-lg-12">  
					    			<button type="button" class="btn btn-primary btn-sm btn_emp_submit">Update </button>
                                    </div>
                                <?php
							}
							else{
								?>
                            
                            <div class="col-lg-6">
                            <label>Latest Notification</label>
                                        <textarea id="txt_notification"   name="txt_notification" class="form-control" placeholder="Notification *"></textarea>
                                        <input type="hidden" name="txtHide" id="txtHide" value="">
                                        <br>
                            
                            </div>
                            <div class="col-lg-12">  
					    			<button type="button" class="btn btn-primary btn-sm btn_emp_submit">Submit </button>
                                    </div>
				    		<?php } ?>	
                                
                                    
							</form> 
							
							
							<div style="clear:both;"></div>
							<br>
                    
                    

<style>

#user_img{
	width:50px; height:50px; margin-right:5px;
}
</style>

</div>

 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                                            <thead>

                                               <tr style="background:#000; color:#fff;">
                            <th>S No.</th>
                            <th>Notification</th>
                            <th>Option</th>
                        </tr>
						</thead>
						<tbody>
             			<?php
							$Query=$db->query("SELECT * FROM latest_notification  order by e_d_optn") or die("error");
							$i=0;
							while($Result=$Query->fetch(PDO::FETCH_ASSOC))
							{
								$i++;									
						?>
            			<tr id='emp_tr_<?php echo $Result['id']; ?>'>           
                            <td><?php echo $i; ?> </td>
                            <td>
                            
							
							<?php echo $Result['l_notification']; ?>
                            
                             </td>             
                                          
                            
                            <td>
                            <?php if($Result['flag']=='true'){ ?>
                            <button id="<?php echo $Result['id']; ?>" class="btn btn-sm btn-info btn_edit">Edit</button>
						
						
									<?php if($Result['e_d_optn']=='true'){

?>
<button class="btn btn-sm btn-success btn_disable" id="<?php echo $Result['id']; ?>">Enable</button>
<button class="btn btn-sm btn-danger btn_delete" id="<?php echo $Result['id']; ?>">Delete</button>
<?php									} else {
?>
<button class="btn btn-sm btn-danger enable_btn" id="<?php echo $Result['id']; ?>">Disable</button>

<button class="btn btn-sm btn-danger btn_delete" id="<?php echo $Result['id']; ?>">Delete</button>



									
<?php }} else { ?>								
									
		<button class="btn btn-sm btn-default btn_restore" id="<?php echo $Result['id']; ?>">Restore</button>
		
<?php } ?>
                            
                            
                          </td>
            			</tr>
          <?php } ?> </tbody>
                                        </table>
                    
                    
                    
                                        
                   </div>
                </div>
            </div>
        </div>
    </div>


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

   
    
 	$("#txt_e_name").on("keyup", function(e) {
		if ($("#txt_e_name").hasClass("alert_img") == true) {
			$("#txt_e_name").removeClass("alert_img");
		}
	});	
	$("#txt_e_pass").on("keyup", function(e) {	
		if ($("#txt_e_pass").hasClass("alert_img") == true) {
			$("#txt_e_pass").removeClass("alert_img");
		}
	});	
	$("#txt_e_c_pass").on("keyup", function(e) {	
		if ($("#txt_e_c_pass").hasClass("alert_img") == true) {
			$("#txt_e_c_pass").removeClass("alert_img");
		}
	});  

	$(".btn_emp_submit").on("click",function(e){
		
		if($("#txt_notification").val()==''){
			$("#txt_notification").addClass("alert_img");
			$("#txt_notification").focus();
		}		
		
		else{
							
				$("#l_noti_form").submit();
			
		}
	});
	
   </script>

<script>
  $(".btn_edit").on("click",function(e){
		var cur_id=$(this).attr('id');
		window.location.replace("latest_notification_master.php?id="+cur_id);
	});
	
	
$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_latest_notification.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});


$(".btn_restore").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"restore_latest_notification.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	
	$(".enable_btn").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"enable_latest_notification.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	
	
	$(".btn_disable").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"disable_latest_notification.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
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