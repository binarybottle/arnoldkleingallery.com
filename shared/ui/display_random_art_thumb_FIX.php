<div class="browse_artists_nav">
<?php
$browseby='Name';

$art_directory='art';

function random_image($art_directory, $browseby)
{
   $query0 = "SELECT * FROM artists";
   $result0 = mysqli_query($link,$query0);
   $nrows0 = mysqli_num_rows($result0);
 
  $row[0]=='';
  while ($row[0]==''){ ///@rno's fix for the problem of skipped id#s in the artist database:

    $artist_id = (rand() % $nrows0);

    $result = mysqli_query($link,"SELECT * FROM art, artists WHERE art.fk_artist_id=artists.pk_artist_id AND artists.pk_artist_id=$artist_id AND art.art_status!=\"Sold\" AND art.art_status!=\"SOLD\" AND art.art_hide=0");

    $row = mysqli_fetch_array($result);
  }
print "<a href=\"artwork.php?art_id=$row[pk_art_id]\"><img src=\"thumbs/$art_directory/$row[art_image_name]\" class=\"art_display_image_thumb\" /></a><p class=\"art_display_info\"><a href=\"artwork.php?art_id=$row[pk_art_id]\"><em>$row[artist_name_first] $row[artist_name_last]</em></a></p>";
}
?>

<h2>Featured Works</h2>

</div>

<div id="art_table">

<table>
  <tr align="center">    <td width="150"><?php echo random_image($art_directory, $browseby); ?></td>
    <td width="150"><?php echo random_image($art_directory, $browseby); ?></td>
    <td width="150"><?php echo random_image($art_directory, $browseby); ?></td>
    <td width="150"><?php echo random_image($art_directory, $browseby); ?></td>
  </tr>
  <tr align="center">
    <td><?php echo random_image($art_directory, $browseby); ?></td>
    <td><?php echo random_image($art_directory, $browseby); ?></td>
    <td><?php echo random_image($art_directory, $browseby); ?></td>
    <td><?php echo random_image($art_directory, $browseby); ?></td>
  </tr>
  <tr align="center">
    <td><?php echo random_image($art_directory, $browseby); ?></td>
    <td><?php echo random_image($art_directory, $browseby); ?></td>
    <td><?php echo random_image($art_directory, $browseby); ?></td>
    <td><?php echo random_image($art_directory, $browseby); ?></td>
  </tr>
</table>
</div>