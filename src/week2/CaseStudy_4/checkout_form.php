<?php
session_start();
require_once("./db.php");
require_once("./components/process_checkout.php");
header("Location: menu.php");
exit();
?>