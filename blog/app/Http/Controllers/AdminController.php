<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use App\User;
use App\Post;
use App\Notifications\User_Added;
use App\Charts\pulseChart;
use App\Requestroomadmin;
use App\Request_room_info;
use PDF;

class AdminController extends Controller
{
    /**
     * index
     * Display a listing of the resource.
     *@bodyParam posts1 int required count of hostel type
     *@bodyParam posts2 int required count of resident type
     *@bodyParam room1 int required count of location type 1
     *@bodyParam room2 int required count of location type 2
     *@bodyParam room3 int required count of location type 3
     *@queryParam type string required type of apartment. Example: Resident
     *@queryParam created_at date required date of the creation
     *@queryParam location string required type of apartment
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //

        $users= User::orderBy('name','asc')->paginate(10);
        $posts1= Post::where('type', 'Hostel')->count();;
        $posts2= Post::where('type', 'Resident')->count();;
        $chart = new pulseChart;
        $chart->labels(['Resident', 'Hostel']);
       $dpiset=$chart->dataset('My dataset', 'pie', [$posts2, $posts1]);
        $dpiset->backgroundColor(collect(['#7158e2','#3ae374']));
        $dpiset->color(collect(['#7d5fff','#32ff7e']));
        $users1 = User::whereDate('created_at', '2019-05-30')->count();
        $users2 = User::whereDate('created_at', '2019-06-02')->count();
        $users3 = User::whereDate('created_at', '2019-07-01')->count();
         $users4 = User::whereDate('created_at', '2019-06-29')->count();
         $linechart = new pulseChart;
        $linechart->labels(['type1', 'type2','type3','type4']);
        $linechart->dataset('Join', 'line', [$users1, $users2,$users3,$users4]);
         $room1 = Post::where('location','LIKE', '%'.'motijheel'.'%')->count();
         $room2 = Post::where('location','LIKE', '%'.'adabor'.'%')->count();
          $room3 = Post::where('location','LIKE', '%'.'dhanmondi'.'%')->count();
          $room4 = Post::where('location','LIKE', '%'.'farmgate'.'%')->count();
          $room5 = Post::where('location','LIKE', '%'.'uttora'.'%')->count();
           $room6 = Post::where('location','LIKE', '%'.'polasi'.'%')->count();
         $roomchart = new pulseChart;
         $roomchart->labels(['Motijheel','Adabor', 'Dhanmondi','Farmgate','Uttora','Polasi']);
          $dbarset= $roomchart->dataset('Join', 'bar', [$room1, $room2,$room3,$room4,$room5,$room6]);
         $dbarset->backgroundColor(collect(['#7158e2','#3ae374','#ff4d4d','#32ff7e','#32ff7e','#32ff7e']));
        $dbarset->color(collect(['#7d5fff','#32ff7e','#32ff7e','#32ff7e','#32ff7e','#32ff7e']));
        return view('admin.index',compact('chart','linechart','roomchart'))->with('admin',$users);
    }
    
    /**
     * show indi users
     * Display users of the system.
     *@bodyParam posts1 int required count of hostel type
     *@bodyParam posts2 int required count of resident type
     *@bodyParam room1 int required count of location type 1
     *@bodyParam room2 int required count of location type 2
     *@bodyParam room3 int required count of location type 3
     *@queryParam id int required id of user. Example: 3
     *@queryParam type string required type of apartment. Example: Resident
     *@queryParam created_at date required date of the creation
     *@queryParam location string required type of apartment
     *
     */



