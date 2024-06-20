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
                                        <h4 class="p-0 mt-2">Rapor Pendidikan</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">NID</th>
                                                <th scope="col">Nama</th>
                                                <th class="text-center">1</th>
                                                <th class="text-center">2</th>
                                                <th class="text-center">3</th>
                                                <th class="text-center">4</th>
                                                <th class="text-center">5</th>
                                                <th class="text-center">6</th>
                                            </tr>
                                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($students as $index => $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->nis }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-center">
                                                    @foreach ($rapors as $rapor)
                                                        @if ($rapor->student_id == $item->id && $rapor->semester == 1)
                                                            <a class="badge badge-primary text-start me-1 action-view" href="/data/rapor/1/{{ $item->id }}">
                                                                <span class="far fa-eye"></span>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @foreach ($rapors as $rapor)
                                                        @if ($rapor->student_id == $item->id && $rapor->semester == 2)
                                                            <a class="badge badge-primary text-start me-1 action-view" href="/data/rapor/2/{{ $item->id }}">
                                                                <span class="far fa-eye"></span>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @foreach ($rapors as $rapor)
                                                        @if ($rapor->student_id == $item->id && $rapor->semester == 3)
                                                            <a class="badge badge-primary text-start me-1 action-view" href="/data/rapor/3/{{ $item->id }}">
                                                                <span class="far fa-eye"></span>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @foreach ($rapors as $rapor)
                                                        @if ($rapor->student_id == $item->id && $rapor->semester == 4)
                                                            <a class="badge badge-primary text-start me-1 action-view" href="/data/rapor/4/{{ $item->id }}">
                                                                <span class="far fa-eye"></span>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @foreach ($rapors as $rapor)
                                                        @if ($rapor->student_id == $item->id && $rapor->semester == 5)
                                                            <a class="badge badge-primary text-start me-1 action-view" href="/data/rapor/5/{{ $item->id }}">
                                                                <span class="far fa-eye"></span>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @foreach ($rapors as $rapor)
                                                        @if ($rapor->student_id == $item->id && $rapor->semester == 6)
                                                            <a class="badge badge-primary text-start me-1 action-view" href="/data/rapor/6/{{ $item->id }}">
                                                                <span class="far fa-eye"></span>
                                                            </a>
                                                        @endif
                                                    @endforeach
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
    <div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subjectModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle text-white"></i><span class="icon-name"></span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="group" class="col-sm-3 col-form-label"><p>Kelompok</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="group" id="group">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="number" class="col-sm-3 col-form-label"><p>Nomor Urut</p></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="number" id="number" required>
                                    <option selected disabled value="">Pilih...</option>
                                    <option>1.1.</option>
                                    <option>1.2.</option>
                                    <option>1.3.</option>
                                    <option>1.4.</option>
                                    <option>1.5.</option>
                                    <option>2.1.</option>
                                    <option>2.2.</option>
                                    <option>2.3.</option>
                                    <option>2.4.</option>
                                    <option>2.5.</option>
                                    <option>3.1.</option>
                                    <option>3.2.</option>
                                    <option>3.3.</option>
                                    <option>3.4.</option>
                                    <option>3.5.</option>
                                    <option>4.1.</option>
                                    <option>4.2.</option>
                                    <option>4.3.</option>
                                    <option>4.4.</option>
                                    <option>4.5.</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label"><p>Pelajaran</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" required>
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
        document.querySelectorAll('.editSubject').forEach(function(element) {
            element.addEventListener('click', function() {
                const id = this.dataset.id;
                document.getElementById('subjectModalLabel').innerHTML = 'Edit Data <b>Pelajaran</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/data/pelajaran/' + id);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/data/pelajaran/' + id);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        document.getElementById('number').value = data.subject.number;
                        document.getElementById('group').value = data.subject.group;
                        document.getElementById('name').value = data.subject.name;
                        document.getElementById('methodField').value = 'PATCH';
                    }
                };
                xhr.send();
            });
        });

        document.querySelectorAll('.inputSubject').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('subjectModalLabel').innerHTML = 'Input Data <b>Pelajaran</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/data/pelajaran');
                document.getElementById('number').value = '';
                document.getElementById('group').value = '';
                document.getElementById('name').value = '';
                document.getElementById('methodField').value = '';
            });
        });
    </script>

@endsection
