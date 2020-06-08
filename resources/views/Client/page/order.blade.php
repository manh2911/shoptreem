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
            <form action="/thanh-toan" data-ajax="true" data-ajax-method="POST" id="paymentInfo" method="post" novalidate="novalidate">
                <div class="left-order">
                    <div class="thong-tin">
                        <span class="tieu-de">Thông tin mua hàng</span>
                        <div class="dia-chi-giao">
                            <input value="NEW" id="ShoppingInfo_AddressId" name="ShoppingInfo.AddressId" type="hidden">
                            <div class="add-address" style="display: block">
                                <div class="line-order">
                                    <input class="text-box" id="ShoppingInfo_DiffFullName" name="name"
                                           placeholder="Họ và tên" type="text" value="" required>
                                    <span class="field-validation-valid" data-valmsg-for="ShoppingInfo.DiffFullName"
                                          data-valmsg-replace="true"></span>
                                </div>
                                <div>
                                    <span class="field-validation-valid" data-valmsg-for="ShoppingInfo.DiffGender"
                                          data-valmsg-replace="true"></span>
                                </div>
                                <div class="line-order">
                                    <input class="text-box" data-val="true"
                                           data-val-regex="Số điện thoại không hợp lệ, vui lòng kiểm tra lại"
                                           data-val-regex-pattern="^([0-9]+)$" id="ShoppingInfo_DiffPhone" name="phone"
                                           placeholder="Số điện thoại" type="tel" value="" required>
                                    <span class="field-validation-valid" data-valmsg-for="ShoppingInfo.DiffPhone"
                                          data-valmsg-replace="true"></span>
                                </div>
                                <div class="line-order">
                                    <input class="text-box" id="ShoppingInfo_DiffAddress"
                                           name="address" placeholder="Địa chỉ" type="text" value="" required>
                                    <span class="field-validation-valid" data-valmsg-for="ShoppingInfo.DiffAddress"
                                          data-valmsg-replace="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="thanh-toan">
                        <span class="tieu-de">Thời gian nhận hàng</span>
                        <div class="line-order ">
                            <div class="radio" style="margin-bottom: 10px">
                                <label><input type="radio" name="delivery_time" value="{{\App\Helper\ServiceAction::DURING_OFFICE_HOURS}}" checked>   Trong giờ hành chính</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="delivery_time" value="{{\App\Helper\ServiceAction::OUT_OFFICE_HOURS}}">   Ngoài giờ hành chính</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-order">
                    <div class="box-cart-info">
                        <span class="tieu-de">
                            Đơn hàng<span class="so-luong">(<span id="hdCountPro">{{ count($content) }}</span> sản phẩm)</span>
                        </span>
                        <div>
                            @foreach($content as $item)
                                <div class="content-cart-infor ps-container ps-theme-default" id="item-{{ $item->productId }}">
                                    <div class="item-cart">
                                        <div class="cart-img">
                                            <img
                                                src="{{ $item->image }}"
                                                title="{{ $item->name }}"
                                                alt="{{ $item->name }}">
                                        </div>
                                        <div class="cart-name">
                                            <div class="name-box">
                                                <div class="div-name">
                                        <span class="name" title="{{ $item->name }}">
                                            {{ $item->name }}
                                        </span>
                                                </div>
                                                <div class="cart-price">
                                                    <span class="bold"><span class="price">{{ number_format($item->last_price) }}</span><i>đ</i></span>
                                                    <br>
                                                    <span class="old"><span class="price-old">{{ number_format($item->origin_price) }}</span><i>đ</i></span>
                                                    <span class="km orange">(-20k)</span>
                                                </div>
                                                <div class="price-box">
                                                    <span class="bold"><span class="price">{{ number_format($item->last_price) }}</span><i>đ</i></span>
                                                    <br>
                                                    <span class="old"><span class="price-old">{{ number_format($item->origin_price) }}</span><i>đ</i></span>
                                                    <span class="km orange">(-20k)</span>
                                                </div>
                                            </div>
                                            <div class="cart-sl">
                                                <div class="div-sl">
                                                    <span>Số lượng:</span>
                                                    <a class="minus" data-id="{{ $item->productId }}"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                    <a class="quan" id="{{ $item->productId }}">{{ $item->quantity }}</a>
                                                    <a class="plus" data-id="{{ $item->productId }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                </div>
                                                <div class="div-del">
                                                    <a class="del" data-id="{{ $item->productId }}" title="Xóa sản phẩm khỏi đơn hàng">
                                                        <i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="cartSummary">
                            <div id="cartSummary">
                                <span class="line-order tam-tinh">
                                    <span class="tit">Tạm tính</span><span id="total_origin_price" class="fl-right">
                                        {{ number_format($cart->total_origin_price) }}
                                        <i>đ</i></span>
                                </span>
                                <span class="line-order khuyen-mai">
                                    <span class="tit">Khuyến mãi</span><span id="total_discount" class="fl-right">
                                        -{{ number_format($cart->total_discount) }}
                                        <i>đ</i></span>
                                </span>
                                <div class="line-order total">
                                    <span class="total-text">Thành tiền</span><span class="total-money" id="total_price">
                                        {{ number_format($cart->total_price) }}
                                        <i>đ</i></span>
                                </div>
                            </div>
                        </div>
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

