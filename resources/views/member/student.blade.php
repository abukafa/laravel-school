@extends('templates.navbar')

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="../src/plugins/src/table/datatable/datatables.css">

    <link rel="stylesheet" type="text/css" href="../src/plugins/css/light/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/css/light/table/datatable/custom_dt_custom.css">

    <link rel="stylesheet" type="text/css" href="../src/plugins/css/dark/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/css/dark/table/datatable/custom_dt_custom.css">
    <!-- END PAGE LEVEL CUSTOM STYLES -->

@section('content')

    <div id="content" class="main-content">

        <div class="row mx-4 mt-4 mb-2">
            <div class="col-12 d-flex justify-content-between">
                <h5 class="mt-2">Data Santri</h5>
                <a href="/admin/siswa/create" type="button" class="btn btn-primary">Tambah</a>
            </div>
        </div>

        <div class="layout-px-spacing">
        
            <!-- FLASH ALERT -->
            @if (session()->has('success') || session()->has('danger'))
            <div class="col-12 mt-4">
                <div class="alert alert-icon-left alert-light-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show mb-4" role="alert">
                    <button type="button" class="btn-close mt-1" data-bs-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                    <strong>{{ session('success') ?: session('danger') }}.</strong>
                </div>
            </div>
            @endif

            <div class="middle-content container-xxl p-0">
                <div class="row layout-spacing mt-4">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <table id="style-1" class="table style-1 dt-table-hover non-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Pic</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th class="text-center dt-no-sorting">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($students as $index => $student)
                                            
                                        <tr>
                                            <td>{{ $loop->index +1 }}</td>
                                            <td>{{ $student->nis }}</td>
                                            <td class="">
                                                <a class="profile-img" href="javascript: void(0);">
                                                    <img src="{{ $student->image ? asset('storage/member/' . $student->image) : '/src/assets/img/no.png' }}" alt="{{ $student->image }}">
                                                </a>
                                            </td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->rumble }}</td>
                                            <td class="text-center">
                                                <div class="action-btns">
                                                    <a href="/admin/siswa/{{ $student->id }}/edit" class="btn btn-outline-secondary btn-icon btn-rounded">
                                                        <span class="far fa-edit"></span>
                                                    </a>
                                                    <form action="/admin/siswa/{{ $student->id }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger btn-icon btn-rounded" onclick="return confirm('Apakah anda yakin?')" {{ session('user.role') < 3 ? 'disabled' : '' }}><i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
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

    <script src="../src/plugins/src/global/vendors.min.js"></script>
    <script src="../src/assets/js/custom.js"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../src/plugins/src/table/datatable/datatables.js"></script>
    <script>
        c1 = $('#style-1').DataTable({
            // headerCallback:function(e, a, t, n, s) {
            //     e.getElementsByTagName("th")[0].innerHTML=`
            //     <div class="form-check form-check-primary d-none">
            //         <input class="form-check-input chk-parent" type="checkbox" id="form-check-default">
            //     </div>`
            // },
            // columnDefs:[ {
            //     targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
            //         return `
            //         <div class="form-check form-check-primary d-none">
            //             <input class="form-check-input child-chk" type="checkbox" id="form-check-default">
            //         </div>`
            //     }
            // }],
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 10
        });

        multiCheck(c1);
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->  
    
@endsection