<?php
// One line tailored to Karen Klein
        include_once "../db/arnoldkleingallery_db.php";

	$artist_id   = sanitize_int($_GET['artist_id']);
	$browseby    = isset($_GET['browseby']) ? sanitize_string($link, $_GET['browseby']) : ''; 
	$browsebyvar = isset($_GET['browsebyvar']) ? sanitize_string($link, $_GET['browsebyvar']) : ''; 
	$current_limit_start = sanitize_int($_GET['current_limit_start']);

	include_once("shared/ui/header.php"); 
             $title="arnoldkleingallery.com | Dedicated to promote and sell fine art, rare books, and handmade crafts. "; 

	$SQL="SELECT * FROM art, artists WHERE ";
	$SQL.=" art.fk_artist_id=artists.pk_artist_id ";
	$SQL.=" AND artists.pk_artist_id='$artist_id' ";
#        $SQL.=" AND art.art_registered=1 ";
        $SQL.=" AND art.art_hide=0 ";
        $SQL.=" AND art.art_status!=\"Sold\" AND art.art_status!=\"SOLD\"";
	$rst=mysqli_query($link,$SQL);
	$num_rows = mysqli_num_rows($rst);
	if($row=mysqli_fetch_array($rst))
	{
		$art_id=$row["pk_art_id"];
		$artist_id=$row["fk_artist_id"];
		$user_id=$row["fk_user_id"];
		$art_title=$row["art_title"];
		$art_medium=$row["art_medium"];
		$art_date=$row["art_date"];
		$art_size=$row["art_size"];
		$art_price=$row["art_price"];
		$art_notes=$row["art_notes"];
		$art_status=$row["art_status"];
		$image_name=$row["art_image_name"];
		$section="Artists"; //$row["art_section"];
		$artist_name_first=$row["artist_name_first"];
		$artist_name_last=$row["artist_name_last"];
		$artist_period=$row["artist_period"];
		$artist_nation=$row["artist_nation"];
        $cv=$row["cv"];
	}
/*   
    else {
	   $SQL="SELECT * FROM art, artists WHERE ";
   	   $SQL.="art.fk_artist_id=artists.pk_artist_id ";
	   $SQL.="AND artists.pk_artist_id=$artist_id AND artists.pk_artist_id=\"$artist_id\" ";
	   $rst=mysqli_query($link,$SQL);
	   if($row=mysqli_fetch_array($rst))
  	   {
		$artist_name_first=$row["artist_name_first"];
		$artist_name_last=$row["artist_name_last"];
  	   }
    }
*/
    if ($browseby=="Nation") {
       $query  = 'SELECT nation_name FROM nations WHERE pk_nation_id = '.$browsebyvar;
       $result = mysqli_query($link,$query);
       $nation = mysqli_fetch_row($result);
       $browseby_fillin = $nation[0];
    } else {
       if ($browsebyvar!='') {
          $browseby_fillin = $browsebyvar;
       } else {
          $browseby_fillin = '';
       }
    }

	if (strlen($browseby)>0)
	{
		$browsebyline="by ".$browseby."";
	}
	else
	{
		/// do nothing
	}
	if (!strcmp($section, "Shows"))
	{
		$art_directory="shows";
	}
	else if(!strcmp($section, "Hand Mades"))
	{
		$art_directory="handmades";
	}
	else
	{
		$art_directory="art";
	}
	print "<div id=\"trail\">";

    print "<a href=\"index.php\" class=\"trail\">";
    $title="arnoldkleingallery.com - ".$artist_name_first." ".$artist_name_last."";
    $artists_page = "<a href=\"artists.php\"";

	print "Home</a>";
    if ($num_rows>0) {
      print " &gt; ";
      print $artists_page;
      print " class=\"trail\">Artists</a>";
    }
	print " &gt; ";

    if (strlen($browseby)>0) {
	          $bb = "&browseby=$browseby";
    } else {  $bb = "";
    }
    if (strlen($browsebyvar)>0) {
	          $bbv = "&browsebyvar=$browsebyvar";
    } else {  $bbv = "";
    }

    print "<a href=\"artists_browse.php?$bb$bbv\" class=\"trail\">";
	print $browseby_fillin;
    print "</a>";
    if (strlen($browseby_fillin)>0) {
       print " &gt; ";
    }
	print "".$artist_name_first." ".$artist_name_last."";
	print "</div>";
	print "<div id=\"art_display_box_single\">";

	print "<h1>";

    if (strlen($cv)>1) {
		  if (!strcmp($artist_name_last, "Klein") && !strcmp($artist_name_first, "Karen")) {
	        print "".$artist_name_first." ".$artist_name_last."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href=\"./docs/$cv\">r&eacute;sum&eacute;</a>";
		  } 
          else {
	        print "".$artist_name_first." ".$artist_name_last." &nbsp;&nbsp;&nbsp;<a href=\"https://www.kaklein.com/resume.php\">r&eacute;sum&eacute;</a>";
	        //print "".$artist_name_first." ".$artist_name_last." (".$artist_period.") &nbsp;&nbsp;&nbsp;(<a href=\"https://www.kaklein.com/resume.php</a>)";
          }
	}
	else {
      if (!strcmp($artist_period, "")) {
	      print "".$artist_name_first." ".$artist_name_last."";       
      } 
      else {
	      print "".$artist_name_first." ".$artist_name_last." ($artist_period) ";
      }
    }

