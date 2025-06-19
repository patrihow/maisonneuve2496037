<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    // Form pour login
    public function create()
    {
        return view('auth.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100|exists:users',
            'password' => 'min:6|max:20',
        ]);
        $credentials = $request->only('email', 'password');

        if(!Auth::validate($credentials)) {
            return redirect(route('login'))
                ->withErrors(['email' => trans('auth.failed')])
                ->withInput();
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);

        return redirect()->intended(route('student.index'))
            ->with('success', 'Vous êtes connecté avec succès.');
    }

    // Logout
    public function destroy()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'))
            ->with('success', 'Vous êtes déconnecté avec succès.');
    }
}
