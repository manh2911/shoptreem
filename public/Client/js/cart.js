$(document).ready(function(){
    addToCart();
});

function addToCart() {
    $('.btn_add_cart').click(function () {
        let productId = $(this).data("id");
        $.ajax({
            type: 'POST',
            url: '/add-to-cart',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                "productId" : productId,
            },
            success: function(res) {


            }
        });
    })
}
