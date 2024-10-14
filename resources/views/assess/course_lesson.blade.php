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
                                                <h5>Input Data Kursus</h5>
                                            </div>
                                            <form action="/data/kursus{{ $item ? '/' . $item->id : '' }}" method="POST">
                                                <div class="invoice-detail-header">
                                                    <div class="row g-3">
                                                        @csrf
                                                        @if($item)
                                                            @method('PUT') <!-- Gantikan metode POST dengan PUT jika $item ada -->
                                                        @endif
                                                        <div class="col-md-8">
                                                            <label for="ids" class="form-label">Nama Kursus</label>
                                                            <input type="text" class="form-control" name="name" id="name" value="{{ $items && $items->first() ? $items->first()->name : '' }}" {{ $items ? 'readonly' : 'required' }}>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="year" class="form-label">Subjek</label>
                                                            @if ($items && $items->first())
                                                                <input type="text" class="form-control" name="subject" id="subject" value="{{ $items->first()->subject }}" readonly>
                                                            @else
                                                                <select class="form-select" name="subject" id="subject" required>
                                                                    <option selected>Pilih...</option>
                                                                    @foreach ($subjects as $subject)
                                                                        <option>{{ $subject }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label for="year" class="form-label">Keterangan</label>
                                                            <input type="text" class="form-control" name="note" id="note" value="{{ $items && $items->first() ? $items->first()->note : '' }}"  {{ $items ? 'readonly' : 'required' }}>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="year" class="form-label">Author</label>
                                                            <input type="text" class="form-control" name="author" id="author" value="{{ $items && $items->first() ? $items->first()->author : '' }}"  {{ $items ? 'readonly' : 'required' }}>
                                                        </div>

                                                        <div class="col-md-8">
                                                            <label for="idb" class="form-label">Judul</label>
                                                            <input type="text" class="form-control" id="title" name="title" value="{{ $item ? $item->title : '' }}" required>
                                                        </div>
                                                        <div class="col-md-4 mb-2">
                                                            <label for="amount" class="form-label">Bab</label>
                                                            <input type="text" class="form-control" name="section" id="section" value="{{ $items && $items->first() ? $items->first()->section : '' }}" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="year" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" name="description" id="description" >{{ $item ? $item->description : '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label for="idb" class="form-label">URL Video</label>
                                                            <input type="text" class="form-control" id="video_url" name="video_url" value="{{ $item ? $item->video_url : 'https://' }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="idb" class="form-label">Durasi Video</label>
                                                            <input type="text" class="form-control" id="video_duration" name="video_duration" value="{{ $item ? $item->video_duration : '00.00' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-center mt-4">
                                                    <button type="submit" class="btn btn-primary me-1">Simpan</button>
                                                    <a href="/data/kursus" class="btn btn-secondary ms-1">Kembali</a>
                                                </div>
                                            </form>
                                            <div class="invoice-detail-items">
                                                <div class="table-responsive">
                                                    <table class="table item-table align-middle">
                                                        <thead class="mb-2">
                                                            <tr>
                                                                <th>Bab</th>
                                                                <th>Judul</th>
                                                                <th>Durasi</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($items !== null)
                                                                @foreach ($items as $i => $item)
                                                                    <tr>
                                                                        <td>{{ $item->section }}</td>
                                                                        <td>{{ $item->title }}</td>
                                                                        <td>{{ $item->video_duration }}</td>
                                                                        <td>
                                                                            <a href="/data/kursus/{{ $item->id }}/editItem" class="btn btn-outline-secondary btn-icon btn-rounded editSubject">
                                                                                <span class="far fa-edit"></span>
                                                                            </a>
                                                                            <form action="/data/kursus/{{ $item->id }}" method="POST" class="d-inline">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="submit" class="btn btn-outline-danger btn-sm btn-icon btn-rounded" onclick="return confirm('Apakah anda yakin?')"><i class="far fa-trash-alt"></i></button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
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
        // Make sure to get the 'ids' value initially
        let ids = document.getElementById('ids').value;

        // Function to get billing and payment data
        function getBillingPayment(ids) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('name').value = data.student.name;
                    document.getElementById('year').value = data.student.registered;
                    document.getElementById('payment_category').value = data.student.payment_category;

                    // Clear the existing options in the select element
                    const select = document.getElementById('idb');
                    select.innerHTML = '';

                    // Add the default option
                    select.innerHTML += '<option selected disabled value="">Pilih...</option>';

                    // Populate the select element with new options
                    data.billing.forEach(element => {
                        const newSelect = `<option value='${element.id}'>${element.name}</option>`;
                        select.innerHTML += newSelect;
                    });

                    // Clear other form fields
                    document.getElementById('account').value = '';
                    document.getElementById('billing').value = '';
                    document.getElementById('amount').value = '';
                }
            };
            xhr.open('GET', '/admin/tagihan/search/ids/' + ids, true);
            xhr.send();
        }

        // Check if 'ids' has a value, and call the function initially
        if (ids) {
            getBillingPayment(ids);
        } else {
            // If 'ids' is empty, add an event listener to handle changes
            document.getElementById('ids').addEventListener('change', function() {
                ids = this.value; // Update the 'ids' value
                getBillingPayment(ids);
            });
        }

        document.getElementById('idb').addEventListener('change', function() {
            var id = this.value;
            var ids = document.getElementById('ids').value;
            var name = this.selectedOptions[0].textContent;
            var xhr = new XMLHttpRequest();
            // console.log(ids);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('account').value = data.billing.account;
                    document.getElementById('billing').value = document.getElementById('idb').selectedOptions[0].textContent;
                    document.getElementById('amount').value = data.balance;
                }
            };
            xhr.open('GET', '/admin/tagihan/sisa/' + id + '/' + ids + '/' + name, true);
            xhr.send();
        });
    </script>

@endsection
