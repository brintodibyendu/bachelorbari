<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;
use DB;

class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
    //   $posts= Post::where('booking','booked')->get();


    //   $posts = Post::where([['booking', '=', 'booked'],['user_id', '=', $user_id],])->get();



         //$posts=DB::table('posts')->where('id','LIKE','%'.$user_id.'%');
        //return view('dashboard')->with('posts',$posts);
        return view('dashboard')->with('posts',$user->posts);
       //  return view('dashboard',['posts'=>$user->posts]);
    }


    public function requestroom(Request $request)
    {
         $user_id=auth()->user()->id;
        $posts = Post::where([['booking', '=', 'pending'],['user_id', '=', $user_id]])->get();
        return view('requestroom')->with('posts',$posts);
    }

    public function confirmroom($id)
    {
         $post= Post::find($id);
        DB::table('room_book')->insert(
            ['rid' => $post->id, 'taken' => $post->hostid,'from_date' => $post->requested_from_date,'to_date'=>$post->requested_to_date]);
        $post->booking="booked";
        $post->save();
        return redirect('/dashboard/requestroom');
    }


    public function cancelroom($id)
    {
        $post= Post::find($id);
        $post->booking="";
        $post->save();
        return redirect('/dashboard/requestroom');
    }

       public function occupiedroom(Request $request)
    {
        $ind=0;
         $cposts = array();
         $user_id=auth()->user()->id;
        $posts = Post::where([['booking', '=', 'booked'],['user_id', '=', $user_id]])->get();
        foreach($posts as $p){
             $cposts[]=$p->id;
         }
        $userid=DB::table('room_book')->where('rid', '=', $cposts[$ind])->get();
        $ind=$ind+1;
        return view('occupiedroom')->with('posts',$posts)->with('userid',$userid);
    }


}
