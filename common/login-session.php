<!-- Built-in PHP session manager: https://www.php.net/manual/en/function.session-start.php -->
<?php session_start(); ?>

<?php
if (!isset($_SESSION) || !isset($_SESSION['pwd']) || !isset($_SESSION['email'])) {
    // header("Location: index.php");
    echo "<script>window.location = 'index.php';</script>";
}
?>
