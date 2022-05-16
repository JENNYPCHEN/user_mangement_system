<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index(){
        return view('homepage');
    }

    public function loginPage(){
        return view('login');
    }

    public function authenticate(Request $request) {
        $loginForm=$request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        if(auth()->attempt($loginForm)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('message', 'Vous êtes connecté');
        }
        return back()->withErrors(['error' => 'Identifiants non valides']);
    }
    public function dashboard(){
        if(auth()->user()->is_admin===0){
            $profiles=auth()->user();
        }
        if(auth()->user()->is_admin===1){
            $profiles=User::all();
        }
        return view('dashboard',compact('profiles'));
    }
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Vous êtes déconnecté');

    }
}
