<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable=[
        'name','description','image','status','compare_price','store_id','slug','category_id','price','rating'
    ];
    use HasFactory,SoftDeletes;
    protected static function booted()
    {
        static::addGlobalScope('store',new StoreScope);
    }
    public function category(){
       return $this->belongsTo(Category::class,'category_id','id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,
        'product_tag',
        'product_id',
            'tag_id',
        'id',
        'id');
    }
    public function rules(){
        return[
        'name'=>['required','min:5'],
        'image'=>['file','mimes:png,jpg'],
            'status'=>'in:active,draft,archived',
            'compare_price'=>['required','numeric'],
            'price'=>['required','numeric'],
            'store_id'=>'required',
            'category_id'=>'required'
            ];
    }
}
