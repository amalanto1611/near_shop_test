<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Logincontroller extends Controller
{
    public function show()
    {
        return view('login.index');
    }

    public function dash()
    {
        $shops = Shops::all();
        return view('login.dashboard', compact('shops'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function check(Request $request)
    {
        // Validate the incoming request data
        //dd($request);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the user in
        $credentials = $request->only('email', 'password');
        //dd( $credentials);

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to the dashboard
            return redirect()->route('dashboard');
        } else {
            // Authentication failed, redirect back to the login with an error message
            return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
        }
    }

    public function search(Request $request)
    {
    $latitude = $request->input('latitude');
    $longitude = $request->input('longitude');

    // Haversine formula to calculate distance
    $shops = DB::table('shops')
        ->select(DB::raw('*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance'))
        ->setBindings([$latitude, $longitude, $latitude])
        ->orderBy('distance')
        ->get();

    return view('login.dashboard', compact('shops'));
}
}
