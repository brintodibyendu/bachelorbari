<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;
use App\Room_info;
use App\Notification;
use App\room_book;
use App\Pending_request;
use App\Checkout_history;
use DB;
use PDF;

class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *Dashboard
     * Show the application dashboard.
     *@bodyparam user_id required id of the user
     *@bodyparam flat_name required name of the flat 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
    //   $posts= Post::where('booking','booked')->get();
        //$rooms=new Room_info();

    //   $posts = Post::where([['booking', '=', 'booked'],['user_id', '=', $user_id],])->get();
        foreach($user->posts as $indr)
        {
          $rooms=DB::table('room_info')->where('flat_name','=',$indr->title)->get();
        //  $merged = $teamStatistics->merge($teamStanding);
        }
         //$posts=DB::table('posts')->where('id','LIKE','%'.$user_id.'%');
        //return view('dashboard')->with('posts',$posts);
        return view('dashboard')->with('posts',$user->posts)->with('indiroom',$user->rooms);
       //  return view('dashboard',['posts'=>$user->posts]);
    }

/**
     *Request Room
     * Host can confirm room booking of the users
     *@queryParam id int required id of the room.
     *@queryParam id1 int required id of the request.
     *@queryParam user_id int optional id of the user
     *@queryParam user_name int optional name of the user
     *@queryParam guest_id int optional id of the guest
     *@queryParam from_date date optional date of booking start
     *@queryParam to_date date optional date of booking ends
     *@queryParam status string optional status of booking of the user
     * 
     */
    public function requestroom(Request $request)
    {
         $user_id=auth()->user()->id;
       # $posts = Room_info::where([['booking', '=', 'pending'],['user_id', '=', $user_id]])->get();
         $posts=DB::table('pending_request')->where('host_id',auth()->user()->id)->get();
        return view('requestroom')->with('posts',$posts)->with('isblock',auth()->user()->BLOCK);
    }
    /**
     *Confirm Room
     * Host can confirm room booking of the users
     *@queryParam id int required id of the room.
     *@queryParam id1 int required id of the request.
     *@queryParam user_id int optional id of the user
     *@queryParam user_name int optional name of the user
     *@queryParam guest_id int optional id of the guest
     *@queryParam from_date date optional date of booking start
     *@queryParam to_date date optional date of booking ends
     *@queryParam status string optional status of booking of the user
     * 
     */
    public function confirmroom($id,$id1)
    {
         $post= Room_info::find($id);
        DB::table('room_book')->insert(
            ['rid' => $post->id, 'hostid' => $post->hostid,'from_date' => $post->requested_from_date,'to_date'=>$post->requested_to_date,'user_id'=>$post->user_id,'host_name'=>$post->host_name,'rpname'=>$post->rpname,'max_people'=>$post->max_people]);
        $post->booking="booked";
        DB::table('notifications')->insert(['user_id'=>auth()->user()->id,'user_name'=>auth()->user()->name,'guest_id'=>$post->hostid,'guest_name'=>$post->host_name,'room_id'=>$post->id,'room_name'=>$post->rpname,'status'=>'confirm']);
        DB::table('pending_request')->where('id', $id1)->update(['status'=>"CONFIRM"]);
        $post->save();
        return redirect('/dashboard/requestroom');
    }

      public function checkout($id)
    {
        DB::table('room_book')->where('id', $id)->update(['checkout'=>"checked"]);
        return redirect('/dashboard/occupiedroom');
    }

/**
    * Cancel room
     * Host can cancel room booking of the users
     *@queryParam id int required id of the room.
     *@queryParam id1 int required id of the request.
     *@queryParam from_date date optional date of booking start
     *@queryParam hostid id of hosts
     *@queryParam from_date date optional date of booking start
     *@queryParam to_date date optional date of booking ends
     *@queryParam status string optional status of booking of the user
     * 
     */
    public function cancelroom($id,$id1)
    {
        $post= Room_info::find($id);
         DB::table('notifications')->insert(['user_id'=>auth()->user()->id,'user_name'=>auth()->user()->name,'guest_id'=>$post->hostid,'guest_name'=>$post->host_name,'room_id'=>$post->id,'room_name'=>$post->rpname,'status'=>'cancel']);
        $post->booking="";
        $post->requested_from_date="";
        $post->requested_to_date="";
         $post->hostid="";
          $post->host_name="";
           DB::table('pending_request')->where('id', $id1)->update(['status'=>"CANCEL"]);
        $post->save();
        return redirect('/dashboard/requestroom');
    }
    /**
     * Occupied room
     * Showing occupied room page with the users who occupied host rooms at present
     *@bodyParam user_id int required id of the host.
     *
     * 
     */

       public function occupiedroom(Request $request)
    {

         $user_id=auth()->user()->id;
        $posts = room_book::where('user_id', '=', $user_id)->get();
           /*   $result=DB::table('users')
         ->where('id',function ($query) use ($posts){
            foreach($posts as $p){
            $query->select('id')->from('room_book')->where('rid','=',$p->id);
        }
        })->get();*/
        
        return view('occupiedroom')->with('posts',$posts)->with('isblock',auth()->user()->BLOCK);
    }
