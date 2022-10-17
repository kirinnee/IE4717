<?php
session_start();
require_once("./db.php");
require_once("./components/process_coffee_updates.php");

header("Location: admin.php");
exit();
?>