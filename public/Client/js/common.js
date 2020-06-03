$(document).ready(function () {
    //hien thi san pham ban da xem
    setgototop();
    $(window).scroll(function () {
        setgototop();
    });
    //if ($(".address-item-box").length > 0) {
    //    $(".address-item-box:eq(1)").css({ 'margin-bottom': "100px" });
    //}
    $('.navibar-top-1 .address-count').hover(function () {
        OpenBoxAddress($(this));
        $('.navibar-top-1 .address-list-box').show();
    });
    $('.navibar-top-1 .address-list-box').mouseleave(function () {
        $('.navibar-top-1 .address-list-box').hide();
    });
    $(".address-list-content .p-address-item .count-address span").each(function (index) {
        $(this).text(index + 1);
        if (index + 1 >= 10) {
            $(this).css({ 'left': "1px" });
        }
    });
    $(".address-list-content").perfectScrollbar();
});

function setgototop() {
    var scrPos = $(window).scrollTop();
    if (scrPos !== 0) {
        $(".go-top-desktop").fadeIn();
    } else {
        $(".go-top-desktop").fadeOut();
    }

    if ($("#home-header-wr").length > 0) {
        if (scrPos > 800 && !$("#home-header-wr").is(".dock-header-box")) {
            $("#home-header-wr").addClass("dock-header-box");
            $(".menu-floor-title-wr").addClass("dock-menu-box");
        } else if (scrPos < 200 && $("#home-header-wr").is(".dock-header-box")){
            $("#home-header-wr").removeClass("dock-header-box");
            $(".menu-floor-title-wr").removeClass("dock-menu-box");
        }
    }
}

function addSearchHandler(txtCondition, autoComplete, url) {
    var txt = $(txtCondition);

    if (txt.length > 0) {
        if (autoComplete) {
            $(txt).autocomplete(url, {
                dataType: "json",
                scroll: false,
                minChars: 2,
                noRecord: '',
                selectFirst: false,
                cacheLength: 0,
                clickFire: true,
                parse: function (data) {
                    return jQuery.map(data, function (au) {
                        return {
                            data: au,
                            label: au.Name,
                            value: au.Name,
                            result: au.Name,
                            id: au.ParentId,
                            desc: au.ParentName
                        };
                    });
                },
                formatItem: function (doc) {
                    return formatForDisplay(doc);
                },
                _renderMenu: function (ul, items) {
                    var that = this;
                    $.each(items, function (index, item) {
                        that._renderItemData(ul, item);
                    });
                    $(ul).find("li:odd").addClass("abc");
                }
            }).result(function (e, doc) {
                $("#btnSearch").click();
            });
        }

        function formatForDisplay(doc) {
            var rt = "<span class='suggest-keyword'>" + doc.Name + "</span>";
            if (doc.ParentName != null && doc.ParentName != '')
                rt = "";
            //if (doc.ParentName != null && doc.ParentName != '')
            //    rt += "<span class='concat-keyword'>trong danh mục</span><span class='parent-keyword'>" + doc.ParentName + "</span>";
            return rt;
        }

        txt.focus(function () {
            $(this).css({ 'border-color': '#fff', 'box-shadow': 'none', '-webkit-box-shadow': 'none' });
        });
        txt.click(function () {
            $('.b-InputSearch .dropdown-search').removeClass('dropdown-search').addClass('dropdown-searchActive');
            //tao border cho o tim kiem
            $(this).css({ 'border-color': '#fff', 'box-shadow': 'none', '-webkit-box-shadow': 'none' });
            //var patxtSeach = $(this).parent().parent().parent().parent();
            //if (patxtSeach.length > 0)
            //patxtSeach.css({ "border": "1px solid #e49747", 'border-radius': '5px 3px 2px 5px' });
            $('.dropdown-search').css("border-top", "1px solid #e49747");
        });
        txt.blur(function () {
            $('.b-InputSearch .dropdown-searchActive').removeClass('dropdown-searchActive').addClass('dropdown-search');
            var patxtSeach = $(this).parent().parent().parent().parent();
            if (patxtSeach.length > 0)
                patxtSeach.css({ "border": "none", 'border-radius': '0' });
            $('.dropdown-search').css("border-top", "none");
        });
    }
}

function SetTinhThanhCookie(url) {

    $.ajax({
        type: "GET",
        url: url,
        cache: false,
        contentType: "text/plain",
        success: function (data) {
            if (data === '1') {
                window.location.reload();
            }
        }
    });
}

function ShowMenuHomePage() {
    $('.box-menu-lv1 ul > li').hover(function () {
        $('.d-overlay').show(); //hien background
        $('.box-navibar').addClass('pos-topheader ');
        $('.topheader').addClass('pos-topheader ');
        $('.box-submenu').show();
        $('.box-menu-lv1').css({ 'background': '#fce2ec' });
        $('.box-menu-lv1 ul > li').removeClass("menu-lv1-active");
        $(this).addClass('menu-lv1-active');
        //show menu cap 2
        $('.box-submenu').hide();
        var item = $(this).attr('id');
        $('#submenu-' + item).show();
    });
}

function ShowMenuHover() {
    $('.box-dmsp').hover(function () {
        $('.box-menu').show();
        $('.d-overlay').show();//hien background
        $('.box-navibar').addClass('pos-topheader');
        $('.topheader').addClass('pos-topheader ');
        //active menu cap 1 dau tien
        $('.box-menu-lv1 ul li').removeClass('menu-lv1-active');
        $('.box-menu-lv1 ul li:first-child').addClass('menu-lv1-active');
        $('.box-menu-lv1').css({ 'background': '#fce2ec' });
        var attr = $('.box-menu-lv1 ul > li').first().attr('id');
        $('#submenu-' + attr).show();
    }, function () {
        $('.box-menu').hide();
        $('.d-overlay').hide();
        $('.box-navibar').removeClass('pos-topheader');
    });
}

