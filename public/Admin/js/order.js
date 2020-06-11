$(document).ready(function(){
    changeStatusToSuccess();
    changeStatusToCancel();
    showDetail();
});

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
                    $('#status-' + orderId).text('Success');
                } else if (status == 3) {
                    $('#order-' + orderId).css("background-color", "lightgray");
                    $('#status-' + orderId).text('Cancel');
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
        if (confirm('Bạn có muốn chuyển trạng thái sang [SUCCESS]')) {
            let orderId = $(this).data("id");
            changeStatusOrder(orderId, 2, this)
        } else {
            return;
        }
    })
}

function changeStatusToCancel() {
    $('.status-cancel').click(function () {
        if (confirm('Bạn có muốn chuyển trạng thái sang [CANCEL]')) {
            let orderId = $(this).data("id");
            changeStatusOrder(orderId, 3)
        } else {
            return;
        }

    })
}

function showDetail() {
    $('.show-detail').click(function () {
        $('#classModal').modal('show');
        let orderId = $(this).data("id");
        $.ajax({
            type: 'POST',
            url: '/admin/order/show-detail',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                "orderId" : orderId,
            },
            success: function(res) {
                $("#classTable > tbody").empty();

                if (res.status == true) {
                    let order = res.order; // append info order
                    let total_origin_price = order.total_origin_price.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';
                    let total_discount = order.total_discount.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';
                    let total_price = order.total_price.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';
                    $('#total_origin_price').text(total_origin_price);
                    $('#total_discount').text(total_discount);
                    $('#total_price').text(total_price);
                    $('#receiver').text(order.name);
                    $('#phone').text(order.phone);
                    $('#address').text(order.address);

                    let items = res.items; // append info order items
                    let nameProducts = res.nameProducts;
                    let imageProducts = res.imageProducts;
                    for (let i = 0; i < items.length; i++) {
                        let origin_price = items[i].origin_price.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';
                        let discount_price = items[i].discount_price.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';
                        let last_price = items[i].last_price.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';

                        let html = " <tr>\n" +
                            "            <td>"+ (i + 1) +"</td>\n" +
                            "            <td><img class=\"img-order-item\" src="+ imageProducts[i] +"></td>\n" +
                            "            <td>"+ nameProducts[i] +"</td>\n" +
                            "            <td>"+ items[i].quantity +"</td>\n" +
                            "            <td>"+ origin_price +"</td>\n" +
                            "            <td>"+ discount_price +"</td>\n" +
                            "            <td>"+ last_price +"</td>\n" +
                            "        </tr>"

                        $("#classTable tbody").append(html);
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

    })

}


