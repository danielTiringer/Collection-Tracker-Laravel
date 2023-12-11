<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (!$user instanceof User) {
            return redirect()
                ->route('users.create')
                ->with('error', 'User cannot be found');
        }

        auth()->login($user);

        return redirect()
            ->route('collections.index')
            ->with('success', 'Registration successful');
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

            return redirect()
                ->route('collections.index')
                ->with('success', 'Login successful');
        }

        return back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Logged out');
    }

    public function edit(): View|Application|Factory|ContractsApplication
    {
        return view('users.edit')
            ->with(['user' => auth()->user()]);
    }

    public function update(UpdateUserRequest $request): RedirectResponse
    {
        $validatedFormFields = $request->validated();

        $currentUser = (new User)->findOrFail(Auth::id());
        if (!$currentUser instanceof User) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'User cannot be found');
        }

        try {
            $this->authorize('update', $currentUser);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to update user');
        }

        $validatedFormFields['id'] = $currentUser->id;

        $userUpdated = $currentUser->update($validatedFormFields);
        if (!$userUpdated) {
            return redirect()
                ->route('users.edit')
                ->with('error', 'Update failed');
        }

        return redirect()
            ->route('users.edit')
            ->with('success', 'Update successful');
    }

    public function editPassword(): View|Application|Factory|ContractsApplication
    {
        return view('users.change_password');
    }

    public function updatePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $validatedFormFields = $request->validated();

        $currentUser = (new User)->findOrFail(Auth::id());
        if (!$currentUser instanceof User) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'User cannot be found');
        }

        try {
            $this->authorize('updatePassword', $currentUser);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to update user');
        }

        if (!Hash::check($validatedFormFields['old_password'], $currentUser->password)) {
            return redirect()
                ->route('users.edit')
                ->with('error', 'Incorrect old password');
        }

        $validatedFormFields['password'] = Hash::make($validatedFormFields['password']);

        $userUpdated = $currentUser->update($validatedFormFields);
        if (!$userUpdated) {
            return redirect()
                ->route('users.edit')
                ->with('error', 'Update failed');
        }

        return redirect()
            ->route('users.edit')
            ->with('success', 'Update successful');
    }
}
