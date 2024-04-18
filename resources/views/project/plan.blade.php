@extends('templates.navbar')

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css') }}">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/flatpickr/flatpickr.css') }}">

@section('content')

    <div id="content" class="main-content">

        <div class="row mx-4 mt-4 mb-2">
            <div class="col-12 d-flex justify-content-between">
                <h5 class="mt-2">Data Project</h5>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-primary inputProject" data-bs-toggle="modal" data-bs-target="#projectModal" onclick="newData()">Tambah</button>
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
                                            <th>Subjek</th>
                                            <th>Tema</th>
                                            <th>Deadline</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($projects as $index => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->subject }}</td>
                                            <td>{{ $item->theme }}</td>
                                            <td>{{ $item->end_date }}</td>
                                            <td class="text-center d-none d-sm-table-cell">
                                                <span class="badge badge-light-{{ $item->status == 'In Progress' ? 'primary' : ($item->status == 'Complited' ? 'success' : ($item->status == 'On Hold' ? 'warning' : ($item->status == 'Cancelled' ? 'danger' : 'secondary'))) }}">{{ $item->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="action-btns">
                                                    <button class="btn btn-outline-secondary btn-icon btn-rounded editProject" onclick="showData({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#projectModal">
                                                        <span class="far fa-edit"></span>
                                                    </button>
                                                    <form action="/data/project/{{ $item->id }}" method="POST" class="d-inline">
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
                    <h5 class="modal-title" id="projectModalLabel">Project Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle text-white"></i><span class="icon-name"></span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="start_date" class="col-sm-3 col-form-label"><p>Tanggal</p></label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" name="start_date" id="start_date" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="end_date" class="col-sm-3 col-form-label"><p>Deadline</p></label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" name="end_date" id="end_date" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="subject" class="col-sm-3 col-form-label"><p>Subjek</p></label>
                            <div class="col-sm-9">
                            <select type="text" class="form-select" name="subject" id="subject" required>
                                <option selected disabled value="">Pilih...</option>
                                <option>Alquran</option>
                                <option>Tsaqofah</option>
                                <option>Multimedia</option>
                                <option>Informatika</option>
                                <option>Literasi</option>
                                <option>Leadership</option>
                                <option>Social Media</option>
                                <option>Entrepreneurship</option>
                                <option>Public Speaking</option>
                            </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="theme" class="col-sm-3 col-form-label"><p>Tema</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="theme" id="theme" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-sm-3 col-form-label"><p>Deskripsi</p></label>
                            <div class="col-sm-9">
                            <textarea type="text" class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-sm-3 col-form-label"><p>Status</p></label>
                            <div class="col-sm-9">
                            <select type="text" class="form-select" name="status" id="status" required>
                                <option>In Progress</option>
                                <option>Completed</option>
                                <option>On Hold</option>
                                <option>Cancelled</option>
                            </select>
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

    <script src="{{ asset('src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        var f1 = flatpickr(document.getElementById('start_date'));
        var f1 = flatpickr(document.getElementById('end_date'));

        function showData(id) {
            console.log(id);
            document.getElementById('projectModalLabel').innerHTML = 'Edit Data <b>Project</b>';
            document.querySelector('.modal-content form').setAttribute('action', '/data/project/' + id);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/data/project/' + id);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('start_date').value = data.project.start_date;
                    document.getElementById('end_date').value = data.project.end_date;
                    document.getElementById('subject').value = data.project.subject;
                    document.getElementById('theme').value = data.project.theme;
                    document.getElementById('description').value = data.project.description;
                    document.getElementById('status').value = data.project.status;
                    document.getElementById('methodField').value = 'PATCH';
                }
            };
            xhr.send();
        };

        function newData() {
            document.getElementById('projectModalLabel').innerHTML = 'Input Data <b>Project</b>';
            document.querySelector('.modal-content form').setAttribute('action', '/data/project');
            document.getElementById('start_date').value = new Date().toISOString().slice(0,10);
            document.getElementById('end_date').value = '';
            document.getElementById('subject').value = '';
            document.getElementById('theme').value = '';
            document.getElementById('description').value = '';
            document.getElementById('status').value = 'In Progress';
            document.getElementById('methodField').value = '';
        }
    </script>

@endsection
