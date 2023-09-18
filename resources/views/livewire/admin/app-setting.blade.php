<div class="bg-gray-100" >
    <div class="py-4 ">
        <div class="text-center">
            <x-jet-button wire:click="createShowModal">
                {{ __('Create Setting') }}
            </x-jet-button>
        </div>
    </div>  
    {{-- table data --}}
    <div class="px-5  bg-white-500 ">
        <div class="overflow-auto rounded-lg shadow  md:block">
            <table class="w-full">
                <thead class="bg-gray-700 border-b-2 border-gray-200 text-white">
                    <tr>

                        <th class="w-15 px-2 py-3 text-sm  text-left   text-white uppercase">
                            No.</th>
                        <th class=" w-15  py-3  text-sm  tracking-wide text-left   text-white uppercase">
                            Key</th>
                        <th class=" w-15 py-3  text-sm  tracking-wide text-left   text-white uppercase">
                            value</th>
                        <th class="w-25  py-3  text-sm  tracking-wide text-left   text-white uppercase">
                            Created at</th>
                        <th class=" w-30 py-3   text-sm  tracking-wide text-center   text-white uppercase "
                            colspan="2">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($settings as $setting)
                        <tr class="bg-white">
                            <td class="w-15  py-4 text-sm  whitespace-nowrap border-b">
                                <span class="px-2"></span> {{ $setting->id }} </th>
                            </td>
                            <td class="w-15   py-4  text-sm  whitespace-nowrap border-b">
                                {{ $setting->key }}
                            </td>
                            <td class="w-15   py-4  text-sm  whitespace-nowrap border-b">
                                {{ $setting->value }}
                            </td>
                            <td class="w-25  py-4 text-sm whitespace-nowrap border-b">
                                {{ $setting->created_at }}</td>
                            <td class="w-10 text-sm whitespace-nowrap border-b">
                                <x-jet-button wire:click="updateShowModel({{ $setting->id }})">
                                    {{ __('Update') }}
                                </x-jet-button>
                            </td>
                            <td class="w-10  px-2 text-sm whitespace-nowrap border-b">
                                <x-jet-danger-button wire:click="deletShowModel({{ $setting->id }})">
                                    {{ __('Delete') }}
                                    </x-jet-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-2 ">
            {{ $settings->links() }}
        </div>
    </div>
    {{-- Model form --}}
<x-jet-dialog-modal wire:model="modalFormVisable">
        <x-slot name="title">
            {{ __('Create New App Setting ') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to Create App Setting') }}
            <div class="mt-4">
                <x-jet-label for="key" value="{{ __('Key:') }}" />
                <x-jet-input id="key" class="block mt-1 w-full" type="text" wire:model="key" required />
                <div class="bg-red-700 ">
                    @error('key')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="value" value="{{ __('Value:') }}" />
                <x-jet-input id="value" class="block mt-1 w-full" type="text" wire:model="value" required />
                <div class="bg-red-700 ">
                    @error('value')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$toggle('modalFormVisable')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>

            @if ($modelId)
                <x-jet-secondary-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-secondary-button>
                <x-slot name="title">
                    {{ __('Update  App Setting ') }}
                </x-slot>
            @else
                <x-jet-secondary-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-secondary-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    {{-- delet model form  --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeletVisable">
        <x-slot name="title">
            {{ __('Delete This Seting') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Setting? ') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$toggle('modalConfirmDeletVisable  ')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-secondary-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete Setting') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
