<?php
    session_start();

    $con = new mysqli("localhost","dev","30eb1ca0d998f3d7983fe372d2249d6ef9594253","tutdev_cms");

    if ($con -> connect_errno) {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
    }

    if (isset($_POST['postname']) && isset($_POST['subject']) && isset($_POST['content'])) { 
        $e_postname = base64_encode($_POST['postname']);
        $e_subject = base64_encode($_POST['subject']);
        $e_data = base64_encode($_POST['content']);

        $sql = "insert into posts (postname,subject,post) values ('{$e_postname}','{$e_subject}','{$e_data}')";

        if(mysqli_query($con, $sql)) {
            echo "Post created";
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }
        mysqli_close($con);
    }

    if (isset($_POST['get_all_posts'])) {
        
        $sql = "select id,postname,subject,date,last_updated from posts order by date desc";

        $result = mysqli_query($con, $sql);

        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="n_wrap">';
                echo '<div class="s_post"><a class="showpost" href="#">'.base64_decode($row['postname']).'</a></div>'.
                '<div class="category"><i>'.base64_decode($row['subject']).'</i></div>
                <div class="date">'.$row['date'].'</div>
                <div class="mod_date" value="'.$row['id'].'">'.$row['last_updated'].'</div>
                <div class="p_del"><button value="'.$row['id'].'" class="p_delete" href="#">Delete</button></div>
                <div class="edit_p"><button value3="'.base64_decode($row['postname']).'" value="'.$row['id'].'" value2="'.base64_decode($row['subject']).'" class="p_edit" href="#">Edit</button></div>';
                echo '</div>';
            }
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }
        mysqli_close($con);

    }

    if (isset($_POST['getpost'])) {
        $post = $_POST['getpost'];

        $sql = "select post from posts where postname = TO_BASE64('$post')";

        $result = mysqli_query($con, $sql);

        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                for( $i=0; $i<count($row);$i++ ) {
                    echo base64_decode($row['post']);
                }
            }
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }
        mysqli_close($con);
    }

    if (isset($_POST['getpost_id'])) {

        $id = $_POST['getpost_id'];

        $sql = "select post from posts where id = $id";

        $result = mysqli_query($con, $sql);

        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                for( $i=0; $i<count($row);$i++ ) {
                    echo base64_decode($row['post']);
                }
            }
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }
        mysqli_close($con);
    }

    if (isset($_POST['u_postname']) && Isset($_POST['dbid']) && isset($_POST['u_category']) && isset($_POST['u_content'])) {
        $e_file = base64_encode($_POST['u_postname']);
        $e_category = base64_encode($_POST['u_category']);
        $e_data = base64_encode($_POST['u_content']);
        $id = $_POST['dbid'];

        $last_updated_time = "select date from posts where id=$id";

        $result = mysqli_query($con, $last_updated_time);
        $row = mysqli_fetch_assoc($result);

        $lst_dte = $row['date'];

        $sql = "update posts set post='$e_data', postname='$e_file', subject='$e_category', last_updated='$lst_dte' where id='$id'";
        if(mysqli_query($con, $sql)) {
            echo "Post updated";
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($con);
        }
        mysqli_close($con);
    }

    if(isset($_POST['delid'])) {
        $id = $_POST['delid'];

        $sql = "select postname from posts where id = '$id'; delete from posts where id = '$id'";

        $con->multi_query($sql);

        do {
            if (0 !== $con->errno) {
                echo "Query failed: (" . $con->errno . ") " . $con->error;
                break;
            }
            if(false !== ($res = $con-> store_result() )) {
                $ult = $res->fetch_all(MYSQLI_ASSOC);
                foreach($ult as $found) {
                    echo "Deleted: ".base64_decode($found['postname']);
                }
                $res->free();
            }
            if (false === ($con->more_results() )) {
                break;
            }
            $con->next_result();
        } while (true);
    }

?>