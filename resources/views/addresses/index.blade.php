<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Addresses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                            Add New Address
                        </a>
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($addresses as $address)
                        <div class="border rounded-lg p-4">
                            <div class="mb-2">
                                <strong>Original Address:</strong>
                                <p>{{ $address->original_address }}</p>
                            </div>
                            <div class="mb-2">
                                <strong>Translated Address:</strong>
                                <p>{{ $address->translated_address }}</p>
                            </div>
                            <a href="{{ route('addresses.show', $address->id) }}"
                                class="text-blue-600 hover:text-blue-900">
                                Show Full Screen
                            </a>
                            <div class="flex justify-end">
                                <form action="{{ route('addresses.destroy', $address) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this address?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>