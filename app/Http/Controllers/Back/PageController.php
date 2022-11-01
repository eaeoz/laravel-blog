<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index(){
        $pages=Page::all();

        return view('back.pages.index',compact('pages'));
    }

    public function switch(Request $request){
        $page=Page::findOrFail($request->id);
        $page->status=$request->statu=="true" ? 1 : 0 ;
        $page->save();
    }
    public function create(){
        return view('back.pages.create');
    }
    public function post(Request $request)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $last=Page::orderBy('order','desc')->first();
        // dd($last); // bu komutla ciktiya bakabiliriz.kendisi programi sonlandirip cikti verecektir.

        $page=new Page;
        $page->title=$request->title;
        $page->content=$request->content;
        $page->order=$last->order+1;
        $page->slug=str::slug($request->title);
        if($request->hasFile('image')){
            $imageName=str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='uploads/'.$imageName;
        }
        $page->save();
        toastr()->success('Page created succesfully');
        return redirect()->route('admin.page.index');
    }
    public function update($id){
        $page=Page::findOrFail($id);

        return view('back.pages.update',compact('page'));
    }
    public function edit(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $page=Page::findOrFail($id);
        $page->title=$request->title;
        $page->content=$request->content;
        $page->slug=str::slug($request->title);
        if($request->hasFile('image')){
            $imageName=str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='uploads/'.$imageName;
        }
        $page->save();
        toastr()->success('Page updated succesfully');
        return redirect()->route('admin.page.index');
    }
    // public function delete($id){
    //     Page::find($id)->delete();
    //     toastr()->success('Page Moved to Trash');
    //     return redirect()->route('admin.page.index');
    // }

    public function delete($id){
        $page=Page::find($id);
        if(File::exists($page->image)){
            File::delete(public_path($page->image));
        }
        $page->delete();
        toastr()->success('Page Successfully Deleted');
        return redirect()->route('admin.page.index');
    }
    public function orders(Request $request){
        // dd($request->get('orders')); ordere burdan gorebiliriz payload icin
        foreach($request->get('page') as $key => $order ){
            Page::where('id',$order)->update(['order'=>$key]);
        }
    }
}
