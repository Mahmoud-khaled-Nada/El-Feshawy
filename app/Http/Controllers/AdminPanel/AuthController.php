<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class AuthController extends Controller
{
    public function login()
    {
        return view('AdminPanel.Authentication.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth('web')->attempt($credentials)) {
            Flashy::success(__('auth.success'));
            return redirect()->intended(route('dashboard'));
        } else {
            Flashy::error('Wrong Email or Password');
            return redirect()->back();
        }
    }

    public function logout()
    {
        auth('web')->logout();
        Flashy::success(__('auth.logged_out_succes'));
        return redirect("/");
    }
}
