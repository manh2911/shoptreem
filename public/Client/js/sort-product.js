$(document).ready(function(){
    sort();
});

function sort() {
    $('#sortProduct').change(function () {
        callFunctionSort();
    })

    $('.sortBrand').change(function () {
        callFunctionSort();
    })

    $('.submit_range').click(function () {
        callFunctionSort();
    })
}

function callFunctionSort() {
    let idCurrentCategory = $('#idCurrentCategory').val();
    let sortByName = $('#sortProduct').val();
    let sortByBrand = getBrandChecked();
    let sortByPrice = getRangePrice();
    $.ajax({
        type: 'POST',
        url: '/sort',
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            "sortByName" : sortByName,
            "sortByBrand" : sortByBrand,
            "sortByPrice" : sortByPrice,
            "idCurrentCategory" : idCurrentCategory
        },
        success: function(res) {


        }
    });
}

function getBrandChecked() {
    let brandsChecked = [];
    $('input.sortBrand:checkbox:checked').each(function () {
        brandsChecked.push($(this).data('id'));
    });

    return brandsChecked;
}

function getRangePrice() {
    let from = $('#price_from').val();
    let to = $('#price_to').val();

    return {from: from, to: to};
}
