@extends('Client.auth.auth_master')
@section('content')

    <div id="form_login" class="width-common">
        @include('Client.auth.header')
        <div class="width-common">
            <div class="wrap">

                <div class="login_content width-common" id="form_signup">
                    <div class="login_mail">
                        <div class="login_mail_title">
                            Quên mật khẩu
                        </div>
                        <div class="form_info_login">
                            <form action="{{ route('postForgotPassword') }}" method="post">
                                @csrf
                                <div class="input">
                                    <input class="input_text" data-val="true"
                                           data-val-regex="Email không đúng, vui lòng kiểm tra lại"
                                           data-val-regex-pattern="^[a-zA-Z|0-9|]+([_][a-zA-Z|0-9]+)*([.a-zA-Z|0-9]+([_][a-zA-Z|0-9]+)*)?@[a-zA-Z0-9][-a-zA-Z|0-9|]+\.([a-zA-Z][a-zA-Z|0-9]+(\.[a-zA-Z][a-zA-Z|0-9]+)?)$"
                                           data-val-required="Vui lòng nhập Email" id="Email" name="email"
                                           placeholder="Email" type="text" value="{{ old('email') }}"/>
                                    <i class="fa fa-envelope"></i>
                                    <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                                </div>
                                <?php
                                    $status = Session::get('status');
                                ?>
                                @if(isset($status))
                                    <p style="color: blue; font-size: 12px; margin-bottom: 15px; margin-top: -10px">{{ $status }}</p>
                                @endif
                                @if($errors->any())
                                    <?php $error = $errors->first(); ?>
                                    <p style="color: red; font-size: 12px; margin-bottom: 15px; margin-top: -10px">{{ $error }}</p>
                                @endif

                                <button type="submit" >Gửi</button>
                            </form>
                            <div class="clear"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
