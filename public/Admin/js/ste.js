$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#submit').click(function (e) {
    var data = $('form').serialize();
    var url = $('#url').val();
    var method = $('#method').val();

    $.ajax({
        url: url,
        type: method,
        data: data,
        dataType: "html",

    }).done(function(data){
        if (data == 'true') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'error',
            })
        }

    }).fail(function(xhr,status, response) {
        var error = jQuery.parseJSON(xhr.responseText);
        var textError = '';
        for(var k in error.message){
            if(error.message.hasOwnProperty(k)){
                error.message[k].forEach(function(val){
                    textError += val + '<br>';
                });

            }
        }
        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: textError,
        })
    });
    e.preventDefault();
});

