<?php 
include_once "../db/arnoldkleingallery_db.php";

$browseby = isset($_GET['browseby']) ? sanitize_string($link, $_GET['browseby']) : '';
$browsebyvar = isset($_GET['browsebyvar']) ? sanitize_string($link, $_GET['browsebyvar']) : '';

if ($_GET['browseby']){
   $browsebyline="by $browseby";
}

$title="arnoldkleingallery.com - Artists $browseby";
include_once("shared/ui/header.php");

if ($browseby=="Nation") {
   $query  = 'SELECT nation_name FROM nations WHERE pk_nation_id = '.$browsebyvar;
   $result = mysqli_query($link,$query);
   $nation = mysqli_fetch_row($result);
   $browseby_fillin = ' &gt; '.$nation[0];
} else {
   if (strlen($browsebyvar)>0) {
      $browseby_fillin = ' &gt; '.$browsebyvar;
   } else {
      $browseby_fillin = '';
   }
}

echo '<div id="trail"><a href="index.php" class="trail">Home</a> &gt; <a href="artists.php" class="trail">Artists</a>'.$browseby_fillin.'</div>';

print "<h1>Artists $browsebyline</h1>";
print '<div id="art_table">';

if(!$_GET['browseby'] AND !$_GET['browsebyvar']){
   include_once "shared/ui/browse_artists_letters.php";
   include_once "shared/ui/browse_artists_nations.php";
}
elseif($_GET['browseby']=='Nation' AND $_GET['browsebyvar'] > 0){
   include_once "shared/ui/browse_artists_nation.php";
}
else{
   include_once "shared/ui/browse_artists_letter.php";
}

print '</div></div>';

include_once "shared/ui/footer.php";

?>