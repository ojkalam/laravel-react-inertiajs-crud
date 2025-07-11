<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    public function profile()
    {
        return Inertia::render("Admin/Profile", [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|max:2048', // Max 2MB
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            $validatedData = $validator->validated();

            if ($request->hasFile('profile_photo')) {
                // Delete old photo if exists
                if ($user->profile_photo_path) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }
                $validatedData['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos', 'public');
            }

            $user->update($validatedData);
            return Redirect::back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while updating the profile: ' . $e->getMessage())->withInput();
        }
    }

    public function settings()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return Inertia::render("Admin/Settings", [
            'settings' => $settings,
        ]);
    }

    public function updateSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_title' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            foreach ($validator->validated() as $key => $value) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
            return Redirect::back()->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while updating settings: ' . $e->getMessage())->withInput();
        }
    }
}
