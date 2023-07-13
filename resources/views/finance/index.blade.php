@extends('templates.navbar')

<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/apps/invoice-list.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/apps/invoice-list.css') }}">
<!-- END PAGE LEVEL CUSTOM STYLES -->

@section('content')

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">
                <div class="row" id="cancel-row">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing">
                        <div class="widget-content widget-content-area br-8">
                            <table id="invoice-list" class="table dt-table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Faktur</th>
                                        <th>Tanggal</th>
                                        <th>Akun</th>
                                        <th>Item</th>
                                        <th>Jumlah</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($finances as $index => $finance)
                                        
                                    <tr>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td>{{ $finance->invoice }}</td>
                                        <td>{{ $finance->date }}</td>
                                        <td>{{ $finance->remark }}</td>
                                        <td>{{ $finance->items }}</td>
                                        <td>{{ number_format($finance->total) }}</td>
                                        <td>
                                            <a class="badge badge-primary text-start me-2 action-view" href="/admin/keuangan/view/{{ $finance->invoice }}">
                                                <span class="far fa-eye"></span>
                                            </a>
                                            
                                            @php
                                                $date = date("Y-m-d", strtotime($finance->date . '+1 week'));
                                            @endphp
                                            <a class="badge badge-secondary text-start me-2 action-edit" href="{{ ($date < date('Y-m-d')) ? '#' : '/admin/keuangan/inv/' . $finance->invoice }}" @if ($date < date('Y-m-d')) onclick="alert('Tanggal Expired.. Invoice tidak bisa diedit..')" @endif>
                                                <span class="far fa-edit"></span>
                                            </a>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  BEGIN FOOTER  -->
        <div class="footer-wrapper mt-0">
            <div class="footer-section f-section-1">
                <p class="">Copyright © <span class="dynamic-year">2022</span> <a target="_blank" href="https://designreset.com/cork-admin/">DesignReset</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
            </div>
        </div>
        <!--  END FOOTER  -->
    </div>
    <!--  END CONTENT AREA  -->

    <script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('src/assets/js/custom.js') }}"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/assets/js/apps/invoice-list.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->     
    
@endsection