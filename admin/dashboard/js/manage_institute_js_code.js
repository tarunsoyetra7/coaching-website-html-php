
$(".deleteTIM").on("click",function(e){
	var value=$(this).attr('id');
	
	
var r = confirm("Are you sure you really wana to delete !!...");
if (r == true) {
	
	
		
    $.ajax({
		type:"POST",
		data:{del_id:value},
		url:"delete_training_institute_master.php",
		success: function(r_data){
			alert(r_data);
			location.reload();
		}
		,error:function(err){
			location.reload();
		}
	});	
} else {   
}


});





function clickToFetch(id){
	
	$("#center_detail_Res").html("");
	
	//alert(id);
	var id=id;
	$.ajax({
		type:"POST",
		url:"view_center_detail.php",
		data:{id:id},		
		success: function(r_data){			
			$("#center_detail_Res").html(r_data);
			$("#myModal").modal("show");
			
		},error:function(err){
			location.reload();
		}
	});
	
	
}



<!---course modal---->


$(".courseDetail").on("click",function(e){
	var abc_str=$(this).attr('id');
	var abc_str_1=abc_str.split("|");
	var center_ID=abc_str_1[0];
	var center_course_id=abc_str_1[1];
	//alert(center_ID +"--------------"+center_course_id);
	
	$.ajax({
		type:"POST",
		data:{center_ID:center_ID,center_course_id:center_course_id},
		url:"fetch_course_vari_attend_sheet.php",
		
		success: function(r_data){
			//alert(r_data);
			$("#courseModal").modal('show');
			$("#courseVariAttenRes").html(r_data);
		},error:function(err){
			location.reload();
		}
	});
});
