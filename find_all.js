function get_details(scheme_id) {


    $.ajax({
        type: "POST",
        url: "test.php",
        data: { scheme_id: scheme_id },
        beforeSend: function() {
            $('#joincard').addClass("disable");
        },
        success: function(data) {
            console.log(data);
            $('#joincard').removeClass("disable");
            var response = JSON.parse(data);
            $('#emamonthly').html(response.ema);
            $('#emapay').html(response.newema);
            $('#pending').html(response.pending);
            $('#totalpay').html(response.total);
            $('#Pay_final').val(response.total);

        }
    });

}