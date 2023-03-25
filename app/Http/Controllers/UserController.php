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
            $credential_admin = [
                'username' => $request->input('username'),
                'password' => $request->input('password')
            ];

            // ----------------------

            if (Auth::attempt($credential_admin))
                return redirect()->route('admin.dashboard');
            else
                return redirect()->route('user.login')->with('failed', 'Username or Password is incorrect');
            
        }
        else
        {
            $credential_user = [
                'username' => $request->input('username'),
                'password' => $request->input('password')
            ];

            // ----------------------

            if (Auth::attempt($credential_user))
                return redirect()->route('admin.dashboard');
            else
                return redirect()->route('user.login')->with('failed', 'Username or Password is incorrect');
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

    // ----------------------------------------------
    // ==============================================

    public function dashboard()
    {
        $role = Auth::user()->role;
        return view('admin.dashboard', compact('role'));
    }

    // ------------------------------------------

    public function add_account()
    {
        return view('admin.add_account');
    }

    // ------------------------------------------

    public function add_account_process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->route('admin.add-account')->with('failed', 'Username is already used for other account')->withInput();

        // ----------------------

        $user = new User;
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('admin.add-account')->with('success', 'Account successfully added');
    }
}
