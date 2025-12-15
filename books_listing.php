<?phpPHP
    include_once "../db/arnoldkleingallery_db.php"; 
	include_once("shared/ui/header.php"); 
	$title="arnoldkleingallery.com | Dedicated to promote and sell fine art, rare books, and handmade crafts. "; 
	$book_listing=htmlentities($_GET['book_listing']);
    $current_limit_start=0; //$_GET['current_limit_start']; 
	$browseby=$_GET['browseby']; 
	$browsebyvar=$_GET['browsebyvar']; 

	$SQL="SELECT * FROM books "; //WHERE ";
    // $SQL.="book_listing LIKE \"%$book_listing%\" ";
    // $SQL.="book_listing=\"$book_listing\" ";
    // $SQL.="AND book_category='$browseby' ";
    // $SQL.="AND book_hide='0' ";
    // $SQL.="AND book_registered='1' ";
    // $SQL.= "ORDER BY book_year ";

	$rst=mysqli_query($link,$SQL);
	$num_rows = mysqli_num_rows($rst);

// print $SQL;

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
	print "<a href=\"books_section.php?browseby=".$browseby."\" class=\"trail\">";
	print $browseby;
	print "</a>";
	print " &gt; ";
    print "" . $book_listing;
    print "</div>";

// Formatting variables
	/// If there are no current limit vars just start over
	if (!$current_limit_start)
	{
		$current_limit_start=0;
	}
    $show_all_books = 1;
    if ( $show_all_books == 1 ) {
       $current_limit_end=$num_rows;
	}
    else {
  	   $current_limit_end=12; /// always 12 unless there are fewer to display
    }
    if( $num_rows < $current_limit_start+12)
    {
		$current_limit_end=$num_rows-$current_limit_start;
    }
	$current_limit_last=$current_limit_start+$current_limit_end;
    $current_limit_start_print = $current_limit_start+1;

	print "<h1>";
    if (strlen($cv)>1) {
       print "$book_listing<font size=1> &nbsp;&nbsp;&nbsp;(<a href=\"./docs/$cv\">resume</a>)</font>";
    }
    else {
       print "$book_listing";
    } 
	print "</h1>";

 /// Currently displayed message
	if ( $num_rows > 12 )
	{
	print "<p class=\"next_prev\">Currently displaying books $current_limit_start_print - $current_limit_last (total: $num_rows). </p>";
	}
	else if( $num_rows == 1)
	{
		print "<p class=\"next_prev\">Currently displaying book 1 of 1. Click for more information.</p>";
	}
	else if( $num_rows == 0)
	{
		print "<p class=\"next_prev\">Sorry, all of $book_listing books have been <!a href=\"./sold.php\">sold<!/a>.</p>";
	}
	else
	{
		print "<p class=\"next_prev\">Currently displaying books $current_limit_start_print - $current_limit_last (total: $num_rows).</p>";
	}

    if ( $show_all_books == 0 ) {

  	   if ($current_limit_start >'0' AND $num_rows>$current_limit_last)
  	   { /// Make prev AND next buttons
		$current_limit_start_minus_12=$current_limit_start-12;
		print "<p class=\"next_prev\"><a href=\"books_listing.php?book_id=$book_id&current_limit_start=$current_limit_start_minus_12\">&lt; Previous</a>";
		print " | ";
		$current_limit_start_plus_12=$current_limit_start+12;
		print "<a href=\"books_listing.php?book_id=$book_id&current_limit_start=$current_limit_start_plus_12\">Next &gt</a></p>";
	   }
	   else if	( $current_limit_last >= $num_rows AND $num_rows>12)
	   {
		/// Make prev button
		$current_limit_start_minus_12=$current_limit_start-12;
		print "<p class=\"next_prev\"><a href=\"books_listing.php?book_id=$book_id&current_limit_start=$current_limit_start_minus_12\">&lt; Previous</a></p>";
	   }
	   else if ($current_limit_start<'1' AND $num_rows >'12')
  	   {
		/// Make next button
		$current_limit_start_plus_12=$current_limit_start+12;
		print "<p class=\"next_prev\"><a href=\"books_listing.php?browseby=$book_category&booklisting=$book_listing&current_limit_start=$current_limit_start_plus_12\">Next &gt</a></p>";
	   }	
	   else
 	   {
		/// do nothing
	   }
	}

