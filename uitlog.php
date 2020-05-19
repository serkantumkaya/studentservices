<?php
session_start();
session_destroy();
header('location: InlogPag.php');
?>