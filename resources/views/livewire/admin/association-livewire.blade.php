<div>
    <div class="flex items-center justify-center pb-2">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search" wire:model="search"

                class="block w-50 p-4 pl-10 text-sm text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="  بحث  " autocomplete="off" required>
        </div>
    </div>
    <div class="px-5  bg-white-500  ">
        <div class="overflow-auto rounded-lg shadow  md:block">
            <table class="w-full">
                <thead class="bg-gray-700 border-b-2 border-gray-100 text-white">
                    <tr>

                        <th class="w-7  py-3 text-sm  text-left text-white uppercase">
                            <span class="px-2">اسم المستخدم</span>
                        </th>
                        <th class=" w-27 py-3  px-4 text-sm  tracking-wide text-left  text-white uppercase">
                            قيمه القسط</th>
                        <th class=" w-15  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                            تاريخ الموافقه</th>
                        <th class="w-15 py-3  text-sm  tracking-wide text-left  text-white uppercase">
                            الحاله </th>
                        <th class="w-15  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                            ترتيب المستخدم</th>
                        <th class=" w-10 py-3   text-sm  tracking-wide text-center  text-white uppercase ">
                            تاريخ انتهاء الجمعيه</th>
                        <th class=" w-10 py-3   text-sm  tracking-wide text-center  text-white uppercase ">
                            تاريخ الاستحقاق</th>
                            <th class=" w-10 py-3   text-sm  tracking-wide text-center  text-white uppercase ">
                                  متوقفه
                            </th>
                        <th class=" w-10 py-3   text-sm  tracking-wide text-center  text-white uppercase ">
                            آخر عمليه دفع
                        </th>
                        <th class=" w-20 py-3   text-sm  tracking-wide text-center  text-white uppercase "
                            colspan="2">
                            العمليات
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @if (is_null($associations))
                    @else
                        @foreach ($associations as $association)
                            <tr>
                                <td>

                                    <a href="{{ url('user_details') }}/{{$association->user_id}}" target="_blank"
                                        class="text-gray-600 hover:text-gray-900">
                                        {{ $association->user_id}} {{ $association->name}}
                                    </a>
                                    </td>



                                <td>{{ $association->value }}</td>
                                <td>{{ $association->approved_on }}</td>
                                <td>{{ $association->state }}</td>
                                <td>{{ $association->user_order }}</td>
                                <td>{{ $association->finished_date }}</td>
                                <td>{{ $association->due_date }}</td>
                                <td>{{ $association->suspended }}</td>
                                <td>{{ $association->last_installment_date }}</td>
                                <td class="w-10  text-sm whitespace-nowrap border-b">


                                    @if ($association->state == "pending" )

                                    <x-jet-button wire:click="approve({{ $association->id }})" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" >
                                        {{ __('موافقه') }}
                                    </x-jet-button>

                                    @else

                                    <x-jet-button wire:click="makepayment({{ $association->id }})" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        {{ __('تسويه') }}
                                    </x-jet-button>

                                    @endif



                                </td>
                                <td class="w-10 px-2  text-sm whitespace-nowrap border-b">

                                </td>
                            </tr>
                        @endforeach

                    @endif


                </tbody>
            </table>
        </div>
        <div class="p-2 ">
            {{ $associations->links('pagination-links') }}
        </div>
    </div>
</div>
