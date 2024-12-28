<?php

namespace App\Http\Controllers;

use App\Services\AddressTranslationService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $translationService;

    public function __construct(AddressTranslationService $translationSerice)
    {
        $this->translationService = $translationSerice;
    }

    public function index()
    {
        return view('home');
    }

    public function translate(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            // 'country_code' => 'required|string|size:2',
        ]);

        try {
            $translation = $this->translationService->translate(
                $request->address,
                // $request->country_code,
                'ja'
            );

            // If user is authenticated, save the translation automatically
            if ($request->user()) {
                $request->user()->addresses()->create([
                    'original_address' => $request->address,
                    'translated_address' => $translation['translated_address'],
                    'country_code' => $request->country_code
                ]);
            }

            return view('home', [
                'original_address' => $request->address,
                'translated_address' => $translation['translated_address'],
                'country_code' => $request->country_code
            ]);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
