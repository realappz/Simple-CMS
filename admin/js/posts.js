jQuery(document).ready(function() {
    let url = window.location.protocol + "//" + window.location.host + '/admin/db/postsdb.php';

    xhr_getAllPosts("NULL").done(function(data) {
        $("#posts").html(data);
    })

    function getStatus(status) {
        my_color();
        function my_color() {
            $('.status').html(status).fadeTo("slow", 1000);
            $('.status').html(status).fadeTo("slow", .7);
        }
    }
    
    function xhr_createPost(postname, subject, content) {
        return $.ajax({
            url: url,
            method: 'POST',
            dataType: 'html',
            data: { postname: postname, subject: subject, content: content },
        })
    }

    function xhr_getAllPosts(get_all_posts) {
        return $.ajax({ 
            url: url,
            method: 'POST',
            dataType: 'html',
            data: { get_all_posts: get_all_posts },
        })
    }

    function xhr_getPost(link) {
        return $.ajax({
            url: url,
            method: 'POST',
            dataType: 'html',
            data: { getpost: link },
        })
    }

    function xhr_getPost_id(id) {
        return $.ajax({
            url: url,
            method: 'POST',
            dataType: 'html',
            data: { getpost_id: id },
        })
    }

    function xhr_u_post(postname, category, content, dbid) {
        return $.ajax({
            url: url,
            method: 'POST',
            dataType: 'html',
            data: { u_postname: postname, dbid: dbid, u_category: category, u_content: content },
        })
    }

    function xhr_delId(id) {
        return $.ajax({
            url: url,
            method: 'POST',
            dataType: 'html',
            data: { delid: id },
        })
    }


    $(document).on("click", "#posts_button", function() {
        if( $('#p_subject').val() === "") {
            getStatus("You must have a category");
        } else if( $('#p_postname').val() === "") {
            getStatus("You must have a postname");
        } else {
            let postname = $('#p_postname').val();
            let subject = $('#p_subject').val();
            let content = $('#p_content').html();

            xhr_createPost(postname, subject, content).done(function(data) {
                var saved = "Created " + postname;
                getStatus(saved);
            })

            setTimeout(function() {
                xhr_getAllPosts("NULL").done(function(data) {
                    $('#posts').html(data);
                })
            }, 1000);
        }
    })

    $(document).on('click', ".showpost", function() {
        var link = $(this).text();
        xhr_getPost(link).done(function(data) {
            $('#p_content').html(data)
        })
    })

    $(document).on('click', ".p_edit", function() {
        $('button[class^="p_delete"]').prop('disabled', true);
        $('button[class^="p_edit"]').prop('disabled', true);

        $(this).css("background-color", "rgb(96 34 67 / 62%");

        var dbid = $(this).attr('value');

        xhr_getPost_id(dbid).done(function(data) {
            $('#p_content').html(data);
        })

        var buttonname = $('#posts_button');
        buttonname.val("Update");

        var link_name = $(this).attr('value3');
        var filename = $('#p_postname');
        filename.val(link_name);

        var filecat = $(this).attr('value2');
        var fcat = $('#p_subject');
        fcat.val(filecat);

        $('#posts_button').attr('id', 'p_newlinkname');
        $('#p_newlinkname').attr('value2',dbid);
    })

    $(document).on('click', "#p_newlinkname", function() {
        let postname = $('#p_postname').val();

        var fcat = $('#p_subject');
        let category = fcat.val();

        let content = $('#p_content').html();
        var dbid = $('#p_newlinkname').attr('value2');

        xhr_u_post(postname, category, content, dbid).done(function(data) {
            getStatus("Updated: "+postname);
        })

        $('button[class^="p_delete"]').prop('disabled', false);
        $('button[class^="p_edit"]').prop('disabled', false);

        $(".p_edit").css("background-color", "rgb(96 34 67 / 62%");
        var filename = $('#p_postname');
        filename.val("");

        var fcat = $('#p_subject');
        fcat.val("");

        $('#p_newlinkname').attr('id','posts_button');
        var linkname = $('#posts_button');
        linkname.val("Create");

        setTimeout(function() {
            xhr_getAllPosts("NULL").done(function(data) {
                $('#posts').html(data);
            })
        }, 1000);

    })

    $(document).on('click', ".p_delete", function() {
        var id = $(this).attr('value');
        xhr_delId(id).done(function(data) {
            getStatus(data);

            setTimeout(function() {
                xhr_getAllPosts("NULL").done(function(data) {
                    $('#posts').html(data);
                })
            }, 1000);

        })
    })
})