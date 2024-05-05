<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function scopeNameSearch($query,$name){
        if(!empty($name)){
            $query->where('first_name', 'like','%'.$name.'%')->orWhere('last_name', 'like' , '%'.$name.'%')->orWhere('email','like','%'.$name.'%');
        }
    }

    public function scopeGenderSearch($query,$gender){
        if(!empty($gender) and $gender!=4){
            $query->where('gender', $gender);
        }
    }

    public function scopeTypeSearch($query,$type){
        if(!empty($type and $type!=10)){
            $query->where('category_id', $type);
        }
    }

    public function scopeDateSearch($query,$date){
        if(!empty($date)){
            $query->whereDate('created_at', $date);
        }
    }

}