     public function showindiuser($id)
    {
         $posts1= Post::where('type', 'Hostel')->count();;
        $posts2= Post::where('type', 'Resident')->count();;
        $chart = new pulseChart;
        $chart->labels(['Resident', 'Hostel']);
       $dpiset=$chart->dataset('My dataset', 'pie', [$posts2, $posts1]);
        $dpiset->backgroundColor(collect(['#7158e2','#3ae374']));
        $dpiset->color(collect(['#7d5fff','#32ff7e']));
        $users1 = User::whereDate('created_at', '2019-05-30')->count();
        $users2 = User::whereDate('created_at', '2019-06-02')->count();
        $users3 = User::whereDate('created_at', '2019-07-01')->count();
         $users4 = User::whereDate('created_at', '2019-06-29')->count();
         $linechart = new pulseChart;
        $linechart->labels(['type1', 'type2','type3','type4']);
        $dliset=$linechart->dataset('Join', 'line', [$users1, $users2,$users3,$users4]);
        $dliset->backgroundColor(collect(['#7158e2','#3ae374','#ff4d4d']));
        $dliset->color(collect(['#7d5fff','#32ff7e','#32ff7e']));
         $room1 = Post::where('location','LIKE', '%'.'motijheel'.'%')->count();
         $room2 = Post::where('location','LIKE', '%'.'adabor'.'%')->count();
          $room3 = Post::where('location','LIKE', '%'.'dhanmondi'.'%')->count();
          $room4 = Post::where('location','LIKE', '%'.'farmgate'.'%')->count();
          $room5 = Post::where('location','LIKE', '%'.'uttora'.'%')->count();
           $room6 = Post::where('location','LIKE', '%'.'polasi'.'%')->count();
         $roomchart = new pulseChart;
         $roomchart->labels(['Motijheel','Adabor', 'Dhanmondi','Farmgate','Uttora','Polasi']);
          $dbarset= $roomchart->dataset('Join', 'bar', [$room1, $room2,$room3,$room4,$room5,$room6]);
         $dbarset->backgroundColor(collect(['#7158e2','#3ae374','#ff4d4d','#32ff7e','#32ff7e','#32ff7e']));
        $dbarset->color(collect(['#7d5fff','#32ff7e','#32ff7e','#32ff7e','#32ff7e','#32ff7e']));




        $posts= $rooms=DB::table('posts')->where('user_id','=',$id)->get();
       
       // $rooms=DB::table('room_info')->where('flat_name','=',$post->title)->get();
        
        return view('admin.showindi',compact('chart','linechart','roomchart'))->with('posts',$posts)->with('uuid',$id);
    }

    
    /**
     * show chart
     * Display charts.
     *@bodyParam posts1 int required count of hostel type
     *@bodyParam posts2 int required count of resident type
     *@bodyParam room1 int required count of location type 1
     *@bodyParam room2 int required count of location type 2
     *@bodyParam room3 int required count of location type 3
     *@queryParam id int required id of user. Example: 3
     *@queryParam type string required type of apartment. Example: Resident
     *@queryParam created_at date required date of the creation
     *@queryParam location string required type of apartment
     *
     */



    public function Showchart()
    {
         $users= User::orderBy('name','asc')->paginate(10);
        $posts1= Post::where('type', 'Hostel')->count();;
        $posts2= Post::where('type', 'Resident')->count();;
        $chart = new pulseChart;
        $chart->labels(['Resident', 'Hostel']);
        $dpiset=$chart->dataset('My dataset', 'pie', [$posts2, $posts1]);
        $dpiset->backgroundColor(collect(['#7158e2','#3ae374']));
        $dpiset->color(collect(['#7d5fff','#32ff7e']));
        $users1 = User::whereDate('created_at', '2019-05-30')->count();
        $users2 = User::whereDate('created_at', '2019-06-02')->count();
        $users3 = User::whereDate('created_at', '2019-07-01')->count();
         $users4 = User::whereDate('created_at', '2019-06-29')->count();
         $linechart = new pulseChart;
        $linechart->labels(['type1', 'type2','type3','type4']);
        $dliset=$linechart->dataset('Join', 'line', [$users1, $users2,$users3,$users4]);
        $dliset->backgroundColor(collect(['#7158e2','#3ae374','#ff4d4d']));
        $dliset->color(collect(['#7d5fff','#32ff7e','#32ff7e']));
         $room1 = Post::where('location','LIKE', '%'.'motijheel'.'%')->count();
         $room2 = Post::where('location','LIKE', '%'.'adabor'.'%')->count();
          $room3 = Post::where('location','LIKE', '%'.'dhanmondi'.'%')->count();
          $room4 = Post::where('location','LIKE', '%'.'farmgate'.'%')->count();
          $room5 = Post::where('location','LIKE', '%'.'uttora'.'%')->count();
           $room6 = Post::where('location','LIKE', '%'.'polasi'.'%')->count();
         $roomchart = new pulseChart;
         $roomchart->labels(['Motijheel','Adabor', 'Dhanmondi','Farmgate','Uttora','Polasi']);
         $dbarset= $roomchart->dataset('Join', 'bar', [$room1, $room2,$room3,$room4,$room5,$room6]);
         $dbarset->backgroundColor(collect(['#7158e2','#3ae374','#ff4d4d','#32ff7e','#32ff7e','#32ff7e']));
        $dbarset->color(collect(['#7d5fff','#32ff7e','#32ff7e','#32ff7e','#32ff7e','#32ff7e']));
        return view('admin.charts',compact('chart','linechart','roomchart'))->with('admin',$users);
    }

