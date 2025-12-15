<?php
// To be added to the top of the secondary admin_ pages (called by admin.php).
// Be sure to add }} at the end of the secured code.

// username or password not entered
   if(empty($_POST[submit_password]) || empty($_POST[submit_username]))
   {
      echo 'You must enter both a username and password.';  die;
   }
   else {
   // Find password
      $sql_isuser = 'SELECT member_password FROM members
                     WHERE pk_member_id="'.$ID.'" 
                     AND member_username="'.$submit_username.'"';
      $result_isuser = mysqli_query($link,$sql_isuser) or die (mysql_error());
      $row = mysqli_fetch_array($result_isuser);
      $submit_password = crypt($submit_password,$row[member_password]);
   // no match -- let them try again:
      if(substr($submit_password,0,strlen($row[member_password])) != $row[member_password])
      {
         echo 'Sorry, no password matches.';  die;
      }
   // password match:
      else 
      {
?>

