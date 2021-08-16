<?php require 'partition/navbar.php'   ?>
<?php
session_start();

session_unset();
session_destroy();

header("Location: login.php");

?>