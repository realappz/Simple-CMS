<?php if( !empty($_SESSION['id']) && $_SESSION['role'] == 'user') {?>
    <!DOCTYPE html>
        <html>
            <head>
                <title>Profile</title>
                <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>

                <script type="text/javascript" src="../admin/js/login.js"></script>
                <script type="text/javascript" src="js/users.js"></script>

                <link rel="stylesheet" href="../admin/css/style.css" type="text/css">
            </head>
            <body>
        <?php
            include('head.php');
} ?>