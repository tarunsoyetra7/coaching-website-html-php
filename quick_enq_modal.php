<script>
$(document).ready(function(){  
  /* $("#myEnqModal").modal({
        show: false,
        backdrop: 'static'
    });
	*/
		
	$("#myEnqModal").modal("show");
  
 });

 
 $("#quickEnqImg").on("click",function(e){
	$("#myEnqModal").modal("show");
});
</script>
<style>
#loader_quick_enq{
	 width:28px; height:28px; visibility:hidden;
}
.enq_success_cls{
	color: green;
    margin-top: 15px;
    font-size: 15px;
    font-weight: 600; display:none;
}
</style>
<!-- Modal -->
<div id="myEnqModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius:0px;">
      <div class="modal-header" style="background:#005399;">
        
        <h4 class="modal-title" style="text-align:center; color:#fff;">Quick Enquiry</h4>
      </div>
      <div class="modal-body">
        <label>Name *</label>
		<input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Enter Name *">
		<br>
		
		<label>Mobile Number *</label>
		<input type="number" class="form-control" id="txt_mo" name="txt_mo" placeholder="Enter Mobile Number *">
		<br>
		
		<button class="btn btn-sm btn-info btn_click" type="button" style="background:#005399; border:none;">Submit</button> &nbsp;&nbsp;
		<button type="button" class="btn btn-default  btn-sm" data-dismiss="modal">Close</button>
		<img src="images/loading2.gif" class="rp_loader" id="loader_quick_enq">
		<div style="clear:both;"></div>
		
		<h5 align="center" class="enq_success_cls">Successfully Submitted. Our executive will contact you within 24 hour !..</h5>
		
      </div>
      
    </div>

  </div>
</div>

<script>

$(".btn_click").on("click",function(e){

	if($("#txt_name").val()=="" || $("#txt_name").val()==null){
		$("#txt_name").addClass("error_class");
		$("#txt_name").focus();
	}
	else if($("#txt_mo").val()=="" || $("#txt_mo").val()==null){
		$("#txt_mo").addClass("error_class");
		$("#txt_mo").focus();
	}
	
	else{
		
		var first_name=$("#txt_name").val();
		
		var phone=$("#txt_mo").val();
		

		var filter =/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if ((filter.test(phone)) || (!isNaN(phone) && phone.length == 10)) {			
			$("#loader_quick_enq").css("visibility","visible");		

			$(".btn_click").attr("disabled",true);
			
			$.ajax({
				type:"POST",
				url:"quick_enq_modal_do.php",
				data:{first_name:first_name,phone:phone},
				success:function(r_data){
					if(r_data=="s"){
						//alert("success");
						$(".enq_success_cls").css("display","block");
						$("#loader_quick_enq").css("visibility","hidden");	
						$(".btn_click").attr("disabled",false);
						$("#myEnqModal").modal("hide");
					}
					else{
						alert("Try Again !...");
						location.reload();						
					}
					
				},error:function(err){
					location.reload();
				}
			});
		}
		else{
			$("#txt_mo").addClass("error_class");
			$("#txt_mo").focus();
		}
	}
	
	
});
</script>

<style>
.error_class{
	border-color:red;
}
</style>

