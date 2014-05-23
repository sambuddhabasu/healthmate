<?php
session_start();
session_destroy();
require_once('include.php');
header("Location: " . $ROOT_URL . "index.php");
?>