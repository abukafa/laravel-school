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
                <h5 class="mt-2">Data Proyek</h5>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-primary inputProject" data-bs-toggle="modal" data-bs-target="#projectModal">Tambah</button>
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
                                            <th>Nama</th>
                                            <th>Semester</th>
                                            <th>Proyek</th>
                                            <th>Item</th>
                                            <th>Hasil</th>
                                            <th>Dibuat</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($projects as $index => $item)    
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->student }}</td>
                                            <td>{{ $item->semester }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->item }}</td>
                                            <td>{{ $item->result }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="text-center">
                                                <div class="action-btns">
                                                    <button class="btn btn-outline-secondary btn-icon btn-rounded editProject" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#projectModal">
                                                        <span class="far fa-edit"></span>
                                                    </button>
                                                    <form action="/data/proyek/{{ $item->id }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger btn-icon btn-rounded" onclick="return confirm('Apakah anda yakin?')"><i class="far fa-trash-alt"></i></button>
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
    <!-- Modal -->
    <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle text-white"></i><span class="icon-name"></span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="student_id" class="col-sm-3 col-form-label"><p>Peserta</p></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="student_id" id="student_id" required>
                                    <option selected disabled value="">Pilih...</option>
                                    @foreach ($students as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="form-control" name="student" id="student">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="semester" class="col-sm-3 col-form-label"><p>Semester</p></label>
                            <div class="col-sm-9">
                                <select type="text" class="form-select" name="semester" id="semester" required>
                                    <option selected disabled value="">Pilih...</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label"><p>Proyek</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="item" class="col-sm-3 col-form-label"><p>Item</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="item" id="item" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="result" class="col-sm-3 col-form-label"><p>Hasil</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="result" id="result" required>
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

    <script>
        document.getElementById('student_id').addEventListener('change', function() {
            document.getElementById('student').value = this.options[this.selectedIndex].text;
        });
        document.querySelectorAll('.editProject').forEach(function(element) {
            element.addEventListener('click', function() {
                const id = this.dataset.id;
                document.getElementById('projectModalLabel').innerHTML = 'Edit Data <b>Project</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/data/proyek/' + id);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/data/proyek/' + id);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        document.getElementById('student_id').value = data.project.student_id;
                        document.getElementById('student').value = data.project.student;
                        document.getElementById('semester').value = data.project.semester;
                        document.getElementById('name').value = data.project.name;
                        document.getElementById('item').value = data.project.item;
                        document.getElementById('result').value = data.project.result;
                        document.getElementById('methodField').value = 'PATCH';
                    }
                };
                xhr.send();
            });
        });

        document.querySelectorAll('.inputProject').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('projectModalLabel').innerHTML = 'Input Data <b>Project</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/data/proyek');
                document.getElementById('student_id').value = '';
                document.getElementById('student').value = '';
                document.getElementById('semester').value = '';
                document.getElementById('name').value = '';
                document.getElementById('item').value = '';
                document.getElementById('result').value = '';
                document.getElementById('methodField').value = '';
            });
        });
    </script>
    
@endsection