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
                                <h4 align="center"><strong>Notification Master</strong></h4>
                                <hr>

                                <ol class="breadcrumb">

                                   
                                                <li class="active">
                                        <a href=""><i class="fa fa-dashboard"></i> Add Notification</a>
                                    </li>

                                  
									
									
                                </ol>
                            </div>

<?php if(isset($_REQUEST['id'])){
	$edit_id=str_replace("'","",$_REQUEST['id']);
	$editQ=$db->query("select * from notification_master where flag='true' and id=$edit_id") or die("");
	$editQ_res=$editQ->fetch(PDO::FETCH_ASSOC);

?>
 <form method="post" action="notification_master_do.php" enctype="multipart/form-data" id="txt_form">
                                            <div class="col-lg-6">

                                                <label>Notification Title</label>
                                                <input value="<?php echo $editQ_res['noti_title']; ?>" required id="txt_title" name="txt_title" type="text" class="form-control" placeholder="Title *">
                                                <input type="hidden" name="txt_hide" id="txt_hide" value="<?php echo $editQ_res['id']; ?>">
                                                <br>
											</div>	
										
												
												<div class="col-lg-6">
												 <label>Button URL </label>
                                               
                                                <input required id="txt_btn_url" name="txt_btn_url" value="<?php echo $editQ_res['noti_url']; ?>" type="text" class="form-control" placeholder="URL *"> 
                                                <br>
												</div>
											
                                <div class="col-lg-12">
												<strong>Long Description:</strong>
                                                <br>
												
                                                <script src="ckeditor.js"></script>
                                                <script src="samples/js/sample.js"></script>

                                                <link rel="stylesheet" href="samples/toolbarconfigurator/lib/codemirror/neo.css">
                                                <script src="js/jquery.min.js"></script>
                                                <style>
                                                    #cke_1_contents {
                                                        height: 300px !important;
                                                    }
                                                </style>
                                                <main>
                                                    <div id="editor"><?php echo $editQ_res['noti_detail']; ?></div>
                                                </main>

                                                <script>
                                                    initSample();
                                                </script>
                                                <br>
												
                                                <input type="hidden" id="txt_long_descp" name="txt_long_descp">
												</div>

												

                                            <div class="col-lg-12">
                                    <button class="btn btn-success btn-sm btn_submit" type="submit">Submit</button><br><br>
                                            <br><br>
											</div>
                                            <!---end--->

                                        </form>
<?php	} else { ?>
                            <form method="post" action="notification_master_do.php" enctype="multipart/form-data" id="txt_form">
                                            <div class="col-lg-6">

                                                <label>Notification Title</label>
                                                <input required id="txt_title" name="txt_title" type="text" class="form-control" placeholder="Title *">
                                                <input type="hidden" name="txt_hide" id="txt_hide">
                                                <br>
											</div>	
										
												
												<div class="col-lg-6">
												 <label>Button URL </label>
                                               
                                                <input required id="txt_btn_url" name="txt_btn_url" type="text" class="form-control" placeholder="URL *"> 
                                                <br>
												</div>
												
												<div class="col-lg-12">
												<strong>Long Description:</strong>
                                                <br>
												
                                                <script src="ckeditor.js"></script>
                                                <script src="samples/js/sample.js"></script>

                                                <link rel="stylesheet" href="samples/toolbarconfigurator/lib/codemirror/neo.css">
                                                <script src="js/jquery.min.js"></script>
                                                <style>
                                                    #cke_1_contents {
                                                        height: 300px !important;
                                                    }
                                                </style>
                                                <main>
                                                    <div id="editor"></div>
                                                </main>

                                                <script>
                                                    initSample();
                                                </script>
                                                <br>
												
                                                <input type="hidden" id="txt_long_descp" name="txt_long_descp">
												</div>
											
                                           

                                            <div class="col-lg-12">
                                    <button class="btn btn-success btn-sm btn_submit" type="button">Submit</button><br><br>
                                            <br><br>
											</div>
                                            <!---end--->

                                        </form>
                                        
                            <!---end--->
<?php } ?>



<div style="clear:both;"></div>
                    <div class="col-lg-12"><br>
                    	
 <table id="example1" class="table table-middle dataTable table-bordered table-condensed table-hover">

                        	<thead style="background:#000; color:#fff;">
                            	<tr>
                                	<th>S No</th>
                                    <th>Notification Title</th>
									<th>Notification URL</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php $q=$db->query("select * from notification_master order by id desc") or die(""); $i=0;
								while($result=$q->fetch(PDO::FETCH_ASSOC)){ $i++; ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td>
									<?php echo $result['noti_title']; ?>
									</td>
									<td>
									<?php echo $result['noti_url']; ?>
									</td>
									<td><?php if($result['flag']=='true'){ ?>
								
									<button id="<?php echo $result['id']; ?>" class="btn btn-sm btn-info btn_edit">Edit</button>
						
						
									<?php if($result['e_d_optn']=='true'){

?>
<button class="btn btn-sm btn-success btn_disable" id="<?php echo $result['id']; ?>">Enable</button>
<button class="btn btn-sm btn-danger btn_delete" id="<?php echo $result['id']; ?>">Delete</button>
<?php									} else {
?>
<button class="btn btn-sm btn-danger enable_btn" id="<?php echo $result['id']; ?>">Disable</button>

<button class="btn btn-sm btn-danger btn_delete" id="<?php echo $result['id']; ?>">Delete</button>


<?php
	} ?>
									
<?php } else { ?>								
									
		<button class="btn btn-sm btn-default btn_restore" id="<?php echo $result['id']; ?>">Restore</button>
		
<?php } ?></td>
								</tr>
								<?php } ?>
                           
                            </tbody>
                        </table>	<br><br>
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
	  


$(".btn_delete").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"delete_notification_master.php",
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
			url:"restore_notification_master.php",
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
			url:"enable_notification_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	
	
	
		$(".btn_edit").on("click",function(e){
		var cur_id=$(this).attr('id');
		window.location.replace("notification_master.php?id="+cur_id);
	});
	
	
	$(".btn_disable").on("click",function(e){
		var cur_id=$(this).attr('id');
		
		$.ajax({
			type:"POST",
			url:"disable_notification_master.php",
			data:{cur_id:cur_id},
			success:function(r_data){
				alert(r_data);
				location.reload();
			},error:function(err){
			location.reload();
			}
		});
		
		
	});	
	

$(".btn_submit").on("click",function(e){
	var Descp = $('#cke_1_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html();
	//alert(Descp);
	$("#txt_long_descp").val(Descp);
	$("#txt_form").submit();
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