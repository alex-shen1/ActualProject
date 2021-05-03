<!-- Built-in PHP session manager: https://www.php.net/manual/en/function.session-start.php -->
<?php
if(isset($_GET['session'])) {
    session_id($_GET['session']);
}
session_start();
//echo session_id();?>


<?php
if (!isset($_SESSION) || !isset($_SESSION['pwd']) || !isset($_SESSION['email'])) {
    // header("Location: index.php");
    echo "<script>window.location = 'index.php';</script>";
}
?>
