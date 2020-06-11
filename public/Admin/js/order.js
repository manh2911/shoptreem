$(document).ready(function(){
    changeStatusToSuccess();
    changeStatusToCancel();
    showDetail();
});

function confirmChangeStatus(status) {
    confirm("Bạn có muốn chuyển trạng thái sang [" + status + "]");
}

function changeStatusOrder(orderId, status) {
    $.ajax({
        type: 'POST',
        url: '/admin/order/change-status',
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            "orderId" : orderId,
            "status" : status
        },
        success: function(res) {
            if (res.status == true) {
                $('#btn-success-' + orderId).prop('disabled', true);
                $('#btn-cancel-' + orderId).prop('disabled', true);

                if (status == 2) {
                    $('#order-' + orderId).css("background-color", "lightgreen");
                } else if (status == 3) {
                    $('#order-' + orderId).css("background-color", "lightgray");
                } else {

                }
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Đã có lỗi xảy ra',
                    showConfirmButton: true,
                })
            }
        }
    });
}

function changeStatusToSuccess() {
    $('.status-success').click(function () {
        let orderId = $(this).data("id");
        changeStatusOrder(orderId, 2, this)
    })
}

function changeStatusToCancel() {
    $('.status-cancel').click(function () {
        let orderId = $(this).data("id");
        changeStatusOrder(orderId, 3)
    })
}

function showDetail() {
    $('.show-detail').click(function () {
        $('#classModal').modal('show')
    })

}
