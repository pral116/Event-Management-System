<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;

class AuthController extends Controller
{
    public function viewUserRegister(){
        return view('auth.user-register');
    }

    public function userRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user = User::where('email', $request->email)->first();
        $request->session()->put('user', $user);
        return redirect('/');
    }

    public function viewAdminRegister(){
        return view('auth.admin-register');
    }

    public function adminRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = "1";
        $user->password = Hash::make($request->password);
        $user->save();
        $user = User::where('email', $request->email)->first();
        $request->session()->put('user', $user);
        return redirect()->route('admin.dashboard');
    }

    public function viewLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $user = User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('user', $user);
                if ($user->is_admin == '0')
                    return redirect('/');
                else
                    return redirect()->route('admin.dashboard');
            }
            else{
                return back()->with('fail', 'Wrong Password!');
            }
        }
        else{
            return back()->with('fail', 'email not registered');
        }
    }

    static function user(){
        if (Session::has('user')){
            return Session::get('user');
        }
    }

    public function logout(){
        Session::pull('user');
        return redirect('user/login');
    }
}
