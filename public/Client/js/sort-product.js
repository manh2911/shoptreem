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

    clickPageLink()
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

function getCurrentPage() {
    let currentPage = $('#currentPage').val();

    return currentPage;
}

function callFunctionSort(nextPage = null) {
    let idCurrentCategory = $('#idCurrentCategory').val();
    let sortByName = $('#sortProduct').val();
    let sortByBrand = getBrandChecked();
    let sortByPrice = getRangePrice();
    let currentPage = getCurrentPage();

    $.ajax({
        type: 'POST',
        url: '/sort',
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            "sortByName" : sortByName,
            "sortByBrand" : sortByBrand,
            "sortByPrice" : sortByPrice,
            "idCurrentCategory" : idCurrentCategory,
            "currentPage" : currentPage,
            "nextPage" : nextPage,
        },
        success: function(res) {
            $( ".product" ).remove();
            $( ".pagination" ).remove();

            initProducts(res.products, res.images)
            initPagination(res.countPage, res.nextPage)

        }
    });
}

function initProducts(products, images) {
    for (let i=0; i<products.length; i++) {
        let html = "               <div class=\"product\">\n" +
            "                        <div class=\"product_child\" id=\"product_child-"+ products[i].id +"\">\n" +
            "                            <div class=\"pro_img\">\n" +
            "                                <a href=\"/product/"+ products[i].id +"\" target=\"_blank\"\n" +
            "                                   title=\""+ products[i].id +"\"><img\n" +
            "                                        src=\""+ images[i].image +"\"\n" +
            "                                        alt=\""+ products[i].name +"\"></a>\n" +
            "                            </div>\n" +
            "                            <h3 class=\"name_pro\">\n" +
            "                                <a href=\"/product/"+ products[i].id +"\" target=\"_blank\"\n" +
            "                                   title=\""+ products[i].name +"\">\n" +
            "                                    "+ products[i].name +"\n" +
            "                                </a>\n" +
            "                            </h3>\n" +
            "                            <div class=\"product_price\" id=\"product_price-"+ products[i].id +"\">\n" +
            "                                <span class=\"price_item\" id=\"price_item-"+ products[i].id +"\">\n" +
            "                                </span>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>"


        $('.list_item_cate').append(html);

        $('#price_item-' + products[i].id).html(showPrice(products[i].origin_price, products[i].discount));

        let originPrice = products[i].origin_price.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0})
        if (products[i].discount != 0) {
            $('#product_price-' + products[i].id).append('<span class="old_price">'+ originPrice +'</span>');
            $('#product_child-' + products[i].id).append('<span class="discount">-'+ products[i].discount +'%</span>');
        }
    }
}

function showPrice(origin_price, discount) {
    let priceShow = calculatorPrice(origin_price, discount);
    priceShow = priceShow.toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0})
    return priceShow + 'đ';
}

function calculatorPrice(origin_price, discount) {
    let price = origin_price - (origin_price * discount / 100);

    return Math.ceil(price/1000)* 1000;
}

function initPagination(countPage, page) {
    let html = '<div class=\"clear\"></div> ' +
        '       <div class="pagination">\n' +
        '          <ul>\n' +
        '              <nav>\n' +
        '                 <ul class="pagination" id="pagination-page">\n' +
        '                 </ul>\n' +
        '             </nav>\n' +
        '         </ul>\n' +
        '       </div>'
    $('#product_cate').append(html);
    $('#currentPage').val(page);
    appendPrevious(countPage, page);
    appendPages(countPage, page);
    appendNext(countPage, page);
    clickPageLink();
}

function appendPrevious(countPage, page) {
    let pre = '<li class="page-item page-sort" id="previous" data-value="previous">\n' +
        '         <a class="page-link" rel="prev" aria-label="« Previous">‹</a>\n' +
        '      </li>'
    $('#pagination-page').append(pre);
    if (page == 1) {
        $('#previous').addClass('disabled');
    } else {
        $('#previous').removeClass('disabled');
    }
}

function appendPages(countPage, page) {
    for (let i = 1; i <= countPage; i++) {
        let pageNumber = '<li class="page-item page-sort" id="page-item-' + i + '" data-value="' + i + '"><a class="page-link">' + i + '</a></li>';
        $('#pagination-page').append(pageNumber);
        if (i == page) {
            $('#page-item-' + i).addClass('active');
        }
    }
}

function appendNext(countPage, page) {
    let next = '<li class="page-item page-sort" id="next" data-value="next">\n' +
        '          <a class="page-link" rel="next" aria-label="Next »">›</a>\n' +
        '       </li>'
    $('#pagination-page').append(next);
    if (page == countPage) {
        $('#next').addClass('disabled');
    } else {
        $('#next').removeClass('disabled');
    }
}

function clickPageLink() {
    $( ".page-sort" ).click(function(event) {
        let nextPage = $(this).data('value');
        callFunctionSort(nextPage);
    });
}
