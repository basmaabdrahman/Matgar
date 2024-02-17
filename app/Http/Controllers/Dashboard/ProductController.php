<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::with(['store','category'])->paginate();
        return view('dashboard.products.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product=new Product();
        $stores=Store::all();
        $categories=Category::all();
        return view('dashboard.products.create',compact(['product','stores','categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate((new \App\Models\Product)->rules());
        $request->merge(['slug'=> Str::slug($request->post('name'))]);

        $data=$request->except('tag');
        $data['image']=$this->uploadImage($request);
        $tag=$request->post('tag');

        Tag::create([
            'name'=>$tag,
            'slug'=>Str::slug($tag)
        ]);
        $product=Product::create($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Product::findorFail($id);
        $tags=implode(',',$product->tags()->pluck('name')->toArray());
        return view('dashboard.products.update',compact(['product','tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tag'));
        $tags=explode(',',$request->input('tag'));
        $saved_tags=Tag::all();
        $tag_ids=[];
        foreach ($tags as $t_name){
            $slug=Str::slug($t_name);
            $tag=$saved_tags->where('slug',$slug)->first();
            if(!$tag){
                $tag=Tag::create([
                    'name'=>$t_name,
                    'slug'=>$slug
                ]);
            }
            $tag_ids[]=$tag->id;
        }
        $product->tags()->sync($tag_ids);
        return redirect()->route('dashboard.products.index')->with('success','product update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::findorfail($id);
        $product->delete();
        return redirect()->route('dashboard.products.index')->with('danger','Product moved to trash ');
    }
    public function uploadImage(Request $request){
        if(!$request->hasFile('image')){
            return;
        }
        $image=$request->file('image');
        $path=$image->store('/images/products',
            ['disk'=>'public']);
        return $path;
    }
    public function trash(){
       $products=Product::onlyTrashed()->paginate(10);
       return view('dashboard.products.trash',compact('products'));
    }
    public function restore(Request $request,$id){
        $product=Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('dashboard.products.index')->with('success','Product has been restored');
    }
    public function forceDelete(Request $request,$id){
        $product=Product::onlyTrashed()->findorFail($id);
        $product->forceDelete();
        return redirect()->route('dashboard.products.index')->with('success','Product deleted successfully');

    }
}
