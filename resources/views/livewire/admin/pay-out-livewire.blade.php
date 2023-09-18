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

    <div class="px-5  bg-white-500 ">
        <div class="overflow-auto rounded-lg shadow  md:block">
            <table class="w-full">
                <thead class="bg-gray-700 border-b-2 border-gray-200 text-white">
                    <tr>
                        <th class="w-5 px-2 py-3 text-sm  text-left   text-white uppercase">
                            رقم.</th>
                        <th class="w-5 px-2 py-3 text-sm  text-left   text-white uppercase">
                            اسم المستخدم </th>
                        <th class="w-40 py-3  text-sm  tracking-wide text-left   text-white uppercase">
                            القيمه</th>
                        <th class=" w-15  py-3  text-sm  tracking-wide text-left   text-white uppercase">
                            الحاله </th>
                        <th class="w-20  py-3  text-sm  tracking-wide text-center   text-white uppercase">
                            الرقم المحول عليه</th>

                        <th class="w-20  py-3  text-sm  tracking-wide text-center   text-white uppercase">
                            تنفيذ</th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 italic font-semibold ">
                    @if (is_null($payOuts))
                        <div class="alert alert-warning">
                            <strong>Sorry!</strong> No pay Out Found.
                        </div>
                    @else
                        @foreach ($payOuts as $payOut)
                            <tr class="bg-white">
                                <td class="w-5  px-2   text-sm  whitespace-nowrap border-b">
                                    @if (is_null($payOut->id))

                                    @else
                                    {{ $payOut->id }}
                                    @endif
                                </td>
                                <td class="w-5  px-2   text-sm  whitespace-nowrap border-b">
                                    @if (is_null($payOut->name ))

                                    @else
                                    <a class="hover:text-2xl text-blue-800 font-bold" href="{{ url('user_details') }}/{{$payOut->id}}"
                                        class="text-blue-600 hover:text-2xl ">
                                        {{ $payOut->name }}
                                    </a>
                                    @endif

                                </td>
                                <td class="w-40   py-4  text-sm  whitespace-nowrap border-b">
                                    @if (is_null($payOut->amount))

                                    @else
                                    {{ $payOut->amount }}
                                    @endif

                                </td>
                                <td class="w-15  py-4 text-sm whitespace-nowrap border-b">
                                    @if (is_null($payOut->reason))

                                    @else
                                    {{ $payOut->reason }}
                                    @endif

                                </td>
                                <td class="w-15  py-4 text-sm whitespace-nowrap border-b">

                                    {{ $payOut->value }}

                                    </td>

                                <td class="w-10  py-4 text-sm whitespace-nowrap border-b">


                                    @if ($payOut->reason == "pending")
                                    <x-jet-button wire:click="pull({{ $payOut->id }})">
                                        تنفيذ الطلب
                                    </x-jet-button>
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    @endif


                </tbody>
            </table>
        </div>
        <div class="p-2 ">
            {{ $payOuts->links('pagination-links') }}
        </div>
    </div>




</div>
