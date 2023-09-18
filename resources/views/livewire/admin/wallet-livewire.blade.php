<div>
<div>

    {{-- alert --}}
    <div>
        @if (session()->has('message'))
            <div id="alert-border-3"
                class="justify-center flex p-4  mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                role="alert">
                <div class="ml-3 text-xl font-medium">
                    {{ session('message') }}
                </div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <svg class=" flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
        @endif
    </div>
{{-- end alert  --}}

    <div class="flex items-center justify-center p-2">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search" wire:model="search"

                class="block w-50 p-4 pl-10 text-sm text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="  بحث  " autocomplete="off" required>
        </div>
    </div>

    <div class="px-5  bg-white-500 ">
        <div class="overflow-auto rounded-lg shadow  md:block">
            <table class="w-full">
                <thead class="bg-gray-700 border-b-2 border-gray-200 text-white">
                    <tr>

                        <th class="w-5 px-2 py-3 text-sm  text-left   text-white uppercase">
                            اسم المستخدم</th>
                        <th class="w-40 py-3  text-sm  tracking-wide text-left   text-white uppercase">
                            القيمه</th>
                        <th class="w-20 py-3  text-sm  tracking-wide text-center   text-white uppercase" colspan="2">
                            العمليات</th>

                        {{-- <th class="w-20  py-3  text-sm  tracking-wide text-center   text-white uppercase" colspan="2">
                            Action</th> --}}

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100  italic font-semibold">
                    @if (is_null($wallets))
                        <div class="alert alert-warning">
                            <strong>Sorry!</strong> No wallets Found.
                        </div>
                    @else
                        @foreach ($wallets as $wallet)
                            <tr class="bg-white">
                                <td class="w-5  px-2   text-sm  whitespace-nowrap border-b">
                                    {{ $wallet->name }}
                                </td>
                                <td class="w-40   py-4  text-sm  whitespace-nowrap border-b">
                                    {{ $wallet->balance }}
                                </td>


                                <td class="w-10  py-4 text-sm whitespace-nowrap border-b">
                                    <x-jet-button wire:click="push({{ $wallet->id }})"
                                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        {{ __('ايداع') }}
                                    </x-jet-button>
                                </td>
                                <td class="w-10 py-4 text-sm whitespace-nowrap border-b">
                                    <x-jet-danger-button wire:click="pull({{ $wallet->id }})" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        {{ __('سحب') }}
                                        </x-jet-button>
                                </td>
                            </tr>
                        @endforeach
                    @endif


                </tbody>
            </table>
        </div>
        <div class="p-2 ">
            {{ $wallets->links('pagination-links') }}
        </div>
    </div>
</div>


{{-- Model form --}}
<x-jet-dialog-modal wire:model="modalFormVisable">
    <x-slot name="title">
        {{ __('') }}
    </x-slot>
    <x-slot name="content">
        {{-- {{ __('Are you sure you want to Crate Notification ?') }} --}}
        <div class="mt-4">
            <x-jet-label for="inputBalance" value="{{ __('المبلغ:') }}" />
            <x-jet-input id="inputBalance" class="block mt-1 w-full" type="number" wire:model="inputBalance"
                required />
            <div class="bg-red-700 ">
                @error('inputBalance')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-danger-button wire:click="cancel" wire:loading.attr="disabled">
            {{ __('الغاء') }}
        </x-jet-danger-button>

        <x-jet-secondary-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
            {{ __('حفظ') }}
        </x-jet-secondary-button>

    </x-slot>
</x-jet-dialog-modal>
</div>
