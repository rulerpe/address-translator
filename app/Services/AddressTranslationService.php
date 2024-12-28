<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AddressTranslationService
{
    public function translate(string $address, string $countryCode): array
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $address,
            'key' => config('services.google.maps_api_key'),
            'language' => $countryCode
        ]);

        $data = $response->json();

        if ($data['status'] !== 'OK') {
            throw new \Exception('Could not translate address. Please try again.');
        }

        return [
            'translated_address' => $data['results'][0]['formatted_address']
        ];
    }
}
