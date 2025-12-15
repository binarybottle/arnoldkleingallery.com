<?php
    include_once "../db/arnoldkleingallery_db.php"; 
    
	$art_id      = sanitize_int($_GET['art_id']);
	$browseby    = isset($_GET['browseby']) ? sanitize_string($link, $_GET['browseby']) : '';
	$browsebyvar = isset($_GET['browsebyvar']) ? sanitize_string($link, $_GET['browsebyvar']) : '';
    $num_moreworks = 3;

    include_once("shared/ui/header.php"); 
    $artists_page = "<a href=\"artists.php\"";

    if (strlen($browseby)>0) {
	          $bb = "&browseby=$browseby";
    } else {  $bb = "";
    }
    if (strlen($browsebyvar)>0) {
	          $bbv = "&browsebyvar=$browsebyvar";
    } else {  $bbv = "";
    }
	
	if(!strcmp($browseby, "Nation"))
	{
		$SQL="SELECT pk_nation_id as Id FROM nations ";
		$SQL.="WHERE nation_name='$browsebyvar'";
		$rst=mysqli_query($link,$SQL);
		if( $row = mysqli_fetch_array($rst) )
		{
			$browsebyvar=$row["Id"];	
		}
	}
	$SQL="SELECT * FROM art, artists WHERE art.pk_art_id='$art_id' ";
	$SQL.=" AND art.fk_artist_id=artists.pk_artist_id "; #AND art.art_hide!='0'";
	$rst=mysqli_query($link,$SQL);
	if( $row = mysqli_fetch_array($rst) )
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
		$section="Art"; //$section=$row["art_section"];
		$artist_name_first=$row["artist_name_first"];
		$artist_name_last=$row["artist_name_last"];
		$artist_period=$row["artist_period"];
	}
	else
	{
		print "database error: #00001<br />";	
	}
    $art_directory="art";

    $title="arnoldkleingallery.com | Dedicated to promote and sell fine art, rare books, and handmade crafts. "; 

	print "<div id=\"trail\">";
    print "<a href=\"index.php\" class=\"trail\">";
	print "Home</a>";
	print " &gt; ";
    print $artists_page;
    print " class=\"trail\">Artists</a>";
	print " &gt; ";
    if($browseby) {
        if($browseby=="Nation") {
          $query  = 'SELECT nation_name FROM nations WHERE pk_nation_id = '.$browsebyvar;
          $result2 = mysqli_query($link,$query);
          if ($result2) {
             $nation = mysqli_fetch_row($result2);
             $browseby_fillin = $nation[0];
          } else {
             $browseby_fillin = '';
          }
  	      print "<a href=\"artists_browse.php?$bb$bbv\" class=\"trail\">";
        } elseif($browseby=="Name") {
          if (strlen($browsebyvar)>0) {
             $browseby_fillin = $browsebyvar;
          } else {
             $browseby_fillin = '';
          }
  	      print "<a href=\"artists_browse.php?$bb$bbv\" class=\"trail\">";
        } elseif($browseby=="Sold"||$browseby=="SOLD") {
          $browseby_fillin = "<a href=\"artists_sold.php\" class=\"trail\"> Sold ";
        }
        print $browseby_fillin;
	} 
    //else {
    //    print " &gt;<a href=\"artists_sold.php\" class=\"trail\">";
    //    print " Sold ";
    //}
	print "</a>";
    if (strlen($browseby_fillin)>0) {
       print " &gt; ";
    }
    if ($browseby=="Sold"||$browseby=="SOLD") {
	   print "<a href=\"artist.php?artist_id=$artist_id$bbv\" class=\"trail\">";
    } else {
	   print "<a href=\"artist.php?artist_id=$artist_id$bb$bbv\" class=\"trail\">";
    }
	print "".$artist_name_first." ".$artist_name_last."";
	print "</a>";
    if (trim($art_title)!='') {
	   print " &gt; ";
	   print $art_title;
    }
	print "</div>";

	print "<div id=\"art_display_box_single\">";
	print "<h1>";

        if (!strcmp($artist_period, "")) {
  	       print "$artist_name_first" . " " . "$artist_name_last<br>";
           print "$art_title";
           $compare_status = strcmp($art_status,"Sold")+strcmp($art_status,"SOLD");
           if($compare_status>0) {
	          print "<br>";
              print "<a class=\"hSOLD\">   (SOLD) </a>";
           } 
        } 
        else {
    	   print "$artist_name_first" . " " . "$artist_name_last" . " (" . $artist_period . ")<br>";          print "$art_title";
           $compare_status = strcmp($art_status,"Sold")+strcmp($art_status,"SOLD");
           if( $compare_status>0) {
	          print "<br>";
              print "<a class=\"hSOLD\">   (SOLD) </a>";
           } 
        }
	print "</h1>";

	print "<div id=\"art_display\">";
	include_once("shared/ui/display_art.php"); 	
	print "</div>";

 // See if there are more works
	print "<div id=\"more_works\">";

	$SQL="SELECT * FROM art, artists WHERE ";
	$SQL.=" art.fk_artist_id=artists.pk_artist_id ";
    $SQL.=" AND art.fk_artist_id=$artist_id ";
    $SQL.=" AND art.pk_art_id!=$art_id ";
#    $SQL.=" AND art.art_hide!=\"0\" ";
    $SQL.=" AND art.art_status!=\"Sold\" AND art.art_status!=\"SOLD\"";
    $SQL.=" ORDER BY art.pk_art_id"; 

	$result=mysqli_query($link,$SQL);
    if ($result) {
	 if (mysqli_num_rows($result) > 0)
	 {
		echo "<h2>More Works by $artist_name_first $artist_name_last</h2>";
		echo "<table class=\"art_table\">";
                $count_myrow = 0;
		do
	  	{
		   $count_myrow = $count_myrow + 1;
	       if ($count_myrow > $num_moreworks) {
		      break;
           }

           if($browseby=="Sold"||$browseby=="SOLD") {
             $bbbbv = $bbv;
	       } else {
             $bbbbv = $bb.$bbv;
           }          
           if($myrow['art_date']) {
			 $dd = " ($myrow[art_date]) ";
           } else {
			 $dd = '';
           }
           printf("<tr><td class=\"art_display_image_thumb\" width=\"150\"><a href=\"artwork.php?art_id=$myrow[pk_art_id]$bbbbv\"><img src=\"https://arnoldkleingallery.com/thumbs/$art_directory/$myrow[art_image_name]\" class=\"art_display_image_thumb\" /></a></td><td class=\"art_display_info\"><a href=\"artwork.php?art_id=$myrow[pk_art_id]$bbv\"><em>$myrow[art_title]</em></a><br />$myrow[art_medium]$dd</td></tr>\n", $myrow[pk_art_id], $myrow[pk_artist_id] );
		}
	  	while( $myrow = mysqli_fetch_array($result) );
		echo "</table>\n";
	 }
    }

	print "</div></div>";

include_once("shared/ui/footer.php"); 	
	
?>