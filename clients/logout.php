<?php
session_start();
// session_destroy($_SESSION['cu']);
// unset($_SESSION['cu']);
unset($_SESSION['cu']);
echo "<script>window.location.href='../index.php';</script>";
?>