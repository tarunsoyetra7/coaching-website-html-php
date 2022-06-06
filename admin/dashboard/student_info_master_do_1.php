<?php
if(isset($_COOKIE['login']))
{	
	$login_id=$_COOKIE['login'];
	require("../../root/db_connection.php");	
	
	if(isset($_REQUEST['txtSelTrainingInstitute']) && isset($_REQUEST['txtCourseId']) && isset($_REQUEST['txtCourseName']) && isset($_REQUEST['txtNOfAppli'])){
	
		$txtHide=str_replace("'","",$_REQUEST['txtHide']);
		$txtSelTrainingInstitute=str_replace("'","",$_REQUEST['txtSelTrainingInstitute']);
		
		$txtHide1=str_replace("'","",$_REQUEST['txtHide1']);
		
		
		$updateQ=$db->query("UPDATE tmp_student_master SET flag='false' ,vari_status='true' WHERE id=$txtHide1");
		
		
		
		$insId1=explode("|",$txtSelTrainingInstitute);
		$insId=$insId1[1];
		$insName=$insId1[2];
		
		$txtCourseId=str_replace("'","",$_REQUEST['txtCourseId']);
		
		$txtCourseId=str_replace("c_n","",$txtCourseId);
		$txtCourseName=str_replace("'","",$_REQUEST['txtCourseName']);
		$txtNOfAppli=str_replace("'","",$_REQUEST['txtNOfAppli']);
		$txtPhoto=str_replace("'","",$_FILES['txtPhoto']['name']);		
		
		if($txtPhoto=="" || $txtPhoto==NULL){
			$txtPhotoName="";
		}
		else{
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
		$txtAdhrNo=str_replace("'","",$_REQUEST['txtAdhrNo']);
		$tenQuli=str_replace("'","",$_REQUEST['tenQuli']);
		$tenschClg=str_replace("'","",$_REQUEST['tenschClg']);
		$tenbordUni=str_replace("'","",$_REQUEST['tenbordUni']);
		$tenyearPass=str_replace("'","",$_REQUEST['tenyearPass']);
		$tenDiviMark=str_replace("'","",$_REQUEST['tenDiviMark']);
		/*$tenDocument=str_replace("'","",$_FILES['tenDocument']['name']);
		
		if($tenDocument=="" || $tenDocument==NULL){
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
		/*$twelDocument=str_replace("'","",$_FILES['twelDocument']['name']);
		
		if($twelDocument=="" || $twelDocument==NULL)
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
		/*$clgDocument	=str_replace("'","",$_FILES['clgDocument']['name']);
		
		if($clgDocument=="" || $clgDocument==NULL)
		{
			$clgDocumentName="";
		}
		else{
			$a=date("Y-m-d h:i:s");
			$a=str_replace(" ","-",$a);
			$a=str_replace(":","-",$a);
			$finalDate3=$a;		
			$clgDocumentName="clg_doc".$finalDate3."-".$clgDocument;
		}		
		*/
		
		
		
		$txtDocFile=str_replace("'","",$_FILES['txtDocFile']['name']);
		
		if($txtDocFile=="" || $txtDocFile==NULL)
		{
			$txtDocFileName="";
		}
		else{
			$a=date("Y-m-d h:i:s");
			$a=str_replace(" ","-",$a);
			$a=str_replace(":","-",$a);
			$finalDate3=$a;		
			$txtDocFileName="clg_doc".$finalDate3."-".$txtDocFile;
		}
		
		
		
		
		if($txtHide=="" || $txtHide==NULL){
			
			$max_id_q=$db->query("SELECT (IFNULL(MAX(id),0))+1 AS ID FROM student_master") or die("");	
			$max_id_q_res=$max_id_q->fetch(PDO::FETCH_ASSOC);	
			$enroll_id=$max_id_q_res['ID'];
			
			$studEnrollNo="ITSPL03/SETPST".$enroll_id;
		
			$insQ=$db->query("insert into student_master(stud_enroll_no,institut_id,institute_name ,course_id ,
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
				'$txtEmail','$txtAdhrNo','$txtMo',
				'$tenQuli','$tenschClg','$tenbordUni',
				'$tenyearPass','$tenDiviMark',
				'$twelQuli','$twelschClg','$twelbordUni',
				'$twelyearPass','$twelDiviMark',
				'$clgQuli','$clgschClg','$clgbordUni','$clgyearPass',
				'$clgDiviMark','$txtDocFileName',$login_id,now())") or die("");
			if($insQ==TRUE)
			{
				
				move_uploaded_file($_FILES['txtPhoto']['tmp_name'],"../../stud_documents/".$txtPhotoName);
				
				move_uploaded_file($_FILES['txtDocFile']['tmp_name'],"../../stud_documents/".$txtDocFileName);
				/*move_uploaded_file($_FILES['twelDocument']['tmp_name'],"../../stud_documents/".$twelDocumentName);
				move_uploaded_file($_FILES['clgDocument']['tmp_name'],"../../stud_documents/".$clgDocumentName);*/
				
				
				?>
					<script>
						alert("Sucessfully Added !...");
						window.location.replace("student_info_master.php");
					</script>
				<?php
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
			/*==update---*/
			$updateQ=$db->query("update 
			student_master set 
			stud_enroll_no='$studEnrollNo',institut_id='$insId',
			institute_name='$insName' ,course_id='$txtCourseId' ,
				course_name='$txtCourseName' ,stud_name='$txtNOfAppli' ,stud_image='$txtPhotoName' ,
				stud_m_name='$txtMotherName' ,stud_f_name='$txtFatherName' ,
				stud_occupation='$txtOccupation' ,
				stud_orgnization='$txtOrgni' ,stud_add='$txtCmpleteAdd',
				stud_dob='$txtDOB' ,stud_marital ='$txtMateriState',
				stud_gender='$txtGender' ,
				stud_city='$txtCity' ,stud_pin='$txtPin' ,stud_state='$txtState' ,
				stud_email='$txtEmail' ,stud_aadhr='$txtAdhrNo' ,stud_mo ='$txtMo',
				stud_ten_quali='$tenQuli' ,stud_ten_school='$tenschClg' ,
				stud_ten_board ='$tenbordUni',
				stud_ten_yop='$tenyearPass' ,stud_ten_mark='$tenDiviMark' ,
				stud_ten_doc ='$tenDocumentName',
				stud_ele_quali='$twelQuli' ,stud_ele_school='$twelschClg' ,
				stud_ele_board ='$twelbordUni',
				stud_ele_yop='$twelyearPass' ,stud_ele_mark='$twelDiviMark' ,
				stud_ele_doc ='$twelDocumentName',
				stud_clg_quali ='$clgQuli',stud_clg_school='$clgschClg' ,
				stud_clg_board='$clgbordUni' ,stud_clg_yop ='$clgyearPass',
				stud_clg_mark ='$clgDiviMark',
				stud_clg_doc='$clgDocumentName' ,updated_by=$login_id ,updated_on=now() where id=$txtHide");
				
				
			if($updateQ==TRUE){
				?>
					<script>
						alert("Sucessfully Updated !...");
						window.location.replace("student_info_master.php");
					</script>
				<?php
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