/**
     * Wanting room
     * Showing users requested rooms
     *@bodyParam user_id int required id of the user.
     *@queryParam hostid int required id of the host.
     * 
     */

     public function wantingroom(Request $request)
    {
        $user_id=auth()->user()->id;
        $posts = Room_info::where([['booking', '=', 'pending'],['hostid', '=', $user_id]])->get();

        return view('wantingroom')->with('posts',$posts);
    }
    /**
    *Cancel Wanting rooms
    *User can cancel requested room
    *@queryParam id int required id of the room.
    *@queryParam requested_to_date date required date of checkout.
    *@queryParam requested_from_date date required date of the entry.
    */
      public function cancelwantingroom($id)
    {
        $post= Room_info::find($id);
        $post->booking="";
        $post->requested_to_date=NULL;
        $post->requested_from_date=NULL;
        $post->hostid="";
        $post->host_name="";
        $post->save();
        return redirect('/dashboard/wantingroom');
    }
    /**
     *Notification
     *showing notifications for the user account
     *@bodyParam user_id int required id of the user.
     *@queryParam guest_id date required date of user.
     *@queryParam requested_from_date date required date of the entry.
     */
    public function notify(Request $request)
    {
        $user_id=auth()->user()->id;
        $posts=Notification::where([['guest_id','=',$user_id]])->get();
        return view('notification')->with('posts',$posts);
    }
    public function get_customer_data()
    {
         $user_id=auth()->user()->id;
        $posts = room_book::where('user_id', '=', $user_id)->get();
        return $posts;
    }

      public function pdf()
    {
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());
         return $pdf->stream();
    }
    public function convert_customer_data_to_html()
    {
        $customer_data=$this->get_customer_data();
        $output= '<h2 align="center">Occupied Room Report</h2><h3 align="center">'.auth()->user()->name.'</h3><table width="100%" style="border-collapse: collapse; border: 0px;">
  <thead>
    <tr>
      <th style="border: 1px solid; padding:12px;" width="20%">Room Name</th>
      <th style="border: 1px solid; padding:12px;" width="20%">From date</th>
      <th style="border: 1px solid; padding:12px;" width="20%">To Date</th>
      <th style="border: 1px solid; padding:12px;" width="20%">Booked By</th>
    </tr>
  </thead> <tbody>';
        foreach($customer_data as $customer)
        {
            $output.=' <tr>
      <td style="border: 1px solid; padding:12px;">'.$customer->rpname.'</td>
      <td style="border: 1px solid; padding:12px;">From:'.$customer->from_date.'</td>
      <td style="border: 1px solid; padding:12px;">Till: '.$customer->to_date.'</td>
      <td style="border: 1px solid; padding:12px;">'.$customer->host_name.'</td>
    </tr>';
        }
         $output .= '</tbody></table>';
         return $output;
    }

     public function advertise($id,$hid,$mpeople,$name,Request $request)
    {
        $ss='dick';
      //   $post= Post::find($id);
        $plame=$name;

        DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['booking' => ""]);
            $name="maxpeople".$id;

             DB::table('room_info')
            ->where('rpname', $plame)
            ->update(['max_people' => $request->input($name)]);
        

          DB::table('room_book')
            ->where('rid', $id)
            ->where('hostid',$hid)
            ->update(['max_people' => $mpeople-$request->input($name)]);
             
        //$iroom->booking="pending";
       
        //$post->room_no=$post->room_no+1;
      
        //$post->save();
        return back();
    }
    /**
     *Useroom
     *Showing the room currently user is using. After checkout, he can give rating.
     *@bodyParam user_id int required id of the user.
     *@bodyParam cc int required count of the confirm requests.
     *@bodyParam cc1 int required count of the checkouts
     *@bodyParam cnt int required sum of cc and cc1
     *@bodyParam todayDate date required date of today
     *@queryParam requested_by_id int required id of the user.
     *@queryParam status string required status of the request.
     */
    public function useroom(Request $request)
   {
        $v1="booked";
        $v2="checkout";
       $user_id=auth()->user()->id;
       //$posts = Room_info::where([['booking', '=', 'booked'],['hostid', '=', $user_id]])->orWhere([['booking', '=', 'checkout'],['hostid', '=', $user_id]])->get();
       //$posts=DB::table('room_info')->where()
       $posts=Pending_request::where([['status','=','CONFIRM'],['requested_by_id','=',$user_id]])->orWhere([['status','=','CHECKOUT'],['requested_by_id','=',$user_id]])->get();

       $cc=Pending_request::where([['status','=','CONFIRM'],['requested_by_id','=',$user_id]])->count();
       $cc1=Pending_request::where([['status','=','CHECKOUT'],['requested_by_id','=',$user_id]])->count();;
       $cnt=$cc+$cc1;

       //$hh=DB::table('checkout_history')->where([['status','=','not reviewed'],['user_id','=',$user_id]])->get();
       //$uu=Post::find($posts->flat_id);
       $todayDate = date("Y-m-d");


       return view('useroom')->with('posts',$posts)->with('todayDate',$todayDate)->with('cnt',$cnt);
   }
   /**
     *Owner rating page
     *Host can give ratings to the users after checkout of the user.
     *@bodyParam user_id int required id of the user.
     *@bodyParam cnt int required count of the checkouts of that hosts.
     *@queryParam status string required staus of check out.
     *@queryParam owner_id int required id of the owner.
     */
   public function owner_rating_page(Request $request){
        $user_id=auth()->user()->id;
        $posts=DB::table('checkout_history')->where([['status','=','checkout'],['owner_id','=',$user_id]])->get();
        $cnt=DB::table('checkout_history')->where([['status','=','checkout'],['owner_id','=',$user_id]])->count();
        return view('owner_review')->with('posts',$posts)->with('cnt',$cnt);
    }
}
