<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    public function home()
    {
        return view('posts.front_page');
    }
}