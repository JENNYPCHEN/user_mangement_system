<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(){
        return view('homepage');
    }

    public function loginPage(){
        return view('login');
    }

    public function authenticate(LoginRequest $request) {
        $loginForm = $request->validated();
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
            $profiles=DB::table('users')->where('is_admin', 0)->get();
        }
        return view('dashboard',compact('profiles'));
    }
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Vous êtes déconnecté');
    }
    public function editPage(User $user) {
        return view('edit', ['user' => $user]);
    }
    public function update(EditRequest $request, User $user) {
        $editForm = $request->validated();
        $user->update($editForm);
        return redirect()->route('dashboard')->with('message', 'le détail du compte a été modifié avec succès');
    }

}
