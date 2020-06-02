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
                        <li class="cate_li menu-{{ $key }} menu-item-{{ $key }} menu_cate">

                            <a href="{{ route('category', $parent_category->id) }}" class="cate_li_title">
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
                                        <li><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
                                        @endforeach

                                        <li><a href="{{ route('category', $parent_category->id) }}" class="seeall">Xem tất cả <i class="fa fa-angle-double-right"></i></a></li>
                                    </ul>
                                </div>
                                <div class="img_hover">
                                    <a><img alt=""></a>
                                </div>
                            </div>
                            <style>
                                .menu-item-{{ $key }}.menu-{{ $key }}.menu_hover .menu_cate {
                                    border-top: 1px solid {{ \App\Helper\ServiceAction::COLOR_CATEGORIES[$key] }};
                                }

                                .menu-{{ $key }}.cate_li.menu-item-{{ $key }}.hover {
                                    background: {{ \App\Helper\ServiceAction::COLOR_CATEGORIES[$key] }};
                                }

                                .menu-{{ $key }}.subcate_hover {
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
                        <a href="#"><img src="../upload/image_slide/768x399-1.png" alt=""></a>
                    </div>
                    <div class="slide-item">
                        <a href="#"><img src="../upload/image_slide/khuyen-mai-don-hang-abbott-2-1.png" alt="Qu&#224; tặng Abbott"></a>
                    </div>
                </div>
            </div>
            <div class="box_product_suggest">

                <div class="item_banner">
                    <div class="img_banner">
                        <a href="#"><img src="https://media.shoptretho.com.vn/upload/image/banner/20200218/giao-hang-nhanh-thoi-corona.png" alt="Th&#244;ng b&#225;o ch&#237;nh s&#225;ch KH 2020"></a>
                    </div>
                </div>
                <div class="item_banner">
                    <div class="img_banner">
                        <a href="#"><img src="https://media.shoptretho.com.vn/upload/image/banner/20200218/giao-hang-nhanh-thoi-corona.png" alt="Giao h&#224;ng tận nh&#224; thời Corona"></a>
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
