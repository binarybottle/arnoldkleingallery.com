<?php $current_limit_start=$_GET['current_limit_start'];
$letter=$_GET['name'];
$nation=$_GET['nation'];
	include_once "../db/arnoldkleingallery_db.php"; 
$title="arnoldkleingallery.com - Books";
include_once("shared/ui/header.php");
$section='Books';
?>

<div id="trail"><a href="index.php" class="trail">Home</a> &gt; Books</div>

<h1>Books:

<?php
function book_section_link($section){
print "<a href=\"books_section.php?browseby=$section\" >$section</a>";
}
?>
<?php print book_section_link("Art"); ?></h1>

<div class="main">

																  <h2>(coming soon: <?php print book_section_link("Literature"); ?>, <?php print book_section_link("Popular Culture"); ?>, <?php print book_section_link("Other"); ?>)</p>
</h2>

<br>

<p> Also available, collections to be sold in their entirety: <br>
1. Edna St. Vincent Millay <br>
&nbsp;&nbsp;(exceptional in-depth collection of first <br>
&nbsp;&nbsp;&nbsp;and subsequent editions) <br>
2. James Dean <br>
3. Bob Dylan <br>
4. Andy Warhol <br>
5. Elinor Wylie <br>
<br>
Please <a href="contact.php">contact us</a> for details. </p>
<br>

</div>

<?php include_once "shared/ui/footer.php"; ?>