function SetHrefFilter() {
    var urlPro, urlAge = "";
    $('.provider-menu ul > li').hover(function () {
        var data = $(this).find('a').attr("dataitem");
        var href = $(this).find('a').attr("href");
        urlPro = href;
        $(this).find('a').attr('href', href + data);
    }, function () {
        $(this).find('a').attr('href', urlPro);
    });

    $('.age-menu ul > li').hover(function () {
        var data = $(this).find('a').attr("dataitem");
        var href = $(this).find('a').attr("href");
        urlAge = href;
        $(this).find('a').attr('href', href + data);
    }, function () {
        $(this).find('a').attr('href', urlAge);
    });
}

function setPositionMatchParent(cmd, parent) {
    //alert(cmd.text())
    var leftReturn = 0;
    var leftW = cmd.position().left + (cmd.width() / 2); /*khoang cach tu dien bat dau den vi tri can truot*/
    //alert(cmd.width() / 2);
    var iconW = $(parent).find('.icon-line-match').width() / 2; /*do dai cua icon lay dien giua*/
    leftReturn = leftW - iconW; //den vi tri bat ki
    $(parent).find('.icon-line-match').animate({
        left: leftReturn + 'px'
    });
}

function activeInitSlide() {
    var last = $('.slide-top .slide-navigator a:last');
    var cnt = $('.slide-top .slide-navigator a').index(last);
    var id = Math.round(Math.random() * cnt);
    $('.slide-top .nv-clickItem:eq(' + id + ')').addClass('btactive');
    $('.slide-top .slide-content .slide-image:eq(' + id + ')').css({ 'display': 'block' });
    var parent = $('.slide-top');
    setPositionMatchParent($('.slide-top .slide-navigator .nv-clickItem:eq(' + id + ')'), parent);
}

function SetSildeHome() {
    var htitle = $('.slide-navigator').height();
    var hbox = $('.slide-content').height();
    var hbt = $('.slide-btn').height();
    var wbn = $('.slide-content img').width();
    if (wbn == 0) { wbn = 660; }
    $('.slide-btn').css({ "top": (hbox - hbt) / 2 + htitle });

    activeInitSlide();

    $('.slide-navigator .nv-clickItem').click(function () {
        var parent = $(this).parent().parent();
        var id = $(parent).find('.slide-navigator a').index(this);
        $(parent).find('.slide-navigator a').removeClass("btactive");
        $(parent).find('.slide-content .slide-image').hide();
        $(parent).find(this).addClass('btactive');
        $(parent).find('.slide-content .slide-image:eq(' + id + ')').css({ 'left': 0 });
        $(parent).find('.slide-content .slide-image:eq(' + id + ')').fadeIn();
        setPositionMatchParent($(parent).find('.slide-navigator .nv-clickItem:eq(' + id + ')'), parent);
    });

}

function ShowLoading(element, position) {
    if (element.length > 0) {
        element.append("<div class='loading-icon' style='position: " + position + "'></div>");
        //element.css("position", "relative");
    }
}

function HideLoading(element) {
    if (element.length > 0) {
        element.find(".loading-icon").remove();
    }
}

//thay doi url theo tieu chi loc
function ReplaceFilterUrl(url) {
    window.history.replaceState(null, null, url);
}

var classShowed = '';
function ShowBox(chk, className, typeSend) {
    if ($(className).length === 0) return;
    /*Can giua box-login*/
    if (typeSend !== 'send-email') {
        fixCenterBox(className);
    }
    $($(className)[0]).show();
    classShowed = className;
    $('.d-overlay').show();


    if (chk) {
        $('.d-overlay').unbind('click');
    } else {
        $('.d-overlay').click(function () {
            HideBox();
        });
    }
}

//show box fadeIn
var classShowedFadeIn = '';
function ShowBoxFadeIn(chk, className, typeSend) {
    if ($(className).length == 0) return;
    /*Can giua box-login*/
    if (typeSend != 'send-email') {
        fixCenterBox(className);
    }
    $(className).fadeIn(600);
    classShowedFadeIn = className;
    $('.d-overlay').show();


    if (chk) {
        $('.d-overlay').unbind('click');
    } else {
        $('.d-overlay').click(function () {
            HideBoxFadeOut();
        });
    }
}

//hide box fadeOut
function HideBoxFadeOut() {
    if (classShowed != '') {
        $(classShowed).fadeOut(400);
        $('.d-overlay').hide();
    }
}

function HideBox() {
    if (classShowed != '') {
        $(classShowed).hide();
        $('.d-overlay').hide();
    }
}

function HideBoxClass(className) {
    if (className != '') {
        $(className).hide();
        $('.d-overlay').hide();
    }
}
function fixCenterBox(box) {
    var kichThuocBrowser = $(window).width();
    var kichThuocBox = $(box).outerWidth();
    var caoThuocBrowser = $(window).height();
    var caoThuocBox = $(box).outerHeight();
    var fixLeft = (kichThuocBrowser - kichThuocBox) / 2;
    var fixTop = (caoThuocBrowser - caoThuocBox) / 2;
    //fix độ cao box giỏ hàng
    //if (box == '.m-cart-box-content') {
    //    $(box).css({ 'left': fixLeft, 'position': 'fixed' });
    //} else {
    $(box).css({ 'left': fixLeft, 'top': fixTop, 'position': 'fixed' });
    //}

}

function ProvinceChange(obj, url) {
    var cityId = $(obj).val();
    var tenTt = $(obj).find("option:selected").text();
    $(".list-district").load(url, { cityId : cityId }, function () {
        $("#TenTinhThanh").val(tenTt);
        var tenQh = $('#QuanHuyenId option:selected').text();
        $("#TenQuanHuyen").val(tenQh);
    });
}

function InfoCustomerNavibar(urlcus) {
    $(".customer-login-info").load(urlcus, function() {
        var cusInfo = $(".customer-login-info").find("#customerInfo").html();
        if (cusInfo !== undefined && cusInfo !== null && cusInfo !== "") {
            $(".customer-login-info").find("#customerInfo").hide();
            $(".login-top-hover").html(cusInfo);
            $(".customer-login-info").hide();
        }
    });
}

function GetProductFavourite(urlfav) {
    $("#pro-fav").load(urlfav);
}

function GetListCartNavibar(urlcart) {
    $(".boxorder").load(urlcart, function () {
        window.prettyPrint && prettyPrint();
        $(".scrollbar").scrollbar();
    });
}

