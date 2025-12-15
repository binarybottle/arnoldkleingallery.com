<?php
include_once "../db/arnoldkleingallery_db.php"; 

/// If there are no POST vars, the try GET so you can link to searches
if (!$_POST['words']){
  $searchwords = (isset($_GET['words']) ? htmlspecialchars(stripslashes($_GET['words'])) : '');
}
else {
  $searchwords = (isset($_POST['words']) ? htmlspecialchars(stripslashes($_POST['words'])) : '');
}

$art_directory="art";
$limit=10000;

include_once("shared/ui/header.php"); 
$title="arnoldkleingallery.com - Search Results: $searchwords";

/// Strip ALL Special CHaracters and HTML
$searchwords=strip_tags($searchwords);
$searchwords=stripslashes($searchwords);
$searchwords=mysqli_real_escape_string($link, $searchwords);

print "<div id=\"trail\">";
print "<a href=\"index.php\" class=\"trail\">";
print "Home";
print "</a>";
print " &gt; ";
print "Search Results";

////////////////////////////////////////////////////////////////////////////////////
// Fine Art Search Results
////////////////////////////////////////////////////////////////////////////////////

echo '<h1>Search Results - Art</h1>';
echo '<div id="results_section_art" class="results_section">';

$SQL = "SELECT *,
        MATCH(art_title, art_medium, art_notes) 
        AGAINST('$searchwords') AS score
        FROM art
        WHERE MATCH(art_title, art_medium, art_notes) 
        AGAINST('$searchwords') 
        AND art_hide=0
        ORDER BY score DESC LIMIT 0, $limit";
$result = mysqli_query($link,$SQL);

if ($result) {
   $num_rows = mysqli_num_rows($result);

   if ($result) {
	  if ($num_rows>0) {
         echo "<h2>Results by Artwork ($num_rows)</h2>";
         echo "<ol>";

         while ($myrow = mysqli_fetch_array($result)) {

            if(strcmp($myrow['art_status'],"Sold") == 0) {
                   $Sold_string = "  (SOLD)"; }
            elseif(strcmp($myrow['art_status'],"SOLD") == 0) {
                   $Sold_string = "  (SOLD)"; }
            else { $Sold_string = "";
            }

            if(strcmp($myrow['art_date'],"")>0) {
              print "<li><a href=\"artwork.php?art_id=$myrow[pk_art_id]&browseby=Name\">";
			  print "<em>$myrow[art_title]</em>$Sold_string</a><br />";
              print "$myrow[art_medium] ($myrow[art_date])</li>";
            }
            else {
              print "<li><a href=\"artwork.php?art_id=$myrow[pk_art_id]&browseby=Name\">";
              print "<em>$myrow[art_title]</em>$Sold_string</a><br />";
              print "$myrow[art_title]</li>";
            }
         }
         echo "</ol>";
      }
   }
   if ($num_rows==0){
      echo "<p>No results in Art while searching for \"$searchwords\"</p>";
   }
}
echo '</div>';

////////////////////////////////////////////////////////////////////////////////////
// Artists Search Results
////////////////////////////////////////////////////////////////////////////////////

echo '<h1>Search Results - Artists</h1>';
echo '<div id="results_section_art" class="results_section">';

$SQL = "SELECT *, 
        MATCH(artist_name_first, artist_name_last)
        AGAINST('$searchwords') AS score
        FROM artists
        WHERE MATCH(artist_name_first, artist_name_last) 
        AGAINST('$searchwords')
        ORDER BY score DESC LIMIT 0, $limit";
$result3 = mysqli_query($link,$SQL);

if ($result3) {
   $num_rows = mysqli_num_rows($result3);

   if ($num_rows>0) {
         echo "<h2>Results by Artist ($num_rows)</h2>";
         echo "<ol>";

         while ($myrow = mysqli_fetch_row($result3)) {
            print "<li><a href=\"artist.php?artist_id=$myrow[0]";
            print "&browseby=Nation&browsebyvar=$myrow[6]\">";
            print "$myrow[2] $myrow[3] ($myrow[5])</a></li>";
         } 
         echo "</ol>";
   }
   if ($num_rows==0){
      echo "<p>No results in Artist while searching for \"$searchwords\"</p>";
   }
}
echo '</div>';

////////////////////////////////////////////////////////////////////////////////////
// Books Search Results
////////////////////////////////////////////////////////////////////////////////////
if(strlen($gid)==0) {

echo '<div id="results_section_art" class="results_section">';
echo '<h1>Search Results - Books</h1>';

$SQL = "SELECT *,
        MATCH(book_category, book_listing, book_author, book_title, book_notes) 
        AGAINST('$searchwords') AS score
        FROM books
        WHERE MATCH(book_category, book_listing, book_author, book_title, book_notes) 
        AGAINST('$searchwords') AND book_hide=0
        ORDER BY score DESC LIMIT 0, $limit";
$result5 = mysqli_query($link,$SQL);
if ($result5) {
   $num_rows = mysqli_num_rows($result5);
   if ($num_rows>0) {
     echo "<h2>Results by Book</h2>";
     echo "<ol>";

     while ($myrow = mysqli_fetch_array($result5)) {
        if (strlen($myrow['book_author'])>0) {
		  $author_string = "<i> by $myrow[book_author]</i>";
		} else {
		  $author_string = "";
		}
        print "<li><a href=\"book.php?book_id=$myrow[book_id]&browseby=$myrow[book_category]\">";
        print "$myrow[book_listing]</a>";
        print "$author_string</li>";
     } 
     echo "</ol>";
   } else {
     echo "<p>No results in Book while searching for \"$searchwords\"</p>";
   }
}
echo '</div>';
}

include_once "shared/ui/footer.php"; 

?>
