@extends('templates.navbar')

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css') }}">

@section('content')

    <div id="content" class="main-content">

        <div class="row mx-4 mt-4 mb-2">
            <div class="col-12 d-flex justify-content-between">
                <h5 class="mt-2">Data Task</h5>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-primary inputtask" data-bs-toggle="modal" data-bs-target="#taskModal" onclick="newData()">Tambah</button>
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
                                            <th>Tanggal</th>
                                            <th>Opsi</th>
                                            <th>Nama</th>
                                            <th>ID</th>
                                            <th>Project</th>
                                            <th>Task</th>
                                            <th>Rates</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($tasks as $index => $item)
                                        <tr>
                                            <td>{{ $item->date }}</td>
                                            <td class="text-center">
                                                <div class="action-btns">
                                                    <a href="{{ $item->link }}" target="_blank" class="btn btn-outline-secondary btn-icon btn-rounded">
                                                        <span class="far fa-bell"></span>
                                                    </a>
                                                    <a href="{{ env('APP_URL') . (($item->media == 'Instagram' || $item->media == 'Tiktok') ? '?instagram=true' : '') . '#' . $item->id }}" target="_blank" class="btn btn-outline-secondary btn-icon btn-rounded">
                                                        <span class="far fa-bookmark"></span>
                                                    </a>
                                                    <a class="btn btn{{ $item->accepted ? '' : '-outline' }}-primary btn-icon btn-rounded accTask" onclick="accData({{ $item->id }})" data-task-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#accTaskModal">
                                                        <span class="far fa-thumbs-up"></span>
                                                    </a>
                                                </div>
                                                <span class="d-none">{{ $item->accepted }}</span>
                                            </td>
                                            <td>{{ $item->student_name }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->project_name }}</td>
                                            <td id="taskName-{{ $item->id }}">{{ $item->name }}</td>
                                            <td>
                                                <span class="far fa-star" id="taskRate-{{ $item->id }}"> {{ $item->rate }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-{{ $item->status == 'In Progress' ? 'primary' : ($item->status == 'Complited' ? 'success' : ($item->status == 'On Hold' ? 'warning' : ($item->status == 'Cancelled' ? 'danger' : 'secondary'))) }}">{{ $item->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-outline-secondary btn-icon btn-rounded editTask" onclick="showData({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#taskModal">
                                                    <span class="far fa-edit"></span>
                                                </a>
                                                <form action="/data/task/{{ $item->id }}" method="POST" class="d-inline {{ (auth()->user()->role < 5) ? 'd-none' : '' }}">
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
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-taskModal">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">task Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle text-white"></i><span class="icon-name"></span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="project_id" class="col-sm-3 col-form-label"><p>Project</p></label>
                            <div class="col-sm-9">
                                <select type="text" class="form-select" name="project_id" id="project_id" required>
                                    <option selected disabled value="">Pilih...</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->subject . ' - ' . $project->theme }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="form-control" name="project_name" id="project_name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="student_id" class="col-sm-3 col-form-label"><p>Student</p></label>
                            <div class="col-sm-9">
                            <select type="text" class="form-select" name="student_id" id="student_id" required>
                                <option selected disabled value="">Pilih...</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" class="form-control" name="student_name" id="student_name">
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
                            <label for="name" class="col-sm-3 col-form-label"><p>Judul Task</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-sm-3 col-form-label"><p>Deskripsi</p></label>
                            <div class="col-sm-9">
                            <textarea type="text" class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date" class="col-sm-3 col-form-label"><p>Tanggal</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="date" id="dateTask" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="deadline" class="col-sm-3 col-form-label"><p>Deadline</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="deadline" id="deadline" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-sm-3 col-form-label"><p>Status</p></label>
                            <div class="col-sm-9">
                                <select type="text" class="form-select" name="status" id="status" required>
                                    <option>Not Started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>On Hold</option>
                                    <option>Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="media" class="col-sm-3 col-form-label"><p>Media</p></label>
                            <div class="col-sm-9">
                                <select type="text" class="form-select" name="media" id="media">
                                    <option selected disabled value="">Pilih...</option>
                                    <option>Google Drive</option>
                                    <option>Youtube</option>
                                    <option>Instagram</option>
                                    <option>Tiktok</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="embed" class="col-sm-3 col-form-label"><p>Embed</p></label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" name="embed" id="embed" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="link" class="col-sm-3 col-form-label"><p>Link Task</p></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="link" id="link">
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
    <!-- Modal ACC -->
    <div class="modal fade" id="accTaskModal" tabindex="-1" role="dialog" aria-labelledby="accTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-accTaskModal">
                <div class="modal-header">
                    <h5 class="modal-title" id="accTaskModalLabel">Acceptation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle text-white"></i><span class="icon-name"></span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="teacher_id" class="col-sm-3 col-form-label"><p>Mentor</p></label>
                            <div class="col-sm-9">
                            <select type="text" class="form-select" name="teacher_id" id="teacher_id" onchange="accepter(this.value)" required>
                                <option selected disabled value="">Pilih...</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" class="form-control" name="teacher_name" id="teacher_name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="accepted" class="col-sm-3 col-form-label"><p>Accepted</p></label>
                            <div class="col-sm-9">
                            <select type="text" class="form-select" name="accepted" id="accepted" onchange="statusAccepted(this.value)" required>
                                <option selected disabled value="">Pilih...</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <input type="hidden" class="form-control" name="status" id="status_acceptation" value="In Progress">
                        </div>
                        </div>
                        <div class="row mb-3 d-none" id="rateRange">
                            <label for="review" class="col-sm-3 col-form-label"><p>Rating</p></label>
                            <div class="col-sm-7 col-9">
                                <input type="range" class="form-range pt-4" min="0" max="5" id="customRange3" oninput="rateSlider(this.value)">
                            </div>
                            <div class="col-sm-2 col-3">
                                <input type="text" class="form-control" name="rate" id="rate" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="review" class="col-sm-3 col-form-label"><p>Review</p></label>
                            <div class="col-sm-9">
                            <textarea type="text" class="form-control" name="review" id="review" required cols="30" rows="5"></textarea>
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
        document.getElementById('project_id').addEventListener('change', function() {
            var id = this.value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('project_name').value = data.project.subject + ' - ' + data.project.theme;
                    document.getElementById('deadline').value = data.project.end_date;
                }
            };
            xhr.open('GET', '/data/project/' + id, true);
            xhr.send();
        });

        function showData(id) {
            document.getElementById('taskModalLabel').innerHTML = 'Edit Data <b>task</b>';
            var form = document.querySelector('.modal-taskModal form');
            form.setAttribute('action', '/data/task/' + id);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/data/task/' + id);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('project_id').value = data.task.project_id;
                    document.getElementById('project_name').value = data.task.project_name;
                    document.getElementById('student_id').value = data.task.student_id;
                    document.getElementById('student_name').value = data.task.student_name;
                    document.getElementById('semester').value = data.task.semester;
                    document.getElementById('name').value = data.task.name;
                    document.getElementById('description').value = data.task.description;
                    document.getElementById('dateTask').value = data.task.date;
                    document.getElementById('deadline').value = data.task.deadline;
                    document.getElementById('status').value = data.task.status;
                    document.getElementById('media').value = data.task.media;
                    document.getElementById('embed').value = data.task.embed;
                    document.getElementById('link').value = data.task.link;
                    document.getElementById('methodField').value = 'PATCH';
                }
            };
            xhr.send();

            form.onsubmit = function(event) {
                event.preventDefault();
                var formData = new FormData(form);
                var csrfToken = form.querySelector('input[name="_token"]').value;
                formData.append('_token', csrfToken);
                var actionUrl = '/data/task/' + id;
                var xhrUpdate = new XMLHttpRequest();
                xhrUpdate.open('POST', actionUrl);
                xhrUpdate.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhrUpdate.onload = function() {
                    if (xhrUpdate.status === 200) {
                        document.getElementById('taskName-' + id).innerHTML = document.getElementById('name').value;
                    }else{
                        alert('Failed to update data: ' + xhrUpdate.statusText);
                    }
                    var modal = document.querySelector('#taskModal');
                    var modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();
                };
                xhrUpdate.onerror = function() {
                    console.error('Request error');
                    alert('Request error');
                };
                xhrUpdate.send(formData);
            };
        };

        function accData(id) {
            var form = document.querySelector('.modal-accTaskModal form');
            form.setAttribute('action', '/data/task/acc/' + id);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/data/task/' + id);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('teacher_id').value = data.task.teacher_id;
                    document.getElementById('teacher_name').value = data.task.teacher_name;
                    document.getElementById('accepted').value = data.task.accepted;
                    document.getElementById('rate').value = data.task.rate;
                    document.getElementById('customRange3').value = data.task.rate;
                    document.getElementById('review').value = data.task.review;
                    document.getElementById('methodField').value = 'PATCH';
                    if (data.task.accepted == 1) {
                        document.getElementById('rateRange').classList.remove("d-none");
                    }else{
                        document.getElementById('rateRange').classList.add("d-none");
                    }
                }
            };
            xhr.send();

            form.onsubmit = function(event) {
                event.preventDefault();
                var formData = new FormData(form);
                var csrfToken = form.querySelector('input[name="_token"]').value;
                formData.append('_token', csrfToken);
                var actionUrl = '/data/task/acc/' + id;
                var xhrUpdate = new XMLHttpRequest();
                xhrUpdate.open('POST', actionUrl);
                xhrUpdate.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhrUpdate.onload = function() {
                    if (xhrUpdate.status === 200) {
                        var clickedButton = document.querySelector('.accTask[data-task-id="' + id + '"]');
                        var accepted = document.getElementById('accepted').value;
                        document.getElementById('taskRate-' + id).innerHTML = ' ' + document.getElementById('rate').value;
                        if (clickedButton) {
                            clickedButton.classList.remove(accepted == true ? 'btn-outline-primary' : 'btn-primary');
                            clickedButton.classList.add(accepted == true ? 'btn-primary' : 'btn-outline-primary');
                        }
                    } else {
                        alert('Failed to update data: ' + xhrUpdate.statusText);
                    }
                    var modal = document.querySelector('#accTaskModal');
                    var modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();
                };
                xhrUpdate.onerror = function() {
                    console.error('Request error');
                    alert('Request error');
                };
                xhrUpdate.send(formData);
            };
        };

        function accepter(id) {
            const selectedOption = event.target.options[id];
            const teacher_name = selectedOption.text;
            document.getElementById('teacher_name').value = teacher_name;
        };

        function statusAccepted(accept) {
            document.getElementById('rate').value = 0
            document.getElementById('customRange3').value = 0
            if (accept == 1) {
                document.getElementById('rateRange').classList.remove("d-none");
                document.getElementById('status_acceptation').value = 'Completed'
            }else{
                document.getElementById('rateRange').classList.add("d-none");
                document.getElementById('status_acceptation').value = 'In Progress'
            }
        };

        function rateSlider(rate) {
            document.getElementById("rate").value = rate;
        };

        function newData() {
            document.getElementById('taskModalLabel').innerHTML = 'Input Data <b>task</b>';
            document.querySelector('.modal-taskModal form').setAttribute('action', '/data/task');
            document.getElementById('project_id').value = '';
            document.getElementById('project_name').value = '';
            document.getElementById('student_id').value = '';
            document.getElementById('student_name').value = '';
            document.getElementById('semester').value = '';
            document.getElementById('name').value = '';
            document.getElementById('description').value = '';
            document.getElementById('date').value = new Date().toISOString().slice(0,10);
            document.getElementById('deadline').value = '';
            document.getElementById('status').value = '';
            document.getElementById('link').value = '';
            document.getElementById('methodField').value = '';
        }
    </script>

@endsection
