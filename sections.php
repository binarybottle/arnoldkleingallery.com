<?php $current_limit_start=$_GET['current_limit_start']; ?>
<?php $letter=$_GET['name']; ?>
<?php $nation=$_GET['nation']; ?>

<?php include_once "../db/arnoldkleingallery_db.php"; ?>


<?php $title="arnoldkleingallery.com - $artist_name_first $artist_name_last"; ?>
<?php include_once("shared/ui/header.php"); ?>
<?php 
if(!$section){
$section='Art';
}
else{
$section='Art';
/// do nothing
}
?>

<div id="trail"><a href="index.php" class="trail">Home</a> &gt; <?php print "$section"; ?></div>

<h1>Fine Art</h1>
<!h1><!? print "$section"; ?><!/h1>

<?php
include_once "shared/ui/dir_browse_letter.php";
?>

<?php
include_once "shared/ui/dir_browse_nation.php";
?>

<?php include_once "shared/ui/art_random_thumb.php";?>

<?php include_once "shared/ui/footer.php"; ?>