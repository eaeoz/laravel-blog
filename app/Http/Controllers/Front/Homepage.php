<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

// Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\contact;
use App\Models\Config;



class Homepage extends Controller
{
    public function __construct()
    {
        if(Config::find(1)->active==0){
            return redirect()->to('under-const')->send();
        }
        view()->share('pages',Page::where('status',1)->orderBy('order','ASC')->get());
        view()->share('categories',Category::where('status',1)->inRandomOrder()->get());
        view()->share('config',Config::find(1));
    }
    public function index()
    {
        $data['articles'] = Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
            $query->where('status',1);
        })->orderBy('created_at', 'DESC')->paginate(10);
        $data['articles']->withPath(url('articles'));

        return view('front.homepage', $data);
    }

    public function single($category, $slug)
    {
        $category=Category::whereSlug($category)->first() ?? abort(403, "Could not find specified category");
        $article=Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Could not find any article');
        $article->increment('hit');
        $data['article']=$article;

        return view('front.single', $data);
    }

    public function category($slug){
        $category=Category::whereSlug($slug)->first() ?? abort(403, "Could not find specified category");
        $data['category']=$category;
        $data['articles']=Article::where('category_id',$category->id)->where('status',1)->orderBy('created_at', 'DESC')->paginate(2);

        return view('front.category',$data);
    }

    public function page($slug){
        $page=Page::whereSlug($slug)->first() ?? abort(403,'Boyle bir sayfa bulunamadi.');
        $data['page']=$page;
        return view('front.page',$data);
    }

    public function contact(){
        return view('front.contact');
    }

    public function contactpost(Request $request){
        $rules=[
            'name'=>'required|min:5',
            'email'=>'required|email',
            'topic'=>'required',
            'message'=>'required|min:10'
        ];

        $validate=Validator::make($request->post(),$rules);
        if($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        Mail::raw('Sender: '.$request->name.'
        Sender Address: '.$request->email.'
        Message Subject: '.$request->topic.'
        Message: '.$request->message.'
        Message Date: '.now().'', function ($message) use($request){
            $message->from('hello@example.com', 'John Doe');
            $message->to('sedatergoz@gmail.com');
            $message->subject($request->name,' sent message!');
        });

        // $contact = new Contact;
        // $contact->name=$request->name;
        // $contact->email=$request->email;
        // $contact->topic=$request->topic;
        // $contact->message=$request->message;
        // $contact->save();
        return redirect()->route('contact')->with('success','Your message received. Thank you!!');
    }

}
