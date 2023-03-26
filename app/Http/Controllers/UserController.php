<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Mail\MyMail;

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

    public function send_email_forget_password()
    {
        $mail_data = [
            'title' => 'Forget Password',
            'body' => 'This is for testing email using smtp'
        ];

        // ----------------------

        Mail::to('hiitaufik24@gmail.com')->send(new MyMail($mail_data));

        // ----------------------

        if (Mail::flushMacros())
            return redirect()->route('user.login')->with('failed', 'Something wrong with your email');
        else
            return redirect()->route('user.login')->with('success', 'Check your email for reset password');
    }

    public function set_to_forgetting_password()
    {
        $user = User::where('role', '=', '0')->first();
        $user->status_pass = 1;

        // ----------------------

        if ($user->save())
            return redirect()->route('admin.reset_pass');
        else
            return redirect()->route('user.login')->with('failed', 'Something wrong with your email');
    }

    public function reset_pass_display()
    {
        return view('account.reset_pass');
    }

    public function set_new_pass(Request $request)
    {
        $user = User::where('role', '=', '0')->first();
        $user->password = Hash::make($request->input('password'));
        $user->status_pass = 0;

        // ----------------------

        if ($user->save())
            return redirect()->route('user.login')->with('success', 'Password successfully updated');
        else
            return redirect()->route('user.login')->with('failed', 'Something wrong with your email');
    }

    // ----------------------------------------------
    // ==============================================

    public function ganti_pass_display()
    {
        return view('account.ganti_pass');
    }

    public function ganti_pass_process(Request $request)
    {
        $old_password = $request->input('password_lama');
        $new_password = $request->input('password_baru');

        // ----------------------

        if (Hash::check($old_password, Auth::user()->password))
        {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($new_password);
            $user->save();

            // ----------------------

            return redirect()->route('admin.ganti_pass')->with('success', 'Password successfully updated');
        }
        else
            return redirect()->route('admin.ganti_pass')->with('failed', 'Old password is incorrect');
    }

    // ----------------------------------------------
    // ==============================================

    public function dashboard()
    {
        $role = Auth::user()->role;
        return view('admin.dashboard', compact('role'));
    }

    // ----------------------------------------------
    // ==============================================

    public function list_user()
    {
        $users = User::all();
        return view('admin.list_user', compact('users'));
    }

    public function delete_user($_id)
    {
        $user = User::find($_id);
        $user->delete();

        // ----------------------

        return redirect()->route('admin.list-user')->with('success', 'Account successfully deleted');
    }

    public function edit_role_user(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->role = $request->input('role');
        $user->save();

        // ----------------------

        return redirect()->route('admin.list-user')->with('success', 'Account role successfully updated');
    }

    public function edit_password_user(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // ----------------------

        return redirect()->route('admin.list-user')->with('success', 'Account password successfully updated');
    }

    // ----------------------------------------------
    // ==============================================

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
        $user->status_pass = 0;
        $user->save();

        // ----------------------

        return redirect()->route('admin.list-user')->with('success', 'Account successfully added');
    }
}
