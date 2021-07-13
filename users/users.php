<?php
    session_start();

    if( !empty($_SESSION['id']) && $_SESSION['role'] == 'user') {
        include('header.php');
    ?>
        <button id="logout">Logout</button>

        <div id="main"></div>
    <?php } else {
        echo "Not authorized";
    }
?>