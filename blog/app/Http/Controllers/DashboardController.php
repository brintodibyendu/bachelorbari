<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;
use App\Room_info;
use App\Notification;
use App\room_book;
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
     * Show the application dashboard.
     *
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


    public function requestroom(Request $request)
    {
         $user_id=auth()->user()->id;
       # $posts = Room_info::where([['booking', '=', 'pending'],['user_id', '=', $user_id]])->get();
         $posts=DB::table('pending_request')->where('host_id',auth()->user()->id)->get();
        return view('requestroom')->with('posts',$posts)->with('isblock',auth()->user()->BLOCK);
    }

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

     public function wantingroom(Request $request)
    {
        $user_id=auth()->user()->id;
        $posts = Room_info::where([['booking', '=', 'pending'],['hostid', '=', $user_id]])->get();

        return view('wantingroom')->with('posts',$posts);
    }
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

    public function notify(Request $request)
    {
        $user_id=auth()->user()->id;
        $posts=Notification::where([['guest_id','=',$user_id]])->get();
        return view('notification')->with('posts',$posts);
    }
    public function get_customer_data()
    {
         $user_id=auth()->user()->id;
        $posts = Room_info::where([['booking', '=', 'booked'],['user_id', '=', $user_id]])->get();
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
        $output= '<h3 align="center">Occupied Room</h3><table width="100%" style="border-collapse: collapse; border: 0px;">
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
}
