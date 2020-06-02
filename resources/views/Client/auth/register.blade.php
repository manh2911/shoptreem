@extends('Client.auth.auth_master')
@section('content')

<div id="form_login" class="width-common">
    @include('Client.auth.header')
    <div class="width-common">
        <div class="wrap">

            <div class="login_content width-common" id="form_signup">
                <div class="login_mail">
                    <div class="login_mail_title">
                        Tạo một tài khoản mới
                    </div>
                    <div class="form_info_login">
                        <form action="{{ route('postRegister') }}" method="post">
                            @csrf
                            <div class="input">
                                <input class="input_text" data-val="true"
                                        name="name" placeholder="Họ và tên" type="text" value="{{ old('name') }}" required/>
                                <i class="fa fa-user"></i>
                                <span class="field-validation-valid" data-valmsg-for="FullName" data-valmsg-replace="true"></span>
                                @if($errors->any())
                                    <?php  $error = $errors->getBag('default')->toArray(); ?>
                                    @if(isset($error['name']))
                                    <p style="color: red; font-size: 12px">{{ $error['name'][0] }}</p>
                                    @endif
                                @endif
                            </div>

                            <div class="input">
                                <input class="input_text" data-val="true"
                                       data-val-regex="Email không đúng, vui lòng kiểm tra lại"
                                       data-val-regex-pattern="^[a-zA-Z|0-9|]+([_][a-zA-Z|0-9]+)*([.a-zA-Z|0-9]+([_][a-zA-Z|0-9]+)*)?@[a-zA-Z0-9][-a-zA-Z|0-9|]+\.([a-zA-Z][a-zA-Z|0-9]+(\.[a-zA-Z][a-zA-Z|0-9]+)?)$"
                                       data-val-required="Vui lòng nhập Email" id="Email" name="email"
                                       placeholder="Email" type="text" value="{{ old('email') }}"/>
                                <i class="fa fa-envelope"></i>
                                <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                                @if($errors->any())
                                    <?php  $error = $errors->getBag('default')->toArray(); ?>
                                    @if(isset($error['email']))
                                        <p style="color: red; font-size: 12px">{{ $error['email'][0] }}</p>
                                    @endif
                                @endif
                            </div>
                            <div class="input">
                                <input class="input_text" data-val="true" name="password" placeholder="Mật khẩu" type="password"/>
                                <i class="fa fa-lock"></i>
                                <span class="field-validation-valid" data-valmsg-for="Pass" data-valmsg-replace="true"></span>
                                @if($errors->any())
                                    <?php  $error = $errors->getBag('default')->toArray(); ?>
                                    @if(isset($error['password']))
                                        <p style="color: red; font-size: 12px">{{ $error['password'][0] }}</p>
                                    @endif
                                @endif
                            </div>
                            <div class="input">
                                <input class="input_text" data-val="true" name="re_password" placeholder="Nhập lại mật khẩu" type="password"/>
                                <i class="fa fa-lock"></i>
                                <span class="field-validation-valid" data-valmsg-for="PassConfirm" data-valmsg-replace="true"></span>
                            </div>
{{--                            <div class="input input-captcha">--}}
{{--                                <div class="g-recaptcha" data-sitekey="6Le5jxsTAAAAAANIrb58iHPPBnkG4cJvGkJCVSfC"></div>--}}
{{--                                <div class="clear"></div>--}}
{{--                                <span class="input_text error-message"></span>--}}
{{--                            </div>--}}
                            <div class="clear"></div>

                            <button type="submit" style="margin-top: 20px;">Tạo một tài khoản mới</button>
                        </form>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
