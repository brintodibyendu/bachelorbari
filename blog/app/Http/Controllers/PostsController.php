<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\ProductReview;
use App\Room_info;
use DB;
use App\User;
use App\Notifications\User_Added;
use App\ProductSimilarity;
use PDF;

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
        $this->middleware('auth',['except'=>['index','show','search','advancesearch']]);
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

        $products=Post::whereBetween('id', [39, 44])->get();
          $rr=rand( 39 , 44 );
    $selectedProduct=DB::table('posts')->where('id','=',$rr)->paginate(5);
    $productSimilarity = new ProductSimilarity($products->toArray());
    $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
    $products =$productSimilarity->getProductsSortedBySimularity($rr, $similarityMatrix);
  //  return view('ai_intro', compact('selectedId', 'selectedProduct', 'products'));
$products=(object) $products;

       $posts= Post::orderBy('title','asc')->paginate(6);
       $users=User::orderBy('name','asc')->where('BLOCK','=','0')->get();
        return view('posts.index',compact('products'))->with('posts',$posts)->with('usersb',$users);
        
    }

    public function showvip()
    {

        $products=Post::whereBetween('id', [39, 44])->get();
          $rr=rand( 39 , 44 );
    $selectedProduct=DB::table('posts')->where('id','=',$rr)->paginate(5);
    $productSimilarity = new ProductSimilarity($products->toArray());
    $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
    $products =$productSimilarity->getProductsSortedBySimularity($rr, $similarityMatrix);
  //  return view('ai_intro', compact('selectedId', 'selectedProduct', 'products'));
$products=(object) $products;

       $posts= Post::orderBy('title','asc')->paginate(6);
       $users=User::orderBy('name','asc')->where('BLOCK','=','0')->get();
        return view('posts.vip',compact('products'))->with('posts',$posts)->with('usersb',$users);
    }





     public function showindivip($id)
    {
        //

    //    $products        = json_decode(file_get_contents(storage_path('data/products-data.json')));
    $products=Post::orderBy('title','asc')->get();
   // return $products->toArray();
  //  $selectedId      = intval(app('request')->input('id') ?? $id);
   // $selectedProduct = $products[0];
    //$selectedProduct = array_filter($products->toArray(), function ($product) use ($id) { return $product->id === $id; });
    //if (count($selectedProducts)) {
      //  $selectedProduct = $selectedProducts[array_keys($selectedProducts)[0]];
    //}
    $selectedProduct=DB::table('posts')->where('id','=',$id)->get();
    $productSimilarity = new ProductSimilarity($products->toArray());
    $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
    $products = /*return*/ $productSimilarity->getProductsSortedBySimularity($id, $similarityMatrix);
  //  return view('ai_intro', compact('selectedId', 'selectedProduct', 'products'));
$products=(object) $products;

        $post= Post::find($id);
        $review=DB::table('product_reviews')->where('rid','=',$id)->get();
        $rooms=DB::table('room_info')->where('flat_name','=',$post->title)->get();
      
        return view('posts.showindivip',compact('id', 'selectedProduct', 'products'))->with('post',$post)->with('reviews',$review)->with('indi_rooms',$rooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create')->with('isblock',auth()->user()->BLOCK);
    }


     public function bookvip($id,Request $request)
    {
        $ss='dick';
        $post= Post::find($id);
        $plame=$request->input('fname');

        DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['booking' => "vip booked"]);

        DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['requested_from_date' => $request->input('rfrom_date')]);

             DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['requested_to_date' => $request->input('rto_date')]);

             DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['hostid' => auth()->user()->id]);

             DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['host_name' => auth()->user()->name]);

            DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['vipbook' => "YES"]);
        //$iroom->booking="pending";
       
      //  $post->room_no=$post->room_no-1;
      
        $post->save();
        return back();
      //  return redirect('/posts');
    }








    public function search(Request $request)
    {
         $products=Post::whereBetween('id', [39, 44])->get();
          $rr=rand( 39 , 44 );
    $selectedProduct=DB::table('posts')->where('id','=',$rr)->paginate(5);
    $productSimilarity = new ProductSimilarity($products->toArray());
    $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
    $products =$productSimilarity->getProductsSortedBySimularity($rr, $similarityMatrix);
  //  return view('ai_intro', compact('selectedId', 'selectedProduct', 'products'));
$products=(object) $products;
        $search= $request->get('search');
     //    $posts= Post::orderBy('title','desc')->paginate(5);
        $posts=DB::table('posts')->where('title','LIKE','%'.$search.'%')->orWhere('location','LIKE','%'.$search.'%')->orWhere('type','LIKE','%'.$search.'%')->paginate(5);
        //echo $posts;
       // return view('posts.index')->with('posts',$posts);
        $users=User::orderBy('name','asc')->where('BLOCK','=','0')->get();
       return view('posts.index',compact('products'))->with('usersb',$users)->with('posts',$posts);

    }

        public function advancesearch(Request $request)
    {
       // $query->whereBetween('age', [$ageFrom, $ageTo]);
         $products=Post::whereBetween('id', [39, 44])->get();
          $rr=rand( 39 , 44 );
    $selectedProduct=DB::table('posts')->where('id','=',$rr)->paginate(5);
    $productSimilarity = new ProductSimilarity($products->toArray());
    $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
    $products =$productSimilarity->getProductsSortedBySimularity($rr, $similarityMatrix);
  //  return view('ai_intro', compact('selectedId', 'selectedProduct', 'products'));
$products=(object) $products;
//$products=$products->->get();


        $namesearch= $request->get('namesearch');
        $areasearch= $request->get('areasearch');
        $family= $request->get('is_familysearch');
        $friend= $request->get('is_friendsearch');
        $pet= $request->get('is_petsearch');
        $student= $request->get('is_studentearch');
        $job_seeker= $request->get('is_jobseekersearch');
        $late_night= $request->get('is_latenightsearch');
        $harddrinks= $request->get('is_harddrinkssearch');
      //  $peoplesearch= $request->get('peoplesearch');
     //    $posts= Post::orderBy('title','desc')->paginate(5);
        $posts=DB::table('posts')->where('title','LIKE','%'.$namesearch.'%')->where('location','LIKE','%'.$areasearch.'%')->where('family','LIKE','%'.$family.'%')->where('friends','LIKE','%'.$friend.'%')->where('pet_allow','LIKE','%'.$pet.'%')->where('student','LIKE','%'.$student.'%')->where('job_seeker','LIKE','%'.$job_seeker.'%')->where('late_night','LIKE','%'.$late_night.'%')->where('hard_drinks','LIKE','%'.$harddrinks.'%')->paginate(5);
        //echo $posts;
       // return view('posts.index')->with('posts',$posts);
        $users=User::orderBy('name','asc')->where('BLOCK','=','0')->get();
       return view('posts.index',compact('products'))->with('posts',$posts)->with('usersb',$users);
      // return view('posts.index',)->with('post',$post)->with('reviews',$review)->with('indi_rooms',$rooms);

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
        $total_cost=0;
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
        $post->family=$request->input('is_family');
        $post->friends=$request->input('is_friend');
        $post->pet_allow=$request->input('is_pet');
        $post->student=$request->input('is_student');
        $post->job_seeker=$request->input('is_jobseeker');
        $post->late_night=$request->input('is_latenight');
        $post->hard_drinks=$request->input('is_harddrinks');
        foreach($request->rpname as $item=>$v){
             $total_cost=$total_cost+$request->cost[$item];
            $data2=array(
                'rpname'=>$request->rpname[$item],
                'max_people'=>$request->max_people[$item],
                'cost'=>$request->cost[$item],
                'from_date'=>$request->from_date[$item],
                'to_date'=>$request->to_date[$item],
                'flat_name'=>$request->input('title'),
                'user_id'=>auth()->user()->id,
            );
        Room_info::insert($data2);
         }
         $post->total_cost=$total_cost;
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

    //    $products        = json_decode(file_get_contents(storage_path('data/products-data.json')));
    $products=Post::orderBy('title','asc')->get();
    $showav=DB::table('pending_request')->where('status',"CONFIRM")->get();
   // return $products->toArray();
  //  $selectedId      = intval(app('request')->input('id') ?? $id);
   // $selectedProduct = $products[0];
    //$selectedProduct = array_filter($products->toArray(), function ($product) use ($id) { return $product->id === $id; });
    //if (count($selectedProducts)) {
      //  $selectedProduct = $selectedProducts[array_keys($selectedProducts)[0]];
    //}
    $selectedProduct=DB::table('posts')->where('id','=',$id)->get();
    $productSimilarity = new ProductSimilarity($products->toArray());
    $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
    $products = /*return*/ $productSimilarity->getProductsSortedBySimularity($id, $similarityMatrix);
  //  return view('ai_intro', compact('selectedId', 'selectedProduct', 'products'));
$products=(object) $products;

        $post= Post::find($id);
        $review=DB::table('product_reviews')->where('rid','=',$id)->get();
        $rooms=DB::table('room_info')->where('flat_name','=',$post->title)->get();
        return view('posts.show',compact('id', 'selectedProduct', 'products'))->with('post',$post)->with('reviews',$review)->with('indi_rooms',$rooms)->with('avilable',$showav);
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

        
             DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['host_name' => auth()->user()->name]);
        //$iroom->booking="pending";
       
      //  $post->room_no=$post->room_no-1;


        $room= DB::table('room_info')->where('rpname',$plame)->get();
        foreach($room as $rooms){
            $rrid=$rooms->id;
            $hhid=$rooms->user_id;
        }

        DB::table('pending_request')->insert(
            ['requested_by_id' => auth()->user()->id, 'requested_from_date' => $request->input('rfrom_date'),'requested_to_date' =>  $request->input('rto_date'),'requested_by'=>auth()->user()->name,'room_name'=>$request->input('fname'),'flat_name'=>$post->title,'flat_id'=>$post->id,'room_id'=>$rrid,'host_id'=>$hhid]);    
        $post->save();
        return back();
      //  return redirect('/posts');
    }



     public function review_room($id,Request $request)
    {
        $ss=0;
        $post= Post::find($id);
        DB::table('product_reviews')->insert(
            ['user_id' => auth()->user()->id, 'headline' => $request->input('headline'),'description' => $request->input('description'),'rating'=>$request->input('rate'),'rid'=>$post->id]);
        $rev=DB::table('product_reviews')->where('rid', $id)->get();
         foreach($rev as $revs){
            $ss=$ss+$revs->rating;
         }
         $post->total_rating=$ss;
         $post->save();
         return back();
        //return redirect('/posts');
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
        return redirect('/posts')->with('success','Room Updated');
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
