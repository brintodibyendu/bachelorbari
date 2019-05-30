<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(){
    	$title='welcome to My system!';
   // 	return view('pages.index',compact('title'));
    	return view('pages.index')->with('title',$title);
    }

    public function services(){
    	$data=array(
           'title'=>'Services',
           'services' => ['Rent Room','Select your guests','Give your free rooms']);
    	return view('pages.services')->with($data);
    }
}
