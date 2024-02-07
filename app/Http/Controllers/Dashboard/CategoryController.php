<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $request=request();
        $query=Category::query();
        /*
        select * from categories ,*categories as parents,categories.id,=,parents.parent_id
        categories.name,parents.name as parents_name
        */
        $categories=Category::with(['parent'])/*leftJoin('categories as parents','parents.id','=','categories.parent_id')
            ->select(['categories.*','parents.name as parent_name'])*/
            ->withCount([
                'products as product_number'=>function($query){
                return $query->where('status','active');
                }
        ])
            ->filter($request->query())
            ->orderBy('categories.name')
            ->paginate();
       return view('dashboard.categories.index',compact('categories'));
    }

    public function create()
    {$parents=Category::all();
        $category=new Category();
        return view('dashboard.categories.create',compact('parents','category'));
    }


    public function store(Request $request)
    {
        $request->validate(Category::rules());
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $data = $request->all();


            $data['image'] = $this->uploadimage($request);

        $category=Category::create(
            $data);
        return redirect()->route('dashboard.categories.index')->with('success','Category Added');
    }


    public function show(Category $category)
    {
        return view('dashboard.categories.show',compact('category'));
    }


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


    public function update(CategoryRequest $request, string $id)
    {
        $category=Category::find($id);
        $old_image=$category->image;
        $data=$request->except('image');
            $new_image=$this->uploadimage($request);
            if ($new_image){
                $data['image']=$new_image;
            }

        $category->update($data);

        if ($old_image && $new_image ){
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('dashboard.categories.index')->with('info','Category Updated');
    }


    public function destroy(string $id)
    {
        $category=Category::findorfail($id);
        $category->delete();
//        Storage::delete()

        return redirect()->route('dashboard.categories.index')->with('danger','Category Deleted');
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
        public function trash(){
        $categories=Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trashed',compact('categories'));
        }
        public function restore(Request $request, $id){

        $category=Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect(route('dashboard.categories.index'))->with('info','Category has been restored');
        }
        public function forceDelete($id){
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
            if ($category->image){
                Storage::disk('public')->delete($category->image);
            }
        return redirect(route('dashboard.categories.index'))->with('danger','Category has been Deleted');
        }
}
