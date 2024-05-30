<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


class Customerlogcontroller extends Controller
{
   


    public function showRegistrationForm()
    {
        return view('customer.signup');
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:4|confirmed',
            ]);
    
            if ($validator->fails()) {
                throw ValidationException::withMessages($validator->errors()->toArray());
            }
    
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'customer',
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('login')->with('success', 'Registration successful. Please log in.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }


}