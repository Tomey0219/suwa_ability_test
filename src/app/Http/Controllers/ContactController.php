<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    // public function reg_disp(){
    //     return view('reg');
    // }

    // public function reg_db(Request $request){
    //     $user = $request->all();
    //     User::create($user);
    //     return redirect('/register');
    // }

    // public function login_disp(){
    //     return view('login');
    // }

    public function admin_disp(){

        $contents = Contact::with('category')->get()->paginate(7);
        $categories = Category::all();

        $export_contents = Contact::all();

        return view('admin', compact('contents','categories','export_contents'));
    }

    public function search(Request $request){

        $contents = Contact::with('category')->NameSearch($request->name_search)->GenderSearch($request->gender_search)->TypeSearch($request->type_search)->DateSearch($request->date_search)->get()->paginate(7);
        $categories = Category::all();

        $retention = $request->all();

        $export_contents = Contact::with('category')->NameSearch($request->name_search)->GenderSearch($request->gender_search)->TypeSearch($request->type_search)->DateSearch($request->date_search)->get();

        return view('admin', compact('contents','categories', 'retention','export_contents'));
    }

    public function contact_disp(){
        $categories=Category::all();

        return view('user_contact_form',['categories'=>$categories]);
    }

    public function confirm(ContactRequest $request){

        $category_id=$request->contact_type;
        $category = Category::find($category_id);

        $contact = [
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'gender'=>$request->gender,
            'email'=>$request->email,
            'first_tel'=>$request->first_tel,
            'second_tel'=>$request->second_tel,
            'third_tel'=>$request->third_tel,
            'address'=>$request->address,
            'building'=>$request->building,
            'contact_type'=>$category->content,
            'contact_detail'=>$request->contact_detail
        ];

        return view('user_contact_confirm',['contact'=>$contact]);
    }

    public function correct(Request $request){

        $contact = $request->only(['first_name','last_name','gender','email','first_tel','second_tel','third_tel','address','building','contact_type','contact_detail']);

        $categories=Category::all();
    
        return view('user_contact_form',['contact'=>$contact,'categories'=>$categories]);
    }

    public function reg_db(Request $request){

        $category_name=$request->contact_type;
        $category = Category::where('content',"$category_name")->first();

        $gender_name=$request->gender;

        if($gender_name=="男性"){
            $gender_id = 1;
        }elseif($gender_name=="女性"){
            $gender_id = 2;
        }else{
            $gender_id = 3;
        }

        $contact = [
            'category_id'=>$category->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'gender'=>$gender_id,
            'email'=>$request->email,
            'tel'=>$request->tel,
            'address'=>$request->address,
            'building'=>$request->building,
            'detail'=>$request->contact_detail
        ];

        Contact::create($contact);

        return view('user_contact_thanks',['contact'=>$contact]);

    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin');
    }

    public function export(Request $request){

        $contents=[];

        // ヘッダーデータ
        $csvHeader = ['id','category','first_name', 'last_name' , 'gender' , 'email', 'tel', 'address', 'building', 'detail'];
    
        array_push($contents, $csvHeader);

        $content_ids = $request->export_data;

        // データベースからデータ取得
        foreach ($content_ids as $content_id) {
            $content=Contact::find($content_id);
            $content_array=[
                $content->id,
                $content->category_id,
                $content->first_name,
                $content->last_name,
                $content->gender,
                $content->email,
                $content->tel,
                $content->address,
                $content->building,
                $content->detail
            ];
            
            array_push($contents, $content_array);
        }
    
        $date = date("Ymd");

        $csvFileName = 'C:\Users\enap0\OneDrive\ドキュメント\Coachtech\確認テスト\contactdata_export_at_' . $date .  '.csv';
        $fileName = 'contactdata_export_at_' . $date .  '.csv';
        $stream = fopen($csvFileName, 'w');

        foreach($contents as $content){

            mb_convert_variables('SJIS', 'UTF-8', $content);
            fputcsv($stream, $content);
        }

        fclose($stream);

        // ダウンロードダイアログ表示
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $fileName); 

        readfile($csvFileName);

        return redirect('/admin');
    }


}