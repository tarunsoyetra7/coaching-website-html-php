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
                        <h4 align="center"><strong>Employee  Master</strong></h4>                         
					   <hr>
                       
                       <ol class="breadcrumb">
					   

					   
                           <li class="active">
                                <a href="add_employee.php"><i class="fa fa-dashboard"></i> Add Employee</a>
                            </li>
							
							<li class="active">
                                <a href="authentication_page.php"><i class="fa fa-dashboard"></i> Add Authentication</a>
                            </li>
                            
							<li class="active">
                                <a href="employee_login_status.php"><i class="fa fa-dashboard"></i> Employee Login Status</a>
                            </li>
							
                        </ol>
                    </div>
                  
                    
                  
         
                   
                    
                  
				   <form role="form" name="" method="post" enctype="multipart/form-data" id="employee_frm" action="add_employee_do.php">
                            
                            <?php if(isset($_REQUEST['edit_id'])){
								
								$editID=$_REQUEST['edit_id'];
								$editQ=$db->query("select * from user_infromation where user_id=$editID") or die("");
								$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);
								
								?>
                                <div class="col-lg-6">
                                <label>Employee Name</label>
                                        <input id="txt_e_name" autofocus  name="txt_e_name" type="text" class="form-control" placeholder="Name" value="<?php echo $editQ_res['user_name']; ?>">
                                        <input value="<?php echo $editQ_res['user_id']; ?>" type="hidden" name="txtHide" id="txtHide" value="">
                                        <br>
                            
                            </div>
                            <div class="col-lg-6">
                            <label>Profile Image</label>
                                    
                                    <input type="file" name="txtImage" class="form-control">
                                       
                           <span class="pull-right">(file type : jpg, jpeg, png)</span>
                                       <br>
                            
                            </div>
                           
                            
                             
        							<div class="col-lg-6" >
                                    <label>Password</label>
				        				<input id="txt_e_pass"  name="txt_e_pass" type="text" class="form-control" value="<?php echo $editQ_res['user_pass']; ?>" placeholder="Password "><br>
        							</div>        
				          			<div class="col-lg-6" >
                                    <label>Confirm Password </label>
          								<input id="txt_e_c_pass"  name="txt_e_c_pass" type="text"  class="form-control" value="<?php echo $editQ_res['user_pass']; ?>" placeholder="Confirm Password "><br>
            						</div>
                                <?php
							}
							else{
								?>
                            
                            <div class="col-lg-6">
                            <label>Employee Name</label>
                                        <input id="txt_e_name" autofocus  name="txt_e_name" type="text" class="form-control" placeholder="Name">
                                        <input type="hidden" name="txtHide" id="txtHide" value="">
                                        <br>
                            
                            </div>
                            <div class="col-lg-6">
                            <label>Profile Image</label>
                                    
                                    <input type="file" name="txtImage" class="form-control">
                                       
                           <span class="pull-right">(file type : jpg, jpeg, png)</span>
                                       <br>
                            
                            </div>
                            
                             
        							<div class="col-lg-6" >
                                    <label>Password</label>
				        				<input id="txt_e_pass"  name="txt_e_pass" type="password" class="form-control" placeholder="Password "><br>
        							</div>        
				          			<div class="col-lg-6" >
                                    <label>Confirm Password </label>
          								<input id="txt_e_c_pass"  name="txt_e_c_pass" type="password" class="form-control" placeholder="Confirm Password "><br>
            						</div>
				    		<?php } ?>	
                                <div class="col-lg-12">  
					    			<button type="button" class="btn btn-primary btn-sm btn_emp_submit">Submit </button>
                                    </div>
                                    
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
                            <th>Name</th>
                            <th>Password</th>                         
                             
                            <th>Option</th>
                        </tr>
						</thead>
						<tbody>
             			<?php
							$Query=$db->query("SELECT * FROM user_infromation  order by delstatus") or die("error");
							$i=0;
							while($Result=$Query->fetch(PDO::FETCH_ASSOC))
							{
								$i++;									
						?>
            			<tr id='emp_tr_<?php echo $Result['user_id']; ?>'>           
                            <td><?php echo $i; ?> </td>
                            <td>
                            <?php if($Result['profile_ext']=="" || $Result['profile_ext']==NULL){  $imgNAME="default_image.jpg"; } else { $imgNAME=$Result['user_id'].".".$Result['profile_ext']; } ?>
							<img src="../../employee_profile/<?php echo $imgNAME; ?>" style="width:60px; height:60px; margin-right:5px; float:left;">
							
							<?php echo $Result['user_name']; ?>
                            
                             </td>             
                            <td><?php echo $Result['user_pass']; ?></td>                
                            
                            <td>
                            
                            <?php if($Result['delstatus']==0){ ?>
                            	<a href="add_employee.php?edit_id=<?php echo $Result['user_id']; ?>"><strong>Edit</strong></a> | <a href="delete_employee.php?del_id=<?php echo $Result['user_id']; ?>"><strong>Delete</strong></span></td>
                            <?php } else { ?>
                                	<a href="restore_employee_page.php?id=<?php echo $Result['user_id']; ?>"><strong>Restore User</strong></a>
                            <?php } ?>
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
		
		if($("#txt_e_name").val()==''){
			$("#txt_e_name").addClass("alert_img");
			$("#txt_e_name").focus();
		}		
		else if($("#txt_e_pass").val()==''){
			$("#txt_e_pass").addClass("alert_img");
			$("#txt_e_pass").focus();
		}
		else if($("#txt_e_c_pass").val()==''){
			$("#txt_e_c_pass").addClass("alert_img");
			$("#txt_e_c_pass").focus();
		}
		else{
			if($("#txt_e_pass").val()==$("#txt_e_c_pass").val()){				
				$("#employee_frm").submit();
			}
			else{
				$("#txt_e_pass").addClass("alert_img");
				$("#txt_e_c_pass").addClass("alert_img");
			}
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