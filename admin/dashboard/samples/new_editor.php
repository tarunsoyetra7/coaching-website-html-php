
        <script src="../ckeditor.js"></script>
        <script src="js/sample.js"></script>
        <link rel="stylesheet" href="css/samples.css">
        <link rel="stylesheet" href="toolbarconfigurator/lib/codemirror/neo.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   
    <style>
		.cke_1_contents{
			height:300px;
		}
	</style>
  
        <main>
            <div id="editor"></div>
        </main>
        <input type="button" class="btnSave" value="OK">
        <script>
            initSample();
        </script>
        <script>
		$(".btnSave").on("click",function(e){
		
			alert($('#cke_1_contents > .cke_wysiwyg_frame').contents().find('.cke_editable').html());
		});
		
		</script>
        
