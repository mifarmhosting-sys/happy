<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Member;
use App\Mail\MemberRegisteredCustomer;
use App\Mail\MemberRegisteredAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class MemberAuthController extends Controller
{
    /**
     * Show the member login form.
     */
    public function showLogin()
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('member.profile');
        }

        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('member.login', compact('settings'));
    }

    /**
     * Handle a member login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'customer_id' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('member')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('member.profile'));
        }

        throw ValidationException::withMessages([
            'customer_id' => [trans('auth.failed')],
        ]);
    }

    /**
     * Show the member registration form.
     */
    public function showRegister()
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('member.profile');
        }

        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('member.register', compact('settings'));
    }

    /**
     * Handle a member registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:members,email'],
            'mobile_1' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // Auto-generate a unique customer ID (e.g. PTC-1002)
        $lastMember = Member::orderBy('id', 'desc')->first();
        $nextNum = 1001;
        if ($lastMember) {
            preg_match('/(\d+)/', $lastMember->customer_id, $matches);
            if (isset($matches[1])) {
                $nextNum = intval($matches[1]) + 1;
            }
        }
        $customerId = 'PTC-' . $nextNum;

        // Verify if it exists to be safe
        while (Member::where('customer_id', $customerId)->exists()) {
            $nextNum++;
            $customerId = 'PTC-' . $nextNum;
        }

        // Create the member record
        $member = Member::create([
            'customer_id' => $customerId,
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'mobile_1' => $request->mobile_1,
            'password' => Hash::make($request->password),
        ]);

        // Trigger Notifications
        try {
            // Send email to customer
            Mail::to($member->email)->send(new MemberRegisteredCustomer($member));

            // Send email to admin (explicitly specified as mifarmhosting@gmail.com)
            Mail::to('mifarmhosting@gmail.com')->send(new MemberRegisteredAdmin($member));
        } catch (\Exception $e) {
            logger()->error('Mail delivery failed during member registration: ' . $e->getMessage());
        }

        return redirect()->route('member.login')->with('success_registration', "Your membership has been activated! Your Login ID is {$customerId}. You can now sign in and explore.");
    }

    /**
     * Log the member out of the application.
     */
    public function logout(Request $request)
    {
        Auth::guard('member')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
