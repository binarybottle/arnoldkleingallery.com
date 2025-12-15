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
 ?>
<div id="trail"><a href="index.php" class="trail">Home</a> &gt; <a href="artists.php" class="trail">Artists</a> &gt; Sold </div>


<h1>Artists: Sold Works</h1>

<!div id="works">
<div class="browse_artists_nav">

<h2>Artists by Last Name<?php print $browsebyvar; ?></h2>
<?php

/// If there are no current limit vars just start over
if (!$current_limit_start) {
$current_limit_start=0;
}
else{
/// do nothing
}

$current_limit_end=60; /// always 60 unless there are less to display

/// If there are less then 60 images then reset the limit to max images

$query = "SELECT art.art_hide, art.art_status
          FROM art WHERE art.art_hide=0 
          AND (art.art_status='Sold')";

$result = mysqli_query($link,$query);

$num_rows = mysqli_num_rows($result);

if($num_rows<$current_limit_start+60){
$current_limit_end=$num_rows-$current_limit_start;

}
else{
/// do nothing
}

?>

<div class=\"next_prev\">

<?php

$current_limit_last=$current_limit_start+$current_limit_end;

?>

</div>

<?php
$query = "SELECT art.pk_art_id, artists.artist_name_first, artists.artist_name_last, artists.pk_artist_id, art.fk_artist_id, art.art_registered, art.art_hide, art.art_status
          FROM art, artists
          WHERE (art.fk_artist_id = artists.pk_artist_id)
          AND (art.art_hide='0')
          AND (art.art_status='Sold')
          ORDER BY artists.artist_name_last ASC";
#          AND (art.art_registered='1')

$result = mysqli_query($link,$query);

///set the number of columns and rows
$num_elements = mysqli_num_rows($result);
$num_columns  = 4;
$num_rows     = ceil($num_elements/$num_columns);
?>

<?php

echo "<table class=\"art_table\"><tr>\n";

for($i = 0; $i<$num_elements; $i++) {

    $row = mysqli_fetch_array($result);

    if($i % $num_rows == 0) {

        ///if there is no remainder, we want to start a new row
        echo "<td width=\"160\" class=\"column_data\">";
        echo "<dl plain compact>\n";

    }

    $compare_name = (strcmp($row[2],"")*strcmp($row[1],""));
    if( $compare_name==0 ) {
       echo "<dt>" . "<a href=\"artwork.php?art_id=$row[0]&browseby=Sold\">";
       echo "&nbsp;$row[2]$row[1]</a>" . "</dt>\n";
    } 
    else {
       echo "<dt>" . "<a href=\"artwork.php?art_id=$row[0]&browseby=Sold\">";
       echo "&nbsp;$row[2], $row[1]</a>" . "</dt>\n";
	}
    

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
<!br />
<!br />
<!br />
<!br />
<!br />
<!br />
<!br />
<!br />
<!br />
<!br />

<?php include_once "shared/ui/footer.php"; ?>