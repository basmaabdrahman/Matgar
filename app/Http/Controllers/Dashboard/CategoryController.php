<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all(); //return collection object
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {$parents=Category::all();
        $category=new Category();
        return view('dashboard.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {//dd($request['image']);
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $data = $request->all();


            $data['image'] = $this->uploadimage($request);

        $category=Category::create(
            $data);
        return redirect()->route('dashboard.categories.index')->with('success','Category Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::findOrFail($id);
        $parents=Category::where('id','<>',$id)
            ->where(function ($query) use($id){
                $query->whereNull('parent_id')
                    ->orwhere('parent_id','<>',$id);
            })->get();
        return view('dashboard.categories.update',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category=Category::find($id);
        $old_image=$category->image;
        $data=$request->except('image');


            $data['image']=$this->uploadimage($request);


        $category->update($data);

        if ($old_image && $data['image'] ){
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('dashboard.categories.index')->with('edit','Category Updated');
    }


    public function destroy(string $id)
    {
        $category=Category::findorfail($id);
        $category->delete();
//        Storage::delete()
        if ($category->image){
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.index')->with('delete','Category Deleted');
    }
    protected function uploadimage(Request $request){
        if (!$request->hasFile('image')) {
            return;
        }
            $image = $request->file('image');
            $path=$image->store('/images/categories',
                ['disk'=>'public']);
            return $path;
        }

}
