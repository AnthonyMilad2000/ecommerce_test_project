<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\Country;
use App\Models\CustomerAdress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    public function login(){
        return view('products.account.login');

    }
    public function register(){
        return view('products.account.register');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
            ]);
            if ($validator->passes()){
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();
                session()->flash('success', 'You have been registerd successfully.');
                
                return response()->json([
                    'status' => true,
                ]);
                    
            } else {
            return response()->json([
            'status' => false,
            'errors' => $validator->errors()
            ]);
            }
    }
    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    
        // Attempt to log in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            
            
            
            if (session()->has('url.intended')) {
                return redirect(session()->get('url.intended'));
            }
            
            return redirect()->route('home');
        }
    
        // Authentication failed
        return redirect()->route('login')
            ->withInput($request->only('email'))
            ->with('error', 'Either email/password is incorrect.');
    }
    
public function logout(){
    Auth::logout();
    return redirect()->route('home') // or any page other than login
        ->with('success', 'You successfully logged out!');
}


}