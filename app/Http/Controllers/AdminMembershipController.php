<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipEnquiry;

class AdminMembershipController extends Controller
{
    /**
     * Display a listing of the membership enquiries.
     */
    public function index()
    {
        $enquiries = MembershipEnquiry::orderBy('created_at', 'desc')->get();
        $settings = \App\Models\SiteSetting::first() ?? new \App\Models\SiteSetting();
        return view('admin.membership.index', compact('enquiries', 'settings'));
    }

    /**
     * Remove the specified enquiry from storage.
     */
    public function destroy($id)
    {
        $enquiry = MembershipEnquiry::findOrFail($id);
        $enquiry->delete();
        return redirect()->back()->with('success', 'Enquiry deleted successfully.');
    }
}
