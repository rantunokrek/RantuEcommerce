<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   
    public function admin()
    {
        return view('admin.home');
    }

    public function logout()
    {

       Auth::logout();
       $notification=array('messege' => 'You are logged out!','alert-type' => 'info');
       return redirect()->route('admin.login')->with($notification);

    }
}
