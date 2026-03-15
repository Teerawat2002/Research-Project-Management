<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:100'],
            'lname' => ['required', 'string', 'max:100'],
        ]);

        $user = $request->user();
        if (isset($user->a_fname)) {
            $user->a_fname = $request->fname;
            $user->a_lname = $request->lname;
        } else {
            $user->s_fname = $request->fname;
            $user->s_lname = $request->lname;
        }
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = $request->user();

        if (isset($user->a_password)) {
            $user->a_password = Hash::make($request->password);
        } elseif (isset($user->s_password)) {
            $user->s_password = Hash::make($request->password);
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
