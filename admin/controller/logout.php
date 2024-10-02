<?php
session_start();
session_destroy();
header('Location: http://localhost/php_test1/');
exit();
?>
