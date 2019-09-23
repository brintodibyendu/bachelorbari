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
use App\Requestroomadmin;
use App\Request_room_info;
use App\Pending_request;
use App\Checkout_history;
use PDF;

//use Illuminate\Database\Capsule\Manager as DB;
class PostsController extends Controller
{
    /**
     * Create a new controller instance of construct for posts controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show','search','advancesearch']]);
    }



    /**
     * Display a listing of the apartments with the recommended apartments also.
     * maintain the show room,show profile button to show the individual user information and apartment information
 * @bodyParam  
 * @bodyParam areasearch string required The area name of the search.
 * @bodyParam title string title of the apartment
 * @bodyParam body string Detail description of the apartment 
  * @bodyParam showav Maintain the pending requests
 * @bodyParam select_product select particular product for the input of recommendation system
 * @bodyParam productsimilarity calculate the similaity products
 * @bodyParam similaritymatrix matrix a collection of objects that retuern the similar objects 
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
     * Show the form for creating a new Apartment.
     * This function manages the create window for creating new apartment for the owner
     * @queryParam room_info Field to Update the field of the information of the rooms
 * @queryParam requested_from_date to insert the from date in the database
 * @queryParam requested_to_date to insert the to date in the database

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



    /**
 *   Normal Search
 * Normal search function to maintain the normal search field of the View page.
 * Based on Apartment name and Location of the apartment
 * @bodyParam  products select the id for recommendation system.
 * @bodyParam posts is the collection of the post that is generate by the query.
 * @bodyParam users is defined taht whther the user is blocked or not
 */


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



