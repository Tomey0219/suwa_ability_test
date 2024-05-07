<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

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

        return view('admin', compact('contents','categories'));
    }

    public function search(Request $request){

        $contents = Contact::with('category')->NameSearch($request->name_search)->GenderSearch($request->gender_search)->TypeSearch($request->type_search)->DateSearch($request->date_search)->get()->paginate(7);
        $categories = Category::all();

        $retention = $request->all();

        return view('admin', compact('contents','categories', 'retention'));
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


}