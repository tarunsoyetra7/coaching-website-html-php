<?php
	if(isset($_COOKIE['login'])){
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
</head>
<body>
    <div id="wrapper">
        <?php  include("header.php");  ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 align="center"><strong>Training Institute Master</strong></h4>                         
					   <hr>
                       
                       <ol class="breadcrumb">
                            <li class="active">
                               <a href="training_institute_master.php">
                               		<i class="fa fa-dashboard"></i> Add Institute
                               </a>
                            </li>
                            
                            
                            <li class="active">
                               <a href="manage_training_institute_master.php">
                               		<i class="fa fa-dashboard"></i> Manage Institute
                               </a>
                            </li>
                            
                            
                        </ol>
                    </div>
                    


<div class="col-lg-6" style="border-right:1px solid #000;">
	<h4 align="center">Old Detail</h4><hr>
    
    
    
    <!---start old--->
    
     
          <?php if(isset($_REQUEST['id'])){
			  $id=$_REQUEST['id'];
			  
			  $editQ=$db->query("SELECT user_name, 
       user_pass, 
       ofc_infra_detail, 
       lab_infra_detail, 
       class_room_infra, 
       class_start_date, 
       class_end_date, 
       final_exm_date, 
       stud_data_frm, 
       stud_vari_sheet, 
       stud_pro_file, 
       stud_attan_sheet, 
       ass_fee_detail, 
       pay_descp, 
       total_present_stud, 
       id, 
       o_f_name, 
       t_c_pro_img, 
       o_c_n_id, 
       o_c_n_name, 
       o_l_name, 
       o_dob, 
       o_m_no, 
       instruct_trainner_detail, 
       o_adhar_no, 
       o_email_id, 
       t_c_name, 
       t_r_cmpny, 
       t_cmp_add, 
       t_city, 
       t_district, 
       t_state, 
       t_pincode, 
       t_c_stdate, 
       t_c_ownership, 
       t_c_incharge, 
       t_c_incharge_mo, 
       t_c_ofc_boy, 
       t_c_ofc_boy_mo, 
       oi_sys_avali, 
       oi_dw_avali, 
       oi_govt_ti_up, 
       oi_m_toi, 
       oi_f_toi, 
       oi_washbasin, 
       oi_c_area, 
       cr_noc, 
       cr_setting_cap, 
       cr_no_of_chair, 
       cr_no_of_table, 
       cr_no_of_fan, 
       cr_no_of_light, 
       li_no_of_lab, 
       li_setting_cap, 
       li_no_of_computer, 
       li_l_s_avali, 
       li_no_of_chair, 
       li_no_of_table, 
       li_no_of_fan, 
       li_no_of_light 
FROM   center_info_master 
WHERE  flag = 'true' 
       AND id = $id 
ORDER  BY id DESC ") or die("");
			
			$fetchQres=$editQ->fetch(PDO::FETCH_ASSOC);
			  
			  ?>
            


<div class="col-lg-12">
 <h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Account Setting </h4><br>
</div>
<div class="col-lg-6">

<label>User Name : </label>
<input name="txtUserName" value="<?php echo $fetchQres['user_name']; ?>" id="txtUserName" type="text" class="form-control" placeholder="Enter User Name *" required><br>
</div>

<div class="col-lg-6">

<label>Password : </label>
<input type="text" id="txtPass" value="<?php echo $fetchQres['user_pass']; ?>" name="txtPass" class="form-control" placeholder="Enter Password *" required><br>
</div>

          
<div class="col-lg-12">
                    	<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Course Details </h4><br>
                        
                        <?php $course__ID= $fetchQres['o_c_n_id'];
						
						$courseQUERY=$db->query("select c_name from course_master where FIND_IN_SET(id,'$course__ID')") or die("");
						
						while($courseQUERY_res=$courseQUERY->fetch(PDO::FETCH_ASSOC)){
						 ?>
                        
                        <p style="padding:7px; color:#fff; background:#333;  float:left; margin-right:5px; margin-bottom:5px;">
                        	<?php echo $courseQUERY_res['c_name']; ?>
                        </p>
                        <?php } ?>
                        <div style="clear:both;"></div>
                        
                        
                        <br>
                       
</div> 



					
                 <div class="col-lg-12">
                    	<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Owner Details </h4><br>
                    </div>
                    
                          
                    <div class="col-lg-6">
                    	<label>First Name : </label>
                       
                       <input type="hidden" value="<?php echo $fetchQres['id']; ?>" id="txtHide" name="txtHide">
                        <input value="<?php echo $fetchQres['o_f_name']; ?>"  type="text" id="txtFName" name="txtFName" class="form-control" placeholder="First Name *">
                        <br>
                    </div>
                     
                     
                     
                      <div class="col-lg-6">
                    	<label>Last Name : </label>
                        <input value="<?php echo $fetchQres['o_l_name']; ?>" name="txtLastName" id="txtLastName" type="text" class="form-control" placeholder="Last Name *">
                        <br>
                    </div>
                    
                    
                    
                    
                        
                    <div class="col-lg-5">
                    	<label>Profile Image : </label>
                        <input name="txtProImg" id="txtProImg" type="file" class="form-control">
                        <span>File Type : jpg,png</span>
                        <br>
                    </div>
                    
                    <div class="col-lg-1">
                    	<br>
                        <?php if($fetchQres['t_c_pro_img']=="" || $fetchQres['t_c_pro_img']==NULL){ $centerProfile="default_image.jpg"; } else { $centerProfile=$fetchQres['id'].".".$fetchQres['t_c_pro_img']; } ?>
                        <img src="../../center_profile/<?php echo $centerProfile; ?>" style="width:40px; height:40px;">
                    </div>
                    
                    
                    
                    
                     <div class="col-lg-6">
                    	<label>DOB : </label>
                        <input  id="txtDOB" name="txtDOB" value="<?php echo  $fetchQres['o_dob']; ?>" type="date" class="form-control" >
                        <br>
                    </div>
                    
                    
                    <div class="col-lg-6">
                    	<label>Mobile NO : </label>
                        <input value="<?php echo $fetchQres['o_m_no']; ?>" type="text" id="txtMoNO" name="txtMoNO" placeholder="Mobile NO *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    <div class="col-lg-5">
                    	<label>Aadhr NO : </label>
                        <input id="txtAdhar" name="txtAdhar" type="file" placeholder="Aadhr No *" class="form-control" >
                        <br>
                    </div>
                    
                    <div class="col-lg-1" >
                    	<br>
                        <?php if($fetchQres['o_adhar_no']=="" || $fetchQres['o_adhar_no']==NULL){ $aadharImg="adhar_demo.png"; } else { $aadharImg=$fetchQres['id'].".".$fetchQres['o_adhar_no']; } ?>
                        <img src="../../center_aadhar/<?php echo $aadharImg; ?>" style="width:40px; height:40px;">                    
                    </div>
                    
                    
                    <div class="col-lg-12">
                    	<label>Email ID : </label>
                        <input type="text" value="<?php echo $fetchQres['o_email_id']; ?>" id="txtEmailId" name="txtEmailId" placeholder="Email Address *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                     <div class="col-lg-12">
                    	<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Training Center Details </h4><br>
                    </div>
                    
                    
                    
                     <div class="col-lg-6">
                    	<label>Center Name : </label>
                        <input value="<?php echo $fetchQres['t_c_name']; ?>" type="text" id="txtCenterName" name="txtCenterName" placeholder="Center Name *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Under Registration  : </label>
                        <input value="<?php echo $fetchQres['t_r_cmpny']; ?>" type="text" id="txtRegCmpny" name="txtRegCmpny" placeholder="Under Registration Company/ Society / Farm *" class="form-control" >
                        <br>
                    </div>                    
                    
                    
                    <div class="col-lg-12">
                    	<label>Complete Address : </label>
                        <textarea id="txtCmpleteAdd" name="txtCmpleteAdd" class="form-control" placeholder="Enter Address *" required><?php echo $fetchQres['t_cmp_add']; ?></textarea>
                        <br>
                    </div>
                    
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>City/ Village : </label>
                        <input value="<?php echo $fetchQres['t_city']; ?>" id="txtCity" name="txtCity" type="text" placeholder="City/ Village *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>District : </label>
                        <input value="<?php echo $fetchQres['t_district']; ?>" id="txtDistrict" name="txtDistrict" type="text" placeholder="District *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                     <div class="col-lg-6">
                    	<label>State : </label>
                        <input value="<?php echo $fetchQres['t_state']; ?>" id="txtState" name="txtState" type="text" placeholder="City/ Village *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Pin Code : </label>
                        <input value="<?php echo $fetchQres['t_pincode']; ?>" id="txtPinCode" name="txtPinCode" type="text" placeholder="District *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                     <div class="col-lg-6">
                    	<label>Center Start Date : </label>
                        <input id="txtStartDate" value="<?php echo $fetchQres['t_c_stdate']; ?>" name="txtStartDate" type="date" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Center Ownership : </label>
                        <input value="<?php echo $fetchQres['t_c_ownership']; ?>" id="txtCenterOwnership" name="txtCenterOwnership" type="text" placeholder="Center Ownership *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Center In Charge : </label>
                        <input value="<?php echo $fetchQres['t_c_incharge']; ?>" id="txtCenterInCharge" name="txtCenterInCharge" type="text" placeholder="Center In Charge *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Mobile No : </label>
                        <input value="<?php echo $fetchQres['t_c_incharge_mo']; ?>" id="txtInchargeMoNO" name="txtInchargeMoNO" type="text" placeholder="Mobile No *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Center Office Boy : </label>
                        <input value="<?php echo $fetchQres['t_c_ofc_boy']; ?>" id="centerOfcBoy" name="centerOfcBoy" type="text" placeholder="Center Office Boy *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Mobile No : </label>
                        <input value="<?php echo $fetchQres['t_c_ofc_boy_mo']; ?>" id="txtMoNo" name="txtMoNo" type="text" placeholder="Mobile No *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                    
                     <div class="col-lg-12">
                    	<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Office Infrastructure Details </h4><br>
                        
                        <div  style="width:100%; padding:10px; height:150px; border:1px solid #ccc; border-radius:4px; overflow:auto;" contenteditable="true"><?php echo $fetchQres['ofc_infra_detail']; ?></div><br>
                   
                                               
                    </div>
                    
                   
                    
                    
                    <div class="col-lg-12">
                    	<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Class Room Infrastructure </h4><br>
                        
                        <div  style="width:100%; height:150px; border:1px solid #ccc; border-radius:4px; overflow:auto; padding:10px;" contenteditable="true"><?php echo $fetchQres['class_room_infra']; ?></div><br>
                                              
                                              
                                              
                    </div>
                        
                    
                    
                   <div class="col-lg-12">
                   <h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Lab Infrastructure </h4><br>
                   	<div  contenteditable="true" style="width:100%; height:150px; border-radius:4px;  border:1px solid #ccc; padding:10px; overflow:auto;"><?php echo $fetchQres['lab_infra_detail']; ?></div><br>
                   </div>  
                      
                   
                
                    
					<div class="col-lg-12">
                    <h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Instructor / Trainer Detail </h4><br>
                    <div contenteditable="true"  style="width:100%; height:150px; border:1px solid #CCCCCC; border-radius:4px; padding:10px; overflow:auto;"><?php echo $fetchQres['instruct_trainner_detail']; ?></div><br></div>
			  
              
              
              <div class="col-lg-6">
              	<label>Class Start Date : </label>
                <input value="<?php echo $fetchQres['class_start_date']; ?>" name="txtClsStartDate" type="date" class="form-control"><br>
              </div>
              <div class="col-lg-6">
              	<label>Class End Date : </label>
                <input value="<?php echo $fetchQres['class_end_date']; ?>" name="txtClsEndDate" type="date" class="form-control"><br>
              </div>
              <div class="col-lg-6">
              	<label>Final Exam Date : </label>
                <input value="<?php echo $fetchQres['final_exm_date']; ?>" name="txtFinalExmDate" type="date" class="form-control"><br>
              </div>
              
              
              
              <div class="col-lg-6">
              	<label>Student Data Form  : </label>
                <input value="<?php echo $fetchQres['stud_data_frm']; ?>" name="txtStudDataFrm" type="date" class="form-control"><br>
              </div>
              <div class="col-lg-6">
              	<label> Varification Sheet :</label>
                <input  value="<?php echo $fetchQres['stud_vari_sheet']; ?>" name="txtStudVariSheet" type="date" class="form-control"><br>
              </div>
              <div class="col-lg-6">
              	<label>Project File : </label>
                <input value="<?php echo $fetchQres['stud_pro_file']; ?>" name="txtProjectFile" type="date" class="form-control"><br>
              </div>
             
             
             <div class="col-lg-12">
             
                   	<label> Attandance Sheet : </label>
                    
  <div  contenteditable="true" style="width:100%; overflow:auto; height:95px; border:1px solid #ccc; border-radius:4px; padding:10px;">
  <?php echo $fetchQres['stud_attan_sheet']; ?> </div>
                    
                   
                    
                    <br>
                   
             </div>
           
           
           <div class="col-lg-6">
                    	<label>Assessment Fees  : </label>
                        <textarea id="txtAssFeeDetail" name="txtAssFeeDetail" placeholder="Assessment Fees Detail"  class="form-control" rows="4"><?php echo $fetchQres['ass_fee_detail']; ?></textarea><br>
            </div>
           
           
           
           <div class="col-lg-6">
                    	<label>Payment Descp : </label>
                        <textarea id="txtPayDescp" name="txtPayDescp" placeholder="Payment Description" class="form-control" rows="4"><?php echo $fetchQres['pay_descp']; ?></textarea><br>
                    </div>
             
             
         <div class="col-lg-12">
                   	<label>Total no of present students : </label>
       <input id="txtTotalPreStud" value="<?php echo $fetchQres['total_present_stud']; ?>" name="txtTotalPreStud" type="text" class="form-control" placeholder="Total no of present student ">
                    <br>
                    
                    </div>      
                    
             
               
                   
                   
              <?php
			  
		  }
		 
		  ?> 
          
          
                          
                   
    
    <!---end old--->
    
    
    
</div>

<div class="col-lg-6">
	<h4 align="center">New Detail</h4><hr>
    
    <!---start new--->
     
          <?php if(isset($_REQUEST['id'])){
			  $id=$_REQUEST['id'];
			 
			 $editQ=$db->query("SELECT user_name, 
       user_pass, 
       ofc_infra_detail, 
       lab_infra_detail, 
       class_room_infra, 
       class_start_date, 
       class_end_date, 
       final_exm_date, 
       stud_data_frm, 
       stud_vari_sheet, 
       stud_pro_file, 
       stud_attan_sheet, 
       ass_fee_detail, 
       pay_descp, 
       total_present_stud, 
       id, institute_id,
       o_f_name, 
       t_c_pro_img, 
       o_c_n_id, 
       o_c_n_name, 
       o_l_name, 
       o_dob, 
       o_m_no, 
       instruct_trainner_detail, 
       o_adhar_no, 
       o_email_id, 
       t_c_name, 
       t_r_cmpny, 
       t_cmp_add, 
       t_city, 
       t_district, 
       t_state, 
       t_pincode, 
       t_c_stdate, 
       t_c_ownership, 
       t_c_incharge, 
       t_c_incharge_mo, 
       t_c_ofc_boy, 
       t_c_ofc_boy_mo, 
       oi_sys_avali, 
       oi_dw_avali, 
       oi_govt_ti_up, 
       oi_m_toi, 
       oi_f_toi, 
       oi_washbasin, 
       oi_c_area, 
       cr_noc, 
       cr_setting_cap, 
       cr_no_of_chair, 
       cr_no_of_table, 
       cr_no_of_fan, 
       cr_no_of_light, 
       li_no_of_lab, 
       li_setting_cap, 
       li_no_of_computer, 
       li_l_s_avali, 
       li_no_of_chair, 
       li_no_of_table, 
       li_no_of_fan, 
       li_no_of_light 
FROM   tmp_center_info_master 
WHERE  flag = 'true' 
       AND institute_id = $id 
ORDER  BY id DESC ") or die("");
			
			$fetchQres1=$editQ->fetch(PDO::FETCH_ASSOC);
			  
			  ?>
             <form name="" method="post" id="CenterFrm" enctype="multipart/form-data" action="training_institute_master_do_11.php">


<div class="col-lg-12">
 <h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Account Setting </h4><br>
</div>
<div class="col-lg-6">

<label>User Name : </label>
<input name="txtUserName" value="<?php echo $fetchQres['user_name']; ?>" id="txtUserName" type="text" class="form-control" placeholder="Enter User Name *" required><br>
</div>

<div class="col-lg-6">

<label>Password : </label>
<input type="text" id="txtPass" value="<?php echo $fetchQres['user_pass']; ?>" name="txtPass" class="form-control" placeholder="Enter Password *" required><br>
</div>

          
<div class="col-lg-12">
                    	<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Course Details </h4><br>
                        <input type="hidden" name="txtSelCourse" value="<?php echo $fetchQres['o_c_n_id']; ?>">
                         <?php $course__ID= $fetchQres['o_c_n_id'];
						
						
						$courseQUERY=$db->query("select c_name from course_master where FIND_IN_SET(id,'$course__ID')") or die("");
						
						while($courseQUERY_res=$courseQUERY->fetch(PDO::FETCH_ASSOC)){
						 ?>
                        
                        <p style="padding:7px; color:#fff; background:#333;  float:left; margin-right:5px; margin-bottom:5px;">
                        	<?php echo $courseQUERY_res['c_name']; ?>
                        </p>
                        <?php } ?>
                        <div style="clear:both;"></div>
                        
                        
                        <br>
                        
                        
</div> 



					
                 <div class="col-lg-12">
                    	<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Owner Details </h4><br>
                    </div>
                    
                          
                    <div class="col-lg-6">
                    	<label>First Name  : </label>
                       
                       <input type="hidden" value="<?php echo $fetchQres1['institute_id']; ?>" id="txtHide" name="txtHide">
                        <input value="<?php echo $fetchQres1['o_f_name']; ?>"  type="text" id="txtFName" name="txtFName" class="form-control" placeholder="First Name *">
                        <br>
                    </div>
                     
                     
                     
                      <div class="col-lg-6">
                    	<label>Last Name : </label>
                        <input value="<?php echo $fetchQres1['o_l_name']; ?>" name="txtLastName" id="txtLastName" type="text" class="form-control" placeholder="Last Name *">
                        <br>
                    </div>
                    
                    
                    
                    
                        
                    <div class="col-lg-5">
                    	<label>Profile Image : </label>
                        <input name="txtProImg" id="txtProImg" type="file" class="form-control">
                        <span>File Type : jpg,png</span>
                        <br>
                    </div>
                    
                    <div class="col-lg-1">
                    	<br>
                        <?php if($fetchQres1['t_c_pro_img']=="" || $fetchQres1['t_c_pro_img']==NULL){ $centerProfile="default_image.jpg"; } else { $centerProfile=$fetchQres1['id'].".".$fetchQres1['t_c_pro_img']; } ?>
                       <a href="../../center_profile/<?php echo $centerProfile; ?>" target="_blank" download>
                        <img src="../../center_profile/<?php echo $centerProfile; ?>" style="width:40px; height:40px;">
                        </a>
                    </div>
                    
                    
                    
                    
                     <div class="col-lg-6">
                    	<label>DOB : </label>
                        <input  id="txtDOB" name="txtDOB" value="<?php echo  $fetchQres1['o_dob']; ?>" type="date" class="form-control" >
                        <br>
                    </div>
                    
                    
                    <div class="col-lg-6">
                    	<label>Mobile NO : </label>
                        <input value="<?php echo $fetchQres1['o_m_no']; ?>" type="text" id="txtMoNO" name="txtMoNO" placeholder="Mobile NO *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    <div class="col-lg-5">
                    	<label>Aadhr NO : </label>
                        <input id="txtAdhar" name="txtAdhar" type="file" placeholder="Aadhr No *" class="form-control" >
                        <br>
                    </div>
                    
                    <div class="col-lg-1" >
                    	<br>
                        <?php if($fetchQres1['o_adhar_no']=="" || $fetchQres1['o_adhar_no']==NULL){ $aadharImg="adhar_demo.png"; } else { $aadharImg=$fetchQres1['id'].".".$fetchQres1['o_adhar_no']; } ?>
                        <a href="../../center_aadhar/<?php echo $aadharImg; ?>" target="_blank" download><img src="../../center_aadhar/<?php echo $aadharImg; ?>" style="width:40px; height:40px;">
                        </a>                    
                    </div>
                    
                    
                    <div class="col-lg-12">
                    	<label>Email ID : </label>
                        <input type="text" value="<?php echo $fetchQres1['o_email_id']; ?>" id="txtEmailId" name="txtEmailId" placeholder="Email Address *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                     <div class="col-lg-12">
                    	<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Training Center Details </h4><br>
                    </div>
                    
                    
                    
                     <div class="col-lg-6">
                    	<label>Center Name : </label>
                        <input value="<?php echo $fetchQres1['t_c_name']; ?>" type="text" id="txtCenterName" name="txtCenterName" placeholder="Center Name *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Under Registration  : </label>
                        <input value="<?php echo $fetchQres1['t_r_cmpny']; ?>" type="text" id="txtRegCmpny" name="txtRegCmpny" placeholder="Under Registration Company/ Society / Farm *" class="form-control" >
                        <br>
                    </div>                    
                    
                    
                    <div class="col-lg-12">
                    	<label>Complete Address : </label>
                        <textarea id="txtCmpleteAdd" name="txtCmpleteAdd" class="form-control" placeholder="Enter Address *" required><?php echo $fetchQres1['t_cmp_add']; ?></textarea>
                        <br>
                    </div>
                    
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>City/ Village : </label>
                        <input value="<?php echo $fetchQres1['t_city']; ?>" id="txtCity" name="txtCity" type="text" placeholder="City/ Village *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>District : </label>
                        <input value="<?php echo $fetchQres1['t_district']; ?>" id="txtDistrict" name="txtDistrict" type="text" placeholder="District *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                     <div class="col-lg-6">
                    	<label>State : </label>
                        <input value="<?php echo $fetchQres1['t_state']; ?>" id="txtState" name="txtState" type="text" placeholder="City/ Village *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Pin Code : </label>
                        <input value="<?php echo $fetchQres1['t_pincode']; ?>" id="txtPinCode" name="txtPinCode" type="text" placeholder="District *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                     <div class="col-lg-6">
                    	<label>Center Start Date : </label>
                        <input id="txtStartDate" value="<?php echo $fetchQres1['t_c_stdate']; ?>" name="txtStartDate" type="date" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Center Ownership : </label>
                        <input value="<?php echo $fetchQres1['t_c_ownership']; ?>" id="txtCenterOwnership" name="txtCenterOwnership" type="text" placeholder="Center Ownership *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Center In Charge : </label>
                        <input value="<?php echo $fetchQres1['t_c_incharge']; ?>" id="txtCenterInCharge" name="txtCenterInCharge" type="text" placeholder="Center In Charge *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Mobile No : </label>
                        <input value="<?php echo $fetchQres1['t_c_incharge_mo']; ?>" id="txtInchargeMoNO" name="txtInchargeMoNO" type="text" placeholder="Mobile No *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Center Office Boy : </label>
                        <input value="<?php echo $fetchQres1['t_c_ofc_boy']; ?>" id="centerOfcBoy" name="centerOfcBoy" type="text" placeholder="Center Office Boy *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                    <div class="col-lg-6">
                    	<label>Mobile No : </label>
                        <input value="<?php echo $fetchQres1['t_c_ofc_boy_mo']; ?>" id="txtMoNo" name="txtMoNo" type="text" placeholder="Mobile No *" class="form-control" >
                        <br>
                    </div>
                    
                    
                    
                    
                    
                     <div class="col-lg-12">
                    	<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Office Infrastructure Details </h4><br>
                        
                        <div id="ofcInfraDetail" style="width:100%; padding:10px; height:150px; border:1px solid #ccc; border-radius:4px; overflow:auto;" contenteditable="true"><?php echo $fetchQres1['ofc_infra_detail']; ?></div><br>
                    <input type="hidden" id="txtOfcInfaDetail" name="txtOfcInfaDetail">    
                                               
                    </div>
                    
                   
                    
                    
                    <div class="col-lg-12">
                    	<h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Class Room Infrastructure </h4><br>
                        
                        <div id="clsRoomInfra" style="width:100%; height:150px; border:1px solid #ccc; border-radius:4px; overflow:auto; padding:10px;" contenteditable="true"><?php echo $fetchQres1['class_room_infra']; ?></div><br>
                    <input type="hidden" id="txtClassRoomInfra" name="txtClassRoomInfra">    
                                              
                                              
                                              
                    </div>
                        
                    
                    
                   <div class="col-lg-12">
                   <h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Lab Infrastructure </h4><br>
                   	<div id="labInFra" contenteditable="true" style="width:100%; height:150px; border-radius:4px;  border:1px solid #ccc; padding:10px; overflow:auto;"><?php echo $fetchQres1['lab_infra_detail']; ?></div><br>
                   </div>  
                   
                   <input type="hidden" id="txtLabInfraDetail" name="txtLabInfraDetail">                        
                   
                
                    
					<div class="col-lg-12">
                    <h4 style="border-bottom:3px double #ccc; padding-bottom:10px;">Instructor / Trainer Detail </h4><br>
                    <div contenteditable="true" id="InstcutTrainnerDetail" style="width:100%; height:150px; border:1px solid #CCCCCC; border-radius:4px; padding:10px; overflow:auto;"><?php echo $fetchQres1['instruct_trainner_detail']; ?></div><br></div>
			  <input type="hidden" id="txtTrainnerDetail" name="txtTrainnerDetail"> 
              
              
              <div class="col-lg-6">
              	<label>Class Start Date : </label>
                <input value="<?php echo $fetchQres1['class_start_date']; ?>" name="txtClsStartDate" type="date" class="form-control"><br>
              </div>
              <div class="col-lg-6">
              	<label>Class End Date : </label>
                <input value="<?php echo $fetchQres1['class_end_date']; ?>" name="txtClsEndDate" type="date" class="form-control"><br>
              </div>
              <div class="col-lg-6">
              	<label>Final Exam Date : </label>
                <input value="<?php echo $fetchQres1['final_exm_date']; ?>" name="txtFinalExmDate" type="date" class="form-control"><br>
              </div>
              
              
              
              <div class="col-lg-6">
              	<label>Student Data Form  : </label>
                <input value="<?php echo $fetchQres1['stud_data_frm']; ?>" name="txtStudDataFrm" type="date" class="form-control"><br>
              </div>
              <div class="col-lg-6">
              	<label> Varification Sheet :</label>
                <input  value="<?php echo $fetchQres1['stud_vari_sheet']; ?>" name="txtStudVariSheet" type="date" class="form-control"><br>
              </div>
              <div class="col-lg-6">
              	<label>Project File : </label>
                <input value="<?php echo $fetchQres['stud_pro_file']; ?>" name="txtProjectFile" type="date" class="form-control"><br>
              </div>
             
             
             <div class="col-lg-12">
             
                   	<label> Attandance Sheet : </label>
                    
  <div id="txtSAS" contenteditable="true" style="width:100%; overflow:auto; height:95px; border:1px solid #ccc; border-radius:4px; padding:10px;">
  <?php echo $fetchQres1['stud_attan_sheet']; ?> </div>
                    
                    <input type="hidden" name="txStudAttenSheet" id="txStudAttenSheet">
                    
                    <br>
                   
             </div>
           
           
           <div class="col-lg-6">
                    	<label>Assessment Fees  : </label>
                        <textarea id="txtAssFeeDetail" name="txtAssFeeDetail" placeholder="Assessment Fees Detail"  class="form-control" rows="4"><?php echo $fetchQres1['ass_fee_detail']; ?></textarea><br>
            </div>
           
           
           
           <div class="col-lg-6">
                    	<label>Payment Descp : </label>
                        <textarea id="txtPayDescp" name="txtPayDescp" placeholder="Payment Description" class="form-control" rows="4"><?php echo $fetchQres1['pay_descp']; ?></textarea><br>
                    </div>
             
             
         <div class="col-lg-12">
                   	<label>Total no of present students : </label>
       <input id="txtTotalPreStud" value="<?php echo $fetchQres1['total_present_stud']; ?>" name="txtTotalPreStud" type="text" class="form-control" placeholder="Total no of present student ">
                    <br>
                    
                    </div>      
                    
             
                   </form>  
                   
                   
                   
              <?php
			  
		  }
		  else {
		  ?> 
          
                              
                   <?php } ?>                   
                   
    <!---end new--->
    
</div>

      
      
      <div class="col-lg-12">
      <hr>
                   	<p align="center"><br>
                    	<button type="button" class="btn btn-sm btn-info btnSubmitDetail">
                        	Submit
                        </button>
                        
                        
                        <button type="button" class="btn btn-sm btn-danger btnClearDetail">
                        	Clear
                        </button>
                        
                    </p>
                   </div>               
                 
                                              
                   </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
	$(".addMorebtn_1").on("click",function(e){		
		$("#tabStructRes").append($("#tabStruct").html());
	});
	
	
	$(".btnClearDetail").on("click",function(e){
		var del_id=$("#txtHide").val();
		$.ajax({
			type:"POST",
			data:{id:del_id},
			url:"delete_training_insti_changes_req_by_admin.php",
			success: function(r_data){
				alert(r_data);
				window.location.replace("report_page.php");
			},
			error: function(err){
				location.reload();
			}
		});
		
	});
	

$(".btnSubmitDetail").on("click",function(e){
	
			
	  	$("#txtTrainnerDetail").val($("#InstcutTrainnerDetail").html());
	  		
		$("#txtLabInfraDetail").val($("#labInFra").html());		
		
		$("#txtOfcInfaDetail").val($("#ofcInfraDetail").html());	
		
		$("#txtClassRoomInfra").val($("#clsRoomInfra").html());	
		
		$("#txStudAttenSheet").val($("#txtSAS").html());
			
		$("#CenterFrm").submit();
	
});
	
	
	
	</script>
    
		<style>
            .c_sec
            {
                float:left;                margin-right:10px; 
                margin-bottom:10px;        padding:5px; 
                color:#fff;                background:#333; 
                cursor:pointer;
            }
        </style>
        
   
	
	
</body>
</html>
<?php
}
else
{
	header("location:../index.php");	
}
?>