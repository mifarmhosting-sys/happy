<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Booking;
use App\Mail\BookingReceivedCustomer;
use App\Mail\BookingReceivedAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class MemberBookingController extends Controller
{
    /**
     * Show the member profile page.
     */
    public function profile()
    {
        $member = Auth::guard('member')->user();
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('member.profile', compact('member', 'settings'));
    }

    /**
     * Show the holiday booking form.
     */
    public function showBookingForm()
    {
        $member = Auth::guard('member')->user();
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('member.booking', compact('member', 'settings'));
    }

    /**
     * Store a new booking request.
     */
    public function storeBooking(Request $request)
    {
        $member = Auth::guard('member')->user();

        $request->validate([
            'extra_member_name' => ['nullable', 'string', 'max:255'],
            'extra_member_age' => ['nullable', 'integer', 'min:0', 'max:120'],
            'journey_start_date' => ['required', 'date', 'after_or_equal:today'],
            'journey_end_date' => ['required', 'date', 'after:journey_start_date'],
            'destination_type' => ['required', 'in:Single,Multi'],
            'destination_details' => ['required', 'string'],
            'opt_ticket_details' => ['nullable', 'string'],
            'opt_pickup_drop_details' => ['nullable', 'string'],
            'opt_sightseeing_details' => ['nullable', 'string'],
            'opt_food_details' => ['nullable', 'string'],
        ]);

        // Auto-calculate tenure (days & nights)
        $start = Carbon::parse($request->journey_start_date);
        $end = Carbon::parse($request->journey_end_date);
        $nights = $start->diffInDays($end);
        $days = $nights + 1;
        $journey_tenure = "{$days} Days / {$nights} " . ($nights === 1 ? "Night" : "Nights");

        // Use transaction to ensure data safety
        $booking = DB::transaction(function () use ($request, $member, $journey_tenure) {
            $booking = new Booking();
            $booking->member_id = $member->id;
            $booking->extra_member_name = $request->extra_member_name;
            $booking->extra_member_age = $request->extra_member_age;
            $booking->journey_start_date = $request->journey_start_date;
            $booking->journey_end_date = $request->journey_end_date;
            $booking->journey_tenure = $journey_tenure;
            $booking->destination_type = $request->destination_type;
            $booking->destination_details = $request->destination_details;

            // Optional Add-ons
            $booking->opt_ticket = $request->has('opt_ticket_chk') ? ($request->opt_ticket_details ?? 'Yes (Standard)') : null;
            $booking->opt_pickup_drop = $request->has('opt_pickup_drop_chk') ? ($request->opt_pickup_drop_details ?? 'Yes (Standard)') : null;
            $booking->opt_sightseeing = $request->has('opt_sightseeing_chk') ? ($request->opt_sightseeing_details ?? 'Yes (Standard)') : null;
            $booking->opt_food = $request->has('opt_food_chk') ? ($request->opt_food_details ?? 'Yes (Standard)') : null;

            $booking->save();
            return $booking;
        });

        // Trigger Email Notifications (Customer & Admin)
        try {
            // Email A: To the customer
            Mail::to($member->email)->send(new BookingReceivedCustomer($booking));

            // Email B: To the admin (configurable in .env, falls back to contact email or admin email)
            $adminEmail = env('ADMIN_NOTIFICATION_EMAIL', SiteSetting::first()->contact_email ?? 'admin@premiumtravel.club');
            Mail::to($adminEmail)->send(new BookingReceivedAdmin($booking));
        } catch (\Exception $e) {
            // Log mail failures but don't crash the booking flow
            logger()->error('Mail delivery failed for booking ID ' . $booking->id . ': ' . $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your request has been submitted successfully. Our team will contact you within 24 Hours. Thank you for connecting with us.',
                'redirect_url' => route('member.profile')
            ]);
        }

        return redirect()->route('member.profile')->with('success_booking', true);
    }
}
