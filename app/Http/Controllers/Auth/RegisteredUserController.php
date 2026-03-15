<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Advisor;
use App\Models\Major;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // ดึงข้อมูลจากตาราง majors
        $majors = Major::all();
        // dd($majors->all());
        return view('auth.register', compact('majors'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(route('dashboard', absolute: false));
    // }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        // ดึงข้อมูลจากตาราง majors

        $request->validate([
            'a_id' => ['required', 'string', 'max:255', 'unique:advisors'],
            'a_fname' => ['required', 'string', 'max:255'],
            'a_lname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'a_type' => ['required', 'in:advisor,admin,teacher'], // Validate the type
            'm_id' => ['required', 'exists:majors,id'], // Validate m_id
        ]);

        $advisors = Advisor::create([
            'a_id' => $request->a_id,
            'a_fname' => $request->a_fname,
            'a_lname' => $request->a_lname,
            'a_password' => Hash::make($request->password),
            'status' => 'active',
            'a_type' => $request->a_type,
            'm_id' => $request->m_id, // Save m_id
        ]);

        // Trigger the Registered event
        event(new Registered($advisors));

        // Log in the advisor after registration
        Auth::guard('advisors')->login($advisors);

        // Redirect based on a_type
        switch ($advisors->a_type) {
            case 'admin':
                return redirect()->route('admin.advisor.index');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'advisor':
                return redirect()->route('advisor.dashboard');
            default:
                return redirect()->route('dashboard'); // Default fallback route
        }
    }
}
