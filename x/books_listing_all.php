<?phpPHP
	include_once "../db/arnoldkleingallery_db.php"; 
	include_once("shared/ui/header.php"); 
	$title="arnoldkleingallery.com | Dedicated to promote and sell fine art, rare books, and handmade crafts. "; 

	$SQL="SELECT * FROM books WHERE ";
        $SQL.="book_hide='0' ";
        $SQL.="AND book_registered='1' ";
        $SQL.= "ORDER BY book_id";

	$rst=mysqli_query($link,$SQL);
	$num_rows = mysqli_num_rows($rst);

// Navigation 
	print "<div id=\"trail\">";
	print "<a href=\"index.php\" class=\"trail\">";
	print "Home";
	print "</a>";
	print " &gt; ";
	print "<a href=\"books.php\" class=\"trail\">";
	print "Books";
	print "</a>";
	print " &gt; ";
	print "All";
        print "</div>";

// Formatting variables
	$current_limit_start=0;
        $current_limit_end=$num_rows;
	$current_limit_last=$current_limit_start+$current_limit_end;
        $current_limit_start_print = $current_limit_start+1;

 /// Currently displayed message
	print "<p class=\"next_prev\">Currently displaying books $current_limit_start_print - $current_limit_last (total: $num_rows).</p>";

// Display text
     while($row=mysqli_fetch_array($rst))
     {
        $book_id=$row["book_id"];
        $book_category=$row["book_category"];
        $book_listing=$row["book_listing"];
        $book_author=$row["book_author"];
        $book_title=$row["book_title"];
        $book_publisher=$row["book_publisher"];
        $book_place=$row["book_place"];
        $book_year=$row["book_year"];
        $book_edition=$row["book_edition"];
        $book_size=$row["book_size"];
        $book_condition=$row["book_condition"];
        $book_price=$row["book_price"];
        $book_notes=$row["book_notes"];
        $book_hide=$row["book_hide"];
        $book_price = str_replace('$','',$book_price);

	print "<hr>";
	print "<div id=\"art_display_box_single\">";
	print "<h2>";
        print "$book_title";
	print "</h2>";

    $compare = strcmp(trim($book_author),"");
    if( $compare==0 ) {
    } 
    else {
      print "<p>by $book_author</p>";
    }
    $compare = strcmp(trim($book_publisher),"");
    if( $compare==0 ) {
      print "<p>";
    } 
    else {
      print "<p>Published by $book_publisher";
      $compare = strcmp(trim($book_place),"");
      if( $compare==0 ) {
      } 
      else {
        print ", $book_place ";
      }
    }

    $compare = strcmp(trim($book_year),"");
    if( $compare==0 ) {
      print "</p>";
    } 
    else {
      print " ($book_year)</p>";
    }
    $compare = strcmp(trim($book_size),"");
    if( $compare==0 ) {
    } 
    else {
       print "<p>Size: $book_size</p>";
    }
    $compare = strcmp(trim($book_condition),"");
    if( $compare==0 ) {
    } 
    else {
       print "<p>Condition: $book_condition</p>";
    }
    $compare = strcmp(trim($book_notes),"");
    if( $compare==0 ) {
    } 
    else {
      print "<p>$book_notes</p>";
    }
    $compare = strcmp(trim($book_price),"");
    if( $compare==0 ) {
    } 
    else {
      print "<p>\$$book_price</p>";
    }
    print "<p>[ID: $book_id]</p>";
    print "</div>";

   } // while

   include_once("shared/ui/footer.php"); 

?>