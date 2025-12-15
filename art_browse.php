<?php $current_limit_start=$_GET['current_limit_start']; ?>
<?php $browseby=$_GET['browseby']; ?>
<?php $browsebyvar=$_GET['browsebyvar']; ?>
<?php
if (!$_GET['browseby']){
/// do nothing

}
else{
$browsebyline="by $browseby";
}
?>
<?php include_once "../db/arnoldkleingallery_db.php"; ?>


<?php $title="arnoldkleingallery.com - Browse $browseby"; ?>
<?php include_once("shared/ui/header.php"); ?>
<?php if(!$section){
$section='Art';
}
else{
$section='Art';
/// do nothing
}

if ($browseby=="Nation") {
   $query  = 'SELECT nation_name FROM nations WHERE pk_nation_id = '.$browsebyvar;
   $result = mysqli_query($link,$query);
   $nation = mysqli_fetch_row($result);
   $browseby_fillin = ' &gt; '.$nation[0];
} else {
   if ($browsebyvar!='') {
      $browseby_fillin = ' &gt; '.$browsebyvar;
   } else {
      $browseby_fillin = '';
   }
}

?>
<div id="trail"><a href="index.php" class="trail">Home</a> &gt; <a href="sections.php?section=<?php print "$section"; ?>" class="trail"><?php print "$section"; ?></a><?php print "$browseby_fillin"; ?></div>

<h1>Browse <?php print $browsebyline; ?></h1>

<div id="art_table">
<?php
if(!$_GET['browseby'] AND !$_GET['browsebyvar']){
include_once "shared/ui/dir_browse_letter.php";
include_once "shared/ui/dir_browse_nation.php";
}
elseif($_GET['browseby']=Nation AND $_GET['browsebyvar'] > 0){
include_once "shared/ui/art_display_browse_nation.php";
}
else{
include_once "shared/ui/art_display_browse_letter.php";
}
?>
</div>

</div>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

<?php include_once "shared/ui/footer.php"; ?>