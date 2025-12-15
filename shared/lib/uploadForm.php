<?php

// This is adapted from code downloaded from www.plus2net.com //

$max_size = 5000000; // Maximum image size

while(list($key,$value) = each($_FILES[files][name]))
{
   if(!empty($value))
   {

      $file_type = $_FILES["files"]["type"];
      $file_size = $_FILES["files"]["size"];
      if ($file_type[0] == "image/jpeg") {
         if ($file_size[0] < $max_size) {

            $filename = $value;
            $add = "uploads/$filename";
            copy($_FILES[files][tmp_name][$key], $add);

         // Insert filenames in art table
            $sql = 'INSERT INTO art (art_image_name,art_registered,fk_user_id)
                    VALUES ("'.$filename.'","0","'.$userID.'")';
            mysqli_query($link,$sql) or die (mysql_error());

         }
         else {
            echo '<font color="red"><p>'.$file_size[0] . ' is too large a file.<br /> 
            Please hit the back button on your browser and upload appropriately sized images.</p></font>';
         }
      }
      else {
         echo '<font color="red"><p>'.$file_type[0] . ' is not a valid file type.<br />
         Please hit the back button on your browser and upload appropriately formatted images.</p></font>';
      }
   }
}

?>
