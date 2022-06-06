<?php
$name = ''; $type = ''; $size = ''; $error = ''; 
   function compress_image($source_url, $destination_url, $quality) {

      $info = getimagesize($source_url);

          if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source_url);

          elseif ($info['mime'] == 'image/gif')
          $image = imagecreatefromgif($source_url);

          elseif ($info['mime'] == 'image/png')
          $image = imagecreatefrompng($source_url);

          imagejpeg($image, $destination_url, $quality);
          return $destination_url;
        }

         if($_POST){

foreach($_FILES['file']['tmp_name'] as $key => $tmp_name ){
	
		$file_name = $key.$_FILES['file']['name'][$key];
		$file_size =$_FILES['file']['size'][$key];
		$file_tmp =$_FILES['file']['tmp_name'][$key];
		$file_type=$_FILES['file']['type'][$key];	
		$img_ext= pathinfo($file_name,PATHINFO_EXTENSION);
		 

            $url = 'demo_css/'.$_FILES['file']['name'][$key] ;
            $filename = compress_image($file_tmp, $url, 20);
			
}
		 }
     
?>
<html>
    <head>
        <title>Php code compress the image</title>
    </head>
    <body>

        <div class="error">
            <?php
                if($_POST){
                  if ($error) {
            ?>
            <label class="error"><?php echo $error; ?></label>
            <?php
            }
         }
       ?>
       </div>
           <fieldset class="well">
               <legend>Upload Image:</legend>
                   <form action="" name="img_compress" id="img_compress" method="post" enctype="multipart/form-data">
                       <ul>
                           <li>
                               <label>Upload:</label>
                                   <input type="file" name="file[]" multiple id="file"/>
                               </li>
                           <li>
                               <input type="submit" name="submit" id="submit" class="submit btn-success"/>
                           </li>
                       </ul>
                  </form>
           </fieldset>
     </body>
</html>