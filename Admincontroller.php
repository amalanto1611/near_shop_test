<?php

namespace App\Http\Controllers;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
class Admincontroller extends Controller
{
    public function show()
    {
       
            return view('admin.create');
        
    }
    public function editshow($id)
    {
             $shop = Shops::findOrFail($id); // Assuming your model name is Shop
             return view('admin.edit', compact('shop'));
    }
    public function createshop(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
               
            ]);
    
            if ($validator->fails()) {
                throw ValidationException::withMessages($validator->errors()->toArray());
            }
    
            Shops::create([
                'name' => $request->name,
                'type' => $request->type,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
               
            ]);
            return redirect()->route('dashboard')->with('success', 'Shop creation success.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    public function updateshop(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
            ]);
    
            if ($validator->fails()) {
                throw ValidationException::withMessages($validator->errors()->toArray());
            }
    
            $shop = Shops::findOrFail($id); // Assuming your model name is Shop
    
            $shop->update([
                'name' => $request->name,
                'type' => $request->type,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
    
            return redirect()->route('dashboard')->with('success', 'Shop updated successfully.');
    
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    public function deleteshop($id)
{
    try {
        $shop = Shops::findOrFail($id); // Assuming your model name is Shop
        $shop->delete();
        
        return redirect()->route('dashboard')->with('success', 'Shop deleted successfully.');

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}
}
