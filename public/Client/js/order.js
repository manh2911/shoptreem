function saveTemp(a) {
    var n = "FullName=" + $(".thong-tin #ShoppingInfo_FullName").val();
    n += "&Phone=" + $(".thong-tin #ShoppingInfo_Phone").val(), n += "&Email=" + $(".thong-tin #ShoppingInfo_Email").val(), n += "&TinhThanhId=" + $(".thong-tin #ShoppingInfo_TinhThanhId").val(), n += "&QuanHuyenId=" + $(".thong-tin #ShoppingInfo_QuanHuyenId").val(), n += "&Address=" + $(".thong-tin #ShoppingInfo_Address").val(), n += "&Gender=" + $(".thong-tin #ShoppingInfo_Gender").val(), $.ajax({
        url: a,
        data: n,
        success: function () {
        },
        error: function () {
        }
    })
}

function gtgtInfor() {
    $(".box-xuathoadon").slideToggle()
}

function ApdungVoucher(a) {
    var n = $("#coupon").val();
    "" === n && null == n || ($("#hdMaVoucher").val(n), $.ajax({
        url: a,
        data: {magiamgia: n},
        type: "GET",
        beforeSend: ShowLoading($("#divAddVoucher"), "fixed"),
        success: function (a) {
            null !== a.NoiDung && "" !== a.NoiDung && void 0 !== a.NoiDung ? $(".apdung-voucher .fl-left").text(a.NoiDung) : $("#cartSummary").html(a)
        },
        complete: HideLoading($("#divAddVoucher"))
    }))
}

function HuyVoucher(a) {
    var n = $("#hdMaVoucher").val();
    "" === n && null == n || $.ajax({
        url: a,
        data: {magiamgia: n},
        type: "GET",
        beforeSend: ShowLoading($("#cartSummary"), "fixed"),
        success: function (a) {
            null != a && $("#cartSummary").html(a)
        },
        complete: HideLoading($("#cartSummary"))
    })
}

function setRadioChecked(a) {
    var n = $(a).find("i");
    if (!n.is(".fa-dot-circle-o")) {
        $(a).find("input").prop("checked", !0);
        var e = $(a).attr("itemprop");
        $(".div-radio-button[itemprop='" + e + "']").find("i").removeClass("fa-dot-circle-o").addClass("fa-circle"), n.removeClass("fa-circle-o").addClass("fa-dot-circle-o");
        var t = $(a).attr("data-val");
        $("#" + e).length > 0 && $("#" + e).val(t), $(a).parent().removeClass("input-validation-error");
        var o = e.replace("_", ".");
        $("span[data-valmsg-for='" + o + "']").length > 0 && $("span[data-valmsg-for='" + o + "']").text("")
    }
}

function setCheckBoxChecked(a) {
    var n = $(a).find("i");
    n.is(".fa-check-square") ? ($(a).find("input").prop("checked", !1), n.removeClass("fa-check-square").addClass("fa-square-o")) : ($(a).find("input").prop("checked", !0), n.removeClass("fa-square-o").addClass("fa-check-square"))
}

function CityChange(a, n) {
    var e = $(a).val();
    $.ajax({
        url: n, data: {cityId: e}, type: "POST", success: function (n) {
            if (null != n && "" !== n) {
                var e = $(a).parent().parent().find(".province-ditrict");
                if (e.html(n), e.focus(), document.createEvent) {
                    var t = document.createEvent("MouseEvents");
                    t.initMouseEvent("mousedown", !0, !0, window, 0, 0, 0, 0, 0, !1, !1, !1, !1, 0, null), e[0].dispatchEvent(t)
                } else element.fireEvent && e[0].fireEvent("onmousedown")
            }
        }
    })
}

function diaChiGiaoHang(a) {
    a ? $(".dia-chi-giao").show() : $(".dia-chi-giao").hide()
}

function ChonDiaChi(a) {
    var n = $(a).val();
    "NEW" === n ? ($(".view-address").hide(), $(".add-address").show(), $("#ShoppingInfo_DiffFullName").val(""), $("#ShoppingInfo_DiffPhone").val(""), $("#ShoppingInfo_DiffAddress").val(""), $("#ShoppingInfo_DiffGender").val(""), $(".div-radio-button[itemprop='ShoppingInfo_DiffGender']").find("i").removeClass("fa-dot-circle-o").addClass("fa-circle-o")) : ($(".add-address").hide(), $(".view-address").hide(), $(".view-address[itemprop='" + n + "']").show())
}

