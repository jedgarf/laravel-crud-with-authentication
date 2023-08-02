<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

use App\Models\User;

class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->users = new User();
    }

    public function auth(Request $request)
    {

        $credentials = $request->only(['email', 'password']);

        // check email if exist
        $user = $this->users->where('email', $credentials['email'])->first();

        if ($user) {

            $password = $credentials['password'];

            // Matching Password
            if (Hash::check($password, $user->password)) {

                // Saving Sessions
                session(['is_logged' => true], ['user_id' => $user->id]);

                // Goto Student CRUD
                return redirect('/admin/students');

            } else {
                return back()->with('login_msg', 'Invalid Password.');
            }

        } else {
            return back()->with('login_msg', 'Invalid Email.');
        }

    }

    public function logout(Request $request)
    {
        $request->session()->forget(['is_logged', 'user_id']);
        return redirect('/');
    }
}
