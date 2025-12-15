
<!div id="works">
<div class="browse_artists_nav">
<?php
$result = mysqli_query($link,"SELECT * FROM nations WHERE pk_nation_id='$browsebyvar'");
$row = mysqli_fetch_row($result);
$browsebyvar_id=$row[0];
$browsebyvar_name=$row[2];
?>

<h2><?php print "$browsebyvar_name"; ?></h2>
<?php

$query = "SELECT DISTINCT artists.pk_artist_id, artists.artist_name_first, artists.artist_name_last, art.fk_artist_id, artists.fk_nation_id FROM artists, art WHERE artists.pk_artist_id=art.fk_artist_id AND artists.fk_nation_id ='$browsebyvar' AND art.art_hide=0 AND art.art_status!=\"Sold\" ORDER BY artists.artist_name_last ASC";

$result = mysqli_query($link,$query);

///set the number of columns and rows
$num_elements = mysqli_num_rows($result);

if( $num_elements > 0 ) 
{

$num_columns  = 4;
$num_rows     = ceil($num_elements/$num_columns);

echo "<table class=\"art_table\"><tr>\n";

for($i = 0; $i < $num_elements; $i++) {

    $row = mysqli_fetch_array($result);

    if($i % $num_rows == 0) {

        ///if there is no remainder, we want to start a new row
        echo "<td width=\"160\" class=\"column_data\">";
        echo "<dl plain compact>\n";

    }

    $spacer_string = '';//&nbsp;&nbsp;';

        $compare_name = (strcmp($row[1],"")*strcmp($row[2],""));
        if( $compare_name==0 ) {
    echo "<dt>" . "<a href=\"artist.php?artist_id=$row[0]&browseby=Nation&browsebyvar=$browsebyvar\">$spacer_string$row[2]$row[1]</a>" . "</dt>\n";
        } 
        else {
    echo "<dt>" . "<a href=\"artist.php?artist_id=$row[0]&browseby=Nation&browsebyvar=$browsebyvar\">$spacer_string$row[2], $row[1]</a>" . "</dt>\n";
	}
    

    if(($i % $num_rows) == ($num_rows - 1) || ($i + 1) == $num_elements) {
        ///if there is a remainder of 1, end the row
        ///or if there is nothing left in our result set, end the row

        echo "</dl>\n";
        echo "</td>";
    }
}

echo "</tr></table>\n";

}

?>

</div>