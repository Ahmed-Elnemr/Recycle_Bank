@extends('layouts.master3')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title', 'بيانات العميل ')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">بيانات العميل</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="row">
                    <div class="col-6">
                        <div class="m-2 ">
                            <h4 class="tx-primary tx-center">البيانات الشخصيه </h4>
                            @if (is_null($userInfo))
                                لايوجد له بيانات شخصيه
                            @else
                                @if (is_null($userInfo->first_name))
                                @else
                                    الاسم :{{ $userInfo->first_name . ' ' . $userInfo->last_name }}
                                    <hr>
                                @endif
                                @if (is_null($userInfo->phone_number))
                                @else
                                    رقم الهاتف : {{ $userInfo->phone_number }}
                                    <hr>
                                @endif
                                @if (is_null($userInfo->personal_id))
                                @else
                                    رقم البطاقه:{{ $userInfo->personal_id }}
                                    <hr>
                                @endif

                                @if (is_null($userInfo->gender))
                                @else
                                    النوع : {{ $userInfo->gender }}
                                    <hr>
                                @endif
                                @if (is_null($userInfo->birthdate))
                                @else
                                    تاريخ الميلاد : {{ $userInfo->birthdate }}
                                    <hr>
                                @endif
                                @if (is_null($userInfo->nationality))
                                @else
                                    الجنسيه : {{ $userInfo->nationality }}
                                    <hr>
                                @endif
                            @endif

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="m-2">
                            <h4 class="tx-primary tx-center"> العناوين </h4>
                            @if (is_null($userInfo))
                            لا يوحد له عناوين
                            @else
                                @if (is_null($userAddresses->country))
                                @else
                                    <strong> المحافظه :</strong>{{$userAddresses->country}}
                                    <hr>
                                @endif
                                @if (is_null($userAddresses->city))
                                @else
                                    <hr>
                                @endif
                                @if (is_null($userAddresses->street))
                                @else
                                    <hr>
                                @endif
                                @if (is_null($userAddresses->postal_code))
                                @else
                                    <hr>
                                @endif

                            @endif

                        </div>

                    </div>
                </div>
                <hr>
                <h4 class="tx-primary text-center"> جدول العناوين </h4>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' ;>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">المحافظه </th>
                                    <th class="border-bottom-0">المدينه</th>
                                    <th class="border-bottom-0">الشارع</th>
                                    <th class="border-bottom-0">الرمز البريدي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is_null($adressees))
                                غير مسجل له عناوين
                                @else
                                @foreach ($adressees as $adress )
                                <tr>
                                    <td>{{$adress->id}}</td>
                                    <td>{{$adress->country}}</td>
                                    <td>{{$adress->city}}</td>
                                    <td>{{$adress->street}}</td>
                                    <td>{{$adress->postal_code}}</td>
                                </tr>
                                @endforeach
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- ////////////////////// --}}
                <h4 class="tx-primary tx-center"> جدول الجمعيات </h4>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' ;>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">المحافظه </th>
                                    <th class="border-bottom-0">المدينه</th>
                                    <th class="border-bottom-0">الشارع</th>
                                </tr>
                            </thead>
                            <tbody>

                                <td>csdcdsc</td>
                                <td>dscdsc</td>
                                <td>scdscd</td>
                                <td>dscsdcdsc</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Adress Table --}}



    {{-- ِAssociation Table --}}

@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
@endsection
