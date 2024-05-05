<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=>['required'],
            'last_name'=>['required'],
            'gender'=>['required'],
            'email'=>['required','email'],
            'first_tel'=>['required','numeric','max:99999'],
            'second_tel'=>['required','numeric','max:99999'],
            'third_tel'=>['required','numeric','max:99999'],
            'address'=>['required'],
            'contact_type'=>['required'],
            'contact_detail'=>['required','max:120'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'=>'※姓を入力してください　',
            'last_name.required'=>'※名を入力してください　',
            'gender.required'=>'※性別を選択してください　',
            'email.required'=>'※メールアドレスを入力してください　',
            'email.email'=>'※メールアドレスはメール形式で入力してください　',
            'first_tel.required'=>'※電話番号を入力してください　',
            'first_tel.numeric'=>'※電話番号は数字で入力してください　',
            'first_tel.max'=>"※電話番号は5桁以下で入力してください　",
            'second_tel.required'=>'※電話番号を入力してください　',
            'second_tel.numeric'=>'※電話番号は数字で入力してください　',
            'second_tel.max'=>"※電話番号は5桁以下で入力してください　",
            'third_tel.required'=>'※電話番号を入力してください　',
            'third_tel.numeric'=>'※電話番号は数字で入力してください　',
            'third_tel.max'=>"※電話番号は5桁以下で入力してください　",
            'address.required'=>'※住所を入力してください　',
            'contact_type.required'=>'※お問い合わせの種類を選択してください　',
            'contact_detail.required'=>'※お問い合わせ内容を入力してください　',
            'contact_detail.max'=>'※お問合せ内容は120文字以内で入力してください　',
        ];
    }
}
