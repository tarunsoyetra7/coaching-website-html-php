<?php
	if(isset($_COOKIE['login']))
	{
		$id=$_COOKIE['login'];
		require("../../root/db_connection.php");
		if(isset($_FILES['txtCsvFile']['name']))
		{
			
			$txtSelTrainingInstitute=$_REQUEST['txtSelTrainingInstitute'];
			
			
			
			$fetchCourseQ=$db->query("SELECT id,o_c_n_id,o_c_n_name,t_c_name FROM center_info_master WHERE id=$txtSelTrainingInstitute AND  flag='true'") or die("");			
			$fetchCourseQ_res=$fetchCourseQ->fetch(PDO::FETCH_ASSOC);
			
			$institute_name=$fetchCourseQ_res['t_c_name'];			
			$course_id=$fetchCourseQ_res['o_c_n_id'];
			$course_name=$fetchCourseQ_res['o_c_n_name'];
			
			
			
			$file_name=$_FILES['txtCsvFile']['tmp_name'];			
			$file_name1=$_FILES['txtCsvFile']['name'];			
			$ext=pathinfo($file_name1,PATHINFO_EXTENSION);
			$c=1;					
			if($ext=="csv" || $ext=="CSV" || $ext=="xlsx")
			{
				
				$file=fopen($file_name,"r");				
						
				//$emapData=fgetcsv($file);
				//echo count($emapData);
							
	        	while(($emapData = fgetcsv($file,10000, ",")) !== FALSE)
	        	{			
					if($c == 1){ $c++; continue; }			
					$enrollQ=$db->query("SELECT * FROM enroll_master limit 1") or die("");
					$enrollQ_res=$enrollQ->fetch(PDO::FETCH_ASSOC);
					$max_id_q=$db->query("SELECT (IFNULL(MAX(id),0))+1 AS ID FROM student_master") or die("");
					$max_id_q_res=$max_id_q->fetch(PDO::FETCH_ASSOC);	
					$enroll_id=$max_id_q_res['ID'];
					$studEnrollNo=$enrollQ_res['enroll_no'].$enroll_id;	
					
					//It wiil insert a row to our subject table from our csv file`
					$sql = $db->query("INSERT INTO student_master(
																stud_enroll_no,
																institut_id,
																institute_name,
																course_id,
																course_name,
																stud_name,																
																stud_f_name,
																stud_dob,
																stud_mo,
																stud_occupation,
																stud_add,
																
																created_by,
																created_on)
																 VALUES('$studEnrollNo',
																 $txtSelTrainingInstitute,
																 '$institute_name',
																 '$course_id',
																 '$course_name',
																 '$emapData[1]',
																 '$emapData[2]',
																 '$emapData[3]',
																 '$emapData[4]',
																 '$emapData[5]',
																 '$emapData[6]',
																 
																 $id,
																 now())");	
																 
																 
																 /*---$sql = $db->query("INSERT INTO student_master(
																stud_enroll_no,
																institut_id,
																institute_name,
																course_id,
																course_name,
																stud_name,
																stud_m_name,
																stud_f_name,
																stud_occupation,
																stud_orgnization,
																stud_add,
																stud_dob,
																stud_marital,
																stud_gender,
																stud_city,
																stud_pin,
																stud_state,
																stud_email,
																stud_mo,
																stud_aadhr,
																stud_ten_quali,
																stud_ten_school,
																stud_ten_board,
																stud_ten_yop,
																stud_ten_mark,
																created_by,
																created_on)
																 VALUES('$studEnrollNo',
																 $txtSelTrainingInstitute,
																 '$institute_name',
																 '$course_id',
																 '$course_name',
																 '$emapData[1]',
																 '$emapData[2]',
																 '$emapData[3]',
																 '$emapData[4]',
																 '$emapData[5]',
																 '$emapData[6]',
																 '$emapData[7]',
																 '$emapData[8]',
																 '$emapData[9]',
																 '$emapData[10]',
																 '$emapData[11]',
																 '$emapData[12]',
																 '$emapData[13]',
																 '$emapData[14]',
																 '$emapData[15]',
																 '$emapData[16]',
																 '$emapData[17]',
																 '$emapData[18]',
																 '$emapData[19]',
																 '$emapData[20]',
																 $id,
																 now())");	  ---*/           	         				
	        	}
				$c = $c + 1;
?>
				<script>
                    alert("Sucessfully Inserted !...");
                    window.location.replace("import_student_excel_master.php");
                </script>
             <?php	        
			}
			else
			{
				?>
					<script>
						alert("Invalid File Format !..");
						window.location.replace("import_student_excel_master.php");
                    </script>
                <?php
			}
		}
		else
		{
			header("location:../index.php");	
		}
	}
	else
	{
		header("location:../index.php");	
	}
?>