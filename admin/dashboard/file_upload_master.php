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
                                <h4 align="center"><strong>Upload Files</strong></h4>
                                <hr>

                                <ol class="breadcrumb">

                                    <li class="active">
                                        <a href="file_upload_master.php"><i class="fa fa-dashboard"></i> Upload File</a>
                                    </li>

                                   
                                </ol>
                            </div>
							
							<div class="col-lg-12">
							
							<form role="form" name="" method="post" enctype="multipart/form-data"  action="file_upload_master_do.php">
                        
                        
                       
                            
                            

                            <div class="form-group">
                                <label>Select File/ Image/ Document</label>
                                <input required name="event_image[]" multiple  type="file" class="form-control">
                               <span>(File Type : jpg, jpeg, png, xls, pdf, doc, docx, txt)</span>
                            </div>
                                                      
                            
                            
 <button type="submit" class="btn btn-success btn-sm">Submit </button>
                            

                        </form>
							</div>
							
							<div style="clear:both;"></div>
                    <div class="col-lg-12"><br>
                    	
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	<th>S No</th>
                                    <th>Download</th>
									<th>Upload File URL</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php $fileQ=$db->query("select * from website_files order by id desc") or die(""); $i=0;
								while($fileQ_res=$fileQ->fetch(PDO::FETCH_ASSOC)){ $i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td>
										<a target="_blank" href="../../website_files/<?php echo $fileQ_res['id'].".".$fileQ_res['file_ext']; ?>"><strong>download</strong></a>
									</td>
									<td><?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>/website_files/<?php echo $fileQ_res['id'].".".$fileQ_res['file_ext']; ?></td>
									<td>
									<a href="delete_file_upload_master.php?del_id=<?php echo $fileQ_res['id']; ?>&del_ext=<?php echo $fileQ_res['file_ext']; ?>"><button class="btn btn-sm btn-danger btn_delete">Delete</button></a></td>
								</tr>
								<?php } ?>
                            </tbody>
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
	
    </body>

    </html>
    <?php
}
else
{
	header("location:../index.php");	
}
?>