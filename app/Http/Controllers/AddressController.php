<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Gate;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        return view('addresses.index', [
            'addresses' => Address::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(): View
    // {
    //     return view('addresses.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'address' => 'required|string',
    //         'country_code' => 'required|string|size:2'
    //     ]);

    //     $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
    //         'address' => $request->address,
    //         'key' => config('services.google.maps_api_key'),
    //         'language' => $request->country_code
    //     ]);

    //     $data = $response->json();

    //     if ($data['status'] === 'OK') {
    //         $result = $data['results'][0];
    //         $translatedAddress = $result['formatted_address'];

    //         $request->user()->addresses()->create([
    //             'original_address' => $request->address,
    //             'translated_address' => $translatedAddress,
    //             'country_code' => $request->country_code,
    //         ]);

    //         return redirect()->route('addresses.index')->with('success', 'Address translated and saved successfully!');
    //     }

    //     return back()->with('error', 'Could not translate address. Please try again.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return view('addresses.show', compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        Gate::authorize('delete', $address);

        $address->delete();

        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully!');
    }
}
