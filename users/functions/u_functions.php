<?php
    session_start();
    if( !empty($_SESSION['id']) && $_SESSION['role'] == 'user') {
        $con = new mysqli("localhost","dev","30eb1ca0d998f3d7983fe372d2249d6ef9594253","tutdev_cms");

        if ($con -> connect_errno) {
            echo "Failed to connect to MySQL: " . $con -> connect_error;
            exit();
        }

        if (isset($_POST['account_info'])) {
            $id = $_SESSION['id'];
            $sql = "select * from login_form where id = $id";
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
                    echo "<td>" . $row['id']. "</td>";
                    echo "<td>" . $row['firstname']. "</td>";
                    echo "<td>" . $row['lastname']. "</td>";
                    echo "<td>" . $row['role']. "</td>";
                    echo "<td>" . $row['email']. "</td>";
                    echo "<td>" . $row['password']. "</td>";
                    echo "<td>" . '<input type="button" class="del_user" value="Delete" value2="'.$row['id'].'">';
                    echo "</tr>";
                }
                echo"</table>";
            } else {
                echo "ERROR: Could not execute $sql. " . mysqli_error($con);
            }
            mysqli_close($con);
        }

        if(isset($_POST['change_pw'])) {
            $id = $_SESSION['id'];

            $pass = md5($_POST['change_pw']);
            $sql = "update login_form set password='$pass' where id='$id';";

            if(mysqli_query($con, $sql)) {
                echo "Updated password: $pass (md5)";
            } else {
                echo "ERROR: Could not execute $sql. " . mysqli_error($con);
            }

            mysqli_close($con);
        }

        if( isset($_POST['delete_account'])) {
            $user = $_POST['delete_account'];

            $sql = "delete from login_form where id = $user";

            if(mysqli_query($con, $sql)) {
                echo "Deleted user: $user";
            } else {
                echo "ERROR: Could not execute $sql. " . mysqli_error($con);
            }
            mysqli_close($con);
        }
    }
    
?>
