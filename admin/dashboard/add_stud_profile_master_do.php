<?php
	if(isset($_COOKIE['login']))
	{
		$id=$_COOKIE['login'];
		require("../../root/db_connection.php");
		$txtSelTrainingInstitute=$_REQUEST['txtSelTrainingInstitute'];
		$txtIdRange=$_REQUEST['txtIdRange'];
		$id_1=explode("-",$txtIdRange);
		 if(isset($id_1[1])){
			 //echo "y";
			$start_id=$id_1[0];
			$end_id=$id_1[1]; 	 
			//$limitCondition="  id BETWEEN $start_id AND $end_id";			 
		 }
		 else{
			 //echo "n";
			 $start_id=$id_1[0];
			 //$limitCondition="id=$condiID";
		 }
		//echo $totalCounT=$end_id+1-$start_id;
		
		$txtStudImage=$_FILES['txtStudImage']['name'];
		//echo count($txtStudImage);
		
	
		
foreach($_FILES['txtStudImage']['tmp_name'] as $key => $tmp_name ){
	
		
			
		$file_name = $key.$_FILES['txtStudImage']['name'][$key];
		$file_size =$_FILES['txtStudImage']['size'][$key];
		$file_tmp =$_FILES['txtStudImage']['tmp_name'][$key];
		$file_type=$_FILES['txtStudImage']['type'][$key];	
		$img_ext= pathinfo($file_name,PATHINFO_EXTENSION);		
		
		if($img_ext=="jpg" || $img_ext=="jpeg" || $img_ext=="png" || $img_ext=="JPG" || $img_ext=="JPEG" || $img_ext=="PNG")
		{			
			$a=date("Y-m-d h:i:s");
			$a=str_replace(" ","-",$a);
			$a=str_replace(":","-",$a);
			$finalDate3=$a;		
			$txtProfileName="profile_image".$finalDate3."-".$file_name;      

			$q=$db->query("UPDATE student_master SET stud_image='$txtProfileName',updated_by=$id,updated_on=now() WHERE institut_id=$txtSelTrainingInstitute AND  id=$start_id") or die("error"); 
 			move_uploaded_file($file_tmp,"../../stud_documents/".$txtProfileName);
			
			//echo $start_id."<br>";
			
		}
		else
		{
			?>
            	<script>
					alert("Invalid File Format !...");
					window.location.replace("add_stud_profile_master.php");
				</script>
            <?php
		}
		$start_id++;
		
	}		
			
	?>
		<script>
            alert("Sucessfully  Uploaded !...");
            window.location.replace("add_stud_profile_master.php");
        </script>
    <?php
		
			
	}
	else
	{
		header("location:../index.php");	
	}
?>