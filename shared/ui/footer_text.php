
<!--?php include "https://www.arnoldkleingallery.com/shared/lib/dbclose.php"; ?-->
<?php
//----------------------------
// disconnecting mysql db
//----------------------------
   if ( $link ){
      mysqli_close($link);
   }
?>

<div id="footer">

<p class="fine_print"> Please feel free to contact us if you have questions or would like 
to purchase artworks or books.</p>

<p class="fine_print">e-mail: <b>info[at]arnoldkleingallery.com</b>
</p>

<p class="fine_print"> COPYRIGHT AND TRADEMARK NOTICES:<br>

All content is copyright protected in favour of Arnold Klein Gallery and/or its suppliers. 
All trademarks, names, brand names, etc. used on this website are trademarks 
of Arnold Klein Gallery. Any rights not expressly granted herein are reserved.</p>

<p>
<a target="_top" href="disclaimer.php" class="sub">Disclaimer</a>, <a target="_top" href="guarantee.php" class="sub">Authenticity</a>, <a target="_top" href="privacy.php" class="sub">Privacy Policy</a>
</p>

</div>

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
