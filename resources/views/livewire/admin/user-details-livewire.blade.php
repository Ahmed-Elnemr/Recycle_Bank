<div>
    <div class="m-5 grid grid-cols-2 gap-2">
        <div class="m-2 ">
            <h4 class="text-center text-xl hover:text-2xl text-blue-600 bg-slate-200">البيانات الشخصيه </h4>
            @if (is_null($userInfo))
                لايوجد له بيانات شخصيه
            @else
                @if (is_null($userInfo->first_name))
                @else
                    <strong> الاسم :{{ $userInfo->first_name . ' ' . $userInfo->last_name }}
                        <hr>
                @endif
                @if (is_null($userInfo->phone_number))
                @else
                    <strong> رقم الهاتف </strong> : {{ $userInfo->phone_number }}
                    <hr>
                @endif
                @if (is_null($userInfo->personal_id))
                @else
                    <strong>رقم البطاقه</strong>: {{ $userInfo->personal_id }}
                    <hr>
                @endif

                @if (is_null($userInfo->gender))
                @else
                    <strong>النوع</strong> : {{ $userInfo->gender }}
                    <hr>
                @endif
                @if (is_null($userInfo->birthdate))
                @else
                    <strong>تاريخ الميلاد </strong> : {{ $userInfo->birthdate }}
                    <hr>
                @endif
                @if (is_null($userInfo->nationality))
                @else
                    <strong>الجنسيه</strong> : {{ $userInfo->nationality }}
                    <hr>
                @endif
            @endif

        </div>


        <div class="m-2">
            <h4 class="text-center text-xl hover:text-2xl text-blue-600 bg-slate-200"> رصيد المحغظه  </h4>
            <div class="text-center m-6 text-3xl">
                @if (is_null($balance_wallet->balance))


                @else
                {{  $balance_wallet->balance}} ج.م
                @endif
            </div>

        </div>
    </div>
</div>


<h4 class="text-center text-xl hover:text-2xl text-blue-600 bg-slate-200">  العناوين</h4>

<div class="px-5  bg-white-500 ">
    <div class="overflow-auto rounded-lg shadow  md:block">
        <table class="w-full">
            <thead class="bg-gray-700 border-b-2 border-gray-200 text-white">
                <tr>

                    <th class="w-5 px-2 py-3 text-sm  text-left   text-white uppercase">
                        #</th>
                    <th class="w-40 py-3  text-sm  tracking-wide text-left   text-white uppercase">
                        المحافظه</th>
                    <th class=" w-15  py-3  text-sm  tracking-wide text-left   text-white uppercase">
                        المدينه </th>
                    <th class=" w-25 py-3  text-sm  tracking-wide text-left   text-white uppercase">
                        الشارع </th>
                    <th class="w-20  py-3  text-sm  tracking-wide text-center   text-white uppercase">
                        الرمز البريدي</th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @if (is_null($adressees))
                    غير مسجل له عناوين
                @else
                    @foreach ($adressees as $adress)
                        <tr class="bg-white ">
                            <td class="w-5  px-2   text-sm  whitespace-nowrap border-b">
                                @if (is_null($adress->id))
                                @else
                                    {{ $adress->id }}
                                @endif

                            </td>
                            <td class="w-40   py-4  text-sm  whitespace-nowrap border-b">
                                @if (is_null($adress->country))
                                @else
                                    {{ $adress->country }}
                                @endif

                            </td>
                            <td class="w-15  py-4 text-sm whitespace-nowrap border-b">
                                @if (is_null($adress->city))
                                @else
                                    {{ $adress->city }}
                                @endif

                            </td>
                            <td class="w-25  py-4 text-sm whitespace-nowrap border-b">
                                @if (is_null($adress->street))
                                @else
                                    {{ $adress->street }}
                                @endif
                            </td>
                            <td class="w-25  py-4 text-sm whitespace-nowrap border-b">
                                @if (is_null($adress->postal_code))
                                @else
                                    {{ $adress->postal_code }}
                                @endif
                            </td>

                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="p-2 ">
        {{ $adressees->links() }}
    </div>
</div>



