<?php
if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");	
	if(isset($_REQUEST['txtSelTrainingInstitute']) && isset($_REQUEST['txtSelCourse']) && isset($_REQUEST['txtNOfAppli']))
	{	
		//$txtHide=str_replace("'","",$_REQUEST['txtHide']);
		$txtSelTrainingInstitute=str_replace("'","",$_REQUEST['txtSelTrainingInstitute']);		
		$insId1=explode("|",$txtSelTrainingInstitute);
		$insId=$insId1[1];
		$insName=$insId1[2];
		$txtAdhrNo=str_replace("'","",$_FILES['txtAdhrNo']['name']);
		$adharExt=pathinfo($txtAdhrNo,PATHINFO_EXTENSION);
		$txtCourseId=str_replace("'","",$_REQUEST['txtSelCourse']);		
		$txtcID=explode("|",$txtCourseId);
		$txtCourseId=$txtcID[0];
		$txtCourseName=$txtcID[1];		
		?>
			<script>			
				var a=$("#txtAdhrNo").val();			
			</script>
		<?php		
		$txtNOfAppli=str_replace("'","",$_REQUEST['txtNOfAppli']);
		$txtPhoto=str_replace("'","",$_FILES['txtPhoto']['name']);				
		if($txtPhoto=="" || $txtPhoto==NULL)
		{
			$txtPhotoName="";
		}
		else
		{
			$a=date("Y-m-d h:i:s");
			$a=str_replace(" ","-",$a);
			$a=str_replace(":","-",$a);
			$finalDate=$a;		
			$txtPhotoName="profile_image".$finalDate."-".$txtPhoto;
		}		
		$txtMotherName=str_replace("'","",$_REQUEST['txtMotherName']);
		$txtFatherName=str_replace("'","",$_REQUEST['txtFatherName']);
		$txtOccupation=str_replace("'","",$_REQUEST['txtOccupation']);
		$txtOrgni=str_replace("'","",$_REQUEST['txtOrgni']);
		$txtCmpleteAdd=str_replace("'","",$_REQUEST['txtCmpleteAdd']);
		$txtDOB=str_replace("'","",$_REQUEST['txtDOB']);
		$txtMateriState=str_replace("'","",$_REQUEST['txtMateriState']);
		$txtGender=str_replace("'","",$_REQUEST['txtGender']);
		$txtCity=str_replace("'","",$_REQUEST['txtCity']);
		$txtPin=str_replace("'","",$_REQUEST['txtPin']);
		$txtState=str_replace("'","",$_REQUEST['txtState']);
		$txtEmail=str_replace("'","",$_REQUEST['txtEmail']);
		$txtMo=str_replace("'","",$_REQUEST['txtMo']);		
		$tenQuli=str_replace("'","",$_REQUEST['tenQuli']);
		$tenschClg=str_replace("'","",$_REQUEST['tenschClg']);
		$tenbordUni=str_replace("'","",$_REQUEST['tenbordUni']);
		$tenyearPass=str_replace("'","",$_REQUEST['tenyearPass']);
		$tenDiviMark=str_replace("'","",$_REQUEST['tenDiviMark']);
		//$tenDocument=str_replace("'","",$_FILES['tenDocument']['name']);
		
		/*if($tenDocument=="" || $tenDocument==NULL){
			$tenDocumentName="";
		}
		else{

			$a=date("Y-m-d h:i:s");
			$a=str_replace(" ","-",$a);
			$a=str_replace(":","-",$a);
			$finalDate1=$a;		
			$tenDocumentName="ten_doc".$finalDate1."-".$tenDocument;
		}*/		
		$twelQuli=str_replace("'","",$_REQUEST['twelQuli']);
		$twelschClg=str_replace("'","",$_REQUEST['twelschClg']);
		$twelbordUni=str_replace("'","",$_REQUEST['twelbordUni']);		
		$twelyearPass=str_replace("'","",$_REQUEST['twelyearPass']);
		$twelDiviMark=str_replace("'","",$_REQUEST['twelDiviMark']);
		//$twelDocument=str_replace("'","",$_FILES['twelDocument']['name']);
		
		/*if($twelDocument=="" || $twelDocument==NULL)
		{
			$twelDocumentName="";
		}
		else{
			$a=date("Y-m-d h:i:s");
			$a=str_replace(" ","-",$a);
			$a=str_replace(":","-",$a);
			$finalDate2=$a;		
			$twelDocumentName="twel_doc".$finalDate2."-".$twelDocument;
		}*/
		
		$clgQuli=str_replace("'","",$_REQUEST['clgQuli']);
		$clgschClg=str_replace("'","",$_REQUEST['clgschClg']);
		$clgbordUni=str_replace("'","",$_REQUEST['clgbordUni']);
		$clgyearPass=str_replace("'","",$_REQUEST['clgyearPass']);
		$clgDiviMark=str_replace("'","",$_REQUEST['clgDiviMark']);
		//$clgDocument	=str_replace("'","",$_FILES['clgDocument']['name']);
		
		/*if($clgDocument=="" || $clgDocument==NULL)
		{
			$clgDocumentName="";
		}
		else{
			$a=date("Y-m-d h:i:s");
			$a=str_replace(" ","-",$a);
			$a=str_replace(":","-",$a);
			$finalDate3=$a;		
			$clgDocumentName="clg_doc".$finalDate3."-".$clgDocument;
		}*/		
		
		
		$txtDocFile=str_replace("'","",$_FILES['txtDocFile']['name']);		
		if($txtDocFile=="" || $txtDocFile==NULL)
		{
			$txtDocFileName="";
		}
		else
		{
			$a=date("Y-m-d h:i:s");
			$a=str_replace(" ","-",$a);
			$a=str_replace(":","-",$a);
			$finalDate3=$a;		
			$txtDocFileName="clg_doc".$finalDate3."-".$txtDocFile;
		}
		/*---created by q---*/
		$cb_q=$db->query("SELECT t_c_name,created_by FROM center_info_master WHERE id=$insId") or die("");
		$cb_q_res=$cb_q->fetch(PDO::FETCH_ASSOC);		
		$cb_id=$cb_q_res['created_by'];			
			$max_id_q=$db->query("SELECT (IFNULL(MAX(id),0))+1 AS ID FROM student_master") or die("");	
			$max_id_q_res=$max_id_q->fetch(PDO::FETCH_ASSOC);	
			$enroll_id=$max_id_q_res['ID'];			
			$studEnrollNo="ITSPL03/SETPST".$enroll_id;		
			$insQ=$db->query("insert into student_master(
				stud_enroll_no,
				institut_id,institute_name ,course_id ,
				course_name ,stud_name ,stud_image ,
				stud_m_name ,stud_f_name ,stud_occupation ,
				stud_orgnization ,stud_add,stud_dob ,stud_marital ,
				stud_gender ,stud_city ,stud_pin ,stud_state ,
				stud_email ,stud_aadhr ,stud_mo ,
				stud_ten_quali ,stud_ten_school ,stud_ten_board ,
				stud_ten_yop ,stud_ten_mark ,
				stud_ele_quali ,stud_ele_school ,stud_ele_board ,
				stud_ele_yop ,stud_ele_mark ,
				stud_clg_quali ,stud_clg_school ,stud_clg_board ,stud_clg_yop ,
				stud_clg_mark ,stud_document,created_by ,created_on) values('$studEnrollNo','$insId','$insName','$txtCourseId',
				'$txtCourseName','$txtNOfAppli','$txtPhotoName',
				'$txtMotherName','$txtFatherName','$txtOccupation',
				'$txtOrgni','$txtCmpleteAdd','$txtDOB','$txtMateriState',
				'$txtGender','$txtCity','$txtPin','$txtState',
				'$txtEmail','$adharExt','$txtMo',
				'$tenQuli','$tenschClg','$tenbordUni',
				'$tenyearPass','$tenDiviMark',
				'$twelQuli','$twelschClg','$twelbordUni',
				'$twelyearPass','$twelDiviMark',
				'$clgQuli','$clgschClg','$clgbordUni','$clgyearPass',
				'$clgDiviMark','$txtDocFileName',$cb_id,now())") or die("");
					if($insQ==TRUE)
					{	
						$upQ=$db->query("update tmp_student_master set vari_status='true',updated_by=$login_id, updated_on=now()  where institut_id=$insId")  or die("");					
						move_uploaded_file($_FILES['txtPhoto']['tmp_name'],"../../stud_documents/".$txtPhotoName);				
						move_uploaded_file($_FILES['txtDocFile']['tmp_name'],"../../stud_documents/".$txtDocFileName);						
						$lastID=$db->lastInsertId();
						$adharImgName=$lastID.".".$adharExt;
						move_uploaded_file($_FILES['txtAdhrNo']['tmp_name'],"../../stud_aadhar/".$adharImgName);
							/*move_uploaded_file($_FILES['tenDocument']['tmp_name'],"../../stud_documents/".$tenDocumentName);
				move_uploaded_file($_FILES['twelDocument']['tmp_name'],"../../stud_documents/".$twelDocumentName);
				move_uploaded_file($_FILES['clgDocument']['tmp_name'],"../../stud_documents/".$clgDocumentName);
				*/				
				?>
					<script>
						alert("Sucessfully Added !...");
						window.location.replace("student_info_master.php");
					</script>
				<?php			
		}
		else
		{	
			
		}		
	}
	else
	{
		?>
        	<script>
				alert("Try Again !...");
				window.location.replace("student_info_master.php");
			</script>
        <?php
	}
}
else
{
	header("location:../index.php");	
}
?>