<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Mock users
    private array $users = [
        [
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@groundstandard.com',
            'password' => 'password123',
            'role' => 'Admin',
        ],
        [
            'id' => 2,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'role' => 'Member',
        ],
    ];

    public function showLogin()
    {
        if (session('auth_user')) {
            return redirect()->route('home');
        }

        return view('auth.login', [
            'metaTitle' => 'Login | Ground Standard Agency',
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        foreach ($this->users as $user) {
            if ($user['email'] === $request->email && $user['password'] === $request->password) {
                session(['auth_user' => [
                    'id'    => $user['id'],
                    'name'  => $user['name'],
                    'email' => $user['email'],
                    'role'  => $user['role'],
                ]]);

                return redirect()->route('home')->with('success', 'Welcome back, ' . $user['name'] . '!');
            }
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput($request->only('email'));
    }

    public function logout()
    {
        session()->forget('auth_user');
        return redirect()->route('home')->with('success', 'You have been logged out.');
    }
}
