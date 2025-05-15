<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;



class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return redirect()->route('task.index')
            ->with('message', 'Đăng ký thành công')
            ->cookie('token', $token, 60, null, null, false, true);
    }



    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Thông tin đăng nhập không chính xác'], 401);
        }

        return redirect()->route('task.index')
            ->with('message', 'Đăng nhập thành công')
            ->cookie('token', $token, 60, null, null, false, true);
    }


    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return redirect('/login')
            ->withCookie(cookie('token', '', -1));
    }
}
