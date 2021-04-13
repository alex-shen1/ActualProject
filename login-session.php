<?php session_start(); ?>

<?php
if (!isset($_SESSION) || !isset($_SESSION['pwd']) || !isset($_SESSION['email'])) {
    header("Location: index.php");
}
?>
