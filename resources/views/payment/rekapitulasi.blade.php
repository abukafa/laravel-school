@extends('templates.navbar')

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css') }}">
    <!-- END PAGE LEVEL CUSTOM STYLES -->

@section('content')

    <div id="content" class="main-content">

        <div class="row mx-4 mt-4 mb-2">
            <div class="col-12 d-flex justify-content-between">
                <h5 class="mt-2">Rekapitulasi Pembayaran</h5>
                <div class="m-0">
                    <form action="" method="GET">
                        <select class="form-select form-select-sm" name="year" onchange="this.form.submit()">
                            <option selected>Periode ...</option>
                            @for ($year = date('Y'); $year >= date('Y') - 5; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </form>
                </div>
                
            </div>
        </div>

        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">
                <div class="row layout-spacing mt-4">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <table id="html5-extension" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th class="{{ $period ? '' : 'd-none' }}">Periode</th>
                                            <th>Kategori</th>
                                            <th>Total</th>
                                            <th class="{{ $period ? '' : 'd-none' }}">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($items)
                                        @foreach ($items as $index => $item)
                                            <tr>
                                                <td>{{ $loop->index +1 }}</td>
                                                <td>{{ $item->nis }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td class="{{ $period ? '' : 'd-none' }}">{{ $period }}</td>
                                                <td>{{ $item->category }}</td>
                                                <td>{{ number_format($item->payment) }}</td>
                                                <td class="{{ $period ? '' : 'd-none' }}">
                                                    <a class="badge badge-primary text-start me-2 action-view" href="/admin/pembayaran/rekap/{{ $item->ids }}/{{ $period }}">
                                                        <span class="far fa-eye"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('src/assets/js/custom.js') }}"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/jszip.min.js') }}"></script>    
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/custom_miscellaneous.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->     
    
@endsection