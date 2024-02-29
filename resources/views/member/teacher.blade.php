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
                <h5>Data Guru</h5>
                <a href="/admin/guru/create" type="button" class="btn btn-sm btn-primary {{ auth()->user()->role < 2 ? 'd-none' : '' }}">Tambah</a>
            </div>
        </div>

        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">
                <div class="row layout-spacing mt-4">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <table id="style-2" class="table style-2 dt-table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIG</th>
                                            <th>Nama</th>
                                            <th>Telephone</th>
                                            <th class="text-center">Pic</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center dt-no-sorting">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $index => $item)    
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->nig }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td class="text-center">
                                                <span><img src="{{ $item->image ? asset('storage/guru/' . $item->image) : '/src/assets/img/no.png' }}" class="rounded-circle profile-img" alt="avatar"></span>
                                            </td>
                                            <td class="text-center"><span class="shadow-none badge badge-{{ $item->active == 1 ? 'primary' : 'danger' }}">{{ $item->active == 1 ? 'Active' : 'Suspend' }}</span></td>
                                            <td class="text-center">
                                                <div class="action-btn">
                                                    <a href="/admin/guru/{{ $item->id }}/edit" class="btn btn-outline-secondary btn-icon btn-rounded">
                                                        <span class="far fa-edit"></span>
                                                    </a>
                                                    <form action="/admin/guru/{{ $item->id }}" method="POST" class="d-inline">
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
        c2 = $('#style-2').DataTable({
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

        multiCheck(c2);
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->  
    
@endsection