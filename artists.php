<?php
$current_limit_start=$_GET['current_limit_start'];
$letter=$_GET['name'];
$nation=$_GET['nation'];        
include_once "../db/arnoldkleingallery_db.php";
include_once("shared/ui/header.php"); 
$title="arnoldkleingallery.com - $artist_name_first $artist_name_last";
?>

<div id="trail"><a href="index.php" class="trail">Home</a> &gt; Artists</div>

<h1>Artists</h1>

<?php
include_once "shared/ui/browse_artists_letters.php";
include_once "shared/ui/browse_artists_nations.php";
//include_once "shared/ui/display_random_art_thumb.php";
include_once "shared/ui/footer.php"; 
?>