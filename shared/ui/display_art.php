<img src="https://arnoldkleingallery.com/images/<?php print $art_directory; ?>/<?php print $image_name; ?>" class="art_display_image_large" />
<p class="art_display_info">
<?php print "$art_medium"; ?>

<?php
        $compare = strcmp($art_date,"");
        if( $compare==0 ) {
        } 
        else {
        print " (" . $art_date . ")";
	}
?>

<?php
        $compare = strcmp($art_size,"");
        if( $compare==0 ) {
        } 
        else {
        print " - "; print "$art_size";
	}
?>
<?php

        $compare = strcmp($art_price,"");
        if( $compare==0 ) {
        } 
        else {
        $art_price = str_replace('$','',$art_price);
		if (trim($art_price)!='' && trim($art_price)!='Sold') {
           print "<!--br>$" . $art_price . "<br--><br>";
        }
	}
?>

<span class="fine_print"><?php print "$art_notes"; ?></span>
</p>