   /**
 *   Advance Search
 * Advance search function to maintain the advance search field of the Home page.
 * @bodyParam  namesearch required The title of the search.
 * @bodyParam areasearch string required The area name of the search.
 * @bodyParam is_family string The family of checkbox
 * @bodyParam is_friend string The friend of checkbox 
 * @bodyParam $pet string The friend of checkbox 
 * @bodyParam student string The student of checkbox 
 * @bodyParam job_seeker string The job_seeker of checkbox 
 * @bodyParam late_night string The late_night of checkbox 
 */


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
     * Store a newly created Apartment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
 * @bodyParam  validate check whther all the variables are correctly given
 * @bodyParam areasearch string required The area name of the search.
 * @bodyParam title string title of the apartment
 * @bodyParam body string Detail description of the apartment 
 * @bodyParam user_id int id of the host of the apartment 
 * @bodyParam user_name string name of the owner of the apartment
 * @bodyParam type string type of the apartment
 * @bodyParam room_no int No of rooms 
  * @bodyParam location string Location of the apartment 
   * @bodyParam cost_basis string Payment type of apartment 
    * @bodyParam contact string contact no of the apartment 
     * @bodyParam cover_image string picture of the cover image of the apartment 
      * @bodyParam family family is allowed or not
       * @bodyParam friends string friend is allowed or not
        * @bodyParam pet_allow string pet is allowed or not
         * @bodyParam student string pet is allowed or not
          * @bodyParam job_seeker string pet is allowed or not
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
        #$post=new Requestroomadmin;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id=  auth()->user()->id; 
        $post->user_name=auth()->user()->name;
        $post->type=$request->input('type');
        $post->room_no=$request->input('room_no');
        $post->location=$request->input('location');
        $post->cost_basis=$request->input('cost_basis');
        $post->contact=$request->input('contact');
        $post->cover_image=$fileNameToStore;
        $post->family=$request->input('is_family');
        $post->friends=$request->input('is_friend');
        $post->isapproved="PENDING";
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
          DB::table('room_info')->where('flat_name',$post->title)->update(['flat_id' => $post->id]);
        return redirect('/posts')->with('success','Apartment Requested to admin');
}

    /**
     * Display the Aprropiate apartment details information with recommendation system.
 * @bodyParam  products
 * @bodyParam showav Maintain the pending requests
 * @bodyParam select_product select particular product for the input of recommendation system
 * @bodyParam productsimilarity calculate the similaity products
 * @bodyParam similaritymatrix matrix a collection of objects that retuern the similar objects 
 * @bodyParam posts string lists of the rooms in the appropiate apartment
 * @bodyParam review list of reviews for the appropiate apartment
 * @bodyParam rooms collection list of rooms information as a collection
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
        $review=DB::table('product_reviews')->where('flat_id','=',$id)->get();
        $rooms=DB::table('room_info')->where('flat_name','=',$post->title)->get();
        return view('posts.show',compact('id', 'selectedProduct', 'products'))->with('post',$post)->with('reviews',$review)->with('indi_rooms',$rooms)->with('avilable',$showav);
    }


   
   /**
     * Book Room
     * Request for booking a room to the owner of that room
     * also update the necessary information in the database
    
 * @bodyParam  post collection list of the books that is necessary for the booking
 * @bodyParam request_from_date date input for the given from date.
  * @bodyParam request_to_date date input for the given to date.
 * @bodyParam body string Detail description of the apartment 
 * @bodyParam booking string decide whther the room is booked or not.
 * @bodyParam user_name string name of the owner of the apartment
 * @bodyParam rpname the name of the consecutive apartment of that room
  
     */
   
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

 /**
     *Give review to a specefic room for an apartment
     *
     
 * @bodyParam room_rating check whther all the variables are correctly given
 * @bodyParam post string collection of the room.
 * @bodyParam room_reveiew string review given to taht room
 * @bodyParam status string Detail description of the apartment 
 * @bodyParam room_id int id of the user who giving the rating
 * @bodyParam user_name string name of the user who gives rating
 * @bodyParam avg string calculate the avg rating of the current user
 * @bodyParam user_average_rating int average rating given from the user
  * @bodyParam user_indi_review string Individual review of the user 
   * @bodyParam user_id int the id of the user that givinf the rating 
    * @bodyParam contact string contact no of the apartment 
     * @bodyParam cover_image string picture of the cover image of the apartment 
      * @bodyParam family family is allowed or not
      * update the database room_info,product_reviews according to the given rating
    
     */

   public function review_room($id,$id1,Request $request)
    {
         $ss=0;
         $ss1=0;
         $ss2=0;
         $post=Room_info::find($id);
         $pr=Pending_request::find($id1);


         //$cid=
         DB::table('pending_request')
             ->where('id', $pr->id)
             ->update(['status' => "REVIEWED"]);

         DB::table('product_reviews')->insert(
           ['user_id' => auth()->user()->id, 'headline' => $request->input('headline'), 'rid' => $post->id, 'Given_by' => auth()->user()->name, 'owner_rating' => $request->input('rate1'),'owner_review' => $request->input('owner_review'),
           'room_rating' => $request->input('rate'), 'room_review' => $request->input('description'), 'room_name' => $post->rpname, 'flat_id' => $post->flat_id, 'owner_id' => $post->user_id]
         );
         $rev=DB::table('product_reviews')->where('flat_id', $post->flat_id)->get();

         foreach($rev as $revs){
            $ss=$ss+$revs->room_rating;
         }
         DB::table('posts')
             ->where('id', $post->flat_id)
             ->update(['total_rating' => $ss]);

         $owner_rev=DB::table('product_reviews')->where('owner_id', $post->user_id)->get();
         foreach($owner_rev as $owner_revs){
            $ss1=$ss1+$owner_revs->owner_rating;
         }

         DB::table('users')
             ->where('id', $post->user_id)
             ->update(['owner_rate' => $ss1]);

        $tot=DB::table('product_reviews')->where('owner_id',$post->user_id)->count();
        $avg=$ss1/$tot;
        DB::table('users')
            ->where('id', $post->user_id)
            ->update(['owner_avg_rate' => $avg]);

        $room_rev=DB::table('product_reviews')->where('rid', $post->id)->get();
        foreach($room_rev as $room_revs){
          $ss2=$ss2+$room_revs->room_rating;
        }

        DB::table('room_info')
            ->where('id', $post->id)
            ->update(['room_rate' => $ss2]);

        $tot1=DB::table('product_reviews')->where('rid',$post->id)->count();
        $avg1=$ss2/$tot1;

        DB::table('room_info')
            ->where('id', $post->id)
            ->update(['room_avg_rate' => $avg1]);

          /*  DB::table('checkout_history')
                ->where('user_id', auth()->user()->id)
                ->update(['status' => "reviewed"]);*/

         if($post->booking == "checkout"){
           $post->booking="";
         }
         $post->save();
         return redirect('/dashboard/usingroom');
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
     * Update the specified Apartment information in storage with rooms.
     * this function maintain the edit of the information of apartments.
     * Involve in mainataing the room information also
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @queryParam rpname Field to sort by
 * @queryParam maxpeple int
 * @queryParam costs int total cost of the room
  * @queryParam from_date date from available date
   * @queryParam to_date date to available date
    * @queryParam user_id int indicate the user id of the host
     * @queryParam flat_id int indicate the flat id of the apartname
      * @queryParam flat_name string indicate the name of the apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $total_cost=0;
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
        $post->room_no=$post->room_no+$request->input('room_no');
        $post->body=$request->input('body');
        if($request->hasFile('cover_image'))
        {
            $post->cover_image=$fileNameToStore;
        }
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
                'flat_id'=>$post->id,
            );
        Room_info::insert($data2);
         }
         $post->total_cost = $post->total_cost+$total_cost;

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

 /**
     *To track the Checkout hostory of the user
     *
     
 * @bodyParam room_rating check whther all the variables are correctly given
 * @bodyParam post string collection of the room.
 * @bodyParam room_reveiew string review given to taht room
 * @bodyParam status string Detail description of the apartment 
 * @bodyParam room_id int id of the user who giving the rating
 * @bodyParam user_name string name of the user who gives rating
 * @bodyParam avg string calculate the avg rating of the current user
 * @bodyParam user_average_rating int average rating given from the user
  * @bodyParam user_indi_review string Individual review of the user 
   * @bodyParam user_id int the id of the user that givinf the rating 
    * @bodyParam contact string contact no of the apartment 
     * @bodyParam cover_image string picture of the cover image of the apartment 
      * @bodyParam family family is allowed or not
      * update the database room_info,product_reviews according to the given rating
    
     */


    public function checkout($id,$id1,Request $request)
    {
      $room=Room_info::find($id);
      $pr=Pending_request::find($id1);
      $today=date("Y-m-d");
      //Room_info::where([['booking', '=', 'pending'],['user_id', '=', $user_id]])->get();
      DB::table('room_info')->where('id',$room->id)->update(['booking' => "checkout"]);
      DB::table('pending_request')->where('id',$pr->id)->update(['status' => "CHECKOUT"]);
    //  DB::table('room_book')->where([['rid','=',$room->id],['hostid','=',auth()->user()->id],['status','=','booked'],['to_date','=',$today]])->update(['status' => "checkout"]);
      //$cc=Room_info::where([[]])
      DB::table('notifications')->insert(['user_id'=>auth()->user()->id,'user_name'=>auth()->user()->name,'guest_id'=>$room->user_id,
      'guest_name'=>$room->user_name,'room_id'=>$room->id,'room_name'=>$room->rpname,'status'=>'checkout']);

      DB::table('checkout_history')->insert(['room_id'=>$room->id,'room_name'=>$room->rpname,'flat_id'=>$room->flat_id,'flat_name'=>$room->flat_name,
      'Entry_date'=>$room->requested_from_date,'checkout_date'=>$room->requested_to_date,'user_id'=>$room->hostid,'user_name'=>$room->host_name,'status'=>'checkout',
      'owner_id'=>$room->user_id,'owner_name'=>$room->user_name,'request_id'=>$pr->id]);


      return redirect('/dashboard/usingroom');
    }

 /**
     * Display the information of the Host
     * @bodyParam user find the user who is the owner of that room
 * @bodyParam review the review that the host giving
     */

    public function showHostInfo($id){
        $user=User::find($id);
        $review=DB::table('product_reviews')->where('owner_id','=',$user->id)->get();

        return view('HostProfile')->with('user',$user)->with('review',$review);

    }

 /**
     * Display the information of the User
     * @bodyParam user find the user who is the owner of that room
 * @bodyParam review the review that the user giving
     */

    public function showUserInfo($id)
    {
        $user=User::find($id);
        $review=DB::table('checkout_history')->where('user_id','=',$user->id)->get();
        return view('userprofile')->with('user',$user)->with('review',$review);
    }



    /**
     *Give review to a specefic user
 * @bodyParam user_rating check whther all the variables are correctly given
 * @bodyParam post string collection of the room.
 * @bodyParam user_reveiew string review given to taht room
 * @bodyParam status string Detail description of the apartment 
 * @bodyParam user_id int id of the user who giving the rating
 * @bodyParam user_name string name of the user who gives rating
 * @bodyParam avg string calculate the avg rating of the current user
 * @bodyParam user_average_rating int average rating given from the user
  * @bodyParam user_indi_review string Individual review of the user 
   * @bodyParam cost_basis string Payment type of apartment 
    * @bodyParam contact string contact no of the apartment 
     * @bodyParam cover_image string picture of the cover image of the apartment 
      * @bodyParam family family is allowed or not
       * @bodyParam friends string friend is allowed or not
        * @bodyParam pet_allow string pet is allowed or not
         * @bodyParam student string pet is allowed or not
          * @bodyParam job_seeker string pet is allowed or not
    
     */

     public function review_user($id,Request $request)
    {
        /*$ss=0;
        $pst=Room_info::find($id);
        $id1=$pst->flat_id;
        $post=Post::find($id1);
        DB::table('product_reviews')->insert(
            ['user_id' => auth()->user()->id, 'headline' => $request->input('headline'),'description' => $request->input('description'),'rating'=>$request->input('rate'),'rid'=>$post->id]);
        $rev=DB::table('product_reviews')->where('rid', $post->id)->get();
         foreach($rev as $revs){
            $ss=$ss+$revs->rating;
         }
         $post->total_rating=$ss;
         $post->save();

         return redirect('/dashboard')->with('post',$post)->with('pst',$pst);*/
         //$post=
         $tot=0 ;
         $post=Checkout_history::find($id);

         $post->user_rating=$request->input('Urate');
         $post->user_review=$request->input('Udescription');
         $post->status='reviewed';
         $post->save();
         //DB::table('pending_request')->where('id',$post->request_id)->update()
         $user_rev=DB::table('checkout_history')->where('user_id',$post->user_id)->get();
         $user_rev_cnt=DB::table('checkout_history')->where('user_id',$post->user_id)->count();
         foreach($user_rev as $user_revs){
           $tot=$tot+$user_revs->user_rating;
         }
         $avg=$tot/$user_rev_cnt;

         DB::table('users')
             ->where('id', $post->user_id)
             ->update(['user_rate' => $tot]);

             DB::table('users')
                 ->where('id', $post->user_id)
                 ->update(['user_avg_rate' => $avg]);


         return redirect('/dashboard/own');
        //return redirect('/posts');
    }
}