function OpenPopupFull(url, windowName, width, height, top, left, extras, scrollbars) {
    var additional = extras;
    var newWindow = window.open(url, windowName, 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left + ',features=' + additional + ',location=0,scrollbars=' + scrollbars);
    newWindow.focus();
}

var newWindowPoll;
function OpenPopupPollFull(url, windowName, width, height, top, left, extras, scrollbars) {
    var additional = extras;
    newWindowPoll = window.open(url, windowName, 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left + ',features=' + additional + ',location=0,scrollbars=' + scrollbars);
    newWindowPoll.focus();
}

function CloseWindow() {
    newWindowPoll.close();
}

function HuongDanChiTiet(pId) {
    OpenPopupFull('/chi-tiet-huong-dan-' + pId, 'ChiTietHuongDan', '650', '600', '0', '0', '0', '1');
}

function TroGiupChiTiet(url) {
    OpenPopupFull('/tro-giup/' + url, 'ChiTietTroGiup', '650', '600', '0', '0', '0', '1');
}

function KhaoSat() {
    OpenPopupPollFull('/khao-sat', 'KhaoSatKhachHang', '500', '600', '0', '0', '0', '1');
}

$(document).ready(function () {
    RemoveDotSearch();
    //SetBannerTopCenter();
    $(window).resize(function () {
        RemoveDotSearch();
        //SetBannerTopCenter();
    });

    var id = "";
    $('#banner-list a').each(function () {
        var idItem = $(this).find('#hdBannerId').val();
        id += idItem + "-";
    });
    var url = $('#hdBannerViewUpdateUrl').val();
    if (url === "" || url === undefined) return;
    UpdateBannerView(url, id);
});
//SetBannerTopCenter();
//$(window).resize(function () {
//    SetBannerTopCenter();
//});
//function SetBannerTopCenter()
//{
//    //$('.header-top-banner a').css("padding-left", ($(window).width() - $('.header-top-banner a img').width()) / 2);
//}

function RemoveDotSearch() {
    if ($(".header-list-tag ul li").length > 0) {
        var obj = $(".header-list-tag ul li:last-child").find("a:eq(0)");
        obj.text(obj.text().replace(',', ''));
    }

    if ($(".header-list-tag ul li").length > 0) {
        var widthUl = $(".header-list-tag ul").width();
        var totalWidthLi = 0;
        $(".header-list-tag ul li").each(function (idx) {
            if (idx == 0) {
                totalWidthLi += $(this).width() + 3;
            } else {
                totalWidthLi += $(this).width() + 6;
            }
            if (totalWidthLi > widthUl) {
                var obj = $(this).prev().find("a:eq(0)");
                obj.text(obj.text().replace(',', ''));
            }
        });
    }
}

function ProvinceChangeOrderAddress(obj, url) {
    var cityId = $(obj).val();
    var tenTt = $(obj).find("option:selected").text();
    $(obj).parent().parent().find('.list-district').load(url, { cityId: cityId }, function () {
        $('#TenTinhThanh').val(tenTt);
        var tenQh = $(obj).parent().parent().find('#QuanHuyenId option:selected').text();
        $('#TenQuanHuyen').val(tenQh);
    });
}


function GetNameDistrictOrder(obj) {
    var tenQh = $(obj).find("option:selected").text();
    if (tenQh)
        $('#TenQuanHuyen').val(tenQh);
}

function LoadCartInfo(obj, proId, sizeCode, colorId, quantityBuy) {
    var url = $(obj).data("url");
    if (url){
        $.ajax({
            type: "GET",
            url: url,
            data: { proId: proId, sizeCode: sizeCode, colorId: colorId, quantityBuy: quantityBuy },
            success: function (data) {
                if (data != null && data !== "") {
                    $(".m-cart-box-content").html(data);
                    ShowBox(true, ".m-cart-box-content");
                }
                if (proId) {
                    GetListCartNavibar($("#hfGetListCartNavibarV2").val());
                }
            }
        });
    }
}

function ShowProductIntro(url) {
    $.ajax({
        type: "GET",
        url: url,
        beforeSend: function () {
            if ($('#m-pro-intro-box').find('#m-pro-intro').length === 0) {
                ShowLoading($('#m-pro-intro-box'), 'fixed');
            }
        },
        success: function (data) {
            if (data.indexOf('m-pro-intro-list') > 0)
                $('#m-pro-intro-box').show();
            if ($('#m-pro-intro-box').find('#m-pro-intro').length === 0) {
                $('#m-pro-intro-box').append(data);
                BidingLazyload();
                HideLoading($('#m-pro-intro-box'));
                if ($(".m-pro-intro-title").length > 0) {
                    $('html, body').animate({
                        scrollTop: $(".m-pro-intro-title").offset().top - 80
                    }, 2000);
                }
            }

        }
        //complete:
    });
}

function CloseCart(urlcart, isShow, obj) {
    var urlCart = $(obj).attr('idata');
    GetCartListInOrder(urlCart);
    var url = $('#hdLoadProUrl').val();
    if (isShow === "1" && url !== undefined && url!=="") {
        ShowProductIntro(url);
    }
    HideBox('.m-cart-box');
    //update gio hang
    GetListCartNavibar(urlcart);
}

function GetCartListInOrder(url) {
    $.ajax({
        url: url,
        cache: false,
        success: function (data) {
            if (data.length > 0) {
                $('.right-order').find('.m-box-cart-info').remove();
                $('.right-order').prepend(data);
            }
        }
    });
}

