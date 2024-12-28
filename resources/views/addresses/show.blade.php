<x-app-layout>
    <x-slot name="header">
        <div class="mb-8">
            <a href="{{ route('addresses.index') }}"
                class="text-gray-600 hover:text-gray-900">
                ← Back to addresses
            </a>
        </div>
    </x-slot>
    <div class="bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div class="divide-y divide-gray-200">


                        <!-- Original Address -->
                        <div class="text-base text-gray-500 mb-4">
                            {{ $address->original_address }}
                        </div>

                        <!-- Translated Address -->
                        <div class="py-8">
                            <div class="text-4xl font-bold text-center text-gray-900 break-words">
                                {{ $address->translated_address }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>