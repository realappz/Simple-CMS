<?php 
    session_start();
    include('header.php');
    
    if( !empty($_SESSION['id']) && $_SESSION['role'] == 'admin') {?>

    <button id="m_enable"></button>
    <button id="users">Show Users</button>
    <button id="create_user">Create User</button>
    <button id="logout">Logout</button>

    <div id="main"></div>

    <?php } else {
        echo "Not authorized";
    }
?>