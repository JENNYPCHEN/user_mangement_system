<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{

    public function index()
    {
        return view('homepage');
    }
    public function loginPage()
    {
        return view('login');
    }
    public function signupPage()
    {
        return view('signup');
    }
    public function editPage(User $user)
    {
        return view('edit', ['user' => $user]);
    }
    public function dashboard()
    {
        if (auth()->user()->is_admin == 0) {
            $profiles = auth()->user();
        }
        if (auth()->user()->is_admin == 1) {
            $profiles = DB::table('users')->where('is_admin', 0)->where('deleted_at', '=', NULL)->get();
        }
        return view('dashboard', compact('profiles'));
    }
    public function authenticate(LoginRequest $request)
    {
        $loginForm = $request->validated();
        if (auth()->attempt($loginForm)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('message', 'Vous êtes connecté');
        }
        return back()->withErrors(['error' => 'Identifiants non valides']);
    }
    public function store(RegisterRequest $request)
    {
        $signupForm = $request->validated();
            $signupForm['password'] = bcrypt($signupForm['password']);
            $user = User::create($signupForm);
            if (!Auth::check()) {
                auth()->login($user);
            }
            return redirect()->route('dashboard')->with('message', 'le compte a été créé');
    }
    public function update(EditRequest $request, User $user)
    {
        if($request['name']!==$user['name']&&Db::table('users')->where('name',$request['name'])!==null){
            return back()->withErrors(['name' => 'le nom d \'utilisateur existe déjà dans le système.']);
        }

        if($request['email']!==$user['email']&&Db::table('users')->where('email',$request['email'])!==null){
            return back()->withErrors(['email' => 'l\'adresse email existe déjà dans le système.']);
        }
        $editForm = $request->validated();
        $editForm['password'] = bcrypt($editForm['password']);
        $user->update($editForm);
        return redirect()->route('dashboard')->with('message', 'le détail du compte a été modifié avec succès');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Vous êtes déconnecté');
    }

    public function bin(User $user)
    {

        $user->delete();
        if (auth()->user()->id == $user->id) {
            return redirect('/')->with('message', 'Votre compte a été supprimé');
        } else {
            return redirect()->route('dashboard')->with('message', 'le compte a été supprimé');
        }
    }

    public function delete(User $user)
    {
        $user->forceDelete();
        return redirect()->route('dashboard')->with('message', 'le compte a été supprimé');
    }
}