function ChangeQuan(obj, proId, sizeId, colorId, ts) {
    var url = $(obj).parent().find('#hdUrl').val();
    var productId = $(obj).parent().find('#hdProItemId').val();
    var newQua = $(obj).find("option:selected").val();
    var price = $(obj).parent().find('#hdPrice').val().replace(/\./g, '');
    var newTotal = parseInt(newQua) * parseFloat(price);
    var itemTotal = $(obj).parent().parent().parent().find('.itemMoney');
    itemTotal.text(newTotal).format({ format: "#,###", locale: "vn" });
    itemTotal.attr("idata", itemTotal.text());
    var money = 0;
    $.ajax({
        url: url,
        data: { productId: productId, sizeId: sizeId, colorId: colorId, quantityToBuy: newQua },
        success: function (data) {
            $("#hdTamTinh").html(data.TotalPriceRootStr);
            if (data.KhuyenMai <= 0) {
                $("#hdKhuyenMai").parent().hide();
            } else {
                $("#hdKhuyenMai").html(data.KhuyenMaiStr);
            }
            if (data.TheGiamGia <= 0) {
                $("#hdTheGiamGia").parent().hide();
            } else {
                $("#hdTheGiamGia").html(data.TheGiamGiaStr);
            }
            if (data.TheGiamGia <= 0 && data.KhuyenMai <= 0) {
                $("#hdDivTamTinh").hide();
            }
            $('.m-total-cart b').html(data.TongTienStr);
            $('.m-total-cart b').attr('idata', data.TongTienStr);
            $('.m-total-cart b').fadeOut(500).fadeIn(500);
            $('#hdCountPro').html(data.TotalProduct);
        },
        error: function () {
            console.log('Đã có lỗi xảy ra!');
        }
    });
}

function DeleteCart(obj, url, proId, sizeId, order) {
    if (!confirm('Bạn chắc chắn không mua sản phẩm này nữa?')) {
        return false;
    } else {
        $.ajax({
            type: "POST",
            url: url,
            success: function(data) {
                $("#hdTamTinh").html(data.TotalPriceRootStr);
                if (data.KhuyenMai <= 0) {
                    $("#hdKhuyenMai").parent().hide();
                } else {
                    $("#hdKhuyenMai").html(data.KhuyenMaiStr);
                }
                if (data.TheGiamGia <= 0) {
                    $("#hdTheGiamGia").parent().hide();
                } else {
                    $("#hdTheGiamGia").html(data.TheGiamGiaStr);
                }
                if (data.TheGiamGia <= 0 && data.KhuyenMai <= 0) {
                    $("#hdDivTamTinh").hide();
                }
                $('.m-total-cart b').html(data.TongTienStr);
                $('.m-total-cart b').attr('itemprop', data.TongTien);
                $('.m-total-cart b').fadeOut(500).fadeIn(500);
                $('#hdCountPro').html(data.TotalProduct);
                if (data.TotalProduct == 0) {
                    window.location.reload();
                    HideBox('.m-cart-box');
                }
            }
        });
        $(obj).parent().parent().remove();
    }
}

function ShowProductFavoriteByCate(page, obj, cateId, isFavorite, reItem) {
    var url = $('#hdUrlGetByCate').val();
    $('.m-pages-pro-list').load(url, { page: page, cateId: cateId, isFavorite: isFavorite, reItem: reItem }, function () {
        $(obj).parent().parent().find('.m-pages-cate-item a').each(function () {
            if ($(this).is(obj)) {
                $(this).addClass('bold-weight');
            } else {
                $(this).removeClass('bold-weight');
            }
        });
    });
}

function UpdateValueLike(url) {
    $("#shop-like").load(url);
}

function SetBorder() {
    var left = $('.news-content-left').height();
    var right = $('.news-content-right').height();
    if (left > right) {
        $('.news-content-left').css('border-right', '1px solid #dcdcdc');
        $('.news-content-right').css('border-left', 'none');
    }
    else {
        $('.news-content-right').css('border-left', '1px solid #dcdcdc');
        $('.news-content-left').css('border-right', 'none');
    }
}

function HideFlashMsgBox(container) {
    clearTimeout(theTimeoutFlashMsgBox);
    $(container).hide('blind');
    $(container).html('');
}

var theTimeoutFlashMsgBox;
function FlashMsgBox(container, message, type) {
    if (container == null || container == '') {
        container = ".flashmsgbox";
    }
    if ($(container).length <= 0)
        $('body').prepend('<div class="overlay-white"></div><div class="flashmsgbox"></div>');

    if (!$(container).is('.flashmsgbox'))
        $(container).addClass('flashmsgbox');

    if (type == '' || type == null)
        type = 'inf';

    var str = '<div class="content ' + type + '">' + '<i></i><span>' + message + '</span>' + '</div>';
    $(container).html(str);

    var mtop = ($(window).height() - $(container).height()) / 2;
    var mleft = ($(window).width() - $(container).width()) / 2;

    $(container).css({
        display: 'none',
        top: mtop + 'px',
        left: mleft + 'px'
    });
    $(container).fadeIn('slow');

    theTimeoutFlashMsgBox = setInterval(function () {
        HideFlashMsgBox(container);
        HideFlashMsgBox(".overlay-white");
    }, 4000);

    $(container).click(function () {
        HideFlashMsgBox(container);
        HideFlashMsgBox(".overlay-white");
    });
}

function FlashMsgBoxError(container, message, type) {
    if (container == null || container == '') {
        container = ".flashmsgboxerror";
    }
    if ($(container).length <= 0)
        $('body').prepend('<div class="overlay-white"></div><div class="flashmsgboxerror"></div>');

    if (!$(container).is('.flashmsgboxerror'))
        $(container).addClass('flashmsgboxerror');

    if (type == '' || type == null)
        type = 'inf';

    var str = '<div class="content ' + type + '">' + '<i></i><span>' + message + '</span>' + '</div>';
    $(container).html(str);

    var mtop = ($(window).height() - $(container).height()) / 2;
    var mleft = ($(window).width() - $(container).width()) / 2;

    $(container).css({
        display: 'none',
        top: mtop + 'px',
        left: mleft + 'px'
    });
    $(container).fadeIn('slow');

    theTimeoutFlashMsgBox = setInterval(function () {
        HideFlashMsgBox(container);
        HideFlashMsgBox(".overlay-white");
    }, 6000);

    $(container).click(function () {
        HideFlashMsgBox(container);
        HideFlashMsgBox(".overlay-white");
    });
}

function LoadCartDefaultNew() {
    var url = '/Pages/Ajax/CartInfo.ashx?timespan=' + Number(new Date());
    $.get(url, function (data2) {
        $('.count-pro').text(data2);
        if (data2 == 0) {
            $('#boxListCart').hide();
            $('.row-total').text("Vui lòng chọn sản phẩm").css({ 'font-size': '15px' });
            $('.xemdonhang').hide();
        }
    });
}

