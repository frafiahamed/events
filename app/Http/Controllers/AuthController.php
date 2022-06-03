<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
ini_set('memory_limit', '1024M'); // or you could use 1G
class AuthController extends BaseController
{    
 
    public function index()
    { 
        return view('auth.login');
    }  
       
 
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('events-list')
                        ->withSuccess('Signed in');
        }
   
        return redirect("/")->withSuccess('Login details are not valid');
    }
 
 
 
    public function registration()
    {
        return view('auth.registration');
    }
       
 
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'firstname' => 'required|string|max:255|min:4',
            'lastname' => 'required|string|max:255|min:4',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'dob' => 'required|date|before_or_equal:' . Carbon::now()->subYears(18)->toDateString(),
            'gender' => 'required',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
          
        return redirect("dashboard")->withSuccess('You have signed-in');
    }
 
 
    public function create(array $data)
    {
      return User::create([
        'firstname'     => $data['firstname'],
        'lastname'      => $data['lastname'],
        'email'         => $data['email'],
        'password'      => Hash::make($data['password']),
        'dob'           => $data['dob'],
        'gender'        => $data['gender']
      ]);
    }    
     
 
    public function dashboard()
    {
        if(Auth::check()){
            return view('Events.preevents');
        }
   
        return redirect("/")->withSuccess('You are not allowed to access');
    }
     
 
    public function signOut() {
        Session::flush();
        Auth::logout();
   
        return Redirect('/');
    }
}
