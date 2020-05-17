<section id="list_category" class="width-common">
    <div class="wrap">
        <div class="nav_cate width-common">
            <ul>
                <li class="cate_home nav_top"><i class="fa fa-bars"></i>Danh mục</li>
{{--                <li class="nav_top">--}}
{{--                    <a href="https://shoptretho.com.vn/san-pham-moi" target="_blank" class="float-left"> - Hàng mới về</a>--}}
{{--                </li>--}}
            </ul>
        </div>
        <div class="main_slide width-common">
            <div class="menu_cate">
                <div>
                    <ul>
                        @foreach($parent_categories as $key => $parent_category)
                        <li class="cate_li menu-30 menu-item-{{ $key }}">

                            <a href="https://shoptretho.com.vn/danh-muc/cho-be-an" class="cate_li_title">
                                <img class="img_icon icon_color" style="filter: invert(100%);" src="{{ $parent_category->imageIcon }}?mode=max&amp;width=60&amp;height=60" alt="{{ $parent_category->name }}">
                                <img class="img_icon icon_hover" src="{{ $parent_category->imageIcon }}?mode=max&amp;width=60&amp;height=60" alt="{{ $parent_category->name }}">
                                {{ $parent_category->name }}
                            </a>
                            <div class="cate_hover">
                                <div class="subcate_hover">
                                    <div class="cate_hover_title">{{ $parent_category->name }}</div>
                                    <ul class="submenu_cate_hover">
                                        <?php
                                            $categories = \App\Category::where('parent_id', $parent_category->id)->get();
                                        ?>
                                        @foreach($categories as $category)
                                        <li><a href="https://shoptretho.com.vn/danh-muc/banh-an-dam">{{ $category->name }}</a></li>
                                        @endforeach

                                        <li><a href="https://shoptretho.com.vn/danh-muc/cho-be-an" class="seeall">Xem tất cả <i class="fa fa-angle-double-right"></i></a></li>
                                    </ul>
                                </div>
                                <div class="img_hover">
                                    <a><img alt=""></a>
                                </div>
                            </div>
                            <style>
                                .menu-item-{{ $key }}.menu-30.menu_hover .menu_cate {
                                    border-top: 1px solid {{ \App\Helper\ServiceAction::COLOR_CATEGORIES[$key] }};
                                }

                                .menu-30.cate_li.menu-item-{{ $key }}.hover {
                                    background: {{ \App\Helper\ServiceAction::COLOR_CATEGORIES[$key] }};
                                }

                                .menu-30.subcate_hover {
                                    border: 1px solid {{ \App\Helper\ServiceAction::COLOR_CATEGORIES[$key] }};
                                }
                            </style>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="box_slider">
                <div class="slider owl-carousel" id="slider">
                    <div class="slide-item">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PC2F22A8A6EA6D4"><img src="../media.shoptretho.com.vn/upload/image/banner/20200429/768x399-1.png" alt="Sinh nhật 11 tuổi"></a>
                    </div>
                    <div class="slide-item">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PC0EB5104A93264"><img src="../media.shoptretho.com.vn/upload/image/banner/20200429/khuyen-mai-don-hang-abbott-2-1.png" alt="Qu&#224; tặng Abbott"></a>
                    </div>
                    <div class="slide-item">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PC079AF7E1516A4"><img src="../media.shoptretho.com.vn/upload/image/banner/20200424/xa-kho-tra-mat-bang-tai-quang-ninh-2-1.png" alt="Xả kho Quảng Ninh"></a>
                    </div>
                    <div class="slide-item">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PCEEF7250139A74"><img src="../media.shoptretho.com.vn/upload/image/banner/20200506/khuyen-mai-aptamil-toan-quoc-5-1.png" alt="Khuyến mại Aptamil Anh th&#225;ng 5"></a>
                    </div>
                    <div class="slide-item">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PC36675FFFFD684"><img src="../media.shoptretho.com.vn/upload/image/banner/20200508/uu-dai-tang-me-khoi-lo-tac-sua-2-1.png" alt="M&#225;y h&#250;t sữa cho mẹ"></a>
                    </div>
                    <div class="slide-item">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PC0F7165D8F59D4"><img src="../media.shoptretho.com.vn/upload/image/banner/20200429/khuyen-mai-goon-sieu-dai-4-1.jpg" alt="Khuyến mại Goon si&#234;u đại"></a>
                    </div>
                    <div class="slide-item">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PCEECF38C3964D4"><img src="../media.shoptretho.com.vn/upload/image/banner/20200408/khuyen-mai-sua-hipp-1.png" alt="Khuyến mại sữa HiPP"></a>
                    </div>
                    <div class="slide-item">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PCD2FE0BF45ED04"><img src="../media.shoptretho.com.vn/upload/image/banner/20200506/khuyen-mai-merries-tang-khan-tam-2-1.png" alt="Merries - Mua 2 tặng 1"></a>
                    </div>
                    <div class="slide-item">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PCF54ECF53E9994"><img src="../media.shoptretho.com.vn/upload/image/banner/20200316/qua-tung-bung-mung-sua-moi-1-1.png" alt="Khuyến mại sữa Morinaga Miền Bắc"></a>
                    </div>
                    <div class="slide-item">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PC6174229A8BAC4"><img src="../media.shoptretho.com.vn/upload/image/banner/20200420/mi-an-dam-hakubaku-cho-be-2-1.png" alt="M&#236; ăn dặm Hakubaku"></a>
                    </div>

                </div>
            </div>
            <div class="box_product_suggest">

                <div class="item_banner">
                    <div class="img_banner">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PC68A33649BE4D4"><img src="../media.shoptretho.com.vn/upload/image/banner/20200415/chinh-sach-khach-hang-than-thiet-1.png" alt="Th&#244;ng b&#225;o ch&#237;nh s&#225;ch KH 2020"></a>
                    </div>
                </div>
                <div class="item_banner">
                    <div class="img_banner">
                        <a href="https://shoptretho.com.vn/Home/BannerClick/PCEF6D5D1AA1A54"><img src="../media.shoptretho.com.vn/upload/image/banner/20200218/giao-hang-nhanh-thoi-corona.png" alt="Giao h&#224;ng tận nh&#224; thời Corona"></a>
                    </div>
                </div>

                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="background_black">
    </div>
</section>
@push('scripts')

@endpush
