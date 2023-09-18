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
                {{ __('انشاء مستخدم') }}
            </x-jet-button>
        </div>
        <div class="flex items-center justify-center pb-2">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="search" wire:model="search"

                    class="block w-50 p-4 pl-10 text-sm text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder=" البحث" autocomplete="off" required>
            </div>
        </div>
    </div>
    <div class="px-5  bg-white-500 ">
        <div class="overflow-auto rounded-lg shadow  md:block">
            <table class="w-full">
                <thead class="bg-gray-700 border-b-2 border-gray-200 text-white">
                    <tr>

                        <th class="w-3 px-2 py-3 text-sm  text-left text-white uppercase">
                            #</th>


                        <th class=" w-15  py-3  text-sm  tracking-wide text-left text-white uppercase">
                            اسم المستخدم</th>
                        <th class="w-13 py-3  text-sm  tracking-wide text-left text-white uppercase">
                            الصلاحيه</th>
                        <th class=" w-12 py-3  text-sm  tracking-wide text-left text-white uppercase">
                            البريد الالكتروني</th>
                        <th class="w-15 py-3  text-sm  tracking-wide text-left text-white uppercase">
                            تم الانشاء</th>
                        <th class="w-3 px-2 py-3 text-sm  text-left text-white uppercase">
                            التفاصيل</th>
                        <th class=" w-30 py-3   text-sm  tracking-wide text-center text-white uppercase "
                            colspan="2">
                            العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-bold">
                    @if (is_null($users))
                        <div class="alert alert-warning">
                            <strong>Sorry!</strong> No Users Found.
                        </div>
                    @else

                        @forelse ($users as $user)
                        <div class="hover:text-2xl">

                        </div>
                        <tr class="bg-white ">
                            <td class="w-3 px-2  py-4 text-sm  whitespace-nowrap border-b">
                                {{ $user->id }}
                            </td>


                            <td class="w-15 px-2  py-4  text-sm  whitespace-nowrap border-b">



                                <a class="hover:text-2xl text-blue-800 font-bold" href="{{ url('user_details') }}/{{$user->id}}"
                                    class="text-blue-600 hover:text-2xl ">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td class="w-13 px-2   py-4  text-sm  whitespace-nowrap border-b">
                                @if ($user->rols->role_name =='admin')
                                <div class="bg-blue-600 text-center rounded">
                                    {{ $user->rols->role_name }}
                                </div>

                                @elseif ($user->rols->role_name =='delivery')
                                <div class="bg-green-600 text-center rounded">
                                    {{ $user->rols->role_name }}
                                </div>
                                @else
                                {{ $user->rols->role_name }}
                                @endif


                            </td>
                            <td class="w-12 px-2  py-4 text-sm  whitespace-nowrap border-b">
                                {{ $user->email }}
                            </td>
                            <td class=" w-15 px-2   py-4 text-sm whitespace-nowrap border-b">
                                {{ $user->created_at }}
                            </td>
                            <td class="w-3 px-2  py-4 text-sm  whitespace-nowrap border-b">
                                <a href="{{ url('user_details') }}/{{ $user->id }}"
                                    class="text-gray-600 hover:text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                            <td class=" w-10  text-sm whitespace-nowrap border-b">
                                <x-jet-button wire:click="updateShowModel({{ $user->id }})" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    {{ __('تعديل') }}
                                </x-jet-button>
                            </td>
                            <td class=" w-10 p-2  text-sm whitespace-nowrap border-b">
                                <x-jet-danger-button wire:click="deletShowModel({{ $user->id }})" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    {{ __('حذف') }}
                                    </x-jet-button>
                            </td>


                        </tr>

                        @empty

                        @endforelse

                    @endif


                </tbody>
            </table>
        </div>
        <div class="mt-2 ">
            {{ $users->links('pagination-links') }}
        </div>
    </div>
    {{-- Model form --}}
    <x-jet-dialog-modal wire:model="modalFormVisable">
        <x-slot name="title">
            {{ __('انشاء مستخدم') }}
        </x-slot>
        <x-slot name="content">


            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('الاسم:') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name" required />
                <div class="bg-red-700 ">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('البريد الالكتروني:') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" wire:model="email" required />
                <div class="bg-red-700 ">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-4 pass">
                <x-jet-label for="password" value="{{ __('كلمه السر:') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" wire:model="password" required />
                <div class="bg-red-700 ">
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-4 w-full">
                <x-jet-label for="role" value="{{ __('صلاحيه المستخدم:') }}" />
                <div class="w-full">
                    <select name="role" id="role" wire:model="role" class="form-control required">
                        <option value="">---اختر الصلاحيه---</option>
                        @if (is_null($rols))
                            <div class="alert alert-warning">
                                <strong>Sorry!</strong> No rols Found.
                            </div>
                        @else
                            @foreach ($rols as $role)
                                <option value="{{ $role->id }}"> {{ $role->role_name }}
                                </option>
                            @endforeach
                        @endif


                    </select>
                </div>
                <div class="bg-red-700 ">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
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
                    {{ __('تعديل المستخدم') }}
                </x-slot>
                {{-- password input --}}

                <x-jet-label style="display: none;" for="password" value="{{ __('Password:') }}" />
                <x-jet-input style="display: none;" id="password" class="block mt-1 w-full " type="password"
                    wire:model="password" required />
            @else
                <x-jet-secondary-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                    {{ __('حفظ') }}
                </x-jet-secondary-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    {{-- delet model form  --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeletVisable">
        <x-slot name="title">
            {{ __('Delete  User ') }}
        </x-slot>

        <x-slot name="content">
            {{ __('هل انت متأكد من عمليه الحذف? ') }}
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="$toggle('modalConfirmDeletVisable  ')" wire:loading.attr="disabled">
                {{ __('الغاء') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('حذف') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>


</div>
</div>
