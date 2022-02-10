<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
  Protected function index(Request $req1)
  {
  $req1->validate([
   			'email'=>'required|email',
   			'password'=>'required|min:5|max:12',
   		]);
   			$email=$req1->input('email');
   		$password=$req1->input('password');
   			
   		$users = DB::table('users')
            ->where('email','=',$email)
            ->where('password','=',$password)
            ->first();
            if(!$users)
   	{
   		session()->flash('data','Incorret credentials');
     return redirect('/');
   		// return "";
   	}
   	else{
   		session(['userid' => $users->id]);
   		session(['email' => $users->email]);
   		session(['role' => $users->role]);
   		if($users->role=='1')
        	return redirect('/admin/dashboard');
    	elseif($users->role=='2')
    		return redirect('/teacher/dashboard');
    	elseif($users->role=='3')
    		return redirect('/student/dashboard');
    	else{
    		return redirect('/');
    	}

   	}
  }
}
