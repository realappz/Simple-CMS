<?php session_start() ?>

<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">

<div id="logo"><a href="../index.php"><h1>DEV</h1></a></div>

<div class="m_login">
    <?php if(!isset($_SESSION['id']) || empty($_SESSION['id'])) { ?><button id="login">Login</button><?php }?>
</div>


<div id="title"><h3>Construction Page</h3></div>
