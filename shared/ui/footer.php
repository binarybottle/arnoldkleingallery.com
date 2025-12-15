
<!--?php include "https://www.arnoldkleingallery.com/shared/lib/dbclose.php"; ?-->
<?php
//----------------------------
// disconnecting mysql db
//----------------------------
   if ( $link ){
      mysqli_close($link);
   }
?>

<!-- Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-693862-8");
pageTracker._trackPageview();
</script>

</body>
</html>
