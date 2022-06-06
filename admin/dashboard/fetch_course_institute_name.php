<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	
	$id=str_replace("'","",$_REQUEST['id']);
	$insID=str_replace("'","",$_REQUEST['insID']);
	
	$fetchQ=$db->query("SELECT id,c_name,c_duration FROM course_master WHERE flag='true'  AND  FIND_IN_SET(id,'$id')") or die("");
	
	if($fetchQ==TRUE){
		
		if($fetchQ->rowCount()==0){
			echo "no course";
		}
		else{
			$finalOp="";
			$topOptn="<option value='s_c'>---select course---</option>";
			while($res=$fetchQ->fetch(PDO::FETCH_ASSOC)){
				//$fetchArray[]=$res;
	$bottomOptn="<option value='".$insID."|".$res['id']."'>".$res['c_name']."-".$res['c_duration']."</option>";

			$finalOp=$finalOp.$bottomOptn;	
			}
			$finalOp_1=$topOptn.$finalOp;
			echo $finalOp_1;
			//echo json_encode($fetchArray);
		}	
	}
	else{
		echo "Try Again !...";
	}
}
else
{
	header("location:../index.php");	
}
?>
