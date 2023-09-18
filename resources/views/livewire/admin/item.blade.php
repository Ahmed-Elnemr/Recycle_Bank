<div class="bg-gray-100">



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
    <div class="gride gride-cols-2">
        <div class="flex items-center justify-center pt-2">
            <x-jet-button wire:click="createShowModal"  class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                {{ __('  انشاء عنصر') }}
            </x-jet-button>
        </div>
        <div class="flex items-center justify-center pb-2">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="search" wire:model="search"

                    class="block w-50 p-4 pl-10 text-sm text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="  البحث بالعربيه " autocomplete="off"  required>
            </div>
        </div>
    </div>

    {{-- table data --}}
    <div class="px-5  bg-white-500 ">
        <div class="overflow-auto rounded-lg shadow  md:block">
            <table class="w-full">
                <thead class="bg-gray-700 border-b-2 border-gray-200 text-white">
                    <tr>

                        <th class="w-3 px-2 py-3 text-sm  text-left  text-white  uppercase">
                            رقم</th>
                        <th class="w-15 px-5 py-3  text-sm  tracking-wide text-left  text-white  uppercase">
                            صوره</th>
                        <th class="w-15 py-3  text-sm  tracking-wide text-left  text-white  uppercase">
                            الاسم بالانجليزيه</th>
                        <th class=" w-15  py-3  text-sm  tracking-wide text-left  text-white  uppercase">
                            الاسم بالعربيه</th>
                        {{-- <th class=" w-15 py-3   text-sm  tracking-wide text-left  text-white  uppercase">
                            Piece</th>
                        <th class=" w-15 py-3   text-sm  tracking-wide text-left  text-white  uppercase">
                            Weight</th> --}}

                        <th class=" w-15 py-3   text-sm  tracking-wide text-left  text-white  uppercase">
                            القيمه بالقروش</th>
                        <th class=" w-15 py-3   text-sm  tracking-wide text-left  text-white  uppercase">
                            الوحده</th>
                        <th class=" w-15 py-3   text-sm  tracking-wide text-left  text-white  uppercase">
                             الوزن - العدد</th>

                        <th class="w-15  py-3  text-sm  tracking-wide text-left  text-white  uppercase">
                            اسم التصنيف</th>
                        <th class="w-15  py-3  text-sm  tracking-wide text-left  text-white  uppercase">
                            تاريخ الانشاء</th>
                        <th class=" w-10 py-3   text-sm  tracking-wide text-center  text-white  uppercase "
                            colspan="2">
                            العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-sans	italic font-semibold">
                    @if (is_null($items))
                        <div class="alert alert-warning">
                            <strong>Sorry!</strong> No items Found.
                        </div>
                    @else
                        @foreach ($items as $item)
                            <tr class="bg-white">
                                <td class="w-3  text-sm   whitespace-nowrap border-b">
                                    <span class="px-2"></span> {{ $item->id }} </th>
                                </td>
                                <td class="w-15   py-2 text-sm   whitespace-nowrap border-b"><img
                                        @if (empty($item->media->path)) src=""
                            @else
                            src="{{ $item->media->path }}" @endif
                                        style="width: 100px;height:100px;" alt="">
                                </td>
                                <td class="w-15    text-sm   whitespace-nowrap border-b">
                                    @if (is_null($item->name_en))
                                    @else
                                        {{ $item->name_en }}
                                    @endif

                                </td>
                                <td class="w-15   text-sm  whitespace-nowrap border-b">
                                    @if (is_null($item->name_ar))
                                    @else
                                        {{ $item->name_ar }}
                                    @endif
                                </td>
                                {{-- <td class="w-15 text-sm  whitespace-nowrap border-b">
                            {{ $item->piece }}</td>
                        <td class="w-15 text-sm  whitespace-nowrap border-b">
                            {{ $item->weight }}</td> --}}
                                <td class="w-15 text-sm  whitespace-nowrap border-b">
                                    @if (is_null($item->value))
                                    @else
                                        {{ $item->value }}
                                    @endif
                                </td>
                                <td class="w-15 text-sm  whitespace-nowrap border-b">
                                    @if (is_null($item->piece))
                                    @else
                                        {{ $item->piece }}
                                    @endif
                                </td>
                                <td class="w-15 text-sm  whitespace-nowrap border-b">
                                    @if (is_null($item->weight))
                                    @else
                                        {{ $item->weight }}
                                    @endif
                                </td>


                                <td class="w-15  text-sm  whitespace-nowrap border-b">

                                    @if ($item->category != null)
                                        @if (is_null($item->category->name_en))
                                        @else
                                            {{ $item->category->name_en }}
                                        @endif
                                        <br>

                                        @if (is_null($item->category->name_ar))
                                        @else
                                            {{ $item->category->name_ar }}
                                        @endif
                                    @endif


                                </td>
                                <td class="w-15   text-sm  whitespace-nowrap border-b">
                                    {{ $item->created_at }}</td>

                                <td class="w-5    text-sm  whitespace-nowrap border-b">
                                    <x-jet-button wire:click="updateShowModel({{ $item->id }}  )" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                        >
                                        {{ __('تعديل') }}
                                    </x-jet-button>
                                </td>
                                <td class="w-5 px-2  text-sm  whitespace-nowrap border-b">
                                    <x-jet-danger-button wire:click="deletShowModel({{ $item->id }})" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        {{ __('حذف') }}
                                        </x-jet-button>
                                </td>
                            </tr>
                        @endforeach
                    @endif


                </tbody>
            </table>
        </div>
        <div class="p-2 ">
            {{ $items->links('pagination-links') }}
        </div>
    </div>
    {{-- Model form --}}
    <x-jet-dialog-modal wire:model="modalFormVisable">
        <x-slot name="title">
            {{ __('انشاء عنصر') }}
        </x-slot>

        <x-slot name="content">
            {{-- {{ __('Are you sure you want to create Item ?') }} --}}

            <div class="mt-4">
                <x-jet-label for="name_en" value="{{ __(' الاسم بالانجليزيه:') }}" />
                <x-jet-input id="name_en" class="block mt-1 w-full" type="text" wire:model="name_en" required />
                <div class="bg-red-700 ">
                    @error('name_en')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="name_ar" value="{{ __(' الاسم بالعربيه:') }}" />
                <x-jet-input id="name_ar" class="block mt-1 w-full" type="text" wire:model="name_ar" required />
                <div class="bg-red-700 ">
                    @error('name_ar')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="value" value="{{ __('القيمه:') }}" />
                <x-jet-input id="value" class="block mt-1 w-full" type="number" wire:model="value" required />
                <div class="bg-red-700 ">
                    @error('value')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="piece" value="{{ __('الوحده:') }}" />
                <x-jet-input id="piece" class="block mt-1 w-full" type="text" wire:model="piece" required />
                <div class="bg-red-700 ">
                    @error('piece')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="weight" value="{{ __('العدد:') }}" />
                <x-jet-input id="weight" class="block mt-1 w-full" type="text" wire:model="weight" required />
                <div class="bg-red-700 ">
                    @error('weight')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- @if (count($categories) > 0) --}}
            <div class="mt-4">
                <x-jet-label for="category" value="{{ __('اضافه العنصر للتصنيف:') }}" />
                <div>
                    <select class="w-full" name="category" id="category" wire:model="category_id"
                        class="form-control required">
                        <option value="">--- أختر التصنيف---</option>
                        @if (is_null($categories))
                        @else
                            @foreach ($categories as $category)
                                @if (is_null($category->name_en or $category->name_ar))
                                @else
                                    <option value="{{ $category->id }}"> {{ $category->name_en }}
                                        {{ $category->name_ar }}
                                    </option>
                                @endif
                            @endforeach
                        @endif

                    </select>
                </div>


                <div class="bg-red-700 ">
                    @error('category_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="mt-4">


                <x-jet-label for="image" value="{{ __('اختر الصوره:') }}" />
                <x-jet-input id="image" class="block mt-1 w-full" type="file" wire:model="imagefile" />
                <div class=" ">
                    @error('imagefile')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- @endif --}}
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$toggle('modalFormVisable')" wire:loading.attr="disabled">
                {{ __('الغاء') }}
            </x-jet-danger-button>

            @if ($modelId)
                <x-jet-secondary-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                    {{ __('تعديل') }}
                </x-jet-secondary-button>
                <x-slot name="title">
                    {{ __('نعديل العنصر ') }}
                </x-slot>
            @else
                <x-jet-secondary-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                    {{ __('حغظ') }}
                </x-jet-secondary-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    {{-- delet model form  --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeletVisable">
        <x-slot name="title">
            {{ __(' حذف العنصر') }}
        </x-slot>

        <x-slot name="content">
            {{-- {{ __('Are you sure you want to delete this Item? ') }} --}}


        </x-slot>

        <x-slot name="footer">

            <x-jet-danger-button wire:click="cancel" wire:loading.attr="disabled">
                {{ __('العاء') }}
                </x-jet-secondary-button>

                <x-jet-secondary-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                    {{ ('حذف العنصر') }}
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
