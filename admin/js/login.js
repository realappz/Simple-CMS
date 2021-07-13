jQuery(document).ready(function () {

    $(document).on('click', "#login", function() {
        $.get("login.php?lo", function(data) {
            $(".m_login").html(data);
        });
    });

    $(document).on('click', "#login_submit", function() {
        var user_name = $("#user_name").val();
        var password = $("#password").val();

        if ($("#password").val() == "" && $("#user_name").val() == "") {
            $('.status').html("Please enter username and password.");
            $("#user_name").focus();
        } else if ($("#user_name").val() == "") {
            $('.status').html("Please enter user name");
            $("#user_name").focus();
        } else if ($("#password").val() == "") {
            $('.status').html("Please enter password");
            $("#password").focus();
        } else {
            xhr_getLgin(user_name, password).done(function(data) {
                if( data == true) {
                    localStorage.setItem("Logged In", "True");
                    // alert("You are now logged in.")
                    window.location = '../index.php';
                } else {
                    $('.status').html(data);
                }
            })
        }
    })

    function xhr_getLgin(user_name, password) {
        return $.ajax({
            url: "db/logindb.php",
            method: "POST",
            data: { user_name: user_name, password: password},
        })
    }

    $(document).on('click', "#logout", function() {
        $.get(window.location.protocol + "//" + window.location.host + '/admin/logout.php', function(data) {
            // alert("Sucessfully Logged Out")
        })
        localStorage.clear();
        sessionStorage.clear();
        window.location = window.location.protocol + "//" + window.location.host;
    })

})