    /**
     *create
     *Show the form for creating a new chart.
     *@bodyParam posts1 int required count of hostel type
     *@bodyParam posts2 int required count of resident type
     *@bodyParam room1 int required count of location type 1
     *@bodyParam room2 int required count of location type 2
     *@bodyParam room3 int required count of location type 3
     *@queryParam id int required id of user. Example: 3
     *@queryParam type string required type of apartment. Example: Resident
     *@queryParam created_at date required date of the creation
     *@queryParam location string required type of apartment
     *
     */
    public function create()
    {
                    $users= User::orderBy('name','asc')->paginate(10);
        $posts1= Post::where('type', 'Hostel')->count();;
        $posts2= Post::where('type', 'Resident')->count();;
        $chart = new pulseChart;
        $chart->labels(['Resident', 'Hostel']);
        $chart->dataset('My dataset', 'pie', [$posts2, $posts1]);
        $users1 = User::whereDate('created_at', '2019-05-30')->count();
        $users2 = User::whereDate('created_at', '2019-06-02')->count();
        $users3 = User::whereDate('created_at', '2019-07-01')->count();
         $users4 = User::whereDate('created_at', '2019-06-29')->count();
         $linechart = new pulseChart;
        $linechart->labels(['type1', 'type2','type3','type4']);
        $linechart->dataset('Join', 'line', [$users1, $users2,$users3,$users4]);
         $room1 = Post::where('location','LIKE', '%'.'motijheel'.'%')->count();
         $room2 = Post::where('location','LIKE', '%'.'adabor'.'%')->count();
          $room3 = Post::where('location','LIKE', '%'.'dhanmondi'.'%')->count();
          $room4 = Post::where('location','LIKE', '%'.'farmgate'.'%')->count();
          $room5 = Post::where('location','LIKE', '%'.'uttora'.'%')->count();
           $room6 = Post::where('location','LIKE', '%'.'polasi'.'%')->count();
         $roomchart = new pulseChart;
         $roomchart->labels(['Motijheel','Adabor', 'Dhanmondi','Farmgate','Uttora','Polasi']);
          $roomchart->dataset('Join', 'bar', [$room1, $room2,$room3,$room4,$room5,$room6]);
        $users= User::orderBy('name','asc')->paginate(10);
        return view('admin.tables',compact('chart','linechart','roomchart'))->with('users',$users);
    }
    
    /**
     * request user
     * Display pending requests of users.
     *@bodyParam posts1 int required count of hostel type
     *@bodyParam posts2 int required count of resident type
     *@bodyParam room1 int required count of location type 1
     *@bodyParam room2 int required count of location type 2
     *@bodyParam room3 int required count of location type 3
     *@queryParam id int required id of user. Example: 3
     *@queryParam type string required type of apartment. Example: Resident
     *@queryParam created_at date required date of the creation
     *@queryParam location string required type of apartment
     *@queryParam admin string required status of request. Example: pending
     *
     */

    public function requestuser()
    {
            $users= User::orderBy('name','asc')->paginate(10);
        $posts1= Post::where('type', 'Hostel')->count();;
        $posts2= Post::where('type', 'Resident')->count();;
        $chart = new pulseChart;
        $chart->labels(['Resident', 'Hostel']);
        $chart->dataset('My dataset', 'pie', [$posts2, $posts1]);
        $users1 = User::whereDate('created_at', '2019-05-30')->count();
        $users2 = User::whereDate('created_at', '2019-06-02')->count();
        $users3 = User::whereDate('created_at', '2019-07-01')->count();
         $users4 = User::whereDate('created_at', '2019-06-29')->count();
         $linechart = new pulseChart;
        $linechart->labels(['type1', 'type2','type3','type4']);
        $linechart->dataset('Join', 'line', [$users1, $users2,$users3,$users4]);
         $room1 = Post::where('location','LIKE', '%'.'motijheel'.'%')->count();
         $room2 = Post::where('location','LIKE', '%'.'adabor'.'%')->count();
          $room3 = Post::where('location','LIKE', '%'.'dhanmondi'.'%')->count();
          $room4 = Post::where('location','LIKE', '%'.'farmgate'.'%')->count();
          $room5 = Post::where('location','LIKE', '%'.'uttora'.'%')->count();
           $room6 = Post::where('location','LIKE', '%'.'polasi'.'%')->count();
         $roomchart = new pulseChart;
         $roomchart->labels(['Motijheel','Adabor', 'Dhanmondi','Farmgate','Uttora','Polasi']);
          $roomchart->dataset('Join', 'bar', [$room1, $room2,$room3,$room4,$room5,$room6]);
        $users = User::where('admin', '=', 'pending')->get();
        return view('admin.request',compact('chart','linechart','roomchart'))->with('admin',$users);
    }
    
