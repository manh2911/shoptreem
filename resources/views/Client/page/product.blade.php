@extends('Client.layout.master')
@section('content')

    <section class="product_content width-common">
        <div class="wrap">
            @include('Client.layout.menu_page')
            <div class="background_black"></div>
            <div class="main_content width-common">
                <div class="img_detail">
                    <div id="java_zoom_">
                        <script type="text/javascript">$(document).ready(function () {
                                $("#img_1").elevateZoom();
                            });</script>
                    </div>
                    <div id="showImg">
                        <div id="img_1"
                             data-zoom-image="{{ $productImages[0]->image }}">
                            <img
                                src="{{ $productImages[0]->image }}"
                                title="" alt=""></div>
                    </div>
                    <div id="slider_detail" class="flexslider">

                        <div class="flex-viewport" style="overflow: hidden; position: relative;">
                            <ul class="slides"
                                style="width: 1400%; transition-duration: 0.6s; transform: translate3d(-20px, 0px, 0px);">
                                @foreach($productImages as $productImage)
                                    <li id="img_5_clone" data-color="4"
                                        data-zoom-image="{{ $productImage->image }}"
                                        class="clone" aria-hidden="true"
                                        style="width: 20.0195px; margin-right: 0px; float: left; display: block;"></li>
                                @endforeach
                            </ul>
                        </div>
                        <ul class="flex-direction-nav">
                            <li class="flex-nav-prev"><a class="flex-prev" href="#"><i class="fa fa-angle-left"></i></a>
                            </li>
                            <li class="flex-nav-next"><a class="flex-next" href="#"><i
                                        class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                    <div id="carousel_detail" class="flexslider">

                        <div class="flex-viewport" style="overflow: hidden; position: relative;">
                            <ul class="slides"
                                style="width: 1000%; transition-duration: 0.6s; transform: translate3d(0px, 0px, 0px);">
                                @foreach($productImages as $key => $productImage)
                                    <li data-color="41CD7AA2FFE0"
                                        onclick="getZoom('{{ $key+1 }}', '{{ $productImage->image }}')"
                                        class="flex-active-slide"
                                        style="width: 58.0078px; margin-right: 10px; float: left; display: block;"><img
                                            src="{{ $productImage->image }}?mode=max&amp;width=65&amp;height=65"
                                            alt="" draggable="false"></li>
                                @endforeach
                            </ul>
                        </div>
                        <ul class="flex-direction-nav">
                            <li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="#" tabindex="-1"><i
                                        class="fa fa-angle-left"></i></a></li>
                            <li class="flex-nav-next"><a class="flex-next flex-disabled" href="#" tabindex="-1"><i
                                        class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="detail_right">
                    <h1>{{ $product->name }}</h1>
                    <div class="top_intro">
                        <div style="margin-left: 0" class="pro_detail_brand">
                            <p>Mã SP: <strong id="barcodeMain">{{ $product->code }}</strong></p>
                            <p style="float: right">Thương hiệu: <strong
                                    id="barcodeMain">{{ $product->brand->name }}</strong></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="pro_info">
                        <div id="divPrice" class="box_info box_price">
                            <span class="box_info_txt left">Giá:</span>
                            <span class="pro_price left">
                                <span class="price_show price_item">{{ \App\Helper\ServiceAction::showPrice($product->origin_price, $product->discount) }}đ</span>
                                @if($product->discount != 0)
                                <span class="old_price">{{ number_format($product->origin_price) }}đ</span>
                                <span class="label_km">Tiết kiệm <span id="discount">{{ \App\Helper\ServiceAction::showDiscount($product->origin_price, $product->discount) }}k</span></span><br>
                                @endif
                            </span>
                            <div class="clear"></div>
                        </div>
                        <div class="box_info box_status">
                            <span class="box_info_txt left">Tình trạng:</span>
                            @if($product->quantity > 0)
                            <span class="pro_status left">Còn hàng</span>
                            @else
                            <span class="pro_status left">Hết hàng</span>
                            @endif
                            <div class="clear"></div>
                        </div>
                        <div class="box_info box_ship">
                            <span class="box_info_txt left">Vận chuyển:</span>
                            <span class="left" style="line-height: 20px;">
                        <strong>Miễn phí vận chuyển</strong> cho đơn hàng 100.000đ<br>
                    </span>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="box_btn">
                        <button data-id="{{ $product->id }}" class="btn_order_now">Mua ngay</button>
                        <button data-id="{{ $product->id }}" class="btn_add_cart">Thêm vào giỏ hàng</button>
                        <input id="hidOrderProductId" name="hidOrderProductId" type="hidden" value="PC36CFCBDFB9904">
                        <input id="hidOrderColor" name="hidOrderColor" type="hidden" value="">
                        <div class="clear"></div>
                    </div>
                    <div class="box_phone">
                        Tổng đài mua hàng miễn cước <a href="tel:1800 6066" class="hot_phone">1800 6066</a> (Từ 8h00 đến 21h30 hàng ngày)
                    </div>
                </div>
                <div class="clear"></div>
            </div>

        </div>
    </section>
    <section class="product_detail width-common">
        <div class="nav_product width-common" style="top: 0px;">
            <div class="wrap">
                <div class="nav_product_top">
                    <span class="des_nav scroll_des active"><a href="javascript:;" class="">Mô tả sản phẩm</a></span>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="wrap">
            <div class="des_detail css-content" style="width: 100%">
                <div class="product_des_detail" id="detail">
                    <h2>Mô tả {{ $product->name }}</h2>
                    <hr>
                    <div class="box-detail-content">
                        {!! $product->description !!}
                    </div>
                </div>

            </div>
            <div class="clear"></div>
        </div>
    </section>
    <section id="product_seemore" class="width-common">
        <div class="wrap">
            <div class="box_title_cate">
                Bố mẹ vẫn thường xem thêm
            </div>
            <div class="list_product_seemore" style="margin-bottom: 20px">
                @foreach($relativeProducts as $relativeProduct)
                    <div class="product_seemore">
                        <div class="image_pro">
                            <?php
                                $image = \App\ImageDetailProduct::where('product_id', $relativeProduct->id)->first();
                            ?>
                            <a href="{{ route('product', $relativeProduct->id) }}"><img
                                    src="{{ $image->image }}"
                                    alt=""></a>
                        </div>
                        <h3>
                            <a href="{{ route('product', $relativeProduct->id) }}">{{ $relativeProduct->name }}</a>
                        </h3>
                        <div class="price">
                            <span class="price_item">{{ \App\Helper\ServiceAction::showPrice($relativeProduct->origin_price, $relativeProduct->discount) }}đ</span>
                            @if($relativeProduct->discount != 0)
                                <span class="old_price">{{ number_format($relativeProduct->origin_price) }}đ</span>
                            @endif
                        </div>
                        @if($relativeProduct->discount != 0)
                        <span class="discount">-{{ \App\Helper\ServiceAction::showDiscount($relativeProduct->origin_price, $relativeProduct->discount) }}k</span>
                        @endif
                    </div>
                @endforeach
                <div class="clear"></div>
            </div>

        </div>
    </section>

    <section class="width-common" id="cart_popup_section">
        <div class="wrap">
            <div class="popup_add_cart ">
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>

    </script>
@endpush
