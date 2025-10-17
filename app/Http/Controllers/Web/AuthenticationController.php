<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\AuthenticationLoginFormRequest;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        //
        // abort(419);
        if (Auth::check()) {

            $user = Auth::user();

            if ($user->role === 'staff') {
                return redirect()->intended(route('staffpending.index'));
            }

            if ($user->role === 'field') {
                return redirect()->intended(route('fieldpending.index'));
            }
        }
        return Inertia::render('auth/Login');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function authenticate(LoginFormRequest $request) 
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
        }

        return redirect()->back()->withErrors(['message' => 'Invalid credentials.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        // dd('test logout');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}