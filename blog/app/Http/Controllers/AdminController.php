<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use App\User;
use App\Post;
use App\Notifications\User_Added;
use App\Charts\pulseChart;
use PDF;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
        return view('admin.index',compact('chart','linechart','roomchart'))->with('admin',$users);
    }
    public function Showchart()
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
        return view('admin.charts',compact('chart','linechart','roomchart'))->with('admin',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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

     public function get_customer_data()
    {
         $users= User::orderBy('name','asc')->paginate(10);
        return $users;
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
