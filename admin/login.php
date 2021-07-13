<?php session_start();

    if (isset($_GET['lo'])) {?>
    
    <div id="container">
        <input type="text" placeholder="Username" name="user_name" id="user_name" value=""/>
        <input type="password" placeholder="Password" name="password" id="password" value=""/>

        <button id="login_submit">Login</button>
        <div class="status"></div>
    </div>

    <script>
        $('#password').keypress(function (e) {
            if (e.which == 13) {
                $('#login_submit').click();
            }
        });

        let uname = document.getElementById("user_name");
        let pss = document.getElementById("password");

        if (sessionStorage.getItem("Username")) {
            uname.value = sessionStorage.getItem("Username");
        }
        if (sessionStorage.getItem("Password")) {
            pss.value = sessionStorage.getItem("Password");
        }

        uname.addEventListener("change", function() {
            sessionStorage.setItem("Username", uname.value);
        });

        pss.addEventListener("change", function() {
            sessionStorage.setItem("Password", pss.value);
        });
    </script>
    
<?php } ?>
