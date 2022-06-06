<?php
if(isset($_COOKIE['login']))
{
	require("../../root/db_connection.php");
	$searchVal=str_replace("'","",$_REQUEST['searchVal']);
	$searchQ=$db->query("SELECT id,t_c_name FROM center_info_master WHERE flag='true' AND t_c_name LIKE '%$searchVal%' ORDER BY id desc limit 10") or die("");
	
	if($searchQ==TRUE){
		if($searchQ->rowCount()==0){
			echo json_encode("");
		}
		else{
			while($searchQ_res=$searchQ->fetch(PDO::FETCH_ASSOC)){
				$fetchArray[]=$searchQ_res;
			}
			echo json_encode($fetchArray);
		}
	}
	else{
		echo json_encode("");
	}
}
else
{
	header("location:../index.php");	
}
?>