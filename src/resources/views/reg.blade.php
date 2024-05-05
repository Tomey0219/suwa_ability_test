@extends('layout.layout')

@section('ttl')
    RegisterPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/reg.css') }}">
@endsection

@section('header_btn')
    <div class="div_register_link">
        <a href="/login" class="register_link">login</a>
    </div>
@endsection

@section('content')
    <div class="main_ttl">
        <h2>Register</h2>
    </div>
    <div class="main_box">
        <form class="reg_form" action="/register" method="post">
        @csrf
            <div class="div_reg_tbl">
            <table class="reg_tbl">
                <tr>
                    <th>お名前</th>
                </tr>
                <tr>
                    <td><input type="text" name="name" placeholder="例：山田　太朗" value="{{ old('name') }}">
                    </td>
                </tr>
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
            <button class="reg_submit_btn" type="submit">登録</button>
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