//set slide provider home
function activeInitSlideProviderHome() {
    var last = $('.pro-flr-provider .prov-slide-navigator ul li:last');
    var cnt = $('.pro-flr-provider .prov-slide-navigator ul li').index(last);
    var id = Math.round(Math.random() * cnt);
    $('.pro-flr-provider .prov-slide-navigator ul li').removeClass("m-ads-img-active");
    $('.pro-flr-provider .nv-clickItem:eq(' + id + ')').addClass('m-ads-img-active');
    $('.pro-flr-provider .flr-prov-list .provider-list2:eq(' + id + ')').css({ 'display': 'block' });
}

function SetSlideProviderHome() {
    var htitle = $('.pro-flr-provider .prov-slide-navigator').height();
    var hbox = $('.pro-flr-provider  .flr-prov-list').height();
    var hbt = $(' .slide-btn').height();
    var wbn = $('.pro-flr-provider').width();
    if (wbn == 0) { wbn = 135; }
    $(' .slide-btn').css({ "top": (hbox - hbt) / 2 + htitle });


    activeInitSlideProviderHome();
    var intervalClick = SetInterval();
    $('.pro-flr-provider .flr-prov-back').click(function () {
        var countItem = $(this).parent().find('.flr-prov-list .provider-list2').length;
        var widthProList = countItem * 190;
        var parent = $(this).parent();
        var itemActive = $(parent).find('.prov-slide-navigator .m-ads-img-active');
        var itemLast = $(parent).find('.prov-slide-navigator ul li:last');
        var idLast = $(parent).find('.prov-slide-navigator ul li').index(itemLast);
        var id = $(parent).find('.prov-slide-navigator ul li').index(itemActive);
        var idPr;
        var idNx;
        if (id == 0) {
            idNx = id;
            id = idLast;
            idPr = idLast - 1;
        }
        else {
            idNx = id;
            id = id - 1;
            idPr = id - 1;
        }
        var left = -(162 * id);
        $(parent).find('.prov-slide-navigator ul li').removeClass("m-ads-img-active");
        $(parent).find('.prov-slide-navigator .nv-clickItem:eq(' + id + ')').addClass('m-ads-img-active');
        if (left == 0) {
            $(parent).find('.flr-prov-list').css({ 'width': widthProList, 'position': 'absolute', '-webkit-transform': 'translate3d(' + left + 'px, 0px, 0px) ', '-webkit-transition': '0.5s', 'transition': '0.5s', '-webkit-backface-visibility': 'hidden' });
        } else {
            $(parent).find('.flr-prov-list').css({ 'width': widthProList, 'position': 'absolute', '-webkit-transform': 'translate3d(' + left + 'px, 0px, 0px) ', '-webkit-transition': '0.5s', 'transition': '0.5s', '-webkit-backface-visibility': 'hidden' });
        }
    });

    $('.pro-flr-provider .flr-prov-next').click(function () {
        var countItem = $(this).parent().find('.flr-prov-list .provider-list2').length;
        var widthProList = countItem * 190;
        var parent = $(this).parent();
        var itemActive = $(parent).find('.prov-slide-navigator .m-ads-img-active');
        var itemLast = $(parent).find('.prov-slide-navigator ul li:last');
        var idLast = $(parent).find('.prov-slide-navigator ul li').index(itemLast);
        var id = $(parent).find('.prov-slide-navigator ul li').index(itemActive);
        var idPr;
        var idNx;
        if (id == idLast) {
            idNx = id;
            id = 0;
            idPr = idLast;
        }
        else {
            idNx = id;
            id = id + 1;
            idPr = id + 1;
        }
        var left = -(162 * id);
        $(parent).find('.prov-slide-navigator ul li').removeClass("m-ads-img-active");
        $(parent).find('.prov-slide-navigator .nv-clickItem:eq(' + id + ')').addClass('m-ads-img-active');
        if (left == 0) {
            $(parent).find('.flr-prov-list').css({ 'width': widthProList, 'position': 'absolute', '-webkit-transform': 'translate3d(' + left + 'px, 0px, 0px) ', '-webkit-transition': '0.5s', 'transition': '0.5s', '-webkit-backface-visibility': 'hidden' });
        } else {
            $(parent).find('.flr-prov-list').css({ 'width': widthProList, 'position': 'absolute', '-webkit-transform': 'translate3d(' + left + 'px, 0px, 0px) ', '-webkit-transition': '0.5s', 'transition': '0.5s', '-webkit-backface-visibility': 'hidden' });
        }
    });
}

function SetInterval(obj) {
    setInterval(function () {
        $(obj).find('.pro-flr-provider .flr-prov-next').trigger('click');
    }, 8000);
}

function LoadBoxTinhThanh(urltt) {
    $(".tt-head").load(urltt);
}

function HoverMenu() {
    $(".menu-floor-title-detail").hover(function () {
        if ($(".menu-hide").length > 0 || $(".dock-menu-box").length > 0) {
            //$("#bannerCenter").hide(); //an banner center trong trang chi tiet va danh muc
            $(".menu-floor-wr").removeAttr('style').addClass("show-child-menu");
            $(".menu-floor-list-cate").removeAttr('style').addClass("show-child-menu");
        }
    }).mouseleave(function () {
        $('#home-header-wr').hover(function () {
            if ($(".menu-hide").length > 0 || $(".dock-menu-box").length > 0) {
                $(".menu-floor-wr").removeClass("show-child-menu").removeAttr('style');
                //$('.menu-floor-list-cate').hide().removeAttr('style');
            }
        });
    });
    $('.menu-floor-wr').mouseleave(function () {
        $('.menu-floor-wr').removeClass("show-child-menu").removeAttr('style');
        //$('.menu-floor-list-cate').hide().removeAttr('style');
    });

}

//load cac hieu ung trong chi tiet san pham
function LoadProductImage() {
    $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
    //bat ra lightbox khi kich vao anh thumb
    $(".cloud-zoom-gallery").colorbox({ rel: 'cloud-zoom-gallery', width: "500px", height: "500px" });
    //khi di chuot vao anh thumb se doi mau border cua anh thumb ngay ca khi di chuot ra ngoai
    $("#Carousel-wrap .imgThumbZoom").hover(function () {
        var strItem = $(this).attr('alt');
        $("#Carousel-wrap .imgThumbZoom").each(function () {
            var ItemData = $(this).attr('alt');
            if (strItem != ItemData) {
                $(this).css('border', '1px solid #e9e9e9');
            }
        });
    });
    //con day la cai next anh? ne
    $('ul#Carousel-wrap').carouFredSel({
        auto: false,
        prev: "#prev-carousel",
        next: "#next-carousel"
        //scroll: "linear"
        //pagination: true
        //effect: "fade"
        //wrap: "first"
    });
}

