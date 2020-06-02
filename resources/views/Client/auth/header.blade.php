<div class="header_login width-common">
    <div class="wrap">
        <div class="main_header_login width-common">
            <div class="logo_login">
                <a href="{{ route('index') }}"><img src="../upload/logo.png"></a>
            </div>
            <div class="comback">Chào mừng bạn quay trở lại</div>

            <div class="no_acc">
                <?php $currentUrl = $_SERVER['REQUEST_URI'];?>
                @if($currentUrl == '/register')
                    Bạn đã có tài khoản Shop Trẻ Em ? <a href="{{ route('getLogin') }}">Đăng nhập ngay</a>
                @elseif($currentUrl == '/login')
                    Bạn chưa có tài khoản Shop Trẻ Em ? <a href="{{ route('getRegister') }}">Đăng kí ngay</a>
                @endif
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