function ChonPTTT(a, n, e, t) {
    $("#hidPaymentType").val(n), $(".pttt").load(t, {ptttId: a, nhid: e}, function () {
        "" === $(".pttt").html() ? $(".pttt").hide() : $(".pttt").show()
    })
}

function ChonNganHang(a) {
    var n = $(a).val();
    $("#hidNganHangId").val(n), $(".view-bank").hide(), $(".view-bank[itemprop='" + n + "']").show(), $("span[data-valmsg-for='OtherInfo.NganHangId']").length > 0 && $("span[data-valmsg-for='OtherInfo.NganHangId']").text("")
}

function AddQuantity(a, n, e, t, o, i) {
    if (0 !== $(a).parent().parent().find(".quan").length) {
        var r = parseInt($(a).parent().parent().find(".quan").text()) + o;
        if (!(o < 0 && r <= 0)) {
            var d = o;
            0 === o && (d = -r, r = o);
            var l = $(a).parent().parent().parent().parent();
            $.ajax({
                url: i, data: {productId: n, sizeId: e, colorId: t, quantityToBuy: r}, success: function (n) {
                    if ($.trim(n)) {
                        if (r > 0) {
                            r > 1 ? $(a).parent().parent().find(".minus").removeClass("disale-text") : $(a).addClass("disale-text"), $(a).parent().find(".quan").text(r);
                            var e = l.find("#hdItemPrice").val(), t = l.find("#hdItemRootPrice").val(),
                                o = parseInt(r) * parseFloat(e), i = parseInt(r) * parseFloat(t), c = i - o,
                                h = l.find(".price-box .price"), s = l.find(".price-box .price-old"),
                                f = l.find(".price-box .km");
                            h.text(o).format({
                                format: "#,###",
                                locale: "vn"
                            }), h.length > 0 && s.text(i).format({
                                format: "#,###",
                                locale: "vn"
                            }), f.length > 0 && (c > 0 ? f.text("(-" + c / 1e3 + "k)") : f.text(""))
                        } else l.remove();
                        $("#hdCountPro").length > 0 && $("#hdCountPro").html(parseInt($("#hdCountPro").html()) + d), $(".product-cart-noti .background-image").length > 0 && $(".product-cart-noti .background-image").html(parseInt($(".product-cart-noti .background-image").html()) + d), $("#cartSummary").html(n), $(".total .total-money").fadeOut(500).fadeIn(500)
                    } else $(".tool-box .item.cart a").length > 0 ? $(".tool-box .item.cart a").trigger("click") : $(".header-cart-box .product-cart-noti").length > 0 ? $(".header-cart-box .product-cart-noti").trigger("click") : window.location.reload()
                }, error: function () {
                    alert("Đã có lỗi xảy ra khi cập nhật đơn hàng. Hãy bấm F5 rồi thử lại!")
                }
            })
        }
    }
}

function ShowBoxLogin() {
    ShowBox(!0, ".login-form", "")
}

function ShowBoxLoginMb() {
    $(".login-main").toggle("slow")
}

function loginOrder(a) {
    var n = $("#loginEmail").val(), e = $("#loginPass").val();
    $.ajax({
        url: a, type: "GET", data: {email: n, pass: e}, success: function (a) {
            1 === a && (window.location.href = window.location.href), 0 !== a && !1 !== a || ($("#loginEmail").addClass("input-validation-error"), $("#errorMsg").html("Email/SĐT hoặc Mật khẩu không đúng.").removeClass("field-validation-valid").addClass("field-validation-error")), -1 === a && $("#errorMsg").html("Tài khoản của bạn chưa được kích hoạt.<br/> Vui lòng kiểm tra email đăng ký.").removeClass("field-validation-valid").addClass("field-validation-error")
        }
    })
}

function SubmitForm() {
    $("#ShoppingInfo_Gender").length > 0 && "" === $("#ShoppingInfo_Gender").val() && $("#ShoppingInfo_Gender").parent().addClass("input-validation-error"), $("#OtherInfo_TimeOrderId").length > 0 && "" === $("#OtherInfo_TimeOrderId").val() && $("#OtherInfo_TimeOrderId").parent().addClass("input-validation-error"), $("#OtherInfo_PaymentId").length > 0 && "" === $("#OtherInfo_PaymentId").val() && $("#OtherInfo_PaymentId").parent().addClass("input-validation-error"), $("#paymentInfo").submit()
}

function RedirectTo(a) {
    null !== a && void 0 !== a && "OK" === a.Status && null !== a.Url && (window.location = a.Url)
}
