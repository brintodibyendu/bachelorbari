<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
//use Illuminate\Database\Capsule\Manager as DB;
class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show','search']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $posts= Post::orderBy('title','desc')->get();
        //$posts= Post::orderBy('title','desc')->take(1)->get();
       // $posts=Post::al
        //return User::all();
        //return Post::where('title','second post')->get(); 
      //  $posts=DB::select('SELECT * FROM posts');
       $posts= Post::orderBy('title','desc')->paginate(5);
        return view('posts.index')->with('posts',$posts);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }



    public function search(Request $request)
    {
        $search= $request->get('search');
     //    $posts= Post::orderBy('title','desc')->paginate(5);
        $posts=DB::table('posts')->where('title','LIKE','%'.$search.'%')->paginate(5);
        //echo $posts;
       // return view('posts.index')->with('post',$post);
        return view('posts.index',['posts'=>$posts]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        $this->validate($request,['title'=>'required','body'=>'required',
             'cover_image'=>'image|nullable|max:1999']);
        //handle file
        if($request->hasFile('cover_image'))
        {
            //Get filename with extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //Get just file name
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        else{
            $fileNameToStore='noimage.jpg';
        }


        //create post
        $post=new Post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id=  auth()->user()->id; 
        $post->type=$request->input('type');
        $post->room_no=$request->input('room_no');
        $post->max_people=$request->input('max_people');
        $post->location=$request->input('location');
        $post->cost_basis=$request->input('cost_basis');
        $post->cost=$request->input('cost');
        $post->from_date=$request->input('from_date');
        $post->to_date=$request->input('to_date');
        $post->contact=$request->input('contact');
        $post->cover_image=$fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post= Post::find($id);
        return view('posts.show')->with('post',$post);
    }


   
   
   
     public function book_room($id)
    {
        $ss='dick';
        $post= Post::find($id);
        DB::table('room_book')->insert(
            ['rid' => $post->id, 'taken' => auth()->user()->id]);
        $post->booking="booked";
        $post->save();
        return redirect('/posts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post= Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('posts')->with('error','Unauthorized page');
        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $this->validate($request,['title'=>'required','body'=>'required']);

         if($request->hasFile('cover_image'))
        {
            //Get filename with extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //Get just file name
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }

        //create post
        $post=Post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        if($request->hasFile('cover_image'))
        {
            $post->cover_image=$fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success','Room Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('posts')->with('error','Unauthorized page');
        }
        if($post->cover_image!='noimage.jpg')
        {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/dashboard')->with('success','Room Deleted');
    }
}
