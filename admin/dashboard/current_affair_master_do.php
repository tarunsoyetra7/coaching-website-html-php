<?php
if(isset($_COOKIE['login'])){	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");	
	if(isset($_REQUEST['txtTitle'])){		
		$txtTitle=str_replace("'","",$_REQUEST['txtTitle']);
		$txtHide=str_replace("'","",$_REQUEST['txtHide']);
		$txtDate=str_replace("'","",$_REQUEST['txtDate']);
		$txtDescp=str_replace("'","",$_REQUEST['txtDescp']);
		$txtDoc=str_replace("'","",$_FILES['txtDoc']['name']);		
		
		$txtDocext=pathinfo($_FILES['txtDoc']['name'],PATHINFO_EXTENSION);
		
		if($txtHide=="" || $txtHide==NULL){
			$insQ=$db->query("insert into current_affair(cur_title,cur_date ,cur_descp ,cur_doc ,created_by ,created_on) values('$txtTitle','$txtDate','$txtDescp','$txtDocext',$login_id,now())") or die("");
			
			$lastID=$db->lastInsertId();
			$imgName=$lastID.".".$txtDocext;
			
			move_uploaded_file($_FILES['txtDoc']['tmp_name'],"../../current_affair_doc/".$imgName);
			?>
            	<script>
					alert("Sucessfully Added !...");
					window.location.replace("current_affair_master.php");
				</script>
            <?php
		}
		else{			
			if($txtDoc=="" || $txtDoc==NULL){
				
				$updateQ=$db->query("update current_affair set cur_title='$txtTitle',cur_date ='$txtDate',cur_descp='$txtDescp' ,updated_by=$login_id,updated_on=now() where id=$txtHide") or die("");
				
			}
			else{
				
				$updateQ=$db->query("update current_affair set cur_title='$txtTitle',cur_date ='$txtDate',cur_descp='$txtDescp',cur_doc='$txtDocext' ,updated_by=$login_id,updated_on=now() where id=$txtHide") or die("");
				
				$imgName_1=$txtHide.".".$txtDocext;
				move_uploaded_file($_FILES['txtDoc']['tmp_name'],"../../current_affair_doc/".$imgName_1);
				
			}
			?>
            <script>
					alert("Sucessfully Updated !...");
					window.location.replace("current_affair_master.php");
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