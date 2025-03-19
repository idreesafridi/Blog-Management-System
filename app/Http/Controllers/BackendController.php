<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\BlogAttachment;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 


class BackendController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->get('q');  // Search term sent from Select2
        $items = category::where('name', 'like', '%' . $query . '%') // Search in the `name` column
                     ->limit(10) // Limit to 10 results
                     ->get();

        return response()->json([
            'items' => $items->map(function ($item) {
                return [
                    'id' => $item->id, // This is what Select2 will use as the value
                    'text' => $item->name // This is what Select2 will display
                ];
            })
        ]);
    }
   
    Public function User()
    {
        return view('Backend.auth.register_user');
    }


    // public function CreateUser(Request $request)
    // {
    //     // return $request->all();
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email',
    //         // 'file' => 'required|mimes:jpg,jpeg,png,pdf,docx|max:2048', 
    //         'password' => 'required|string|min:8',
    //     ]);
    
    //     $filePath = null;
    
    //     if ($request->hasFile('file') && $request->file('file')->isValid()) {
    //         $file = $request->file('file');
    //         $filePath = $this->storeFile('user_images',$file);
    //         // $filePath = $file->store('user_images', 'public');
    //     }
    
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'file' => $filePath, 
    //         'password' => bcrypt($request->password),
    //     ]);
    //     if ($user) {
    //         return redirect()->route('login')->with([
    //             'type' => 'success',
    //             'msg' => 'User registered successfully',
    //             'title' => 'Done!',
    //         ]);
    //     }
    //      else {
    //         return redirect()->route('register')->with([
    //             'type' => 'error',
    //             'msg' => 'Unable to register user',
    //             'title' => 'Fail!',
    //         ]);
    //     }
    // }
    
   
    public function dashboard()
    {
        $blogs          = Blog::get();
        $categories     = category::get();
        $newsletters    = newsletter::get();
        $contacts       = contact::get();
        return view('backend.dashboard', compact('blogs','categories','newsletters','contacts'));
    }

   public function categories()
   {
        $categories = Category::get(); 
        return view('backend.categories',compact('categories'));
   }

  public function showCategory($id)
  {
    $categories = Category::find($id);
    return view('backend.category_view',compact('categories'));
  }

   public function createCategory(Request $request)
   {
        extract($request->all());
        $validated = $request->validate([
            'parent_category_id' => 'nullable|exists:categories,id',  
            'name' => 'required|string|max:255',
            'status' => 'required|boolean', 
        ]);
        $category = Category::create(['name'=>$name,'status'=>$status,'parent_category_id'=>$parent_category_id]);
        if($category!=null){
            return redirect()->route('categories')->with(['type'=>'success','msg'=>'Category created successfully','title'=>'Done!']);
        }else{
            return redirect()->route('categories')->with(['type'=>'error','msg'=>'Unable to create category','title'=>'Fail!']);
        }

   }

   public function editCategory( $id)
   {
    $categories = category::find($id);

    return View('backend.categories',compact('categories'));

   }

   public function categoryUpdate(Request $request)
   {
        // return $request->all();
        extract($request->all());
        $validated = $request->validate([
            'parent_category_id' => 'nullable|exists:categories,id',  
            'name' => 'required|string|max:255',
            'status' => 'required|boolean', 
        ]);
        $category = Category::where('id',$category_id)->update(['name'=>$name,'status'=>$status,'parent_category_id'=>$parent_category_id]);
        if($category){
            return redirect()->route('categories')->with(['type'=>'success','msg'=>'Category Update successfully','title'=>'Done!']);
        }else{
            return redirect()->route('categories')->with(['type'=>'error','msg'=>'Unable to Update category','title'=>'Fail!']);
        }
   }

   
   public function destroyCategory($id)
   {

    $delete = category::find($id)->delete();

    if($delete){
        return redirect()->route('categories')->with(['type'=>'success','msg'=>'Category delete successfully','title'=>'Done!']);
    }else{
        return redirect()->route('categories')->with(['type'=>'error','msg'=>'Unable to delete category','title'=>'Fail!']);
    }
   }
    

   public function blog()
   {
        $blogs = blog::get();
         return view('backend.blogs', compact('blogs'));
   }

   public function blogCreate()
   {
        $categories = Category::get();
        
        return view('backend.blog_create',compact('categories'));
   }

   public function showBlog($id)
   {
         $blogs = blog::find($id);
         $blogcomments = $blogs->comments; 
         return view('backend.blog_view',compact('blogs','blogcomments'));
   }
  
   public function blogStore(Request $request)
   {  
    extract($request->all());
    // return $request->all();
       $validated = $request->validate([
           'category_id' => 'required|exists:categories,id',  
           'title' => 'required|string|max:255',
           'description' => 'nullable|string',
        //    'file.*' => 'nullable|mimes:jpg,jpeg,png,pdf,docx|max:2048',  
           'status' => 'required|boolean',
       ]);
       $post = Blog::create([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
    ]);
    if ($request->hasFile('file')) {
        foreach ($request->file('file') as $file) {
            $path = $this->storeFile('blog_attachments',$file);
            $item = BlogAttachment::create([
                'blog_id' => $post->id,
                'file' => $path,
            ]);
        }
    }

    if (isset($tags) && $tags!=null) {
        foreach (explode(',',$tags) as $tag) {
            $tag = BlogTag::create([
                'blog_id' => $post->id,
                'name' => $tag,
            ]);
        }
    }
    if($item!=null){
        return redirect()->route('posts')->with(['type'=>'success','msg'=>'Category created successfully','title'=>'Done!']);
    }else{
        return redirect()->route('posts_create')->with(['type'=>'error','msg'=>'Unable to create category','title'=>'Fail!']);
    }

   }

   public function editBlog($id)
   {
       $blog = Blog::findOrFail($id);
       $categories = Category::get();
   
       return view('backend.blog_update', compact('blog','categories'));
   }

   public function blogUpdate(Request $request, $id)
   {
        extract($request->all());

//     return $request->all();

    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id', 
        'title' => 'required|string|max:255',
        // 'description' => 'nullable|string',
        'status' => 'required',
    ]);
    
    $result = Blog::where('id',$id)->update([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
    ]);
    if (isset($tags) && $tags != null) {
        BlogTag::where('blog_id', $id)->delete();
        foreach (explode(',',$tags) as $tag) {
            $tag = BlogTag::create([
                'blog_id' => $id,
                'name' => $tag,
            ]);
        }
    
    }

    if ($request->hasFile('file')) {
        foreach ($request->file('file') as $file) {
            $path = $this->storeFile('blog_attachments', $file);
            BlogAttachment::create([
                'blog_id' => $id,
                'file' => $path,
            ]);
        }
    }


    if($result){
        return redirect()->route('posts')->with(['type'=>'success','msg'=>'Blog Update successfully','title'=>'Done!']);
    }else{
        return redirect()->route('posts')->with(['type'=>'error','msg'=>'Unable to Update Blog','title'=>'Fail!']);
    }

   }

   
   public function blogDestroy($id)
   {

    $delete = Blog::find($id)->delete();

    if($delete){
        return redirect()->route('posts')->with(['type'=>'success','msg'=>'Blog delete successfully','title'=>'Done!']);
    }else{
        return redirect()->route('posts')->with(['type'=>'error','msg'=>'Unable to delete Blog','title'=>'Fail!']);
    }
   }
    

   public function newsletters()
   {
    $news = Newsletter::get();
        return view('backend.Newsletters',compact('news'));
   }

   public function newsDestroy($id)
   {

    $delete = Newsletter::find($id)->delete();

    if($delete){
        return redirect()->route('newsletters')->with(['type'=>'success','msg'=>'Newsletter delete successfully','title'=>'Done!']);
    }else{
        return redirect()->route('newsletters')->with(['type'=>'error','msg'=>'Unable to delete Newsletter','title'=>'Fail!']);
    }
   }

   public function contact()
   {
        $contacts = contact::get();
        return view('backend.contacts',compact('contacts'));
   }

   public function contactDestroy($id)
   {

    $delete = Contact::find($id)->delete();

    if($delete){
        return redirect()->route('contacts')->with(['type'=>'success','msg'=>'Contact delete successfully','title'=>'Done!']);
    }else{
        return redirect()->route('contacts')->with(['type'=>'error','msg'=>'Unable to delete Contact','title'=>'Fail!']);
    }
   }



}
