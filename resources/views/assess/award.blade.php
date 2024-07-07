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
                <h5 class="mt-2">Data Penghargaan</h5>
                <div class="d-flex align-items-center">
                    <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#awardModal" onclick="newData()">Tambah</a>
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
                                            <th>Subject</th>
                                            <th>Nilai</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($awards as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->student }}</td>
                                                <td>{{ $item->semester }}</td>
                                                <td>{{ $item->subject .' - '. $item->item }}</td>
                                                <td>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $item->rate)
                                                            <i class="far fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </td>
                                                <td class="text-center {{ auth()->user()->role < 3 ? 'd-none' : '' }}">
                                                    <div class="action-btns">
                                                        <a href="https://member.jazmedia.site/academy/awards/{{ strtolower($item->subject) }}/{{ $item->id }}" target="_blank" class="btn btn-outline-secondary btn-icon btn-rounded">
                                                            <span class="far fa-eye"></span>
                                                        </a>
                                                        <button class="btn btn-outline-secondary btn-icon btn-rounded editAward" onclick="showData({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#awardModal">
                                                            <span class="far fa-edit"></span>
                                                        </button>
                                                        <form action="/data/award/{{ $item->id }}" method="POST" class="d-inline">
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
    <div class="modal fade" id="awardModal" tabindex="-1" role="dialog" aria-labelledby="awardModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-awardModal">
                <div class="modal-header">
                    <h5 class="modal-title" id="awardModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle text-white"></i><span class="icon-name"></span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="date" class="col-sm-3 col-form-label"><p>Tanggal</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="date" id="date">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="student_id" class="col-sm-3 col-form-label"><p>Nama</p></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="student_id" id="student_id" required>
                                    <option selected disabled value="">Pilih ...</option>
                                    @foreach ($names as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="form-control" name="student" id="student" required>
                                <input type="hidden" class="form-control" name="registered" id="registered" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="semester" class="col-sm-3 col-form-label"><p>Semester</p></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="semester" id="semester" required>
                                    <option selected disabled value="">Pilih ...</option>
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
                            <label for="subject" class="col-sm-3 col-form-label"><p>Subjek</p></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="subject" id="subject" required>
                                    <option selected disabled value="">Pilih ...</option>
                                    <option>Alquran</option>
                                    <option>ICT</option>
                                    <option>Entrepreneurship</option>
                                    <option>Umum</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="item" class="col-sm-3 col-form-label"><p>Penghargaan</p></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="item" id="item" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="review" class="col-sm-3 col-form-label"><p>Rating</p></label>
                            <div class="col-sm-7 col-9">
                                <input type="range" class="form-range pt-4" min="0" max="5" id="slider" oninput="rateSlider(this.value)">
                            </div>
                            <div class="col-sm-2 col-3">
                                <input type="text" class="form-control" name="rate" id="rate" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="result" class="col-sm-3 col-form-label"><p>Nilai</p></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="result" id="result" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mentor" class="col-sm-3 col-form-label"><p>Mentor</p></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="mentor" id="mentor" required>
                                    <option selected disabled value="">Pilih ...</option>
                                    @foreach ($mentors as $item)
                                        <option>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="remark" class="col-sm-3 col-form-label"><p>Keterangan</p></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="remark" id="remark" required>
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
        function rateSlider(rate) {
            document.getElementById("rate").value = rate;
            let resultText;
            switch (parseInt(rate)) {
                case 5:
                    resultText = 'Excellent';
                    break;
                case 4:
                    resultText = 'Very Good';
                    break;
                case 3:
                    resultText = 'Good';
                    break;
                case 2:
                    resultText = 'Not Bad';
                    break;
                default:
                    resultText = 'Bad';
                    break;
            }
            document.getElementById('result').value = resultText;
        }


        function newData() {
            document.getElementById('awardModalLabel').innerHTML = 'Input Data <b>Award</b>';
            document.querySelector('.modal-awardModal form').setAttribute('action', '/data/award');
            document.getElementById('date').value = '';
            document.getElementById('student_id').value = '';
            document.getElementById('student').value = '';
            document.getElementById('registered').value = '';
            document.getElementById('semester').value = '';
            document.getElementById('subject').value = '';
            document.getElementById('item').value = '';
            document.getElementById('rate').value = '';
            document.getElementById('result').value = '';
            document.getElementById('mentor').value = '';
            document.getElementById('remark').value = '-';
            document.getElementById('methodField').value = '';
        }
        function showData(id) {
            document.getElementById('awardModalLabel').innerHTML = 'Edit Data <b>Award</b>';
            var form = document.querySelector('.modal-awardModal form');
            form.setAttribute('action', '/data/award/' + id);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/data/award/' + id);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('date').value = data.award.date;
                    document.getElementById('student_id').value = data.award.student_id;
                    document.getElementById('student').value = data.award.student;
                    document.getElementById('registered').value = data.award.registered;
                    document.getElementById('semester').value = data.award.semester;
                    document.getElementById('subject').value = data.award.subject;
                    document.getElementById('item').value = data.award.item;
                    document.getElementById('rate').value = data.award.rate;
                    document.getElementById('slider').value = data.award.rate;
                    document.getElementById('result').value = data.award.result;
                    document.getElementById('mentor').value = data.award.mentor;
                    document.getElementById('remark').value = data.award.remark;
                    document.getElementById('methodField').value = 'PATCH';
                }
            };
            xhr.send();
        }
        document.getElementById('student_id').addEventListener('change', function() {
            var id = this.value;
            var xhr = new XMLHttpRequest();
            console.log(id);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('student').value = data.student.name;
                    document.getElementById('registered').value = data.student.registered;
                }
            };
            xhr.open('GET', '/admin/siswa/' + id, true);
            xhr.send();
        });
    </script>

@endsection
