<?php 
    session_start();
    include('header.php');
?>

<?php
    if( !empty($_SESSION['id'])) {
        include('admin/adminbar.php');
    }
?>

<?php 
    if( isset($_SESSION['id'])) {
        echo '<pre>'; print_r($_SESSION); echo '</pre>';
    }
?>