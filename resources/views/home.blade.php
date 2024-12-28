<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6 text-center">Translate Addresses for Your Japan Trip</h1>

                    <div class="max-w-xl mx-auto">
                        @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                        @endif

                        <form action="{{ route('translate') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <x-text-input
                                    id="address"
                                    name="address"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    placeholder="Enter destination (e.g., Tokyo Tower, Shibuya Crossing)"
                                    value="{{ old('address', $original_address ?? '') }}" />
                            </div>

                            <!-- <div class="mb-6">
                                <x-input-label for="country_code" value="Select Country" />
                                <select id="country_code" name="country_code"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="ja">Japan</option>
                                    <option value="KR">South Korea</option>
                                    <option value="CN">China</option>
                                    <option value="TH">Thailand</option>
                                    <option value="VN">Vietnam</option>
                                </select>
                            </div> -->

                            <x-primary-button type="submit" class="w-full justify-center">
                                {{ __('Translate Address') }}
                            </x-primary-button>
                        </form>

                        @if(isset($translated_address))
                        <div class="mt-8">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <div class="text-sm text-gray-600 mb-2">Original Address:</div>
                                <div class="mb-4">{{ $original_address }}</div>

                                <div class="text-sm text-gray-600 mb-2">Translated Address:</div>
                                <div class="text-xl font-semibold break-words">
                                    {{ $translated_address }}
                                </div>
                            </div>
                            @guest
                            <div class="mt-6 border-t pt-4">
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <p class="text-blue-800 text-sm">
                                        Want to save this translation for your trip?
                                        <a href="{{ route('register') }}" class="font-medium underline">Register now</a>
                                        or
                                        <a href="{{ route('login') }}" class="font-medium underline">sign in</a>
                                        to keep track of all your translated addresses!
                                    </p>
                                </div>
                            </div>
                            @endguest
                        </div>
                        @endif

                        @if(!isset($translated_address))
                        <div class="text-gray-600 mt-4 text-sm">
                            Try searching for: Tokyo Tower, Shibuya Crossing, or Sensoji Temple
                        </div>
                        <!-- Pro Tips Section -->
                        <div class="bg-blue-50 p-6 rounded-lg mt-8">
                            <h2 class="text-blue-900 font-semibold text-lg mb-4">Pro Tips:</h2>
                            <ul class="space-y-3 text-blue-800">
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    Save your hotel address for quick access
                                </li>
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    Show the Japanese text to your taxi driver
                                </li>
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    Use the exact address for better accuracy
                                </li>
                            </ul>
                        </div>


                        @auth
                        <div class="mt-6 text-center">
                            <a href="{{ route('addresses.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                View your translation history →
                            </a>
                        </div>
                        @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>