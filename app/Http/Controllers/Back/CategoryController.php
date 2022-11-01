<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('back.categories.index',compact('categories'));
    }
    public function switch(Request $request){
        $category=Category::findOrFail($request->id);
        $category->status=$request->statu=="true" ? 1 : 0 ;
        $category->save();
    }
    public function create(Request $request){
        // print_r($request->post()); // test icin bu komutu kullanabiliriz.
        $isExist=Category::whereSlug(str::slug($request->category))->first();
        if($isExist){
            toastr()->error($request->category.' category exist!!!');
            return redirect()->back();
        }
        $category = new Category;
        $category->name=$request->category;
        $category->slug=str::slug($request->category);
        $category->save();
        toastr()->success('Category Successfully Created');
        return redirect()->back();
    }
    public function getData(Request $request){
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }
    public function update(Request $request){
        $isSlug=Category::whereSlug(str::slug($request->slug))->whereNotIn('id',[$request->id])->first();
        $isName=Category::whereName($request->category)->whereNotIn('id',[$request->id])->first();
        if($isSlug or $isName){
            toastr()->error($request->category.' category exist!!!');
            return redirect()->back();
        }
        $category = Category::find($request->id);
        $category->name=$request->category;
        $category->slug=str::slug($request->slug);
        $category->save();
        toastr()->success('Category Successfully Edited');
        return redirect()->back();
    }
    public function delete(Request $request){
        $category=Category::findOrFail($request->id);
        if($category->id==1){
            toastr()->error('Bu kategori silinemez');
            return redirect()->back();
        }
        $message='';
        $count=$category->articleCount();
        if($count>0){
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
            $defaultCategory=Category::find(1);
            $message=$count.' articles transferred to '.$defaultCategory->name.' category section.';
        }
        $category->delete();
        toastr()->success('Category Successfully deleted.'.$message);
        return redirect()->back();
    }
}
