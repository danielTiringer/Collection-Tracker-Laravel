<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(): View|Application|Factory|ContractsApplication
    {
        return view('users/register');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validatedFormFields = $request->validated();

        $validatedFormFields['password'] = Hash::make($validatedFormFields['password']);

        $user = (new User)->create($validatedFormFields);

        auth()->login($user);

        return redirect()->route('collections.index')->with('success', 'Registration successful');
    }

    public function login(): View|Application|Factory|ContractsApplication
    {
        return view('users.login');
    }

    public function auth(LoginUserRequest $request): RedirectResponse
    {
        $validatedFormRequest = $request->validated();

        if (auth()->attempt($validatedFormRequest)) {
            $request->session()->regenerate();

            return redirect()->route('collections.index')->with('success', 'Login successful');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out');
    }
}
