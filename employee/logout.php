<?php
session_start();
// session_destroy();
unset($_SESSION['emp']);
echo "<script>window.location.href='../index.php';</script>";
?>