@extends('templates.navbar')

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/apps/invoice-list.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/apps/invoice-list.css') }}">
    <!-- END PAGE LEVEL CUSTOM STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="../src/assets/css/light/components/list-group.css" rel="stylesheet" type="text/css">
    <link href="../src/assets/css/dark/components/list-group.css" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/flatpickr/flatpickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/flatpickr/custom-flatpickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}"> --}}
    <!--  END CUSTOM STYLE FILE  -->

@section('content')

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">

        <div class="row mx-4 mt-4 mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h5 class="mt-2">Tabungan</h5>
                <a type="button" class="btn btn-primary btn-tambah">Tambah</a>
            </div>
        </div>

        <div class="layout-px-spacing">
        
            <!-- FLASH ALERT -->
            @if (session()->has('success') || session()->has('danger'))
            <div class="col-12 mt-3">
                <div class="alert alert-icon-left alert-light-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close mt-1" data-bs-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                    <strong>{{ session('success') ?: session('danger') }}.</strong>
                </div>
            </div>
            @endif
        
            <div class="middle-content container-xxl p-0">
                <div class="row" id="cancel-row">
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing mt-2">
                        <div class="widget-content widget-content-area br-8">
                            <table id="invoice-list" class="table dt-table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Kredit</th>
                                        <th>Debit</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($savings as $index => $saving)
                                        
                                    <tr>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td>{{ $saving->date }}</td>
                                        <td>{{ $saving->name }}</td>
                                        <td>{{ number_format($saving->credit,0) }}</td>
                                        <td>{{ number_format($saving->debit,0) }}</td>
                                        <td>
                                            <a class="btn btn-outline-primary btn-icon btn-rounded" href="/admin/tabungan/view/{{ $saving->ids }}">
                                                <span class="far fa-eye"></span>
                                            </a>
                                            <button class="btn btn-outline-secondary btn-icon btn-rounded editSaving" data-id="{{ $saving->id }}" data-bs-toggle="modal" data-bs-target="#savingModal">
                                                <span class="far fa-edit"></span>
                                            </button>
                                            <form action="/admin/tabungan/{{ $saving->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger btn-icon btn-rounded" onclick="return confirm('Apakah anda yakin?')"><i class="far fa-trash-alt"></i></button>
                                            </form>
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

        <!-- Modal -->
        <div class="modal fade" id="savingModal" tabindex="-1" role="dialog" aria-labelledby="savingModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="savingModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="far fa-times-circle"></i><span class="icon-name"> times-circle</span>
                        </button>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="_method" id="methodField" value="">
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="date" class="col-sm-3 col-form-label"><p>Tanggal</p></label>
                                <div class="col-sm-9">
                                <input type="date" class="form-control" name="date" id="date" required>
                                </div>
                            </div>
                            <div class="row mb-3" id="optional">
                                <label for="ids" class="col-sm-3 col-form-label"><p>Nomor Induk</p></label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="ids" name="ids" required>
                                        <option selected disabled value="">Pilih...</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->nis . ' - ' . $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label"><p>Nama</p></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="name" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="credit" class="col-sm-3 col-form-label"><p>Simpan</p></label>
                                <div class="col-sm-9">
                                <input type="number" class="form-control" name="credit" id="credit">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="debit" class="col-sm-3 col-form-label"><p>Ambil</p></label>
                                <div class="col-sm-9">
                                <input type="number" class="form-control" name="debit" id="debit">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="note" class="col-sm-3 col-form-label"><p>Catatan</p></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="note" id="note">
                                <input type="hidden" class="form-control" name="admin" id="admin" value="{{ session('user.name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="indexModal" tabindex="-1" role="dialog" aria-labelledby="indexModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="indexModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="far fa-times-circle"></i><span class="icon-name"> times-circle</span>
                        </button>
                    </div>
                    <!-- Images -->
                    <div class="m-4 index-content">
                        <ul class="list-group list-group-media">
                            <li class="list-group-item border-0">
                                <div class="media">
                                    <div class="me-3">
                                        <img alt="avatar" src="/src/assets/img/no.png" class="img-fluid rounded-circle">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="tx-inverse">Luke Ivory</h6>
                                        <p class="mg-b-0">Project Lead</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item border-0">
                                <div class="media">
                                    <div class="me-3">
                                        <img alt="avatar" src="/src/assets/img/no.png" class="img-fluid rounded-circle">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="tx-inverse">Sonia Shaw</h6>
                                        <p class="mg-b-0">Web Designer</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item border-0">
                                <div class="media">
                                    <div class="me-3">
                                        <img alt="avatar" src="/src/assets/img/no.png" class="img-fluid rounded-circle">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="tx-inverse">Dale Butler</h6>
                                        <p class="mg-b-0">Developer</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Tutup</button>
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
    <!-- END PAGE LEVEL SCRIPTS -->     

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    {{-- <script src="{{ asset('src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('src/plugins/src/flatpickr/custom-flatpickr.js') }}"></script> --}}
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        var invoiceList = $('#invoice-list').DataTable({
            "dom": "<'inv-list-top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'l<'dt-action-buttons align-self-center'B>><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f<'toolbar align-self-center'>>>>" +
                "<'table-responsive'tr>" +
                "<'inv-list-bottom-section d-sm-flex justify-content-sm-between text-center'<'inv-list-pages-count  mb-sm-0 mb-3'i><'inv-list-pagination'p>>",
            
                buttons: [
                {
                    text: 'Index',
                    className: 'btn btn-primary btn-index'
                }
            ],
            "order": [[ 1, "asc" ]],
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });
        
        // var f1 = flatpickr(document.getElementById('date'));

        document.getElementById('ids').addEventListener('change', function() {
            var ids = this.value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('name').value = data.student.name;
                }
            };
            xhr.open('GET', '/admin/siswa/' + ids, true);
            xhr.send();
        });

        const button = document.querySelector('.btn-tambah');
        button.setAttribute('data-bs-toggle', 'modal');
        button.setAttribute('data-bs-target', '#savingModal');
        document.querySelectorAll('.editSaving').forEach(function(element) {
            element.addEventListener('click', function() {
                const id = this.dataset.id;
                document.getElementById('savingModalLabel').innerHTML = 'Edit Data <b>Tabungan</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/admin/tabungan/' + id);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/admin/tabungan/' + id);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        document.getElementById('date').value = data.saving.date;
                        document.getElementById('ids').value = data.saving.ids;
                        document.getElementById('name').value = data.saving.name;
                        document.getElementById('credit').value = data.saving.credit;
                        document.getElementById('debit').value = data.saving.debit;
                        document.getElementById('note').value = data.saving.note;
                        document.getElementById('methodField').value = 'PATCH';
                    }
                };
                xhr.send();
            });
        });

        document.querySelectorAll('.btn-tambah').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('savingModalLabel').innerHTML = 'Input Data <b>Tabungan</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/admin/tabungan');
                document.getElementById('date').value = '';
                document.getElementById('ids').value = '';
                document.getElementById('name').value = '';
                document.getElementById('credit').value = '';
                document.getElementById('debit').value = '';
                document.getElementById('note').value = '';
                document.getElementById('methodField').value = '';
            });
        });

        const btnIndex = document.querySelector('.btn-index');
        btnIndex.setAttribute('data-bs-toggle', 'modal');
        btnIndex.setAttribute('data-bs-target', '#indexModal');
        btnIndex.addEventListener('click', function () {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/admin/tabungan/rekap/all');
            xhr.onload = function () {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                document.getElementById('indexModalLabel').innerHTML = 'Rp. <b>' + data.total.toLocaleString('en-US') + '</b>';

                // Convert JSON to array
                var students = data.item;

                // Adding li to ul
                const ul = document.querySelector('.modal-content ul');

                // Clear the existing list items if needed
                ul.innerHTML = '';

                students.forEach(student => {
                    const liHTML = `
                    <li class="list-group-item border-0">
                        <div class="media">
                        <div class="me-3">
                            <img alt="avatar" src="${student.image ? '/storage/member/' + student.image : '/src/assets/img/no.png'}" class="img-fluid rounded-circle">
                        </div>
                        <div class="media-body">
                            <h6 class="tx-inverse">${student.name}</h6>
                            <p class="mg-b-0">Rp. ${(student.credit - student.debit).toLocaleString('en-US')}</p>
                        </div>
                        </div>
                    </li>
                    `;

                    ul.innerHTML += liHTML;
                });
            }
        };
        xhr.send();
        });
    </script>
    
@endsection