<?php

print '<div class="browse_artists_nav">';
print '<h2>Browse Artists by Last Name</h2>';

$query = "SELECT DISTINCT artist_name_last
          FROM artists
          ORDER BY artist_name_last
         ";
$result  = mysqli_query($link,$query);
$iletter = 0;
while ($row = mysqli_fetch_array($result)) {
   $artist_name_last  = $row['artist_name_last'];
   $letters[$iletter] = $artist_name_last[0];
   $iletter+=1;
}
$letters = array_unique($letters);

echo '<br>';

$letter='A';
if (in_array($letter, $letters)) {
print "<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">&nbsp;&nbsp;&nbsp;$letter</a> ";
} else { print "&nbsp;&nbsp;&nbsp;$letter "; }

$letter='B';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='C';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='D';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='E';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='F';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='G';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='H';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='I';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='J';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='K';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='L';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='M';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='N';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='O';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='P';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='Q';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='R';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='S';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='T';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='U';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='V';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='W';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='X';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='Y';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

$letter='Z';
if (in_array($letter, $letters)) {
print "&nbsp;<a href=\"artists_browse.php?browseby=Name&browsebyvar=$letter\">$letter</a>  ";
} else { print "&nbsp;$letter "; }

//$letter='[MISC]';
//print "&nbsp;<a href=\"artists_misc.php\">&nbsp;&nbsp;&nbsp;&nbsp;$letter</a>  ";

$letter='[ALL]';
print "&nbsp;<a href=\"artists_browse.php?browseby=Name\">&nbsp;&nbsp;&nbsp;&nbsp;$letter</a>  ";

$letter='[SOLD]';
print "&nbsp;<a href=\"artists_sold.php\">&nbsp;&nbsp;&nbsp;&nbsp;$letter</a>  ";

?>
</div>