<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\BlogAttachment;
use App\Models\BlogComment;
use App\Models\BlogLike;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscription;
use View;
use Auth;

class WebsiteController extends Controller
{
    public function __construct()
    { 
        $blogs = Blog::where('status', 1)
        ->with('Bloglikes')
        ->orderBy('id', 'DESC')->get();
        $categories = Category::get();
        $tags =  BlogTag::get();
       
        View::share('blogs', $blogs);
        View::share('categories', $categories);
        view::share('tags', $tags);
    }


    public function index()
    {
        
        // $tags =  BlogTag::get();
        return view('website.index' );
    }

    // public function blogs()
    // {

    //     return view('website.blogs');
    // }
   public function categoryWise(category $category)
   {
    $posts = $category->blogs()->get();
        return view('website.category_wise', compact('category', 'posts'));
   }

    public function blogDetail($id)
    {
       $blog_detail = Blog::find($id);
       $blogcomments = $blog_detail->comments;
       return view('website.blog_detail',compact('blog_detail','blogcomments'));
    }

    public function blogTagdetail($id)
    {
        $tag_detail = BlogTag::find($id);
    //    $blog_tag_detail= Blog::where('id', $tag_detail->blog_id)->get();
   
        $blogs_tag = $tag_detail->blog;
        //  dd($blogs_tag);
        return view('website.blogtag_detail',compact('tag_detail', 'blogs_tag'));
        
                
    }
    
    public function postComment(Request $request)
    {
            //  $validated = $request->validate([  
            //     'name' => 'required|string|max:255',
            //     'comment' => 'required|string|max:255',
            // ]);
            $comment = BlogComment::create([
            'blog_id'=> $request->post_id,
            'name' => $request->name,
            'status' => 1,
            'comment' => $request->message,
            ]);

            if( $comment!=null){
                return redirect()->back()->with(['type'=>'success','msg'=>'comment save successfully','title'=>'Done!']);
            }else{
                return redirect()->back()->with(['type'=>'error','msg'=>'Unable to Save comment','title'=>'Fail!']);
            }


    }


    public function contact()
    {
        
        $categories = Category::get();
       return view('website.contact',compact('categories'));
    }

    public function contactCreate(Request $request)
    {

                // return $request->all();
            $validated = $request->validate([  
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phone' => 'nullable|string',
                'message' => 'required|string|max:255',
            ]);
            $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->number,
            'message' => $request->message,
            ]);

            if( $contact!=null){
                return redirect()->route('contact')->with(['type'=>'success','msg'=>'Message sent successfully','title'=>'Done!']);
            }else{
                return redirect()->route('contact')->with(['type'=>'error','msg'=>'Unable to Send message','title'=>'Fail!']);
            }

    }

    public function createNewletter(Request $request)
    {
        // extract($request->all());
                // return $request->all();
            // $validated = $request->validate([  
            //     'email' => 'required|string|max:255',
            // ]);
            // $newletter = Newsletter::create([
            // 'email' => $request->email,
            // ]);

            $request->validate([
                'email' => 'required|string|max:255', 
            ]);
    
            $newsletter = Newsletter::create(['email' => $request->email]);
    
            Mail::to($request->email)->send(new NewsletterSubscription($request->email));
    

            if( $newsletter!=null){
                return redirect()->route('index')->with(['type'=>'success','msg'=>'Message sent successfully','title'=>'Done!']);
            }else{
                return redirect()->route('index')->with(['type'=>'error','msg'=>'Unable to Send message','title'=>'Fail!']);
            }

    }


    public function likeBlog($blogId)
    {
        $user = Auth::user(); // Get the currently authenticated user
        $blog = Blog::findOrFail($blogId); // Get the blog by ID

        // Check if the user has already liked the blog
        $like = BlogLike::where('user_id', $user->id)
                    ->where('blog_id', $blog->id)
                    ->first();

        if ($like) {
            return redirect()->route('index')->with(['type'=>'success','msg'=>'You have already liked this blog.','title'=>'Done!']);
        
        }

        // Create a new like
        $result = BlogLike::create([
            'user_id' => $user->id,
            'blog_id' => $blog->id,
        ]);

        if(  $result!=null){
            return redirect()->route('index')->with(['type'=>'success','msg'=>'Blog Like successfully','title'=>'Done!']);
        }else{
            return redirect()->route('index')->with(['type'=>'error','msg'=>'Unable to like blog','title'=>'Fail!']);
        }
    }

    public function unlikeBlog($blogId)
    {
        $user = Auth::user();
        $blog = Blog::findOrFail($blogId);

        // Check if the user has liked the blog
        $like = BlogLike::where('user_id', $user->id)
                    ->where('blog_id', $blog->id)
                    ->first();

        if ($like) {
            
            return redirect()->route('index')->with(['type'=>'success','msg'=>'You have already unliked this blog.','title'=>'Done!']);
        
        }
        $like->delete();

        if(  $like!=null){
            return redirect()->route('index')->with(['type'=>'success','msg'=>'Blog Like successfully','title'=>'Done!']);
        }else{
            return redirect()->route('index')->with(['type'=>'error','msg'=>'Unable to like blog','title'=>'Fail!']);
        }
    }



}
