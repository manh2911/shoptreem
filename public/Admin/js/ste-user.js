$('#change_password').click(function () {
    $('.change_pass').removeAttr('hidden');
})

$('#select-all-item').click(function () {
    $('input:checkbox').prop('checked', this.checked);
    addItemInArrayCheckbox()
});

$(".select-one-item").change(function () {
    addItemInArrayCheckbox()
});

function addItemInArrayCheckbox() {
    var arr_chk = [];
    $(".select-one-item").each(function() {
        if ($(this).is(":checked")) {
            arr_chk.push($(this).attr("id"));
        }
    });

    $('#arr_chk').val(arr_chk);
}