function KeyPressEnterLogin(event, idSubmit, thisInput) {
    if (event.keyCode == 13) {
        $(thisInput).parent().parent().find(idSubmit).click();
    }
}

function GetColNum200(divBaoNgoai) {
    if ($(divBaoNgoai).length == 0) return 0;
    var parentW = $(divBaoNgoai).width();
    var soCot = Math.floor(parentW / 200);
    //alert(divBaoNgoai + '-' + soCot);
    return soCot;
}

function CheckKeyDown(obj) {
    $(obj).keydown(function (event) {
        // Allow special chars + arrows
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9
            || event.keyCode == 27 || event.keyCode == 13
            || (event.keyCode == 65 && event.ctrlKey === true)
            || (event.keyCode >= 35 && event.keyCode <= 39)) {
            return;
        } else {
            // If it's not a number stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();
            }
        }
    });
}

function CountFavourite(url) {
    $("#count-favourite").load(url);
}

function ShowBoxRegisterAccount() {
    $('.dg-content-wr-v2').find('.box-login').hide();
    ShowBoxFadeIn(true, '.mth-box-reg');
}

function IsMobilePhone(txtPhone) {
    txtPhone = txtPhone.trim();
    var length = txtPhone.length;
    if (length == 0) {
        return false;
    }
    if (txtPhone.indexOf('84') == 0) {
        txtPhone = txtPhone.substring(2, length - 2);
    } else {
        if (txtPhone.indexOf('84') == 0) {
            txtPhone = txtPhone.substring(3, length - 3);
        }
    }
    if ((txtPhone.indexOf('09') == 0 || txtPhone.indexOf('1') == 0) && txtPhone.length == 10) {
        return true;
    }
    if (txtPhone.indexOf('9') == 0 && txtPhone.length == 9) {
        return true;
    }
    if (txtPhone.indexOf('01') == 0 && txtPhone.length == 11) {
        return true;
    }
    return false;
}

function OpenProvinceBox(obj) {
    var isShow = $(obj).attr('idata');
    if (isShow == "0") {
        $(obj).find('.mth-out-tt').show();
        $(obj).attr('idata', '1');
    } else {
        $(obj).find('.mth-out-tt').hide();
        $(obj).attr('idata', '0');
    }
}

function OpenBoxAddress(obj) {
    $(".address-list-content .address-item-box").each(function () {
        if($(this).position().left > 250) {
            $(this).css({ "float" : "right" });
        }
    });
    $(".address-list-content .p-address-item").each(function () {
        if($(this).position().left > 250) {
            $(this).css({ "float" : "right" });
        }
    });
}

function DockAvd(idContent, idLeft, idRight) {
    var marginLeft = ($(window).width() - $("#" + idContent).width()) / 2;
    var imgLeft = $("#" + idLeft).find('a:eq(0)').find('img:eq(0)').width();
    var imgRight = $("#" + idRight).find('a:eq(0)').find('img:eq(0)').width();
    $("#" + idLeft).find('a:eq(0)').find('img:eq(0)').load(function () {
        imgLeft = $(this).width();
    });
    $("#" + idRight).find('a:eq(0)').find('img:eq(0)').load(function () {
        imgRight = $(this).width();
    });
    if (imgLeft == 0) {
        imgLeft = 184;
    }

    if (imgRight == 0) {
        imgRight = 184;
    }
    var pY = 10;
    if ($('.header-top-banner-content').height() > 0) { pY = $('.header-top-banner-content').height(); }
    $("#" + idLeft).css({ "left": marginLeft - imgLeft - 5, 'top': pY });
    $("#" + idRight).css({ "right": marginLeft - imgRight - 5, 'top': pY });
    $(window).scroll(function () {
        if ($(window).scrollTop() > $('.header-top-banner-content').height() && $('.header-top-banner-content').height() > 0) {
            pY = 10;
        } else {
            pY = $('.header-top-banner-content').height();
        }
        $("#" + idLeft).css({ "left": marginLeft - imgLeft - 5, 'top': pY });
        $("#" + idRight).css({ "right": marginLeft - imgRight - 5, 'top': pY });

        var bottom = $('#bottom-navibar').offset().top - 50; // - 50 do content thuong margin-bottom 50px
        $('#hdScrollTop').val(bottom + '-' + bottom);
        if ($(window).scrollTop() > (bottom - $('.pos-banner-left').height())) {
            var topLeft = $(window).scrollTop() - (bottom - $('.pos-banner-left').height());
            $("#" + idLeft).removeAttr("style");
            $("#" + idLeft).css({ "left": marginLeft - imgLeft - 5, 'top': -topLeft });
        }
        if ($(window).scrollTop() > (bottom - $('.pos-banner-right').height())) {
            var topRight = $(window).scrollTop() - (bottom - $('.pos-banner-right').height());
            $("#" + idRight).removeAttr("style");
            $("#" + idRight).css({ "right": marginLeft - imgRight - 5, 'top': -topRight });
        }
    });
}

