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
                                                            <input type="text" class="form-control" name="serial" value="{{ $randomNumber = mt_rand(1000000, 9999999); }}" readonly>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="registered" class="form-label">Angkatan</label>
                                                            <select class="form-select" name="registered" id="registered" onchange="showDataTableForm(this.value)" required>
                                                                <option selected disabled value="">Pilih ...</option>
                                                                @for ($i = date('Y'); $i >= date('Y') - 3; $i--)
                                                                    <option>{{ $i }}</option>
                                                                @endfor

                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="semester" class="form-label">Semester</label>
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
                                                        <div class="col-md-3">
                                                            <label for="competence_id" class="form-label">Pelajaran</label>
                                                            <select class="form-select" name="competence_id" id="competence_id" required>
                                                                <option selected disabled>Pilih ...</option>
                                                            </select>
                                                            <input type="hidden" class="form-control" name="subject" id="subject" value="" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-detail-items mt-4">
                                                    <div class="table-responsive">
                                                        <table class="table item-table align-middle">
                                                            <thead class="mb-2">
                                                                <tr class="text-center">
                                                                    <th>No</th>
                                                                    <th>Nama</th>
                                                                    <th>Jan</th>
                                                                    <th>Feb</th>
                                                                    <th>Mar</th>
                                                                    <th>Apr</th>
                                                                    <th>May</th>
                                                                    <th>Jun</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="table-form">

                                                                <tr>
                                                                    <td rowspan="3"><div class="mt-2">1</div></td>
                                                                    <td rowspan="3">
                                                                        <input type="hidden" class="form-control form-control-sm" name="student_id[]" value="">
                                                                        <input type="text" class="form-control form-control-sm" name="student[]" value="Nama Santri">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm text-center" name="month_1[]" id="month_1">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm text-center" name="month_2[]" id="month_2">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm text-center" name="month_3[]" id="month_3">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm text-center" name="month_4[]" id="month_4">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm text-center" name="month_5[]" id="month_5">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm text-center" name="month_6[]" id="month_6">
                                                                    </td>
                                                                </tr>
                                                                <tr class="text-center">
                                                                    <td colspan="2">
                                                                        <textarea class="form-control" name="competence_1[]" id="competence_1" cols="30" rows="3"></textarea>
                                                                        <div class="form-check form-switch mt-3">
                                                                            <input class="form-check-input" type="checkbox" name="is_ok_1[]" id="is_ok_1">
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <textarea class="form-control" name="competence_2[]" id="competence_2" cols="30" rows="3"></textarea>
                                                                        <div class="form-check form-switch mt-3">
                                                                            <input class="form-check-input" type="checkbox" name="is_ok_2[]" id="is_ok_2">
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <textarea class="form-control" name="competence_3[]" id="competence_3" cols="30" rows="3"></textarea>
                                                                        <div class="form-check form-switch mt-3">
                                                                            <input class="form-check-input" type="checkbox" name="is_ok_3[]" id="is_ok_3">
                                                                        </div>
                                                                    </td>
                                                                </tr>

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
        document.getElementById('semester').addEventListener('change', function() {
            var number = this.value;
            var thead = document.querySelector('thead tr.text-center');
            if(number %2 === 0) {
                var head = '<th>No</th><th>Nama</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th>';
            }else{
                var head = '<th>No</th><th>Nama</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th>';
            }
            thead.innerHTML = head;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    const select = document.getElementById('competence_id');
                    select.innerHTML = '';
                    select.innerHTML += '<option selected disabled value="">Pilih...</option>';
                    data.competences.forEach(element => {
                        const newSelect = `<option value='${element.id}'>${element.subject}</option>`;
                        select.innerHTML += newSelect;
                    });
                }
            };
            xhr.open('GET', '/data/kompetensi/semester/' + number, true);
            xhr.send();
        });

        function showDataTableForm(year) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    const tableForm = document.getElementById('table-form');
                    tableForm.innerHTML = '';
                    data.students.forEach((element, i) => {
                        const dataTableForm = `
                            <div>
                                <tr>
                                    <td rowspan="3"><div class="mt-2">${i + 1}</div></td>
                                    <td rowspan="3">
                                        <input type="hidden" class="form-control form-control-sm" name="id[]" value="0">
                                        <input type="hidden" class="form-control form-control-sm" name="student_id[]" value="${element.id}">
                                        <input type="text" class="form-control form-control-sm" name="student[]" value="${element.nickname}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm text-center" name="month_1[]" id="month_1">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm text-center" name="month_2[]" id="month_2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm text-center" name="month_3[]" id="month_3">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm text-center" name="month_4[]" id="month_4">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm text-center" name="month_5[]" id="month_5">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm text-center" name="month_6[]" id="month_6">
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="2">
                                        <textarea class="form-control" name="competence_1[]" id="competence_1" cols="30" rows="3"></textarea>
                                        <div class="form-check form-switch mt-3">
                                            <input class="form-check-input" type="checkbox" name="is_ok_1[]" id="is_ok_1[]" value="1">
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <textarea class="form-control" name="competence_2[]" id="competence_2" cols="30" rows="3"></textarea>
                                        <div class="form-check form-switch mt-3">
                                            <input class="form-check-input" type="checkbox" name="is_ok_2[]" id="is_ok_2[]" value="1">
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <textarea class="form-control" name="competence_3[]" id="competence_3" cols="30" rows="3"></textarea>
                                        <div class="form-check form-switch mt-3">
                                            <input class="form-check-input" type="checkbox" name="is_ok_3[]" id="is_ok_3[]" value="1">
                                        </div>
                                    </td>
                                </tr>
                            </div>
                        `;
                        tableForm.innerHTML += dataTableForm;
                    })
                }
            };
            xhr.open('GET', '/admin/siswa/asesmen/' + year, true);
            xhr.send();
        }

        document.getElementById('competence_id').addEventListener('change', function() {
            var id = this.value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('subject').value = data.competence.subject;
                    const competence_1 = document.querySelectorAll('#competence_1');
                    const competence_2 = document.querySelectorAll('#competence_2');
                    const competence_3 = document.querySelectorAll('#competence_3');
                    competence_1.forEach(element => {
                        element.value = data.competence.competence_1;
                    });
                    competence_2.forEach(element => {
                        element.value = data.competence.competence_2;
                    });
                    competence_3.forEach(element => {
                        element.value = data.competence.competence_3;
                    });
                }
            };
            xhr.open('GET', '/data/kompetensi/' + id, true);
            xhr.send();
        });

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