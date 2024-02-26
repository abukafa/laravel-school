@extends('templates.navbar')

    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/apps/invoice-add.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/apps/invoice-add.css') }}">
    
@section('content')

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">
                <div class="row invoice layout-top-spacing layout-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    
                    <!-- FLASH ALERT -->
                    @if (session()->has('success') || session()->has('danger'))
                    <div class="alert alert-icon-left alert-light-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show mb-4" role="alert">
                        <button type="button" class="btn-close mt-1" data-bs-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                        <strong>{{ session('success') ?: session('danger') }}.</strong>
                    </div>
                    @endif

                        <div class="doc-container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-content">
                                        <div class="invoice-detail-body">
                                            <div class="text-center mt-0 mb-4">
                                                <h5>Input Penilaian</h5>
                                            </div>
                                            <form action="/data/nilai" method="POST">
                                                <div class="invoice-detail-header">
                                                    <div class="row g-3">
                                                        @csrf
                                                        <div class="col-md-3">
                                                            <label for="serial" class="form-label">Kode Input</label>
                                                            <input type="text" class="form-control" name="serial" value="{{ $scores[0]->serial }}" readonly>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="registered" class="form-label">Angkatan</label>
                                                            <input class="form-control" name="registered" id="registered" value="{{ $scores[0]->registered }}" readonly>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="semester" class="form-label">Semester</label>
                                                            <input class="form-control" name="semester" id="semester" value="{{ $scores[0]->semester }}" readonly>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="competence_id" class="form-label">Pelajaran</label>
                                                            <input class="form-control" name="competence_id" id="competence_id" value="{{ $scores[0]->competence_id }}" readonly>
                                                            <input type="hidden" class="form-control" name="subject" id="subject" value="{{ $scores[0]->subject }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-detail-items mt-4">
                                                    <div class="table-responsive">
                                                        <table class="table item-table align-middle">
                                                            <thead class="mb-2">
                                                                <tr class="text-center">
                                                                    @if ( $scores[0]->semester % 2 === 0 )
                                                                        <th>No</th><th>Nama</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th>
                                                                    @else
                                                                        <th>No</th><th>Nama</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody id="table-form">
                                                                @foreach ($scores as $i => $item)
                                                                    <tr>
                                                                        <td style="vertical-align: middle !important;">{{ $i + 1 }}</td>
                                                                        <td>
                                                                            <input type="hidden" class="form-control form-control-sm" name="id[]" value="{{ $item->id }}">
                                                                            <input type="hidden" class="form-control form-control-sm" name="student_id[]" value="{{ $item->student_id }}">
                                                                            <input type="text" class="form-control form-control-sm" name="student[]" value="{{ $item->student }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control form-control-sm text-center" name="month_1[]" id="month_1" value="{{ $item->month_1 }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control form-control-sm text-center" name="month_2[]" id="month_2" value="{{ $item->month_2 }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control form-control-sm text-center" name="month_3[]" id="month_3" value="{{ $item->month_3 }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control form-control-sm text-center" name="month_4[]" id="month_4" value="{{ $item->month_4 }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control form-control-sm text-center" name="month_5[]" id="month_5" value="{{ $item->month_5 }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control form-control-sm text-center" name="month_6[]" id="month_6" value="{{ $item->month_6 }}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <td colspan="2" style="vertical-align: middle !important;">
                                                                            <form action="/data/nilai/{{ $item->id }}" method="POST" class="d-inline">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="submit" class="btn btn-outline-danger btn-icon btn-rounded" onclick="return confirm('Apakah anda yakin?')" disabled>
                                                                                    <i class="far fa-trash-al">{{ $item->id }}</i>
                                                                                </button>
                                                                            </form>                                                                            
                                                                        </td>
                                                                        <td colspan="2">
                                                                            <textarea class="form-control" name="competence_1[]" id="competence_1" cols="30" rows="3">{{ $item->competence_1 }}</textarea>
                                                                            <div class="form-check form-switch mt-3">
                                                                                <input class="form-check-input" type="checkbox" name="is_ok_1[]" id="is_ok_1" value="1" {{ $item->is_ok_1 ? 'checked' : '' }}>
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="2">
                                                                            <textarea class="form-control" name="competence_2[]" id="competence_2" cols="30" rows="3">{{ $item->competence_2 }}</textarea>
                                                                            <div class="form-check form-switch mt-3">
                                                                                <input class="form-check-input" type="checkbox" name="is_ok_2[]" id="is_ok_2" value="1" {{ $item->is_ok_2 ? 'checked' : '' }}>
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="2">
                                                                            <textarea class="form-control" name="competence_3[]" id="competence_3" cols="30" rows="3">{{ $item->competence_3 }}</textarea>
                                                                            <div class="form-check form-switch mt-3">
                                                                                <input class="form-check-input" type="checkbox" name="is_ok_3[]" id="is_ok_3" value="1" {{ $item->is_ok_3 ? 'checked' : '' }}>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary me-1" id="tombol-simpan">Simpan</button>
                                                    <a href="/data/nilai" class="btn btn-secondary ms-1">Kembali</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  BEGIN FOOTER  -->
        <div class="footer-wrapper">
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

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->     
    <script>
        document.getElementById('tombol-simpan').addEventListener('click', function() {
            const isOk1Elements = document.querySelectorAll('[name="is_ok_1[]"]');
            var isOk1Values = [];
            isOk1Elements.forEach(element => {
                isOk1Values.push(element.checked ? "1" : "0");
                // Tambahan untuk memastikan elemen yang tidak dicentang juga diikutsertakan dalam data yang dikirimkan
                if (!element.checked) {
                    const hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.name = "is_ok_1[]";
                    hiddenInput.value = "0";
                    element.parentNode.appendChild(hiddenInput);
                }
            });
            const isOk2Elements = document.querySelectorAll('[name="is_ok_2[]"]');
            var isOk2Values = [];
            isOk2Elements.forEach(element => {
                isOk2Values.push(element.checked ? "1" : "0");
                // Tambahan untuk memastikan elemen yang tidak dicentang juga diikutsertakan dalam data yang dikirimkan
                if (!element.checked) {
                    const hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.name = "is_ok_2[]";
                    hiddenInput.value = "0";
                    element.parentNode.appendChild(hiddenInput);
                }
            });
            const isOk3Elements = document.querySelectorAll('[name="is_ok_3[]"]');
            var isOk3Values = [];
            isOk3Elements.forEach(element => {
                isOk3Values.push(element.checked ? "1" : "0");
                // Tambahan untuk memastikan elemen yang tidak dicentang juga diikutsertakan dalam data yang dikirimkan
                if (!element.checked) {
                    const hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.name = "is_ok_3[]";
                    hiddenInput.value = "0";
                    element.parentNode.appendChild(hiddenInput);
                }
            });
        });

    </script>

@endsection