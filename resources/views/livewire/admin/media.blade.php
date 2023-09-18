<div class="bg-gray-100 py-2">
    {{-- <div class="py-4 ">
        <div class="text-center">
            <x-jet-button wire:click="createShowModal">
                {{ __('Create New Media') }}
            </x-jet-button>
        </div>
    </div> --}}

    {{-- table data --}}

    <div class="px-5  ">
        <div class="overflow-auto rounded-lg shadow  md:block">
            <table class="w-full ">
                <thead class="bg-gray-700 border-b-2 border-gray-200">
                    <tr>

                        <th class="w-10 py-3 text-sm  text-left  text-white uppercase">
                            <span class="px-2">رقم.</span>
                        </th>

                        <th class=" w-30  px-6 py-3  text-sm  tracking-wide text-left  text-white uppercase">
                            الصوره</th>
                        <th class="w-15  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                            تم الانشاء</th>
                        <th class=" w-20 py-3   text-sm  tracking-wide text-center  text-white uppercase "
                            colspan="2">
                            العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @if (is_null($images))
                        <div class="alert alert-warning">
                            <strong>Sorry!</strong> No images Found.
                        </div>
                    @else
                    @foreach ($images as $image)
                    <tr class="bg-white">
                        <td class="w-10    text-sm  whitespace-nowrap border-b">
                            <span class="px-2"></span> {{ $image->id }} </th>
                        </td>

                        <td class="w-30    px-6 text-sm whitespace-nowrap border-b"><img src="{{ $image->path }}"
                                style="width: 100px;height:100px;" alt="no image">
                        </td>
                        <td class="w-15  text-sm  whitespace-nowrap border-b">
                            {{ $image->created_at }}</td>
                        <td class="w-10  text-sm  whitespace-nowrap border-b">
                            <x-jet-button wire:click="updateShowModel({{ $image->id }})" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                {{ __('تعديل') }}
                            </x-jet-button>
                        </td>
                        <td class="w-10 px-2  text-sm whitespace-nowrap border-b">
                            <x-jet-danger-button wire:click="deletShowModel({{ $image->id }})" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                {{ __('حذف') }}
                            </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
                    @endif


                </tbody>
            </table>
        </div>
        <div class="p-2 ">
            {{ $images->links('pagination-links') }}
        </div>
    </div>




    {{-- Model form --}}


    <x-jet-dialog-modal wire:model="modalFormVisable">
        <x-slot name="title">
            {{ __('نعديل الصوره') }}
        </x-slot>

        <x-slot name="content">
            {{-- {{ __('Are you sure you want to Crate New Image') }} --}}

            <div class="mt-4">
                <x-jet-label for="imagefile" value="{{ __('الصوره:') }}" />
                <x-jet-input id="imagefile" class="block mt-1 w-full" type="file" wire:model="imagefile"
                    enctype="multipart/form-data" required />
                {{-- @if ($image)
                        <img src="{{ $image->temporaryUr() }}" alt="no image" style="width: 150px;  height:150px ">
                    @endif --}}
                {{-- <button wire:click='upload'>Upload </button> --}}
                {{-- @error('photo') <span class="error">{{ $message }}</span> @enderror  --}}
            </div>
            @error('imagefile')
                <span class="error text-red-500">{{ $message }}</span>
            @enderror
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$toggle('modalFormVisable')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>

            @if ($modelId)
                <x-jet-secondary-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-secondary-button>
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
            {{-- {{ __('Delete  Image ') }} --}}
        </x-slot>

        <x-slot name="content" >
            {{ __('هل انت متاكد من عمليه الحذف؟ ') }}


        </x-slot>

        <x-slot name="footer">

            <x-jet-danger-button wire:click="cancel  " wire:loading.attr="disabled">
                {{ __('الغاء') }}
            </x-jet-danger-button>

            <x-jet-secondary-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __(' حذف ') }}
            </x-jet-secondary-button>




        </x-slot>
    </x-jet-dialog-modal>



</div>
