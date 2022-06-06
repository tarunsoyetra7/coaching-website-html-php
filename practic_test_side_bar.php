


	<div class="col-left">
    <?php $testQ=$db->query("SELECT id, 
       q_cat_title        
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND q_cat_parent = 0 
ORDER  BY q_cat_priority ASC ") or die(""); 
$i=0;
while($testQ_res=$testQ->fetch(PDO::FETCH_ASSOC)){ $i++; $cat_id=$testQ_res['id'];  ?>
<div > 	
		<h3 id="blog_title" class="blog_h3"></i>
		 <span class="practice_span"><?php echo $testQ_res['q_cat_title']; ?>  </span></h3>
</div>		 
		   <div>
		   
			<ul  class="blog_cat">
<?php $childQ=$db->query("SELECT id, 
       q_cat_title        
FROM   online_test_category 
WHERE  flag = 'true' 
       AND e_d_optn = 'true' 
       AND q_cat_parent = $cat_id 
ORDER  BY q_cat_priority ASC") or die("");
		$j=0;
			while($childQ_res=$childQ->fetch(PDO::FETCH_ASSOC)){ $j++; ?>			
             <li><a href="practic_test_sub_page.php?id=<?php echo $childQ_res['id']; ?>">
			 <i class="fa fa-chevron-right blog_side_li" ></i> 
				<?php echo $childQ_res['q_cat_title']; ?></a></li>
					<?php } ?>
                <!---<li><a href="#">Fab 2018</a></li>
               --->
            </ul>
		   </div>
		     <br>
<?php } ?>
		 
		   
		  <!-- <h3 style="padding-top:8px; padding-left:4px; color:#555; border-bottom:1px solid #555; padding-bottom:6px;">
		 Verbal and Reasoning  </h3>           
		   <div>
			<ul class="submenu-col">		
             <li><a href="#">Verbal Ability</a></li>
                <li><a href="#">Logical Reasoning</a></li>
                <li><a href="#">Verbal Reasoning</a></li>
                <li><a href="#">Non Verbal Reasoning</a></li>
                
            </ul>
		   </div>
		   <br>--->
            
            
    </div>
	

    