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



    <div class="px-5  bg-white-500">
        <div class="overflow-auto rounded-lg shadow  md:block">
            <table class="w-full">
                <thead class="bg-gray-700 border-b-2 border-gray-200 text-white">
                    <tr>

                        <th class="w-15 px-2 py-3 text-sm  text-left  text-white uppercase">
                            #</th>
                        <th class="w-25  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                             اسم <br> العميل</th>
                        <th class="w-25  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                            عامل التوصيل</th>
                        <th class=" w-15 py-3  text-sm  tracking-wide text-left  text-white uppercase">
                            الاجمالي</th>
                        <th class=" w-15 py-3  text-sm  tracking-wide text-left  text-white uppercase">
                            العنوان</th>
                        {{-- <th class=" w-15 py-3  text-sm  tracking-wide text-left  text-white uppercase">
                            Details</th> --}}
                        <th class="w-15  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                             تم الانشاء في</th>
                             <th class="w-15  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                                الحاله</th>
                        <th class=" w-30 py-3   text-sm  tracking-wide text-center  text-white uppercase "
                            colspan="2">
                            العمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100  italic font-semibold">
                    @if (is_null($orders))
                        <div class="alert alert-warning">
                            <strong>Sorry!</strong> No order Found.
                        </div>
                    @else
                        @foreach ($orders as $order)
                            <tr class="bg-white">
                                <td class="w-15  py-4 text-sm   whitespace-nowrap border-b">
                                    <span class="px-2"></span> {{ $order->id }} </th>
                                </td>
                                <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">
                                    @if (is_null($order->customername))
                                    @else
                                        {{ $order->customername }}
                                    @endif

                                </td>
                                <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">
                                    @if (empty($order->deliveryname))
                                    @else
                                        {{ $order->deliveryname }}
                                    @endif
                                </td>
                                <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">
                                    {{ $order->ordertotal / 100 }} ج.م
                                </td>
                                <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">

                                        {{ $order->addresscountry }} <br>
                                        {{ $order->addresscity }}<br>
                                        {{ $order->addressstreet }} <br>
                                        {{ $order->addresspostal_code }} <br>

                                </td>

                                <td class="w-15  py-4 text-sm  whitespace-nowrap border-b">
                                    {{ $order->created_at }}</td>
                                    <td class="w-15  py-4 text-sm  whitespace-nowrap border-b">
                                        @if ($order->status =='approved')

                                        <div class="bg-blue-600 text-center rounded">
                                            {{ $order->status }}
                                        </div>

                                        @elseif ($order->status =='completed')
                                        <div class="bg-green-600 text-center rounded">
                                            {{ $order->status }}
                                        </div>

                                        @elseif ($order->status =='cancelled')
                                        <div class="bg-red-600 text-center rounded">
                                            {{ $order->status }}
                                        </div>



                                        @elseif ($order->status =='cancelld')
                                        <div class="bg-red-600 text-center rounded">
                                            {{ $order->status }}
                                        </div>


                                        @elseif ($order->status =='pending')
                                        <div class="bg-yellow-100 text-center rounded">
                                            {{ $order->status }}
                                        </div>

                                        @endif

                                       </td>
                                <td class="w-10 px-2 text-sm  whitespace-nowrap border-b">
                                    <a href="{{ url('order_details') }}/{{ $order->id }}" target="_blank"
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
                                <td class="w-10 px-2 text-sm  whitespace-nowrap border-b">


                                    @if ($order->status == 'completed' || $order->status == 'cancelld')
                                    @else
                                    <x-jet-button class="txt-blue" wire:click="buttonDelivery({{ $order->id }})">
                                        {{ __('  عامل التوصيل') }}
                                    </x-jet-button>

                                        <x-jet-button wire:click="completed({{ $order->id }})">
                                            {{ __(' مكتمل') }}
                                        </x-jet-button>
                                        <x-jet-danger-button wire:click="cancelld({{ $order->id }})">
                                            {{ __(' رفض') }}
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
            {{ $orders->links() }}
        </div>
    </div>
    {{-- Model form --}}
    <x-jet-dialog-modal wire:model="modalFormVisable">
        <x-slot name="title">
            {{-- {{ __('Create Order') }} --}}
        </x-slot>

        <x-slot name="content">
            {{ __('اختر عامل التوصيل  ') }}
            <div class="mt-4">
                <div class="w-full">
                    <select name="category" id="category" wire:model="delivery_id" class="form-control required">
                        <option value="">---Chose Delivery---</option>
                        @if (empty($deliveries))
                        @else
                            @foreach ($deliveries as $delivery)
                                <option value="{{ $delivery->id }}">
                                    @if (empty($delivery->name))
                                    @else
                                        {{ $delivery->name }}
                                    @endif
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$toggle('modalFormVisable')" wire:loading.attr="disabled">
                {{ __('رجوع') }}
            </x-jet-danger-button>

            {{-- @if ($modelId) --}}
            <x-jet-secondary-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                {{ __('حفظ') }}
            </x-jet-secondary-button>

        </x-slot>

    </x-jet-dialog-modal>

    {{-- delet model form  --}}
    {{-- <x-jet-dialog-modal wire:model="modalConfirmDeletVisable">
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
    </x-jet-dialog-modal> --}}

</div>
