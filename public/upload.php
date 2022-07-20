<?php 

if(isset($_FILES['upload'])){
        $filen = $_FILES['upload']['tmp_name']; 
        $con_images = "uploaded/".$_FILES['upload']['name'];
        move_uploaded_file($filen, $con_images );
       $url = 'http://127.0.0.1:8000/'.$con_images;

   $funcNum = $_GET['CKEditorFuncNum'] ;
  
    
   // Usually you will only assign something here if the file could not be uploaded.
   $message = '';
   echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$funcNum."', '".$url."', '".$message."');</script>";
}
?>