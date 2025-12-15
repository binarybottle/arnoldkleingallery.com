<?php

echo '<div class="browse_artists_nav">';
echo "<h2>$browsebyvar</h2>";
echo '<div class="next_prev"></div>';

if (strlen($ID)>0) {
   $gallery_filter=" AND art.fk_member_id=".$ID;
} else { 
   $gallery_filter='';
}
if (strlen($browsebyvar)>0) {
   $like = " AND artists.artist_name_last LIKE '$browsebyvar%' ";
} else { 
   $like = '';
}
$query ="SELECT DISTINCT artists.pk_artist_id, artists.artist_name_first, ";
$query.=" artists.artist_name_last, art.fk_artist_id ";
$query.=" FROM artists, art ";
$query.=" WHERE artists.pk_artist_id=art.fk_artist_id ";
$query.=  $gallery_filter;
$query.=  $like;
$query.=" AND art.art_hide=0 ";
$query.=" AND art.art_status!=\"Sold\" ";
$query.=" AND art.art_status!=\"SOLD\" ";
$query.=" ORDER BY artists.artist_name_last ASC";

$result = mysqli_query($link,$query);
if ($result) {
///set the number of columns and rows
$num_elements = mysqli_num_rows($result);
$num_columns  = 4;
$num_rows     = ceil($num_elements/$num_columns);

echo "<table class=\"art_table\"><tr>\n";

for($i = 0; $i < $num_elements; $i++) {
    $row = mysqli_fetch_array($result);

    if($i % $num_rows == 0) {
        ///if there is no remainder, we want to start a new row
        echo "<td width=\"180\" class=\"column_data\">";
        echo "<dl plain compact>\n";
    }

    $compare_name = (strcmp($row[1],"")*strcmp($row[2],""));
    if( $compare_name==0 ) {
	          $sep = "";
    } else {  $sep = ", ";
    }
    if (strlen($browsebyvar)>0) {
	          $bbv = "&browsebyvar=$browsebyvar";
    } else {  $bbv = "";
    }
    if (strlen($gallery)>0) {
              $gn = "&gallery=$gallery&ID=$ID";
    } else {  $gn = "";
    }
    
    echo '<dt>';
    echo "<a href=\"artist.php?artist_id=$row[0]&browseby=Name$bbv$gn\">$row[2]$sep$row[1]</a>";
    echo "</dt>\n";

    if(($i % $num_rows) == ($num_rows - 1) || ($i + 1) == $num_elements) {
        ///if there is a remainder of 1, end the row
        ///or if there is nothing left in our result set, end the row
        echo "</dl>\n";
        echo "</td>";
    }
}

echo "</tr></table>\n";

} // if ($result)

?> 

</div>
