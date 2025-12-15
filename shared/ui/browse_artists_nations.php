<?php

echo '<div class="browse_artists_nav">';
echo '<h2>Browse Artists by Nation</h2>';

$query = "SELECT DISTINCT pk_nation_id, nation_name
          FROM nations
          INNER JOIN artists
          ON artists.fk_nation_id = nations.pk_nation_id
          INNER JOIN art
          ON art.fk_artist_id = artists.pk_artist_id
          WHERE art.art_hide=0
          AND art.art_registered=1
          AND art.art_status='Available'
          ORDER BY nation_name
         ";

$result = mysqli_query($link,$query);

// set the number of columns and rows
$num_elements = mysqli_num_rows($result);
$num_columns  = 5;
$num_rows     = ceil($num_elements/$num_columns);

echo "<table class=\"nav_table\"><tr>";

for($i = 0; $i < $num_elements; $i++) {

    $row = mysqli_fetch_array($result);

    if($i % $num_rows == 0) {
        //if there is no remainder, we want to start a new row
        echo "<td width=\"17%\" class=\"column_data\">";  //<valign=\"top\">";
        echo "<dl plain compact>";
    }

    echo "<dt>";
    echo "<a href=\"artists_browse.php?browseby=Nation&browsebyvar=$row[pk_nation_id]\">&nbsp;";
    echo "$row[nation_name]</a>";
    echo "</dt>";

    if(($i % $num_rows) == ($num_rows - 1) || ($i + 1) == $num_elements) {
        ///if there is a remainder of 1, end the row
        ///or if there is nothing left in our result set, end the row
       echo "</dl>";
       echo "</td>";
    }
}

echo "</tr></table></div>";

?>


