$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function confirmDelete() {
    return confirm("Are you sure ?")
}

function addItemInArrayCheckbox() {
    var arr_chk = [];
    $(".select-one-item").each(function() {
        if ($(this).is(":checked")) {
            arr_chk.push($(this).attr("id"));
        }
    });

    $('#arr_chk').val(arr_chk);
}

//select item for action
$('#select-all-item').click(function () {
    $('input:checkbox').prop('checked', this.checked);
    addItemInArrayCheckbox()
});

$(".select-one-item").change(function () {
    addItemInArrayCheckbox()
});
