<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function create()
    {
        $count = User::all()->count();

        $page = redirect('auth/login');
        if ($count < 1) {
            $page = view('pages.auth.regis');
        }

        return $page;
    }

    public function authenticate(LoginRequest $request)
    {
        $request->authenticate();

        $page = route('login');
        $request->session()->regenerate();
        if (auth()->user()->role == 'ADMIN') {
            $page = route('admin');
        }

        if (auth()->user()->role == 'OPERATOR') {
            $page = route('payment.index');
        }

        if (auth()->user()->role == 'STUDENT') {
            $id = encrypt(auth()->user()->id);
            $page = route('payment.show', ['id' => $id]);
        }

        return redirect()->intended($page);
    }

    public function store(Request $request)
    {
        $credential = $request->only(['name', 'email', 'username', 'password']);

        $credential['password'] = bcrypt($credential['password']);

        $credential['role'] = 'ADMIN';

        User::create($credential);

        return redirect()->route('admin');
    }

    public function destroy(Request $request)
    {
        auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }
}
