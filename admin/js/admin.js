jQuery(document).ready(function() {
    let url = window.location.protocol + "//" + window.location.host + '/admin/db/admindb.php';

    $(document).on("click", '#users', function() {
        $.post(url, {
            get_users: "user"
        }, function(data) {
            $("#main").html(data);
        })
    })

    $(document).on("click", '#create_user', function() {
        get_user_form();
        function get_user_form() {
            var user_form = '<input type="text" id="user_fname" placeholder="First Name">';
            user_form += '<input type="text" id="user_lname" placeholder="Last Name">';
            user_form += '<input type="text" id="user_email" placeholder="Email">';
            user_form += '<input type="text" id="user_pss" placeholder="Password">';
            user_form += '<select id="user_role" name="user_role">\
            <option>admin</option>\
            <option selected>user</option>\
            <option>guest</option>\
            </select>';
            user_form += '<input type="button" id="submit_user" value="Create User">';
            $("#main").html(user_form);
        }
    })

    $(document).on("click", '#submit_user', function() {
        var firstname = $("#user_fname").val();
        var lastname = $("#user_lname").val();
        var role = $("#user_role").val();
        var email = $("#user_email").val();
        var pss = $("#user_pss").val();

        $.post(url, {
            create_user: "create", firstname: firstname, lastname: lastname, role: role, email: email, pass: pss
        }, function(data) {
            $("#main").html(data);
        })
    })

    $(document).on("click", '.del_user', function() {
        var user = $(this).attr('value2');

        $.post(url, {
            delete_user: user
        }, function(data) {
            $("#main").html(data);
            $("#users").click();
        }) 
    })

    $(document).on("click", "#admin_posts", function() {
        $.get(window.location.protocol + "//" + window.location.host + '/admin/posts.php', function(data) {
            $("#main").html(data);
        })
    })

})