    /**
     * showrequestedapartments
     * Display requested apartment of users.
     * @bodyParam posts1 int required count of hostel type
     * @bodyParam posts2 int required count of resident type
     * @bodyParam room1 int required count of location type 1
     * @bodyParam room2 int required count of location type 2
     * @bodyParam room3 int required count of location type 3
     * @querParam id int required id of user. Example: 3
     * @queryParam type string required type of apartment. Example: Resident
     * @queryParam created_at date required date of the creation
     * @queryParam location string required type of apartment
     * @queryParam admin string required status of request. Example: pending
     *
     */
    
    

      public function showrequestedapartments()
    {
            #$user_id=auth()->user()->id;
        $user=DB::table('posts')->get();
        $roomm=DB::table('room_info')->get();
    //   $posts= Post::where('booking','booked')->get();
        //$rooms=new Room_info();

    //   $posts = Post::where([['booking', '=', 'booked'],['user_id', '=', $user_id],])->get();
       
        $posts1= Post::where('type', 'Hostel')->count();;
        $posts2= Post::where('type', 'Resident')->count();;
        $chart = new pulseChart;
        $chart->labels(['Resident', 'Hostel']);
        $chart->dataset('My dataset', 'pie', [$posts2, $posts1]);
        $users1 = User::whereDate('created_at', '2019-05-30')->count();
        $users2 = User::whereDate('created_at', '2019-06-02')->count();
        $users3 = User::whereDate('created_at', '2019-07-01')->count();
         $users4 = User::whereDate('created_at', '2019-06-29')->count();
         $linechart = new pulseChart;
        $linechart->labels(['type1', 'type2','type3','type4']);
        $linechart->dataset('Join', 'line', [$users1, $users2,$users3,$users4]);
         $room1 = Post::where('location','LIKE', '%'.'motijheel'.'%')->count();
         $room2 = Post::where('location','LIKE', '%'.'adabor'.'%')->count();
          $room3 = Post::where('location','LIKE', '%'.'dhanmondi'.'%')->count();
          $room4 = Post::where('location','LIKE', '%'.'farmgate'.'%')->count();
          $room5 = Post::where('location','LIKE', '%'.'uttora'.'%')->count();
           $room6 = Post::where('location','LIKE', '%'.'polasi'.'%')->count();
         $roomchart = new pulseChart;
         $roomchart->labels(['Motijheel','Adabor', 'Dhanmondi','Farmgate','Uttora','Polasi']);
          $roomchart->dataset('Join', 'bar', [$room1, $room2,$room3,$room4,$room5,$room6]);
        $users = User::where('admin', '=', 'pending')->get();
        return view('admin.requestapartment',compact('chart','linechart','roomchart'))->with('posts',$user)->with('indiroom',$roomm);
    }
    
    /**
     * confirroomadmin
     * admin confirm host room
     *@queryParam id int required id of aparment
     *@queryParam isapproved string required status of request. Example: CONFIRM
     *
     */
    

    public function confirroomadmin($id)
    {
         $post= Post::find($id);
        $post->isapproved="CONFIRM";
        $post->save();
       // $users=User::first();
    //dd($users);
    $tt=Post::first();
    //dd($tt);
    return redirect('/admin/apartments');
    }

    /**
     * cancelroomadmin
     * admin cancels host room
     *@queryParam id int required id of aparment
     *@queryParam isapproved string required status of request. Example: CANCEL
     *
     */
      public function cancelroomadmin($id)
    {
         $post= Post::find($id);
        $post->isapproved="CANCEL";
        $post->save();
       // $users=User::first();
    //dd($users);
    $tt=Post::first();
    //dd($tt);
    return redirect('/admin/apartments');
    }
    
    /**
     * sendmail
     * admin sends mail to host for confirmation
     *@queryParam users int required id of user
     *
     */

