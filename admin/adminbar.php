<div id="adminbar">
    <?php
        if( !empty($_SESSION['id']) && $_SESSION['role'] == 'admin'){ ?>
            <a href="admin/admin.php">Admin</a>
        <?php } else {?>
            <a href="users/users.php">Profile</a>
        <?php } ?>
    <button id="logout"><a href="admin/logout.php">Logout</a></button>
</div>