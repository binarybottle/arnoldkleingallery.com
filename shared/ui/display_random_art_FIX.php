<div id="art_table">
<?php

$gallery = $_GET['gallery'];
$gid     = $_GET['gid'];

if ($section=='Shows'){
   $art_directory=shows;
}
elseif($section=='Books'){
   $art_directory=books;
}
else{
   $art_directory=art;
}

$loop=1;
while ($loop==1) {
  
      $query0    = "SELECT * FROM artists";
      $result0   = mysqli_query($link,$query0);
      $nrows0    = mysqli_num_rows($result0); 
      $artist_id = (rand() % $nrows0);

      $result = mysqli_query($link,"SELECT * FROM art, artists WHERE art.fk_artist_id=artists.pk_artist_id AND artists.pk_artist_id=$artist_id AND art.art_hide=0 AND art.art_status!=\"Sold\" AND art.art_status!=\"SOLD\"");

      if ($result) {

         $nrows     = mysqli_num_rows($result); 
         if ($nrows>0) {

            $row = mysqli_fetch_array($result);

            print "<a href=\"artwork.php?art_id=$row[pk_art_id]&gallery=$gallery&gid=$gid\"><img src=\"http://arnoldkleingallery.com/images/$art_directory/$row[art_image_name]\" class=\"art_display_image_thumb\" width=\"225\"/></a><p class=\"art_display_info\"><a href=\"artwork.php?art_id=$row[pk_art_id]&gallery=$gallery&gid=$gid\"><em>$row[art_title]</a><br />
            by $row[artist_name_first] $row[artist_name_last]";
           
            break;

         }
      }
}

?>

</div>