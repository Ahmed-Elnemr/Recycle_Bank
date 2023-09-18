<x-app-layout>
    <x-slot name="header">
        @yield('header')
    </x-slot>

    <div class="py-2 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @yield('content')
            </div>
        </div>
    </div>
</x-app-layout>