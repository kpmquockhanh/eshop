$('#addToken').submit(function (e) {
    e.preventDefault();
    let token = $('#addToken input').val();
    let url = $('#addToken').attr('data-url');
    axios.post(url, {
        token: token
    }).then(function (res) {
        if (res.data.success)
        {
            // $("#addToken").parent().parent().fadeOut();
            $("#addToken input").prop('disabled', true);
            $("#addToken button").slideUp();
            $.notify({
                icon: "nc-icon nc-bell-55",
                message: "<b>Success</b>! Update token successfully!"

            }, {
                type: 'success',
                timer: 1000,
            });


        }
    })

});

$('#editToken').click(function (e) {
    e.preventDefault();
    $("#addToken input").prop('disabled', false);
    $("#addToken button").fadeIn();
});
