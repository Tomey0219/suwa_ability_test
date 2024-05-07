<div>
    <button wire:click="openModal()" type="button" class="openModal">詳細</button>

    @if($showModal)
        <div class="modal_box">
            <div id="div_closebtn">
                <button wire:click="closeModal()" type="button" id="closeModal">×</button>
            </div>
            <form action="/delete" method="post">
            @method('delete')
            @csrf
                <table class="modal_tbl">
                    <tr>
                        <th>お名前</th>
                        <td>
                            <input type="text" name="name" value="{{ $content['first_name'] }}　{{ $content['last_name'] }}" readonly >

                            {{-- 裏での処理用 --}}
                            <input type="hidden" name="first_name" value="{{ $content['first_name'] }}">
                            <input type="hidden" name="last_name" value="{{ $content['last_name'] }}">
                        </td>
                    </tr>
                    <tr>
                        <th>性別</th>
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
                            <input type="text" name="gender" value="{{ $gender_name }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>
                            <input type="email" name="email" value="{{ $content['email'] }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>
                            <input type="tel" name="tel" value="{{ $content['tel'] }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>
                            <input type="text" name="address" value="{{ $content['address'] }}" readonly>    
                        </td>
                    </tr>
                    <tr>
                        <th>建物名</th>
                        <td>
                            <input type="text" name="building" value="{{ $content['building'] }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td>
                            <input type="text" name="contact_type" value="{{ $content['category']['content'] }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td>
                            <input type="text" name="contact_detail" value="{{ $content['detail'] }}" readonly>
                        </td>
                    </tr>
                </table>
                <div id="div_deletebtn">
                    <input type="hidden" name="id" value="{{ $content['id']}}" readonly>
                    <button type="submit" id="deletebtn">削除</button>
                </div>
            </form>
        </div>
    @endif
</div>