//	print "</div>";
//set the number of columns
	$columns = 3;

// Display text (vs. book covers below)
   if($row=mysqli_fetch_array($rst))
   {
        $book_directory=$row["book_directory"];
   }
   if (strlen($book_directory)==0) 
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
        //$book_hide=$row["book_hide"];
        $cv=$row["cv"];

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
	print "</h1>";

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
        $book_directory=$row["book_directory"];
        //$book_hide=$row["book_hide"];
        $cv=$row["cv"];

    $book_price = str_replace('$','',$book_price);

	print "<hr>";
	print "<div id=\"art_display_box_single\">";
	print "<h2>";
    print "$book_title";
	print "</h2>";

    $compare = strcmp($book_author,"");
    if( $compare==0 ) {
    } 
    else {
      print "<p>by $book_author</p>";
	}
    $compare = strcmp($book_publisher,"");
    if( $compare==0 ) {
      print "<p>";
    } 
    else {
      print "<p>Published by $book_publisher";
	}
    $compare = strcmp($book_year,"");
    if( $compare==0 ) {
      print "</p>";
    } 
    else {
      print " ($book_year)</p>";
	}
    $compare = strcmp($book_size,"");
    if( $compare==0 ) {
    } 
    else {
       print "<p>Size: $book_size</p>";
	}
    $compare = strcmp($book_condition,"");
    if( $compare==0 ) {
    } 
    else {
       print "<p>Condition: $book_condition</p>";
	}
    $compare = strcmp($book_notes,"");
    if( $compare==0 ) {
    } 
    else {
      print "<p>$book_notes</p>";
	}
    $compare = strcmp($book_price,"");
    if( $compare==0 ) {
    } 
    else {
      print "<p>\$$book_price</p>";
	}
	print "</h1>";

    print "</div>";
	
    } // while

   }  // if

// Display book covers & links to book pages
   else {
	$query = "SELECT * FROM books, bookpages WHERE ";
	$query.= "books.book_id = bookpages.book_id ";
	$query.= "AND book_listing='$book_listing' ";
    $query.= "AND book_category='$browseby' ";
    $query.= "AND book_directory!='' ";
    $query.= "AND book_page='1' ";
    $query.= "AND book_hide='0' ";
    $query.= "ORDER BY book_year ";
    $query.= "LIMIT $current_limit_start, $current_limit_end ";
	$result = mysqli_query($link,$query);
	///we add this line because we need to know the number of rows
	$num_rows = mysqli_num_rows($result);

	print "<table class=\"art_table\">\n";
	///changed this to a for loop so we can use the number of rows
	for($i = 0; $i < $num_rows; $i++)
	{
       $row = mysqli_fetch_array($result);

       $book_id=$row["book_id"];
       $book_category=$row["book_category"];
       $book_title=$row["book_title"];
       $book_directory=$row["book_directory"];
	   $book_image=$row["book_image"];

       if($i % $columns == 0)
	   {
  		///if there is no remainder, we want to start a new row
          print "<tr>\n";
       }
       if ( strlen($book_directory)>0 ) {
   	      print "<td height=\"150\" class=\"art_display_image_thumb\" valign=\"top\" >" . "<a href=\"book.php?browseby=$book_category&book_id=$book_id&page=1\">";
	   }

       print "<img height=\"150\" src=\"thumbs/books/$book_directory/$book_image\" class=\"art_display_image_thumb\" /></a><p class=\"art_display_info\">";

       print "<a href=\"book.php?browseby=$book_category&book_id=$book_id&page=1\"><em>$book_title</em></a><br/>";

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

   }

   include_once("shared/ui/footer.php"); 

?>