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
    
    
    
<link rel="stylesheet" href="css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">  
    
    
    
</head>
<body>
    <div id="wrapper">
        <?php  include("header.php");  ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                       <h4 align="center"><strong>User Query</strong></h4>                         
					   <hr>
                       
                       
                      
                    </div>
                    
                    <div class="col-lg-12">
                    	           

 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                                            <thead>

                                                <tr>

                                                    <th>S. No.</th>

													<th>Center Name</th>
                                                    
                                                    <th>User Query</th>
                                                    <th>Query Date </th>

                                                    

                                                   <th>Option</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php



$q=$db->query("SELECT user_query.id, user_query.flag, 
       user_query, 
       
       (SELECT t_c_name 
        FROM   center_info_master 
        WHERE  center_info_master.id = user_query.created_by) AS user_name, 
       DATE_FORMAT(user_query.created_on, '%d %M %Y')                    AS created_on 
FROM   user_query ,center_info_master
WHERE   center_info_master.id=center_info_master.created_by  $fetch_condition
ORDER  BY user_query.id DESC ") or die("");

                                             
$i=0;
$out="";
                                                while($result = $q->fetch(PDO::FETCH_ASSOC))

                                                {
													if($result['flag']=='true'){
														$viewRes="View |";
													}
													else{
														$viewRes="";
													}
													
													$i++;   $out.='



                                                    <tr>

                                                           <td>'.$i.'</td>
														  														   
														    <td>'.$result['user_name'].'</td>
															
															<td>'.$result['user_query'].' &nbsp; &nbsp; <strong><span id="'.$result['id'].'|'.trim($result['user_query']).'" class="view_user_query">View</span></strong></td>
															
															
															<td>'.$result['created_on'].'</td>
															
															
															
											                         <td>



 <span onClick="viewRes('.$result['id'].')" href="view_user_query.php?delID='.$result['id'].'" ><strong>'.$viewRes.'</strong></span>
 

 
                                                            <a href="delete_user_query.php?delID='.$result['id'].'" ><strong>Delete</strong></a>

                                                            

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
                    </div></div> 
                    
                    
                    
   
        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>                 
       
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/datatables/dataTables.buttons.min.js"></script>
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
<style>
.view_user_query{
	cursor:pointer;
	color:red;
}
</style>
 <script>
 $(".view_user_query").on("click",function(e){
	var abc=$(this).attr('id'); 
	$("#QueryModal").modal("show");
	
	$("#queryShowRes").html(abc);
	
 });
 </script> 




<div id="QueryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" align="center">User Query</h4>
      </div>
      <div class="modal-body">
        <span id="queryShowRes"></span>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-success btnSubmitQuery" >Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>

<script>
$(".btnSubmitQuery").on("click",function(e){
	var view_id=$("#queryShowRes").html();
	view_id=view_id.split("|");
	var v_id=view_id[0];
	//alert(v_id);
	$.ajax({
		type:"POST",
		data:{v_id:v_id},
		url:"view_user_query.php",
		success: function(r_data){
			if(r_data=="success"){
				$("#QueryModal").modal("hide");
				location.reload();
			}
			else{
				alert("Try Again !...");
			}
		},error:function(err){
			location.reload();
		}
	});
});
</script>
<?php
}
else
{
	header("location:../index.php");	
}
?>