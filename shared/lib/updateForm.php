<?php

// Full-Text Search Example
// http://www.phpfreaks.com/tutorials/129/0.php
// Create the search function:

//function updateForm()
//{

// Re-usable form
// variable setup for the form.
  $update_title          = (isset($_GET['update_title'])          ? htmlspecialchars(stripslashes($_REQUEST['update_title'])) : '');
  $update_file           = (isset($_GET['update_file'])           ? htmlspecialchars(stripslashes($_REQUEST['update_file'])) : '');
  $update_date_circa     = (isset($_GET['update_date_circa'])     ? htmlspecialchars(stripslashes($_REQUEST['update_date_circa'])) : '');
  $update_date           = (isset($_GET['update_date'])           ? htmlspecialchars(stripslashes($_REQUEST['update_date'])) : '');
  $update_date2          = (isset($_GET['update_date2'])          ? htmlspecialchars(stripslashes($_REQUEST['update_date2'])) : '');
  $update_medium         = (isset($_GET['update_medium'])         ? htmlspecialchars(stripslashes($_REQUEST['update_medium'])) : '');
  $update_creator        = (isset($_GET['update_creator'])        ? htmlspecialchars(stripslashes($_REQUEST['update_creator'])) : '');
  $update_url            = (isset($_GET['update_url'])            ? htmlspecialchars(stripslashes($_REQUEST['update_url'])) : '');
  $update_email          = (isset($_GET['update_email'])          ? htmlspecialchars(stripslashes($_REQUEST['update_email'])) : '');
  $update_notes          = (isset($_GET['update_notes'])          ? htmlspecialchars(stripslashes($_REQUEST['update_notes'])) : '');
  $update_collection     = (isset($_GET['update_collection'])     ? htmlspecialchars(stripslashes($_REQUEST['update_collection'])) : '');
  $update_collection_url = (isset($_GET['update_collection_url']) ? htmlspecialchars(stripslashes($_REQUEST['update_collection_url'])) : '');
  $update_indate         = (isset($_GET['update_indate'])         ? htmlspecialchars(stripslashes($_REQUEST['update_indate'])) : '');
  $update_update         = (isset($_GET['update_update'])         ? htmlspecialchars(stripslashes($_REQUEST['update_update'])) : '');
  $update_hide           = (isset($_GET['update_hide'])           ? htmlspecialchars(stripslashes($_REQUEST['update_hide'])) : '');
  
  echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
  echo '<input type="hidden" name="cmd2" value="update" />';

  $string1 = 'input type="text" textarea rows="10" ';

  echo 'Title:          <'.$string1.' name="update_title"          cols="35" value="'.$image_title         .'"></textarea> <br />';
  echo 'File:           <'.$string1.' name="update_file"           cols="35" value="'.$image_file          .'"></textarea> <br />';
  echo 'Circa:          <'.$string1.' name="update_date_circa"     cols="35" value="'.$image_date_circa    .'"></textarea> <br />';
  echo 'Start date:     <'.$string1.' name="update_date"           cols="35" value="'.$image_date          .'"></textarea> <br />';
  echo 'End date:       <'.$string1.' name="update_date2"          cols="35" value="'.$image_date2         .'"></textarea> <br />';
  echo 'Medium:         <'.$string1.' name="update_medium"         cols="35" value="'.$image_medium        .'"></textarea> <br />';
  echo 'Creator:        <'.$string1.' name="update_creator"        cols="35" value="'.$image_creator       .'"></textarea> <br />';
  echo 'Image URL:      <'.$string1.' name="update_url"            cols="35" value="'.$image_url           .'"></textarea> <br />';
  echo 'Notes:          <'.$string1.' name="update_notes"          cols="35" value="'.$image_notes         .'"></textarea> <br />';
  echo 'Collection:     <'.$string1.' name="update_collection"     cols="35" value="'.$image_collection    .'"></textarea> <br />';
  echo 'Collection URL: <'.$string1.' name="update_collection_url" cols="35" value="'.$image_collection_url.'"></textarea> <br />';
  echo 'Email:          <'.$string1.' name="update_email"          cols="35" value="'.$image_email         .'"></textarea> <br />';
  echo 'Input date:     <'.$string1.' name="update_indate"         cols="35" value="'.$image_indate        .'"></textarea> <br />';
  echo 'Latest update:  <'.$string1.' name="update_update"         cols="35" value="'.$image_update        .'"></textarea> <br />';
  echo 'Hide:           <'.$string1.' name="update_hide"           cols="35" value="'.$image_hide          .'"></textarea> <br />';

  echo '<input type="submit" value="Update" />';
  echo '<input type="reset"  value="Reset"  />';
  echo '</form> <br />';

//}

?>
