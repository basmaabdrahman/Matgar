<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','description','parent_id','status','image','slug',
    ];
    public static function rules($id=0)
    {
        return [
            'name'=>['required',
                'string',
                'min:5',
                Rule::unique('categories','name')->ignore($id)],
            'parent_id'=>'nullable|int|exists:categories,id',

            'image'=>'file'
            ,'status'=>'in:active,archived'
        ];
    }

}
