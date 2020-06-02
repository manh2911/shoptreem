<header class="width-common">

    <div class="top_header width-common" style="background: #1d69a4">
        <div class="wrap">
            <a href="#" target="_blank" ><img src="../upload/image_slide/dai-tiec-sinh-nhat-shop-tre-tho-lan-thu-11-1.png" alt="Đại tiệc sinh nhật"></a>
        </div>
    </div>

    <div class="top_nav width-common">
        <div class="wrap">
            <div class="nav_content">
                <p class="phone_hotline left">Tổng đài <a href="tel:1800 6066" class="phone_hot">1800 6066</a>(miễn phí) - CSKH <a href="tel:1900 6483" class="phone_hot">1900 6483</a></p>
                <div class="nav_right right">
{{--                    <a href="javascript:;" onclick="openCsChatBox();" class="nav_item_right">Chat trực tuyến</a>--}}
{{--                    <a href="https://shoptretho.com.vn/tro-giup" class="nav_item_right">Hỗ trợ</a>--}}
{{--                    <a href="https://shoptretho.com.vn/lien-he" class="nav_item_right">Góp ý & liên hệ</a>--}}
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="main_header width-common">
        <div class="wrap">
            <div class="header_content width-common">
                <div class="logo left">
                    <a href="{{ route('index') }}"><img src="../upload/logo.png" alt="Shoptretho.com.vn - Thi&#234;n đường cho B&#233;"></a>
                </div>
                <div class="box_search left">
                    <form action="https://shoptretho.com.vn/Desktop/SearchDesktop/SearchTemp" id="fromSearch" method="post">                            <input type="text" data-url="/Product/SuggestProduct" name="keyword" placeholder="Bố mẹ tìm gì cho bé hôm nay ?" id="search_suggest" >
                        <button class="" type="submit" id="btnSearch"><i class="fa fa-search"></i></button>
                        <div class="search_suggest"></div>
                    </form>
                </div>
                <div class="box_right_header right">
                    <div class="box_user">
                        <div>
                            <i class="fa fa-user"></i>
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <a href="" style="color: #6b6b6b">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>|
                                <a href="{{ route('logout') }}" style="color: #6b6b6b">Đăng xuất</a>
                            @else
                                <a href="{{ route('getLogin') }}" style="color: #6b6b6b">Đăng nhập</a>|
                                <a href="{{ route('getRegister') }}" style="color: #6b6b6b">Đăng kí</a>
                            @endif
                        </div>
                    </div>
                    <div class="box_cart">
                        <a href="https://shoptretho.com.vn/thanh-toan">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="cart_qty">0</span>
                            <p>Giỏ hàng</p>
                        </a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</header>
