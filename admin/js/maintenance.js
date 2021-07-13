jQuery(document).ready(function () {

    let url = window.location.protocol + "//" + window.location.host + '/admin/db/admindb.php';

    $.ajax({
        url: url,
        method:  "GET",
        data: { m_check: "status"},
        success: function(data) {
            if( data == 1) {
                if( localStorage.getItem('Logged In') ) {
                    localStorage.Maintenance = JSON.stringify("on")
                    console.log("Maintenance enabled and Logged In")
                } else {
                    window.location.href = "admin/maintenance.php";
                }
            }
        }
    })
        
    var m_button = document.getElementById('m_enable');

    if ( localStorage.Maintenance ) {
        if( JSON.parse(localStorage.Maintenance) == 'on') {
            $("#m_enable").html("Maintenance Enabled")
        } else {
            localStorage.Maintenance = JSON.stringify("off")
            $("#m_enable").html("Maintenance Disabled")
        }
    } else {
        localStorage.Maintenance = JSON.stringify("off")
        $("#m_enable").html("Maintenance Disabled")
    }

    function toggle_maintenance() {
        if ( JSON.parse(localStorage.Maintenance) == "off" ) {
            $("#m_enable").html("Maintenance Enabled")

            let value = 1;
            $.ajax({
                url: url,
                method: 'POST',
                data: { maintenance: value },
            });
            localStorage.Maintenance = JSON.stringify("on")
        } else {
            $("#m_enable").html("Maintenance Disable")
            let value = 0;
            $.ajax({
                url: url,
                method: 'POST',
                data: { maintenance: value },
            })
            localStorage.Maintenance = JSON.stringify("off")
        }
    }

    $(document).on('click', "#m_enable", function() {
        toggle_maintenance();
    });

})