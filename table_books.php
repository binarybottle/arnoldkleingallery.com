<?php 
include_once("./shared/lib/password_protect.php");
include_once "../db/arnoldkleingallery_db.php"; 
include_once("./shared/ui/header.php");
?>

<title>All books</title>

<br />
<h1>All Books</h1>

<div class="body">

Return to <a href="admin_books.php">administering books</a>.<br />
Return to the <a href="admin.php">main admin page</a>.

<br />
<br />

<?php

$sql = "SELECT * FROM books ORDER BY book_id";
$result = mysqli_query($link,$SQL) or die (mysql_error());
if ($result) {

?>

<table>
<tr>
ID, category, listing, author, title, publisher, place, year, edition, size, condition, price, for-sale
</tr>

<?php

  while($row = mysqli_fetch_array($result))
  {
    $ID = $row['book_id'];
    $category = $row['book_category'];
    $listing = $row['book_listing'];
    $author = $row['book_author'];
    $title = $row['book_title'];
    $publisher = $row['book_publisher'];
    $place = $row['book_place'];
    $year = $row['book_year'];
    $edition = $row['book_edition'];
    $size = $row['book_size'];
    $condition = $row['book_condition'];
    $price = $row['book_price'];
    $hide = $row['book_hide'];

    if     ($hide==0) { $hide = 'For sale'; }
    elseif ($hide==1) { $hide = 'Not for sale'; }
    elseif ($hide==2) { $hide = 'Sold'; }

    echo "<tr>";

	//    echo '<td>'.$ID.'</td><td>	'.$category.'</td><td>	'.$listing.'</td><td>	'.$author.'</td><td>	'.$title.'</td><td>	'.$publisher.'</td><td>	'.$place.'</td><td>	'.$year.'</td><td>	'.$edition.'</td><td>	'.$size.'</td><td>	"'.$condition.'</td><td>"	'.$price.'</td><td>	'.$hide.'</td>';
    echo '<td>'.$ID.'</td><td>	'.$author.'</td><td>	'.$title.'</td>';

    echo "</tr>";
  }
  echo "</table>";

 }

?>

</div>

<?php include_once("./shared/ui/footer.php"); ?>