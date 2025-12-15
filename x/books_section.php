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
<?php 	include_once "../db/arnoldkleingallery_db.php";  ?>


<?php $title="arnoldkleingallery.com - Browse $browseby"; ?>
<?php include_once("shared/ui/header.php"); ?>
<?php if(!$section){
$section='Books';
}
else{
$section='Books';
/// do nothing
}
 ?>
<div id="trail"><a href="index.php" class="trail">Home</a> &gt; <a href="books.php" class="trail">Books</a> &gt; <?php print "$browseby"; ?></div>

<div id="art_table">

<div class="browse_artists_nav"> 

<h1>Books: <?php print "$browseby"; ?> Section</h1> 
<h2>(by author or primary subject)</h2>
<h2>Please note: prices subject to change without notice.</h2>

<p>
In addition to the books below, please <a href="contact.php">contact us</a> regarding collections to be sold in their entirety:<br>
1. Edna St. Vincent Millay (exceptional in-depth collection of first and subsequent editions) <br>
2. James Dean <br>
3. Bob Dylan <br>
4. Andy Warhol <br>
5. Elinor Wylie <br>
</p>

<?php

$SQL="SELECT distinct book_listing FROM books WHERE ";
$SQL.="book_category=\"$browseby\" ";
$SQL.="AND book_hide='0' ";
$SQL.="AND book_registered='1' ";
$SQL.="ORDER BY book_listing";
$result = mysqli_query($link,$SQL);

///we add this line because we need to know the number of rows
$num_elements = mysqli_num_rows($result);

///set the number of columns
$num_columns = 1;
$column_width = 480;

///set the number of rows
$num_rows = ceil($num_elements/$num_columns);

echo "<table class=\"nav_table\" cellpadding=\"5\">\n";

for($i = 0; $i < $num_elements; $i++) {

    $row = mysqli_fetch_array($result);
//    print_r($row);
    if($i % $num_rows == 0) {

        ///if there is no remainder, we want to start a new row
        echo "<td width=\"".$column_width."\" class=\"column_data\">";
        echo "<dl plain compact>\n";

    }

    // Find out if there is more than one book for this listing. If so, link to page with all the books
    // with this listing. Otherwise, just link to the book's page.
    $SQL="SELECT * FROM books WHERE ";
    $SQL.="book_listing=\"$row[0]\" ";
    $SQL.="AND book_category=\"$browseby\" ";
    $SQL.="AND book_hide='0' ";
    $result2 = mysqli_query($link,$SQL);
    $num_elements2 = mysqli_num_rows($result2);
    $row0 = htmlentities($row[0]);
    echo "<dt>" . "<a href=\"books_listing.php?browseby=$browseby&book_listing=$row0\">$row0</a>\n" . "</dt>\n";

    if(($i % $num_rows) == ($num_rows - 1) || ($i + 1) == $num_elements) {
        ///if there is a remainder of 1, end the row
        ///or if there is nothing left in our result set, end the row

        echo "</dl>\n";
        echo "</td>";
    }
}

echo "</tr></table>\n";

?> 

</div>
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