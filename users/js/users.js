jQuery(document).ready(function() {
    let url = window.location.protocol + "//" + window.location.host + '/users/functions/u_functions.php';

    $(document).on("click", '#account_info', function() {
        $.post(url, {
            account_info: "user"
        }, function(data) {
            $("#main").html(data)
        })
    })

    $(document).on("click", '#user_changepw', function() {
        get_user_form();
        function get_user_form() {
            var user_form = '<input type="password" id="new_pw" placeholder="New Password">';
            user_form += '<input type="button" id="update_pw" value="Update">';
            $("#main").html(user_form);
        }
    })
    $(document).on("click", '#update_pw', function() {
        var newpass = $("#new_pw").val();
        $.post(url, {
            change_pw: newpass
        }, function(data) {
            $("#main").html(data)
        })
    })

    $(document).on("click", '.del_user', function() {
        if(confirm("Are you sure you would like to delete your account? This operation cannot be undone.")) {
            var user = $(this).attr('value2');
            $.post(url, {
                delete_account: user
            }, function(data) {
                $("#main").html(data);
                $("#logout").click();
            })
        }
    })

})