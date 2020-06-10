$(document).ready(function(){
    addToCart();
    countProductsInCart();
    minusProduct();
    plusProduct();
    deleteProduct();
    orderNow();
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
                if (res.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        showConfirmButton: true,
                    })

                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: res.message,
                        showConfirmButton: true,
                    })
                }
            }
        });

        countProductsInCart();
    })
}

function countProductsInCart() {
    $.ajax({
        type: 'GET',
        url: '/count-products-in-cart',
        success: function(res) {
            $('.cart_qty').text(res);
        }
    });
}

function minusProduct() {
    $('.minus').click(function () {
        let productId = $(this).data("id");
        updateQuantityProduct(2, productId);
    })
}

function plusProduct() {
    $('.plus').click(function () {
        let productId = $(this).data("id");
        updateQuantityProduct(1, productId);
    })
}

function updateQuantityProduct(operator, productId) {
    let quantityNow = $('#'+productId).text();
    $.ajax({
        type: 'POST',
        url: '/update-quantity-in-cart',
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            "productId" : productId,
            "operator" : operator,
            "quantityNow" : quantityNow,
        },
        success: function(res) {
            $('#'+productId).text(res.quantityUpdate);
            let total_origin_price = res.total_origin_price.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';
            let total_discount = '-' + res.total_discount.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';
            let total_price = res.total_price.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';

            $('#total_origin_price').text(total_origin_price);
            $('#total_discount').text(total_discount);
            $('#total_price').text(total_price);
        }
    });
}

function deleteProduct() {
    $('.del').click(function () {
        let productId = $(this).data("id");
        $.ajax({
            type: 'POST',
            url: '/delete-product-in-cart',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                "productId" : productId,
            },
            success: function(res) {
                let total_origin_price = res.total_origin_price.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';
                let total_discount = '-' + res.total_discount.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';
                let total_price = res.total_price.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + ' đ';

                $('#total_origin_price').text(total_origin_price);
                $('#total_discount').text(total_discount);
                $('#total_price').text(total_price);

                let idItem = 'item-' + productId;
                $( "#" + idItem ).remove();
            }
        });

    })
}

function orderNow() {
    $('.btn_order_now').click(function () {
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
                if (res.status == true) {
                    window.location = "/order";

                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: res.message,
                        showConfirmButton: true,
                    })
                }
            }
        });

        countProductsInCart();
    })

}
