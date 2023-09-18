<x-app-layout>
    {{-- <x-slot name="header" >
        <div class="text-center bg-gray-100  ">
        <h2 class="font-light text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </div>
        
    </x-slot> --}}

    <div class="py-2 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('admin.item')
            </div>
        </div>
    </div>
</x-app-layout>