// Tailored to Karen Klein
    if (strcmp($artist_name_first, "Karen Anne")==0 && strcmp($artist_name_last, "Klein")==0) {
       print "&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href=\"https://www.kaklein.com/\" class=\"trail\">website</a>";
       print "&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href=\"https://www.kaklein.com/books.php\" class=\"trail\">artist books</a>";
       print "&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href=\"https://www.toadsonties.com\" class=\"trail\">toadsonties.com</a>";
    }

	print "</h1>";

	print "<div id=\"works\">";
	/// If there are no current limit vars just start over
	if (!$current_limit_start)
	{
		$current_limit_start=0;
	}
	else
	{
		/// do nothing
	}
	$current_limit_end=12; /// always 12 unless there are fewer to display
	if( $num_rows < $current_limit_start+12)
	{
		$current_limit_end=$num_rows-$current_limit_start;
	}
	else
	{
		/// do nothing
	}
	print "<div class=\"next_prev\">";
	$current_limit_last=$current_limit_start+$current_limit_end;
        $current_limit_start_print = $current_limit_start+1;
	/// Currently displayed message
	if ( $num_rows > 12 )
	{
		print "<p class=\"next_prev\">Currently displaying images $current_limit_start_print - $current_limit_last (total: $num_rows). Click on an image to enlarge.</p>";
	}
	else if( $num_rows == 1)
	{
		print "<p class=\"next_prev\">Currently displaying image 1 of 1. Click image to enlarge.</p>";
	}
	else if( $num_rows == 0)
	{
		print "<p class=\"next_prev\">Sorry, all of $artist_name_first $artist_name_last's works have been <a href=\"./artists_sold.php\">sold</a>.</p>";
	}
	else
	{
		print "<p class=\"next_prev\">Currently displaying images $current_limit_start_print - $current_limit_last (total: $num_rows).</p>";
	}
	if ($current_limit_start >'0' AND $num_rows>$current_limit_last)
	{ /// Make prev AND next buttons
		$current_limit_start_minus_12=$current_limit_start-12;
		print "<p class=\"next_prev\">";
        print "<a href=\"artist.php?artist_id=$artist_id";
        print "&browseby=Name$bbv";
        print "&current_limit_start=$current_limit_start_minus_12\">&lt; Previous</a>";
		print " | ";
		$current_limit_start_plus_12=$current_limit_start+12;

		print "<a href=\"artist.php?artist_id=$artist_id";
        print "&browseby=Name$bbv";
        print "&current_limit_start=$current_limit_start_plus_12\">Next &gt</a></p>";
	}
	else if	( $current_limit_last >= $num_rows AND $num_rows>12)
	{
		/// Make prev button
		$current_limit_start_minus_12=$current_limit_start-12;
		print "<p class=\"next_prev\">";
        print "<a href=\"artist.php?artist_id=$artist_id";
        print "&browseby=Name$bbv";
        print "&current_limit_start=$current_limit_start_minus_12\">&lt; Previous</a></p>";
	}
	else if ($current_limit_start<'1' AND $num_rows >'12')
	{
		/// Make next button
		$current_limit_start_plus_12=$current_limit_start+12;
		print "<p class=\"next_prev\">";
		print "<a href=\"artist.php?artist_id=$artist_id";
        print "&browseby=Name$bbv";
        print "&current_limit_start=$current_limit_start_plus_12\">Next &gt</a></p>";
	}	
	else
	{
		/// do nothing
	}
	print "</div>";
	///set the number of columns
	$columns = 4;
        $query = "SELECT * FROM art, artists WHERE art.fk_artist_id=artists.pk_artist_id AND artists.pk_artist_id=$artist_id ";
        $query.= "AND art.art_status!='Sold' AND art.art_status!=\"SOLD\"";
        $query.=" AND art.art_hide=0 ";
#        $query.=" AND art.art_registered=1 ";
        $query.= "ORDER BY art.pk_art_id ";
        $query.= "LIMIT $current_limit_start, $current_limit_end ";
	$result2 = mysqli_query($link,$query);
	///we add this line because we need to know the number of rows
	$num_rows = mysqli_num_rows($result2);
	print "<table class=\"art_table\">\n";
	///changed this to a for loop so we can use the number of rows
	for($i = 0; $i < $num_rows; $i++)
	{
    		$row = mysqli_fetch_array($result2);
			//print_r($row);die;
    		if($i % $columns == 0)
    		{
        		///if there is no remainder, we want to start a new row
        		print "<tr>\n";
    		}
    		print "<td height=\"150\" class=\"art_display_image_thumb\" valign=\"top\" >" . "<a href=\"artwork.php?art_id=$row[pk_art_id]$bb$bbv\">";
    		print "<img src=\"https://arnoldkleingallery.com/thumbs/$art_directory/$row[art_image_name]\" class=\"art_display_image_thumb\" /></a><p class=\"art_display_info\">";
    		print "<a href=\"artwork.php?art_id=$row[pk_art_id]$bb$bbv\"><em>$row[art_title]</em></a><br/>";
    		if(($i % $columns) == ($columns - 1) || ($i + 1) == $num_rows)
    		{
        		///if there is a remainder of 1, end the row
        		///or if there is nothing left in our result set, end the row
        		print "</tr>\n";
    		}
}
print "</table>\n";
print "</div>";
print "</div>";

include_once("shared/ui/footer.php"); 

?>