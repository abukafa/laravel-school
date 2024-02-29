@extends('templates.navbar')

@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing mt-4">
            <div class="middle-content container-xxl p-0">
                <div class="row layout-top-spacing">
                    <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                        
                        <!-- FLASH ALERT -->
                        @if (session()->has('success') || session()->has('danger'))
                        <div class="alert alert-icon-left alert-light-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show mb-4" role="alert">
                            <button type="button" class="btn-close mt-1" data-bs-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                            <strong>{{ session('success') ?: session('danger') }}.</strong>
                        </div>
                        @endif
                        
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row mx-4 mt-4 mb-2">
                                    <div class="col-12 d-flex justify-content-between">
                                        <h4 class="p-0 mt-2">Kompetensi Dasar</h4>
                                        <div class="d-flex align-items-center">
                                            <form action="" method="GET" class="d-flex m-1">
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
                                            <button type="button" class="btn btn-sm btn-primary inputCompetence" data-bs-toggle="modal" data-bs-target="#competenceModal">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Semester</th>
                                                <th scope="col">Pelajaran</th>
                                                <th scope="col">Pengajar</th>
                                                <th scope="col">Kompetensi</th>
                                                <th class="text-center" scope="col">Opsi</th>
                                            </tr>
                                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($competences as $index => $item)    
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->semester }}</td>
                                                <td>{{ $item->subject }}</td>
                                                <td>{{ $item->teacher }}</td>
                                                <td>{{ substr($item->competence_1,0,50) }} ...</td>
                                                <td class="text-center">
                                                    <div class="action-btns {{ auth()->user()->role < 3 && auth()->user()->name <> $item->teacher ? 'd-none' : '' }}">
                                                        <button class="btn btn-outline-secondary btn-icon btn-rounded editCompetence" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#competenceModal">
                                                            <span class="far fa-edit"></span>
                                                        </button>
                                                        <form action="/data/kompetensi/{{ $item->id }}" method="POST" class="d-inline">
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
    </div>
    <!-- Modal -->
    <div class="modal fade" id="competenceModal" tabindex="-1" role="dialog" aria-labelledby="competenceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="competenceModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle text-white"></i><span class="icon-name"></span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="semester" class="col-sm-3 col-form-label"><p>Semester</p></label>
                            <div class="col-sm-9">
                            <select class="form-select" name="semester" id="semester" required>
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
                            <label for="subject" class="col-sm-3 col-form-label"><p>Pelajaran</p></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="subject_id" id="subject_id" required>
                                    <option selected disabled value="">Pilih...</option>
                                    @foreach ($subjects as $item)
                                        <option value="{{ $item->id }}">{{ $item->group . ' - ' . $item->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="form-control" name="subject" id="subject" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="teacher_id" class="col-sm-3 col-form-label"><p>Pengajar</p></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="teacher_id" id="teacher_id" required>
                                    <option selected disabled value="">Pilih...</option>
                                    @foreach ($teachers as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="form-control" name="teacher" id="teacher" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="competence_1" class="col-sm-3 col-form-label"><p>Kompetensi 1</p></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="competence_1" id="competence_1" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="competence_2" class="col-sm-3 col-form-label"><p>Kompetensi 2</p></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="competence_2" id="competence_2" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="competence_3" class="col-sm-3 col-form-label"><p>Kompetensi 3</p></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="competence_3" id="competence_3" cols="30" rows="5"></textarea>
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

    <script>
        document.getElementById('subject_id').addEventListener('change', function() {
            var content = this.options[this.selectedIndex].innerHTML;
            document.getElementById('subject').value = content;
        })
        document.getElementById('teacher_id').addEventListener('change', function() {
            var content = this.options[this.selectedIndex].innerHTML;
            document.getElementById('teacher').value = content;
        })

        document.querySelectorAll('.editCompetence').forEach(function(element) {
            element.addEventListener('click', function() {
                const id = this.dataset.id;
                document.getElementById('competenceModalLabel').innerHTML = 'Edit Data <b>Kompetensi</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/data/kompetensi/' + id);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/data/kompetensi/' + id);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        document.getElementById('subject_id').value = data.competence.subject_id;
                        document.getElementById('subject').value = data.competence.subject;
                        document.getElementById('semester').value = data.competence.semester;
                        document.getElementById('teacher_id').value = data.competence.teacher_id;
                        document.getElementById('teacher').value = data.competence.teacher;
                        document.getElementById('competence_1').value = data.competence.competence_1;
                        document.getElementById('competence_2').value = data.competence.competence_2;
                        document.getElementById('competence_3').value = data.competence.competence_3;
                        document.getElementById('methodField').value = 'PATCH';
                    }
                };
                xhr.send();
            });
        });

        document.querySelectorAll('.inputCompetence').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('competenceModalLabel').innerHTML = 'Input Data <b>Kompetensi</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/data/kompetensi');
                document.getElementById('subject_id').value = '';
                document.getElementById('subject').value = '';
                document.getElementById('semester').value = '';
                document.getElementById('teacher_id').value = '';
                document.getElementById('teacher').value = '';
                document.getElementById('competence_1').value = '';
                document.getElementById('competence_2').value = '';
                document.getElementById('competence_3').value = '';
                document.getElementById('methodField').value = '';
            });
        });
    </script>

@endsection