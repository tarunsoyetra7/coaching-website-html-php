

<?php
if(isset($_COOKIE['login']))
{
?>


<?php
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

        

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">  
    
    
       

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php
        include("header.php");

        ?>
                <div id="page-wrapper">

                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 align="center" class="page-header">
                            Manage News & Updates
                        </h4>
                                <ol class="breadcrumb">
<li class="active">
                                <a href="add-news-updates.php"><i class="fa fa-dashboard"></i> Add News & Updates</a>
                            </li>
                        
                            
                            <li class="active">
                               <a href="manage-news-updates.php"> <i class="fa fa-dashboard"></i> Manage News & Updates
                                </a>
                            </li>
    
                            


                                </ol>
                            </div>
                           

                            <div class="col-lg-12">

                                

 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                                            <thead>

                                                <tr>

                                                    <th>S. No.</th>

													<th>Center Name</th>
                                                    
                                                    <th>News Title</th>
                                                    <th>Date </th>

                                                    <th>Description</th>
                                                    
                                                    <th>File</th>

                                                   <th>Option</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php




$q=$db->query("SELECT news_id, 
       center_info_master.t_c_name, 
       institute_id, 
       news_title, 
       news_date, 
       news_descp, 
       news_img_ext 
FROM   news_and_updates 
       LEFT JOIN center_info_master 
              ON center_info_master.id = news_and_updates.institute_id ORDER BY news_and_updates.news_id desc") or die("");

                                             
$i=0;
$out="";
                                                while($result = $q->fetch(PDO::FETCH_ASSOC))

                                                {
													
													if($result['institute_id']=="0" || $result['institute_id']==NULL){
														$insName="All Center";
													}
													else{
														$insName=$result['t_c_name'];
													}
													
													
												if($result['news_img_ext']=="" || $result['news_img_ext']==NULL){
													$imgURL="";
													?>
                                                    	
                                                    <?php
												}
												else{
													$imgURL="<a target='_blank' href='../../newsImage/".$result['news_id'].".".$result['news_img_ext']."'>download</a>";
												}
													
													$i++;   $out.='



                                                    <tr>

                                                           <td>'.$i.'</td>
														   
														   <td>'.$insName.'</td>
														   
														    <td>'.$result['news_title'].'</td>
															
															<td>'.$result['news_date'].'</td>
															
															
															<td>'.$result['news_descp'].'</td>
															
															<td>'.$imgURL.'</td>
															
											                         <td>
  <a href="edit-news-updates.php?editID='.$result['news_id'].'"><strong>Edit </strong></a>
   | 
 
                                                            <a href="delete-news-updates.php?delID='.$result['news_id'].'" ><strong>Delete</strong></a>

                                                            

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
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

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



    </body>

    </html><?php
}

else
{

	header("location:../index.php");	
}

?>