function FloatAvd(idContent, idLeft, idRight) {
    var TopAdjust = 10;
    var startLX = -204;
    var startLY = 90, startRY = 90;
    var startRX = $("#" + idContent).width() + 5;
    var d = document;
    function ml(id) {
        var el = d.getElementById ? d.getElementById(id) : d.all ? d.all[id] : d.layers[id];
        el.sP = function (x, y) { this.style.left = x + 'px'; this.style.top = y + 'px'; };
        el.x = startRX;
        el.y = startRY;
        return el;
    }
    function m2(id) {
        var e2 = d.getElementById ? d.getElementById(id) : d.all ? d.all[id] : d.layers[id];
        e2.sP = function (x, y) { this.style.left = x + 'px'; this.style.top = y + 'px'; };
        e2.x = startLX;
        e2.y = startLY;
        return e2;
    }
    window.stayTopLeft = function () {
        if (document.documentElement && document.documentElement.scrollTop)
            var pY = document.documentElement.scrollTop;
        else if (document.body)
            var pY = document.body.scrollTop;
        if (document.body.scrollTop > 30) { startLY = 3; startRY = 3; } else { startLY = TopAdjust; startRY = TopAdjust; };
        ftlObj.y += (pY + startRY - ftlObj.y) / 16;
        ftlObj.sP(ftlObj.x, ftlObj.y);
        ftlObj2.y += (pY + startLY - ftlObj2.y) / 16;
        ftlObj2.sP(ftlObj2.x, ftlObj2.y);
        setTimeout("stayTopLeft()", 1);
    }
    if (idRight.length > 0) {
        ftlObj = ml(idRight);
    }

    //stayTopLeft();
    if (idLeft.length > 0) {
        ftlObj2 = m2(idLeft);
    }

    stayTopLeft();
}

function VideoLoadAjax(obj) {
    var url = $(obj).attr('idata');
    $.ajax({
        url: url,
        type: "GET",
        //beforeSend: function () {
        //    ShowLoading($('body'), 'fixed');
        //},
        success: function (data) {
            if (data != null) {
                $(obj).parent().parent('#vd-load-ajax').fadeIn().replaceWith(data);
                BidingLazyload();
            }
        }
        //},
        //complete: function () {
        //    setInterval(HideLoading($('body')), 300);
        //}
    });
}

function FixDockMenuTop() {
    var headerDock = $('#header-dock');
    $(window).scroll(function () {
        if ($(document).scrollTop() > 170) {
            headerDock.fadeIn();
        }
        else {
            headerDock.fadeOut();
        }
    });

}

function UpdateBannerView(url, id) {
    $.ajax({
        type: "GET",
        url: url,
        data: { 'id': id },
        success: function (data) {
        }
    });
}

function UpdateBannerFloorClick(id) {
    var url = $('#hdBannerFloorClickUrl').val();
    $.ajax({
        type: "GET",
        url: url,
        data: { 'id': id },
        success: function (data) {

        }
    });
}

function UpdateBannerMenuClick(id) {
    var url = $('#hdBannerMenuClickUrl').val();
    $.ajax({
        type: "GET",
        url: url,
        data: { 'id': id },
        success: function (data) {

        }
    });
}

function HeaderDockResize() {
    if ($(window).width() <= 1024) {
        $('#hd-cate-show .hd-cate-item:last-child').hide();
        var last = $('#hd-cate-show .hd-cate-item:last-child').find('a.hd-cate-name').html();
        var addLast = "<li>" + last + "</li>";
        $('.hd-cate-more').find('ul.hd-cate-level2').prepend(addLast);
    }
}

function GetBreadCrumb() {
    $('.filter-vd .div-fil-vd').each(function () {
        if ($(this).hasClass('vd-cate-active')) {
            var cateName = $(this).find('a').text();
            $('.vd-br span.breadcrum-text a:nth-child(3)').html("<i></i><span>" + cateName + "</span>");
        }
    });
}

var marker = new Array();
function initializeMapsFull() {
    var markers = new Array();
    $('.m-maps-list .m-maps-list-item .m-maps-item').each(function () {
        var tt = $('#hdTinhThanh').val();
        var itemParent = $(this);
        if (itemParent.attr('idata') == tt) {
            $(this).find('input').each(function () {
                var item = [itemParent.find('.maps-idesc').html(), $(this).attr('ikinhdo'), $(this).attr('ivido')];
                markers.push(item);
            });
        }
    });
    $('.address-list-coming-soon p').each(function () {
        var tt = $('#hdTinhThanh').val();
        var qh = $('#hdQuanHuyen').val();
        var itemParent = $(this);
        if (itemParent.attr('idistrict') == qh) {
            if (itemParent.attr('iprovince') == tt) {
                $(this).find('input').each(function () {
                    var item = [$(this).attr('idesc'), $(this).attr('ikinhdo'), $(this).attr('ivido')];
                    markers.push(item);
                });
            }
        }
    });
    var myOptions = {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: true
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var infowindow = new google.maps.InfoWindow();
    var i;
    var bounds = new google.maps.LatLngBounds();
    var pos;
    if (markers.length == 1) {
        pos = new google.maps.LatLng(markers[0][1], markers[0][2]);
        bounds.extend(pos);
        marker = new google.maps.Marker({
            position: pos,
            map: map,
            icon: "https://shoptretho.com.vn/Content/images/icon-map.png"
        });
        google.maps.event.addListener(marker, 'click', (function (marker) {
            return function () {
                infowindow.setContent(markers[0][0]);
                infowindow.open(map, marker);
            };
        })(marker, 0));
        map.fitBounds(bounds);
        map.setZoom(16);
    }
    else {
        for (i = 0; i < markers.length; i++) {
            pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(pos);
            marker = new google.maps.Marker({
                position: pos,
                map: map,
                icon: "https://shoptretho.com.vn/Content/images/icon-map.png"
            });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(markers[i][0]);
                    infowindow.open(map, marker);
                };
            })(marker, i));
            map.fitBounds(bounds);
        }
    }
}

var map;
var infowindow;
var old_id = 0;
var infoWindowArray = new Array();
var infowindow_array = new Array();
function initializeMaps(a, b, c) {
    var defaultLatLng = new google.maps.LatLng(a, b);
    var myOptions = { zoom: 15, center: defaultLatLng, scrollwheel: false, mapTypeId: google.maps.MapTypeId.ROADMAP };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); map.setCenter(defaultLatLng);
    var arrLatLng = new google.maps.LatLng(a, b);
    infoWindowArray[1161] = c;
    loadMarker(arrLatLng, infoWindowArray[1161], 1161);
    moveToMaker(1161);
}

