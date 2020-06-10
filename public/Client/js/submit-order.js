$(document).ready(function(){
    submitOrder();
});

function submitOrder() {
    $('.btnHoanTatCart').click(function (e) {
        e.preventDefault();
        if ($('.item-in-cart').length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Không có sản phẩm trong giỏ hàng',
                showConfirmButton: true,
            });

            return;
        } else if ($('#name').val() == '' || $('#address').val() == '' || $('#phone').val() == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Bạn phải nhập đầy đủ thông tin',
                showConfirmButton: true,
            });

            return;
        } else {
            let name = $('#name').val();
            let address = $('#address').val();
            let phone = $('#phone').val();
            let delivery_time = $('input[name="delivery_time"]:checked').val();

            $.ajax({
                type: 'POST',
                url: '/postOrder',
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    "name" : name,
                    "address" : address,
                    "phone" : phone,
                    "delivery_time" : delivery_time,
                },
                success: function(res) {
                    if (res.status == true) {
                        Swal.fire({
                            icon: 'success',
                            title: res.message,
                            showConfirmButton: true,
                        }).then(function() {
                            window.location = "/";
                        });

                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: res.message,
                            showConfirmButton: true,
                        })
                    }
                }
            });
        }
    })
}
