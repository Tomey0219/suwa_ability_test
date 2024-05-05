@extends('layout.layout')

@section('ttl')
    ContactPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user_contact_form.css') }}">
@endsection

@section('header_btn')
    <div class="div_register_link"></div>
@endsection

@section('content')
    <div class="main_ttl">
            <h2>Contact</h2>
    </div>
    <div class="main_input">
        <div class="div_input">
        <form class="form_user_input" action="/confirm" method="post">
        @csrf
            <table class="input_tbl">
                <tr>
                    <th>お名前<span>※</span></th>
                    <td>
                        <input id="fname_inp" type="text" name="first_name" placeholder="例：山田" 
                        value="@isset($contact){{ $contact['first_name'] }}@endisset{{ old('first_name') }}">

                        <input id="lname_inp" type="text" name="last_name" placeholder="例：太朗" 
                        value="@isset($contact){{ $contact['last_name'] }}@endisset{{ old('last_name') }}">
                    </td>
                </tr>
                @if($errors->has('first_name') or $errors->has('last_name'))
                    <tr>
                        <td colspan="2" class="error_msg">
                            {{ $errors->first('first_name') }}
                            {{ $errors->first('last_name') }} 
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>性別<span>※</span></th>
                    <td>
                        <input type="radio" id="men" name="gender" value="男性" 
                        @isset($contact)
                            {{ $contact['gender']=='男性' ? 'checked' : '' }}
                        @endisset
                        {{ old('gender')=='男性' ? 'checked' : '' }}>
                        <label for="men">男性　　　　</label>

                        <input type="radio" id="women" name="gender" value="女性"
                        @isset($contact)
                            {{ $contact['gender']=='女性' ? 'checked' : '' }}
                        @endisset
                        {{ old('gender')=='女性' ? 'checked' : '' }}>
                        <label for="women">女性　　　　</label>

                        <input type="radio" id="oth" name="gender" value="その他"
                        @isset($contact)
                            {{ $contact['gender']=='その他' ? 'checked' : '' }}
                        @endisset
                        {{ old('gender')=='その他' ? 'checked' : '' }}>
                        <label for="oth">その他　　　　</label>

                    </td>
                </tr>
                @if($errors->has('gender'))
                    <tr>
                        <td colspan="2" class="error_msg">
                            {{ $errors->first('gender') }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>メールアドレス<span>※</span></th>
                    <td>
                        <input id="email_inp" type="email" name="email" placeholder="例：test@example.com" 
                        value="@isset($contact){{ $contact['email'] }}@endisset{{ old('email') }}">
                    </td>
                </tr>
                @if($errors->has('email'))
                    <tr>
                        <td colspan="2" class="error_msg">
                            @foreach($errors->get('email') as $message)
                                {{ $message }}
                            @endforeach
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>電話番号<span>※</span></th>
                    <td>
                        <input type="tel" id="first_tel" name="first_tel" placeholder="080" 
                        value="@isset($contact){{ $contact['first_tel'] }}@endisset{{ old('first_tel') }}">
                        <label for="first_tel">ー</label>

                        <input type="tel" id="second_tel" name="second_tel" placeholder="1234" 
                        value="@isset($contact){{ $contact['second_tel'] }}@endisset{{ old('second_tel') }}">
                        <label for="second_tel">ー</label>

                        <input type="tel" id="third_tel" name="third_tel" placeholder="5678" 
                        value="@isset($contact){{ $contact['third_tel'] }}@endisset{{ old('third_tel') }}">
                    </td>
                </tr>
                @if($errors->has('first_tel') or $errors->has('second_tel') or $errors->has('third_tel') )
                    <tr>
                        <td colspan="2" class="error_msg">
                            @php
                                $firsttel_errors_array=null;
                                $secondtel_errors_array=null;
                                $thirdtel_errors_array=null;
                                $tel_errors_array=null;
                                $true_tel_errors_array=null;

                                $firsttel_errors_array = $errors -> get('first_tel');
                                $secondtel_errors_array = $errors -> get('second_tel');
                                $thirdtel_errors_array = $errors -> get('third_tel');

                                $tel_errors_array = $firsttel_errors_array + $secondtel_errors_array + $thirdtel_errors_array;

                                $true_tel_errors_array = array_unique($tel_errors_array);
                            @endphp

                            @foreach($tel_errors_array as $tel_error)
                                {{ $tel_error }}
                            @endforeach
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>住所<span>※</span></th>
                    <td>
                        <input id="adress_inp" type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" 
                        value="@isset($contact){{ $contact['address'] }}@endisset{{ old('address') }}">
                    </td>
                </tr>
                @if($errors->has('address'))
                    <tr>
                        <td colspan="2" class="error_msg">
                            {{ $errors->first('address') }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>建物名</th>
                    <td>
                        <input id="bil_inp" type="text" name="building" placeholder="例：千駄ヶ谷マンション101" 
                        value="@isset($contact){{ $contact['building'] }}@endisset{{ old('building') }}">
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせの種類<span>※</span></th>
                    <td>
                        <select id="type_sel" name="contact_type" >
                            <option value="" disabled selected style="display: none">選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}" 
                                @isset($contact)
                                    {{ $contact['contact_type']==$category['content'] ? 'selected' : '' }}
                                @endisset
                                {{ old('contact_type')==$category['id'] ? 'selected' : '' }}
                                >{{ $category['content'] }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @if($errors->has('contact_type'))
                    <tr>
                        <td colspan="2" class="error_msg">
                            {{ $errors->first('contact_type') }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>お問い合わせ内容<span>※</span></th>
                    <td>
                        <textarea id="textarea" name="contact_detail" cols="100" rows="10" placeholder="お問い合わせ内容をご記載ください">@isset($contact){{ $contact['contact_detail'] }}@endisset{{ old('contact_detail') }}</textarea>
                    </td>
                </tr>
                @if($errors->has('contact_detail'))
                    <tr>
                        <td colspan="2" class="error_msg">
                            @foreach($errors->get('contact_detail') as $message)
                                {{ $message }}
                            @endforeach
                        </td>
                    </tr>
                @endif
            </table>
            <button class="reg_submit_btn" type="submit">確認画面</button>
        </form>
        </div>
    </div>
    @foreach($errors->get('first_tel') as $message)
        <p>{{ $message }}</p>
    @endforeach
    @foreach($errors->get('second_tel') as $message)
        <p>{{ $message }}</p>
    @endforeach
    @foreach($errors->get('third_tel') as $message)
        <p>{{ $message }}</p>
    @endforeach
@endsection