function loadMarker(myLocation, myInfoWindow, id) {
    marker[id] = new google.maps.Marker({ position: myLocation, map: map, visible: true, icon: "https://shoptretho.com.vn/Content/images/icon-map.png" });
    google.maps.event.addListener(marker[id], 'mouseover', function () {
        if (id === old_id || infowindow_array[id]===undefined) return;
        if (old_id > 0) infowindow_array[old_id].close();
        infowindow_array[id].open(map, marker[id]);
        old_id = id;
    });
    if(myInfoWindow !== null && myInfoWindow !== "") {
        var popup = myInfoWindow;
        infowindow_array[id] = new google.maps.InfoWindow({ content : popup });
        google.maps.event.addListener(infowindow_array[id], 'closeclick', function() { old_id = 0; });
    }
}

function moveToMaker(id) {
    var location = marker[id].position; map.setCenter(location);
    if (old_id > 0) infowindow_array[old_id].close();
    if(infowindow_array[id] === undefined) return;
    infowindow_array[id].open(map, marker[id]);
    old_id = id;
}

var timer;
function CountDownTimer(dt, id) {
    var end = new Date(dt);
    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            return;
        }
        var second = 1000;
        var minute = second * 60;
        var hour = minute * 60;
        var day = hour * 24;

        var days = Math.floor(distance / day);
        var hours = Math.floor((distance % day) / hour);
        var minutes = Math.floor((distance % hour) / minute);
        var seconds = Math.floor((distance % minute) / second);
        $("#countdown_ngay").html(leftPad(days, 2));
        $("#countdown_gio").html(leftPad(hours, 2));
        $("#countdown_phut").html(leftPad(minutes, 2));
        $("#countdown_giay").html(leftPad(seconds, 2));
    }
    timer = setInterval(showRemaining, 1000);
}

function leftPad(number, targetLength) {
    var output = number + '';
    while (output.length < targetLength) {
        output = '0' + output;
    }
    return output;
}

//Add Favourite
function AddFavourite(url) {
    $.ajax({
        type: "GET",
        url: url,
        cache: false,
        success: function (data) {
            if (data !== 0) {
                if ($("#favDetail").length > 0) {
                    $("#favDetail").html(data);
                    $(".m-cart-box-title.second").trigger("click");
                }
                else {
                    ShowBox(false, ".m-addfv-success");
                    if ($("#hfCountFavourite").length > 0) {
                        $(".m-cm-star-p .love-stt").addClass("active-love");
                        CountFavourite($("#hfCountFavourite").val());
                    }
                }
            }
        }
    });
}

function changeFavSize(obj) {
    if ($(obj).val()!== ""){
        var opt = $(obj).find("option:selected");
        var priceSize = opt.attr("data-price");
        var barCodeSize = opt.attr("data-barcode");
        var realPrice = opt.attr("data-realprice");
        var decreaseprice = opt.attr("data-decreaseprice") + "";
        var quantitypromotion = parseInt($(obj).find("option:selected").attr("data-quantitypromotion"));
        var pr = $(obj).parent().parent().parent().parent();
        if (decreaseprice !== "") {
            $(pr).find(".cart-price .km").html("(-" + decreaseprice + "k)");
        }
        else if (quantitypromotion > 0) {
            $(pr).find(".cart-price .km").html("(-" + quantitypromotion + "%)");
        } else {
            $(pr).find(".cart-price .km").html("");
        }

        if (realPrice === priceSize) {
            $(pr).find(".cart-price .price").html(priceSize);
            $(pr).find(".cart-price .price-old").html("");
        } else {
            $(pr).find(".cart-price .price").html(realPrice);
            $(pr).find(".cart-price .price-old").html(priceSize + "đ");
        }
    }
}

function DeleteAllHistory() {
    if (!confirm('Bạn có chắc chắn muốn xóa tất cả sẩn phẩm đã xem?')) {
        return false;
    } else{
        var url = $('#hfDeleteAllProductHistory').val();
        $.ajax({
            type: "POST",
            url: url,
            data: { id: '' },
            success: function(data) {
                if (data != 0) {
                    $('.list-sput').empty();
                    $('.list-sput').append("<span class='bold-weight cl-green empty-product'>Bạn chưa xem sản phẩm nào.</span>");
                }
            }
        });
    }
}

function CountDownTimerGiveVoucher(dt) {
    var end = new Date(dt);
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;
    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            return;
        }
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);
        document.getElementById('countdown_gio').innerHTML = leftPad(hours, 2);
        document.getElementById('countdown_phut').innerHTML = leftPad(minutes, 2);
        document.getElementById('countdown_giay').innerHTML = leftPad(seconds, 2);
    }
    timer = setInterval(showRemaining, 1000);
}
function setCheckRadio(div) {
    var i = $(div).find("i");
    if (!i.is(".fa-dot-circle-o")) {
        $(div).find("input").prop("checked", true);
        var itemprop = $(div).attr("itemprop");
        if (itemprop) {
            $(".div-radio-button[itemprop='" + itemprop + "']").find("i").removeClass("fa-dot-circle-o").addClass("fa-circle");
            i.removeClass("fa-circle").addClass("fa-dot-circle-o");
            var dataval = $(div).attr("data-val");
            if ($("#" + itemprop).length > 0)
                $("#" + itemprop).val(dataval);
            $(div).parent().removeClass("input-validation-error");
            var namemsg = itemprop.replace("_", ".");
            if ($("span[data-valmsg-for='" + namemsg + "']").length > 0)
                $("span[data-valmsg-for='" + namemsg + "']").text("");
        }
    }
}
function setCheckBox(div) {
    var itemprop = $(div).attr("itemprop");
    var dataval = $(div).attr("data-val");
    var val;
    var i = $(div).find("i");
    if (i.is(".fa-check-square")) {
        i.removeClass("fa-check-square").addClass("fa-square-o");
        $(div).find("input").prop("checked", false);
        if (itemprop) {
            if (dataval && $("#" + itemprop).length > 0) {
                val = $("#" + itemprop).val();
                if (val) {
                    val = val.replace("," + dataval, "").replace(dataval + "", "").replace(dataval, "");
                }
                $("#" + itemprop).val(val);
            }
        }
    } else {
        $(div).find("input").prop("checked", true);
        i.removeClass("fa-square-o").addClass("fa-check-square");
        if (itemprop) {
            if (dataval && $("#" + itemprop).length > 0) {
                val = $("#" + itemprop).val();
                if (val) {
                    val += "," + dataval;
                } else {
                    val = dataval;
                }
                $("#" + itemprop).val(val);
            }
        }
    }
}
