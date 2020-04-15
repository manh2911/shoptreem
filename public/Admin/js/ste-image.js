function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#' + id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#input-img-icon").change(function() {
    readURL(this, 'img-icon');
    $("#img-icon").css("background", 'gray');
});

$("#input-img-slide").change(function() {
    readURL(this, 'img-slide');
});

$("#input-img-avatar").change(function() {
    readURL(this, 'img-avatar');
});

$("#input-img").change(function() {
    readURL(this, 'img-show');
});
