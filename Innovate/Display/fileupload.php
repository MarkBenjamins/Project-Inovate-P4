<?php
if(isset($_FILES['file']['name']))
{
   // file name
   $filename = $_FILES['file']['name'];

   // Location
   $location = '../img/message/'.$filename;

   // file extension
   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);

   // Valid image extensions
   $valid_ext = array("jpg","png","jpeg","gif");

   $response = 0;
   if(in_array($file_extension,$valid_ext))
   {
      // Upload file
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location))
      {
         $response = 1;
      } 
   }
   echo $response;

   recuire ""
}

?>