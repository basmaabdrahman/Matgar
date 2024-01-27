<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable=[
        'name','description','parent_id','status','image','slug',
    ];
    public function scopeActive(Builder $builder){
        $builder->where('status','=','active');
    }
    public function scopeFilter(Builder $builder,$filters ){
        $builder->when($filters['name'] ?? false  ,function($builder ,$value){
           $builder->where('categories.name','LIKE',"%{$value}%");
        });
        $builder->when($filters['status'] ?? false, function ($builder ,$value){
           $builder->where('categories.status','=',$value);
        });
    }
    public static function rules($id=0)
    {
        return [
            'name'=>['required',
                'string',
                'min:5',
                Rule::unique('categories','name')->ignore($id)],
            'parent_id'=>'nullable|int|exists:categories,id',

            'image'=>'file'
            ,'status'=>'in:active,archived',
        ];
    }

}
