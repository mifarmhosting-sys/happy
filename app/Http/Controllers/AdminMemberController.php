<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMemberController extends Controller
{
    /**
     * Display a listing of the registered members.
     */
    public function index()
    {
        $members = Member::orderBy('id', 'desc')->get();
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.members.index', compact('members', 'settings'));
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.members.edit', compact('member', 'settings'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members,email,' . $member->id],
            'mobile_1' => ['required', 'string', 'max:50'],
            'mobile_2' => ['nullable', 'string', 'max:50'],
            'age' => ['nullable', 'integer', 'min:0', 'max:120'],
            'address' => ['nullable', 'string'],
            'co_customer_name' => ['nullable', 'string', 'max:255'],
            'co_customer_age' => ['nullable', 'integer', 'min:0', 'max:120'],
            'kid_1_name' => ['nullable', 'string', 'max:255'],
            'kid_1_age' => ['nullable', 'integer', 'min:0', 'max:120'],
            'kid_2_name' => ['nullable', 'string', 'max:255'],
            'kid_2_age' => ['nullable', 'integer', 'min:0', 'max:120'],
            'membership_category' => ['required', 'string', 'max:255'],
            'membership_issue_date' => ['nullable', 'date'],
            'membership_expiry_date' => ['nullable', 'date'],
            'membership_terms' => ['nullable', 'string'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $data = $request->except(['profile_image']);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            if ($member->profile_image_path && Storage::disk('public')->exists($member->profile_image_path)) {
                Storage::disk('public')->delete($member->profile_image_path);
            }

            $path = $request->file('profile_image')->store('avatars', 'public');
            $data['profile_image_path'] = 'storage/' . $path;
        }

        $member->update($data);

        return redirect()->route('admin.members.index')->with('success', 'Member details updated successfully.');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        // Delete profile image if exists
        if ($member->profile_image_path && Storage::disk('public')->exists(str_replace('storage/', '', $member->profile_image_path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $member->profile_image_path));
        }

        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member account deleted successfully.');
    }
}
