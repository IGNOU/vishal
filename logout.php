<?php
session_start();
// session_destroy();
unset($_SESSION['super']);
echo "<script>window.location.href='index.php';</script>";
?>