@extends('layout.layout')

@section('ttl')
    ConfirmPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user_contact_confirm.css') }}">
@endsection

@section('header_btn')
    <div class="div_register_link"></div>
@endsection

@section('content')
    <div class="main_ttl">
            <h2>Confirm</h2>
    </div>
    <div class="main_input">
    <div class="div_confirm">
        <form class="form_confirm" action="?" method="post">
        @csrf
            <table class="confirm_tbl">
                <tr>
                    <th>お名前</th>
                    <td>
                        <input type="text" name="name" value="{{ $contact['first_name'] }}　{{ $contact['last_name'] }}" readonly >

                        {{-- 裏での処理用 --}}
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        <input type="text" name="gender" value="{{ $contact['gender'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>
                        <input type="email" name="email" value="{{ $contact['email'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>
                        <input type="tel" name="tel" value="{{ $contact['first_tel'] }}{{ $contact['second_tel'] }}{{ $contact['third_tel'] }}" readonly>

                        {{-- 裏での処理用 --}}
                        <input type="hidden" name="first_tel" value="{{ $contact['first_tel'] }}">
                        <input type="hidden" name="second_tel" value="{{ $contact['second_tel'] }}">
                        <input type="hidden" name="third_tel" value="{{ $contact['third_tel'] }}">
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>
                        <input type="text" name="contact_type" value="{{ $contact['contact_type'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>
                        <input type="text" name="contact_detail" value="{{ $contact['contact_detail'] }}" readonly>
                    </td>
                </tr>
            </table>
            <div class="div_confirm_btn">
                <button class="reg_db_btn" type="submit" formaction="/reg_contact_form">送信</button>

                <button class="correct_btn" type="submit" formaction="/correct">修正</button>
            </div>
        </form>
    </div>
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