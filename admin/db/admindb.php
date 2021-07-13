<?php
    session_start();

    $con = new mysqli("localhost","dev","30eb1ca0d998f3d7983fe372d2249d6ef9594253","tutdev_cms");

    if ($con -> connect_errno) {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
    }

    if (isset($_POST['maintenance'])) {
        $value = $_POST['maintenance'];

        $sql = "update site_prefs set maintenance = '{$value}' where id = 1";

        $result = $con -> query($sql);

        $con -> close();
    }
    
    if(isset($_GET['m_check'])) {
        $sql = "select * from site_prefs where id =1";

        $result = $con -> query($sql);
        if($result) {
            $row = $result -> fetch_assoc();
            if(sizeof($row) >0) {
                $_SESSION['maintenance'] = $row['maintenance'];
                echo $_SESSION['maintenance'];
            }
        }
        $con ->close();
    }

    if( !empty($_SESSION['id']) && $_SESSION['role'] == 'admin') {

        if (isset($_POST['get_users'])) {
            $sql = "select * from login_form order by date_registered desc";
            $result = mysqli_query($con, $sql);

            if($result) {
                echo "<table>
                <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Password (md5)</th>
                </tr>";
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['firstname'] . "</td>";
                    echo "<td>" . $row['lastname'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . '<input type="button" class="del_user" value="Delete" value2="'.$row['id'].'">';
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "ERROR: Could not execute $sql. " .  mysqli_error($con);
            }
            mysqli_close($con);
        }
        
        if (isset($_POST['create_user'])) {
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $role = $_POST['role'];
            $email = $_POST['email'];
            $pass = md5($_POST['pass']);
            
            $sql = "insert into login_form (firstname, lastname, role, email, password) values ('{$fname}','{$lname}','{$role}','{$email}','{$pass}')";
            
            if(mysqli_query($con, $sql)) {
                echo "Created user: ($role) $fname $lname $email $pass";
            } else {
                echo "ERROR: Could not execute $sql. " . mysqli_error($con);
            }
            mysqli_close($con);
            
        }
    }

    if(isset($_POST['delete_user'])) {
        $user = $_POST['delete_user'];

        $sql = "delete from login_form where id = $user";

        if(mysqli_query($con, $sql)) {
            echo "Deleted user: $user";
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }

        mysqli_close($con);
    }
?>