@extends('layout.layout')

@section('ttl')
    AdminPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header_btn')
    <div class="div_logout">
        <form class="logout_form" action="/logout" method="post">
        @csrf
            <button class="logout_btn">logout</button>
        </form>
    </div>
@endsection

@section('content')
    <div class="main_ttl">
            <h2>Admin</h2>
    </div>
    <div class="div_search">
        <form class="form_search" action="?" method="POST">
        @csrf

        <input class="name_search" type="text" name="name_search" placeholder="名前やメールアドレスを入力してください" value="@isset($retention['name_search']){{ $retention['name_search'] }}@endisset">

        <select class="gender_search" name="gender_search">
            <option value="" disabled selected style="display: none">性別</option>
            <option value="4" @isset($retention['gender_search']){{ $retention['gender_search']=='4' ? 'selected' :'' }}@endisset>全て</option>
            <option value="1" @isset($retention['gender_search']){{ $retention['gender_search']=='1' ? 'selected' :'' }}@endisset>男性</option>
            <option value="2" @isset($retention['gender_search']){{ $retention['gender_search']=='2' ? 'selected' :'' }}@endisset>女性</option>
            <option value="3" @isset($retention['gender_search']){{ $retention['gender_search']=='3' ? 'selected' :'' }}@endisset>その他</option>
        </select>

        <select class="type_search" name="type_search">
            <option value="" disabled selected style="display: none">お問い合わせの種類</option>
            <option value="10" @isset($retention['type_search']){{ $retention['type_search']==10 ? 'selected' :'' }}@endisset>全て</option>
            @foreach ($categories as $category)
                <option value="{{ $category['id'] }}" @isset($retention['type_search']){{ $retention['type_search']==$category['id'] ? 'selected' :'' }}@endisset>{{ $category['content'] }}</option>
            @endforeach
        </select>

        <input class="date_search" type="date" name="date_search" value="@isset($retention['date_search']){{ $retention['date_search'] }}@endisset">

        <button class="search_btn" type="submit" formaction="/search">検索</button>

        <button class="reset_btn" type="submit" formaction="/admin">リセット</button>

        </form>
    </div>
    <div class="div_pagenation">
        <button class="export_btn" type="submit" >エクスポート</button>

        {{ $contents->links('vendor.pagination.tailwind') }}

    </div>
    <div class="div_content">
        <table class="content_table">
            <tr>
                <th id="name_clm">お名前</th>
                <th id="gender_clm">性別</th>
                <th id="mail_clm">メールアドレス</th>
                <th id="type_clm">お問い合わせの種類</th>
                <th id="btn_clm"></th>
            </tr>
            @foreach ($contents as $content)
            <tr>
                <td>{{ $content['first_name'] }}　{{ $content['last_name'] }}</td>
                <td>
                    @php
                        if($content['gender']==1){
                            $gender_name='男性';
                        }elseif($content['gender']==2){
                            $gender_name='女性';
                        }else {
                            $gender_name='その他';
                        }
                    @endphp
                    {{ $gender_name }}
                </td>
                <td>{{ $content['email'] }}</td>
                <td>{{ $content['category']['content'] }}</td>
                <td><button>詳細</button></td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection