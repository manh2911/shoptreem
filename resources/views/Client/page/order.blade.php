<!DOCTYPE html>
<html lang="en">
@include('Client.layout.head')
<body>
<div class="wrap-order">
    <div class="wrap-order">
        <div id="header-order">

            <div class="header-order">
                <div class="logo-order">
                    <a id="logostt" style="display: block; cursor: pointer;" href="{{ route('index') }}">
                        <img src="https://media.shoptretho.com.vn/upload/logo/logotet2019.png" alt="ShopTreTho.com.vn - Thiên đường cho bé." onclick="ga('send', 'event', 'Điều hướng', 'Quay lại', 'Logo quay về trang chủ', ''); "></a>
                </div>
                <div class="order-header-icon">
                    <div class="giao-hang">
                        <i></i><span>Giao hàng toàn quốc</span></div>
                    <div class="doi-tra">
                        <i></i><span>Đổi hàng 15 ngày miễn phí</span>
                    </div>
                    <div class="chinh-hang">
                        <i></i><span>Đảm bảo hàng chính hãng</span>
                    </div>
                </div>
            </div>


        </div>
        <div class="main-order">
            <form action="/thanh-toan" data-ajax="true" data-ajax-method="POST" id="paymentInfo" method="post" novalidate="novalidate">    <div class="left-order">
                    <div class="thong-tin">
                        <span class="tieu-de">Thông tin mua hàng</span>
                        <div class="dia-chi-giao" >
                            <input value="NEW" id="ShoppingInfo_AddressId" name="ShoppingInfo.AddressId" type="hidden">                <div class="add-address" style="display: block">
                                <div class="line-order">
                                    <input class="text-box" id="ShoppingInfo_DiffFullName" name="ShoppingInfo.DiffFullName" placeholder="Họ và tên" type="text" value="">
                                    <span class="field-validation-valid" data-valmsg-for="ShoppingInfo.DiffFullName" data-valmsg-replace="true"></span>
                                </div>
                                <div>
                                    <span class="field-validation-valid" data-valmsg-for="ShoppingInfo.DiffGender" data-valmsg-replace="true"></span>
                                </div>
                                <div class="line-order">
                                    <input class="text-box" data-val="true" data-val-regex="Số điện thoại không hợp lệ, vui lòng kiểm tra lại" data-val-regex-pattern="^([0-9]+)$" id="ShoppingInfo_DiffPhone" name="ShoppingInfo.DiffPhone" placeholder="Số điện thoại" type="tel" value="">
                                    <span class="field-validation-valid" data-valmsg-for="ShoppingInfo.DiffPhone" data-valmsg-replace="true"></span>
                                </div>
                                <div class="line-order">
                                    <input class="text-box" id="ShoppingInfo_DiffAddress" name="ShoppingInfo.DiffAddress" placeholder="Số nhà, tòa nhà, đường, xã phường" type="text" value="">
                                    <span class="field-validation-valid" data-valmsg-for="ShoppingInfo.DiffAddress" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="thanh-toan">
                        <span class="tieu-de">Thời gian nhận hàng</span>
                        <div class="line-order ">
                            <a class="div-radio-button radio-line-group" data-val="TRONG" itemprop="OtherInfo_TimeOrderId" onclick="setRadioChecked(this); ">
                                <input data-val="true" data-val-required="Vui lòng chọn Thời gian nhận hàng" id="ghTRONG" name="OtherInfo.TimeOrderId" type="radio" value="TRONG">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                                <label for="ghTRONG">Trong giờ hành chính</label>
                            </a>
                            <a class="div-radio-button radio-line-group" data-val="NGOAI" itemprop="OtherInfo_TimeOrderId" onclick="setRadioChecked(this); ">
                                <input id="ghNGOAI" name="OtherInfo.TimeOrderId" type="radio" value="NGOAI">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                                <label for="ghNGOAI">Ngoài giờ hành chính</label>
                            </a>
                            <input id="OtherInfo_TimeOrderId" name="OtherInfo.TimeOrderId" type="hidden" value="">
                        </div>
                    </div>
                </div>
                <div class="right-order">
                    <div class="box-cart-info">
                        <span class="tieu-de">
                            Đơn hàng<span class="so-luong">(<span id="hdCountPro">1</span> sản phẩm)</span>
                        </span>
                        <div class="content-cart-infor ps-container ps-theme-default"
                             data-ps-id="58d1a828-93e3-f35f-3f74-2629c57adc14">

                            <div class="item-cart">
                                <div class="cart-img">
                                    <img
                                        src="https://media.shoptretho.com.vn/upload/image/product/20190528/sua-bot-morinaga-so-9-820g.jpg?mode=max&amp;width=100&amp;height=100"
                                        title="Sữa bột Morinaga số 9 - 820g (1-3 tuổi)"
                                        alt="Sữa bột Morinaga số 9 - 820g (1-3 tuổi)">
                                </div>
                                <div class="cart-name">
                                    <div class="name-box">
                                        <div class="div-name">
                                        <span class="name" title="Sữa bột Morinaga số 9 - 820g (1-3 tuổi)">
                                            Sữa bột Morinaga số 9 - 820g (1-3 tuổi)
                                        </span>
                                        </div>
                                        <div class="cart-price">
                                            <span class="bold"><span class="price">370.000</span><i>đ</i></span>
                                            <br>
                                            <span class="old"><span class="price-old">390.000</span><i>đ</i></span>
                                            <span class="km orange">(-20k)</span>
                                        </div>
                                        <div class="price-box">
                                            <input type="hidden" id="hdItemPrice" value="370000,0000">
                                            <input type="hidden" id="hdItemRootPrice" value="390000,0000">
                                            <span class="bold"><span class="price">370.000</span><i>đ</i></span>
                                            <br>
                                            <span class="old"><span class="price-old">390.000</span><i>đ</i></span>
                                            <span class="km orange">(-20k)</span>
                                        </div>
                                    </div>
                                    <div class="cart-sl">
                                        <div class="div-sl">
                                            <span>Số lượng:</span>
                                            <a class="plus" title="Tăng số lượng mua"
                                               onclick="AddQuantity(this, 'A4F712BB61C8' , '' , '' , 0, '/Desktop/OrderDesktop/ChangeQuantityToBuy' ); "><i
                                                    class="fa fa-minus" aria-hidden="true"></i></a>
                                            <a class="quan" title="Số lượng sản phẩm muốn mua">1</a>
                                            <a class="plus" title="Tăng số lượng mua"
                                               onclick="AddQuantity(this, 'A4F712BB61C8' , '' , '' , 1, '/Desktop/OrderDesktop/ChangeQuantityToBuy' ); "><i
                                                    class="fa fa-plus" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="div-del">
                                            <a class="del" title="Xóa sản phẩm khỏi đơn hàng"
                                               onclick="AddQuantity(this, 'A4F712BB61C8', '', '', 0, '/Desktop/OrderDesktop/ChangeQuantityToBuy'); "><i
                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="div-fav">
                                            <a class="fav" href="javascript:void(0)"
                                               onclick="AddFavourite('/Desktop/ProductDetail/AddFavourite/A4F712BB61C8?fromCart=True&amp;isfv=True&amp;page=1&amp;size=5&amp;inStock=True;')">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                            </div>
                        </div>
                        <div class="content-cart-infor ps-container ps-theme-default"
                             data-ps-id="58d1a828-93e3-f35f-3f74-2629c57adc14">

                            <div class="item-cart">
                                <div class="cart-img">
                                    <img
                                        src="https://media.shoptretho.com.vn/upload/image/product/20190528/sua-bot-morinaga-so-9-820g.jpg?mode=max&amp;width=100&amp;height=100"
                                        title="Sữa bột Morinaga số 9 - 820g (1-3 tuổi)"
                                        alt="Sữa bột Morinaga số 9 - 820g (1-3 tuổi)">
                                </div>
                                <div class="cart-name">
                                    <div class="name-box">
                                        <div class="div-name">
                                        <span class="name" title="Sữa bột Morinaga số 9 - 820g (1-3 tuổi)">
                                            Sữa bột Morinaga số 9 - 820g (1-3 tuổi)
                                        </span>
                                        </div>
                                        <div class="cart-price">
                                            <span class="bold"><span class="price">370.000</span><i>đ</i></span>
                                            <br>
                                            <span class="old"><span class="price-old">390.000</span><i>đ</i></span>
                                            <span class="km orange">(-20k)</span>
                                        </div>
                                        <div class="price-box">
                                            <input type="hidden" id="hdItemPrice" value="370000,0000">
                                            <input type="hidden" id="hdItemRootPrice" value="390000,0000">
                                            <span class="bold"><span class="price">370.000</span><i>đ</i></span>
                                            <br>
                                            <span class="old"><span class="price-old">390.000</span><i>đ</i></span>
                                            <span class="km orange">(-20k)</span>
                                        </div>
                                    </div>
                                    <div class="cart-sl">
                                        <div class="div-sl">
                                            <span>Số lượng:</span>
                                            <a class="minus  disale-text" title="Giảm số lượng mua"
                                               onclick="AddQuantity(this, 'A4F712BB61C8' , '' , '' , -1, '/Desktop/OrderDesktop/ChangeQuantityToBuy' ); "><i
                                                    class="fa fa-minus" aria-hidden="true"></i></a>
                                            <a class="quan" title="Số lượng sản phẩm muốn mua">1</a>
                                            <a class="plus" title="Tăng số lượng mua"
                                               onclick="AddQuantity(this, 'A4F712BB61C8' , '' , '' , 1, '/Desktop/OrderDesktop/ChangeQuantityToBuy' ); "><i
                                                    class="fa fa-plus" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="div-del">
                                            <a class="del" title="Xóa sản phẩm khỏi đơn hàng"
                                               onclick="AddQuantity(this, 'A4F712BB61C8', '', '', 0, '/Desktop/OrderDesktop/ChangeQuantityToBuy'); "><i
                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="div-fav">
                                            <a class="fav" href="javascript:void(0)"
                                               onclick="AddFavourite('/Desktop/ProductDetail/AddFavourite/A4F712BB61C8?fromCart=True&amp;isfv=True&amp;page=1&amp;size=5&amp;inStock=True;')">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                            </div>
                        </div>
                        <div id="cartSummary">
                            <div id="cartSummary">
                                <span class="line-order tam-tinh">
                                    <span class="tit">Tạm tính</span><span id="hdTamTinh" class="fl-right">390.000<i>đ</i></span>
                                </span>
                                                        <span class="line-order khuyen-mai">
                                    <span class="tit">Khuyến mãi</span><span id="hdKhuyenMai" class="fl-right">-20.000<i>đ</i></span>
                                </span>
                                <div class="line-order total">
                                    <span class="total-text">Thành tiền</span><span class="total-money">370.000<i>đ</i></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="googleRemarketing">
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $(".content-cart-infor").perfectScrollbar();
                        });
                    </script>
                    <div class="box-btnHoanTat">
                        <span class="btnHoanTatCart" onclick="SubmitForm();">Đặt hàng</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('Client.layout.footer')
@include('Client.layout.script')
</body>
</html>

