@extends('layout.layout')

@section('ttl')
    LoginPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header_btn')
    <div class="div_login_link">
        <a href="/register" class="login_link">register</a>
    </div>
@endsection

@section('content')
    <div class="main_ttl">
        <h2>Login</h2>
    </div>
    <div class="main_box">
        <form class="login_form" action="/login" method="post">
        @csrf
            <div class="div_login_tbl">
            <table class="login_tbl">
                <tr>
                    <th>メールアドレス</th>
                </tr>
                <tr>
                    <td><input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}"></td>
                </tr>
                <tr>
                    <th>パスワード</th>
                </tr>
                <tr>
                    <td><input type="text" name="password" placeholder="例：coachtech1106" value="{{ old('password') }}"></td>
                </tr>
            </table>
            </div>
            <button class="login_submit_btn" type="submit">ログイン</button>
        </form>
        <div class="div_val_error">
            @if (count($errors)>0)
                <ul class="val_error">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection