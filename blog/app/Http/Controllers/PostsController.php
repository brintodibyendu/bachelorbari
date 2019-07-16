<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\ProductReview;
use App\Room_info;
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
       $posts= Post::orderBy('title','asc')->paginate(6);
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
        $posts=DB::table('posts')->where('title','LIKE','%'.$search.'%')->orWhere('location','LIKE','%'.$search.'%')->orWhere('type','LIKE','%'.$search.'%')->paginate(5);
        //echo $posts;
       // return view('posts.index')->with('posts',$posts);
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
        $post->location=$request->input('location');
        $post->cost_basis=$request->input('cost_basis');
        $post->contact=$request->input('contact');
        $post->cover_image=$fileNameToStore;
        $post->save();
        foreach($request->rpname as $item=>$v){
            $data2=array(
                'rpname'=>$request->rpname[$item],
                'max_people'=>$request->max_people[$item],
                'cost'=>$request->cost[$item],
                'from_date'=>$request->from_date[$item],
                'to_date'=>$request->to_date[$item],
                'flat_name'=>$request->input('title'),
            );
        Room_info::insert($data2);
         }
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
        $review=DB::table('product_reviews')->where('rid','=',$id)->get();
        $rooms=DB::table('room_info')->where('flat_name','=',$post->title)->get();
        return view('posts.show')->with('post',$post)->with('reviews',$review)->with('indi_rooms',$rooms);
    }


   
   
   
     public function book_room($id,Request $request)
    {
        $ss='dick';
        $post= Post::find($id);
        $plame=$request->input('fname');

        DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['booking' => "pending"]);

        DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['requested_from_date' => $request->input('rfrom_date')]);

             DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['requested_to_date' => $request->input('rto_date')]);

             DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['hostid' => auth()->user()->id]);
        //$iroom->booking="pending";
       
        $post->room_no=$post->room_no-1;
      
        $post->save();
        return redirect('/posts');
    }



     public function review_room($id,Request $request)
    {
        $ss='dick';
        $post= Post::find($id);
        DB::table('product_reviews')->insert(
            ['user_id' => auth()->user()->id, 'headline' => $request->input('headline'),'description' => $request->input('description'),'rating'=>$request->input('rate'),'rid'=>$post->id]);
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
