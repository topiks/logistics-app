<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if($request->input('username') == 'adminbbi123')
        {
            $credential_user = [
                'username' => $request->input('username'),
                'password' => $request->input('password')
            ];

            // ----------------------

            if (Auth::attempt($credential_user))
            {
                return redirect()->route('admin.dashboard');
            }
            else
            {
                return redirect()->route('user.login')->with('failed', 'Username or Password is incorrect');
            }
        }
        else
        {
            echo "user";
        }
    }

    // ------------------------------------------

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

    // ------------------------------------------

    public function display_login()
    {
        return view('account.login');
    }

    // ------------------------------------------

    public function dashboard()
    {
        $role = Auth::user()->role;
        return view('admin.dashboard', compact('role'));
    }
}
