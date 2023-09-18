
@extends('layouts.master3')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('title')
    تفاصيل الطلب
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تفاصيل الطلب</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">Recycle  &nbsp   Bank </h1>
                            <div class="billed-from">
                                <h6> معلومات العميل </h6>

                                    @if (is_null($customerInfo))

                                    @else
                                    <li>{{$customerInfo->first_name.' '.$customerInfo->last_name}}</li>
                                    <li>{{$customerInfo->phone_number}}</li>
                                    @endif

                                    <li> العنوان</li>
                                    <p>
                                        @if (is_null($order->address))
                                        @else
                                        {{ $order->address->country }} <br>
                                        {{ $order->address->city }}<br>
                                        {{ $order->address->street }} <br>
                                        {{ $order->address->postal_code }} <br>
                                        @endif
                                    </p>
                            </div><!-- billed-from -->
                        </div><!-- order-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                {{-- <label class="tx-gray-600">Billed To</label> --}}
                                <div class="billed-to">
                                    <h6>معلومات  التوصيل  </h6>
                                    @if (is_null($deliveryInfo))
                                    @else
                                    <li>{{$deliveryInfo->first_name.' '.$deliveryInfo->last_name}}</li>
                                    <li>{{$deliveryInfo->phone_number}}</li>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md">
                               <h6> <p>معلومات الطلب</p></h6>
                                <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                    <span>{{$order->id}}</span></p>
                                <p class="invoice-info-row"><span> الحاله</span>
                                    <span>{{$order->status}}</span></p>
                                <p class="invoice-info-row"><span>ملاحظه</span>
                                    <span>{{$order->note}}</span></p>
                                    <p class="invoice-info-row"><span>تاريخ الاصدار</span>
                                        <span>{{$order->created_at}}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p" >العناصر</th>
                                        <th class="wd-20p" >الكميه</th>
                                        <th class="wd-40p">مبلغ العنصر الواحد  ( ب الجنيه  )</th>
                                        <th class="tx-center" >المبلغ الكلي للعنصر </th>
                                        {{-- <th class="tx-right">مبلغ العمولة</th>
                                        <th class="tx-right">الاجمالي</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderDetails as $orderD )
                                    <tr>
                                        <td>{{$orderD->item->name_ar }}</td>
                                        <td >{{$orderD->quantity }}</td>
                                        <td >{{$orderD->item_price / 100 }} ج.م</td>
                                        <td class="tx-center">   {{ $orderD->total_price / 100 }} ج.م</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="tx-center tx-uppercase tx-bold tx-inverse"> <strong>الاجمالي</strong> </td>
                                        <td class="tx-center" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{$order->total / 100 }}  ج.م </h4>
                                        {{-- {{ number_format($invoices->Discount, 2) }} --}}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection
