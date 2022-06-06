<?php
	if(isset($_COOKIE['login']))
	{
		$id=$_COOKIE['login'];
		require("../../root/db_connection.php");
		if(isset($_FILES['txtCsvFile']['name'])){
			$file_name=$_FILES['txtCsvFile']['tmp_name'];
			
			$file_name1=$_FILES['txtCsvFile']['name'];
			
			$ext=pathinfo($file_name1,PATHINFO_EXTENSION);
			
			if($ext=="csv" || $ext=="CSV"){
			
			$file = fopen($file_name, "r");			
		
			$i=0;
	        while (($emapData = fgetcsv($file, 1000000, ",")) !== FALSE)
	         {
				echo $emapData[5]."<br>"; 

	          //It wiil insert a row to our subject table from our csv file`
	           //$sql = $db->query("INSERT into center_master (center_name,city_name,center_add,contact_no,email_add,created_by,created_on) 	            	values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]',$id,now())");	           $i++;
			         
	         }
			 ?>
             	<script>
					alert("Sucessfully Inserted !...");
					//window.location.replace("excel_import_master.php");
				</script>
             <?php	        
			}
			else{
				?>
                	<script>
						alert("Invalid File Format !..");
						//window.location.replace("excel_import_master.php");
					</script>
                <?php
			}
		}
		else{
			header("location:../index.php");	
		}
	}
	else
	{
		header("location:../index.php");	
	}
?>

