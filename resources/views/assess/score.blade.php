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
                <h5 class="mt-2">Data Penilaian</h5>
                <div class="d-flex align-items-center">
                    <form action="" method="GET" class="d-flex m-1">
                        <select class="form-select form-select-sm m-1" name="year">
                            <option selected>Angkatan ...</option>
                            @for ($year = date('Y'); $year >= date('Y') - 5; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                        <select class="form-select form-select-sm m-1" name="semester" onchange="this.form.submit()">
                            <option selected>Semester ...</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                        </select>
                    </form>
                    <a href="/data/nilai/create" type="button" class="btn btn-sm btn-primary">Tambah</a>
                </div>
            </div>
        </div>

        <div class="layout-px-spacing">

            <!-- FLASH ALERT -->
            @if (session()->has('success') || session()->has('danger'))
            <div class="alert alert-icon-left alert-light-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show mb-4" role="alert">
                <button type="button" class="btn-close mt-1" data-bs-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                <strong>{{ session('success') ?: session('danger') }}.</strong>
            </div>
            @endif

            <div class="middle-content container-xxl p-0">
                <div class="row layout-spacing mt-4">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <table id="html5-extension" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Angkatan</th>
                                            <th>Semester</th>
                                            <th>Pelajaran</th>
                                            <th>Data</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rekap as $index => $item)
                                            <tr>
                                                <td>{{ $loop->index +1 }}</td>
                                                <td>{{ $item->registered }}</td>
                                                <td>{{ $item->semester }}</td>
                                                <td>{{ $item->subject }}</td>
                                                <td class="text-end">{{ $item->count }}</td>
                                                <td>
                                                    <a class="badge badge-primary text-start me-1 action-view" href="/data/nilai/{{ $item->serial }}/edit">
                                                        <span class="far fa-eye"></span>
                                                    </a>
                                                    <a class="badge badge-danger text-start me-1 action-view {{ auth()->user()->role < 5 ? 'd-none' : '' }}" href="/data/delete/nilai/{{ $item->serial }}" onclick="return confirm('Apakah anda yakin?')">
                                                        <span class="far fa-trash-alt"></span>
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