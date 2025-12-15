<?php
    include_once "../db/arnoldkleingallery_db.php"; 
	include_once("shared/ui/header.php"); 
	$current_limit_start = sanitize_int($_GET['current_limit_start']); 
    $book_id = sanitize_int($_GET['book_id']);
    $book_page = isset($_GET['page']) ? sanitize_string($link, $_GET['page']) : '';
	$browseby = isset($_GET['browseby']) ? sanitize_string($link, $_GET['browseby']) : ''; 
	$browsebyvar = isset($_GET['browsebyvar']) ? sanitize_string($link, $_GET['browsebyvar']) : ''; 
	$query="SELECT * FROM books WHERE ";
	$query.="book_id='$book_id' ";
    $query.="AND book_hide='0' ";
    $result = mysqli_query($link,$query);

	if($row=mysqli_fetch_array($result))
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
        $book_hide=$row["book_hide"];
        $title="arnoldkleingallery.com - Books - $book_title";
	}

    print "<div id=\"trail\"><a href=\"index.php\" class=\"trail\">Home</a> ";
    print "&gt; <a href=\"books.php\" class=\"trail\">Books</a> ";
    print "&gt; <a href=\"books_section.php?browseby=$book_category\" ";
    print "class=\"trail\">$book_category</a> ";
    print "&gt; <a href=\"books_listing.php?browseby=$book_category&book_listing=$book_listing\">";
    print "$book_listing"; 
	print "</a>";
  	print " &gt; ";
	print "<a href=\"book.php?book_id=$book_id\" class=\"trail\">";
	print "</a>";
	print $book_title;
	print "</div>";

	print "<div class=\"display_box\">";
	print "<h1>";
    print "$book_title";
	print "</h1>";

    $compare = strcmp($book_author,"");
    if( $compare==0 ) {
    } 
    else {
      print "<p>by $book_author";
	}

    $compare = strcmp($book_directory,"");
    if( $compare==0 ) {
	}
    else {

  	   print "<div class=\"next_prev\">";
  	   //print "<p class=\"next_prev\">Page $book_page</p>";

       $book_page_prev = $book_page-1;
       $book_page_next = $book_page+1;

   	   $query2="SELECT * FROM bookpages WHERE ";
	   $query2.="book_id='$book_id' ";
	   $result2 = mysqli_query($link,$query2);
  	   $num_pages = mysqli_num_rows($result2);

   	   $query3="SELECT * FROM bookpages WHERE ";
	   $query3.="book_id='$book_id' ";
	   $query3.="AND book_page='$book_page' ";
	   $result3 = mysqli_query($link,$query3);

   	   if($row=mysqli_fetch_array($result3)) {
              $book_image=$row["book_image"];
       }

	   if ( $book_page==1 && $num_pages==1 ) {
             //print "<p>Page " . $book_page . " of " . $book_page;
             //print "</p>";     
       }

	   elseif ( $book_page==1 && $num_pages>1 ) {
             print "<p class=\"next_prev\">";
             print "<font color=\"white\">&lt; Previous";
             print "</font>";
             print "&nbsp;&nbsp;&nbsp;&nbsp;Page " . $book_page . "&nbsp;&nbsp;&nbsp;&nbsp;"; //" | ";
             print "<a href=\"book.php?book_id=$book_id&page=$book_page_next\">Next &gt;";
             print "</a></p>";     
       }

	   elseif ( $book_page>1 && $book_page<$num_pages ) {
             print "<p class=\"next_prev\">";
             print "<a href=\"book.php?book_id=$book_id&page=$book_page_prev\">&lt; Previous";
             print "</a>";
             print "&nbsp;&nbsp;&nbsp;&nbsp;Page " . $book_page . "&nbsp;&nbsp;&nbsp;&nbsp;"; //" | ";
             print "<a href=\"book.php?book_id=$book_id&page=$book_page_next\">Next &gt;";
             print "</a></p>";     
	   }

	   elseif ( $book_page==$num_pages ) {
             print "<p class=\"next_prev\">";
             print "<a href=\"book.php?book_id=$book_id&page=$book_page_prev\">&lt; Previous";
             print "</a>";     
             print "&nbsp;&nbsp;&nbsp;&nbsp;Page " . $book_page . "&nbsp;&nbsp;&nbsp;&nbsp;"; //" | ";
             print "</p>";     
       }

       print "</div>";

       print "<img height=\"380\" src=\"images/books/$book_directory/$book_image\" class=\"art_display_image_thumb\" /><!/a><p class=\"art_display_info\">";

	}

    $compare = strcmp($book_publisher,"");
    if( $compare==0 ) {
    } 
    else {
      print "<p>Published by $book_publisher";
	}

    $compare = strcmp($book_year,"");
    if( $compare==0 ) {
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
      $book_price = str_replace('$','',$book_price);
      print "<p>\$$book_price</p>";
	}

    print "</div>";

    include_once("shared/ui/footer.php"); 

?>