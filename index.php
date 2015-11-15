<?php //index.php
include_once 'header.php';

echo "<br /><span class='main'>Welcome to Local Web";

if($loggedin) echo "$user, you are logged in.";

else echo 'please sign up and/or log in to join in.';
?>

</span><br /><br /></body></html>