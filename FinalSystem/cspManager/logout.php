<?php
session_start();
$_SESSION['login_id'] = "0";
session_destroy();
header("location:index.php");