    public function sendmail()
    {
        $users=User::first();
    //dd($users);
    $tt=Post::first();
    //dd($tt);
    $users->notify(new User_Added($tt));
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
      //   return redirect('/admin');
     //    DB::table('admin_test')->insert(
       //     ['name' => $request->input('email'),'password'=>$request->input('password')]);
        if($request->input('email')=="123@gmail.com" && $request->input('password')=="12345678"){
          return redirect('/admin');
        }
        else {
            # code...
            return view("notadminhome");
        }
    }
    
    
    /**
     * confirmuser
     * admin confirm user
     *@queryParam id int required id of aparment
     *@queryParam admin string required status of request. Example: YES
     *
     */

    public function confirmuser($id)
    {
         $post= User::find($id);
        $post->admin="yes";
        $post->save();
       // $users=User::first();
    //dd($users);
    $tt=Post::first();
    //dd($tt);
    $post->notify(new User_Added($tt));
    return redirect('/admin');
    }

    
    /**
     * blockuser
     * admin can block user
     *@queryParam id int required id of aparment
     *@queryParam BLOCK int required status flag of request. Example: 1
     *
     */
      public function Blockuser($id)
    {
         $post= User::find($id);
        $post->BLOCK="1";
        $post->save();
       // $users=User::first();
    //dd($users);
        return redirect('/admin/table');
    }
    
    /**
     * unblockuser
     * admin can unblock user
     *@queryParam id int required id of aparment
     *@queryParam BLOCK int required status flag of request. Example: 0
     *
     */

      public function UnBlockuser($id)
    {
         $post= User::find($id);
        $post->BLOCK="0";
        $post->save();
       // $users=User::first();
    //dd($users);
        return redirect('/admin/table');
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
    }



    public function generatereport()
    {
        //
         return view('admin.generatereport');
    }



     public function get_customer_data()
    {
         $users= User::orderBy('name','asc')->get();
        return $users;
    }

     public function get_room_data($id)
    {
         $users= Post::orderBy('title','asc')->where('user_id','=',$id)->get();
        return $users;
    }
      public function pdf()
    {
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());
         return $pdf->stream();
    }
      public function pdfindiuser($id)
    {
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_room_data_to_html($id));
         return $pdf->stream();
    }
    public function convert_room_data_to_html($id)
    {
         $user_name= User::find($id);
        
        $room_data=$this->get_room_data($id);
        $output= '<h2 align="center">Occupied Room</h2><h3>USER NAME: '.$user_name->name.'</h3><table width="100%" style="border-collapse: collapse; border: 0px;">
  <thead>
    <tr>
      <th style="border: 1px solid; padding:12px;" width="10%">Apartment Name</th>
      <th style="border: 1px solid; padding:12px;" width="10%">Type</th>
      <th style="border: 1px solid; padding:12px;" width="10%">No of Rooms</th>
      <th style="border: 1px solid; padding:12px;" width="5%">Location</th>
      
    </tr>
  </thead> <tbody>';
        foreach($room_data as $room)
        {
            $output.=' <tr>
      <td style="border: 1px solid; padding:12px;">'.$room->title.'</td>
      <td style="border: 1px solid; padding:12px;">'.$room->type.'</td>
      <td style="border: 1px solid; padding:12px;">'.$room->room_no.'</td>
      <td style="border: 1px solid; padding:12px;">'.$room->location.'</td>
      
    </tr>';
        }
         $output .= '</tbody></table>';
         return $output;
    }
    public function convert_customer_data_to_html()
    {
        $customer_data=$this->get_customer_data();
        $output= '<h2 align="center">Occupied Room</h2><table width="100%" style="border-collapse: collapse; border: 0px;">
  <thead>
    <tr>
      <th style="border: 1px solid; padding:12px;" width="10%">Name</th>
      <th style="border: 1px solid; padding:12px;" width="10%">Email</th>
      <th style="border: 1px solid; padding:12px;" width="10%">Phone no</th>
      <th style="border: 1px solid; padding:12px;" width="5%">Age</th>
      <th style="border: 1px solid; padding:12px;" width="10%">Nid</th>
    </tr>
  </thead> <tbody>';
        foreach($customer_data as $customer)
        {
            $output.=' <tr>
      <td style="border: 1px solid; padding:12px;">'.$customer->name.'</td>
      <td style="border: 1px solid; padding:12px;">From:'.$customer->email.'</td>
      <td style="border: 1px solid; padding:12px;">Till: '.$customer->phone_number.'</td>
      <td style="border: 1px solid; padding:12px;">'.$customer->age.'</td>
      <td style="border: 1px solid; padding:12px;">'.$customer->nid.'</td>
    </tr>';
        }
         $output .= '</tbody></table>';
         return $output;
    }
}