<hr>
<h4 class="text-center text-xl hover:text-2xl text-blue-600 bg-slate-200">  الجمعيات</h4>
<div class="p-5  bg-white-500 ">
    <div class="overflow-auto rounded-lg shadow  md:block">
        <table class="w-full">
            <thead class="bg-gray-700 border-b-2 border-gray-200 text-white">
                <tr>
                    <th class="w-7  py-3 text-sm  text-left text-white uppercase">
                        <span class="px-2"># </span>
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

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @if (is_null($associations))
                @else
                    @foreach ($associations as $association)
                        <tr>
                            <td>
                                {{ $association->id }}
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

                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="p-2 ">
        {{ $associations->links() }}
    </div>
</div>

<hr>
<h4 class="text-center text-xl hover:text-2xl text-blue-600 bg-slate-200">  الطلبات </h4>
<div class="p-5  bg-white-500 ">
    <div class="overflow-auto rounded-lg shadow  md:block">
        <table class="w-full">
            <thead class="bg-gray-700 border-b-2 border-gray-200 text-white">
                <tr>

                    <th class="w-15 px-2 py-3 text-sm  text-left  text-white uppercase">
                        #</th>
                    <th class="w-25  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                        Customer</th>
                    <th class="w-25  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                        delivery</th>
                    <th class=" w-15 py-3  text-sm  tracking-wide text-left  text-white uppercase">
                        Total</th>
                    <th class=" w-15 py-3  text-sm  tracking-wide text-left  text-white uppercase">
                        address</th>
                    <th class="w-25  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                        Created at</th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @if (is_null($orders))
                @else
                    @foreach ($orders as $order)
                        <tr class="bg-white">
                            <td class="w-15  py-4 text-sm   whitespace-nowrap border-b">
                                <span class="px-2"></span> {{ $order->id }} </th>
                            </td>
                            <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">
                                @if (empty($order->customer->name))
                                @else
                                    {{ $order->customer->name }}
                                @endif

                            </td>
                            <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">
                                @if (is_null($order->delivery))
                                @else
                                    {{ $order->delivery->name }}
                                @endif
                            </td>
                            <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">
                                {{ $order->total / 100 }} ج.م
                            </td>
                            <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">
                                @if (is_null($order->address))
                                @else
                                    @if (is_null($order->address->country))
                                    @else
                                        {{ $order->address->country }} <br>
                                    @endif
                                    @if (is_null($order->address->city))
                                    @else
                                        {{ $order->address->city }}<br>
                                    @endif
                                    @if (is_null($order->address->street))
                                    @else
                                        {{ $order->address->street }} <br>
                                    @endif

                                    @if (is_null($order->address->postal_code))
                                    @else
                                        {{ $order->address->postal_code }} <br>
                                    @endif
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

<hr>
<h4 class="text-center text-xl hover:text-2xl text-blue-600 bg-slate-200">  حركات المحفظه </h4>
<div class="p-5  bg-white-500 ">
    <div class="overflow-auto rounded-lg shadow  md:block">
        <table class="w-full">
            <thead class="bg-gray-700 border-b-2 border-gray-200 text-white">
                <tr>

                    <th class="w-15 px-2 py-3 text-sm  text-left  text-white uppercase">
                        #</th>
                    <th class="w-25  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                        تاريخ الانشاء</th>
                    <th class="w-25  py-3  text-sm  tracking-wide text-left  text-white uppercase">
                        القيمه</th>
                    <th class=" w-15 py-3  text-sm  tracking-wide text-left  text-white uppercase">
                        حركه العمليه</th>


                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @if (is_null($w_transactions))
                @else
                    @foreach ($w_transactions as $w_t)
                        <tr class="bg-white">
                            <td class="w-15  py-4 text-sm   whitespace-nowrap border-b">
                                <span class="px-2"></span> {{ $w_t->id }} </th>
                            </td>
                            <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">
                                @if (is_null($w_t->created_at))
                                @else
                                    {{ $w_t->created_at }}
                                @endif

                            </td>
                            <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">
                                @if (is_null($w_t->amount))
                                @else
                                    {{ $w_t->amount }}
                                @endif
                            </td>
                            <td class="w-15   py-4  text-sm   whitespace-nowrap border-b">
                                @if (is_null($w_t->is_credit))
                                @else
                                    @if ($w_t->is_credit == 'true')
                                        سحب
                                    @else
                                        ايداع
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="p-2 ">
        {{ $w_transactions->links() }}
    </div>
</div>





</div>
