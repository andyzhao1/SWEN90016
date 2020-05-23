<?php
/* logout */
session_start();

if (isset($_SESSION['user'])){
	unset($_SESSION['user']);
}
// Finally, destroy the session.
session_destroy();
$url  =  "index.html" ;  
echo " <script language = 'javascript' type = 'text/javascript'> ";  
echo " window.location.href = '$url' ";  
echo " </script> ";
?>