@extends('templates.navbar')

    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/apps/invoice-add.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/apps/invoice-add.css') }}">

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/flatpickr/flatpickr.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/noUiSlider/nouislider.min.css') }}"> --}}
    <!-- END THEME GLOBAL STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/scrollspyNav.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/flatpickr/custom-flatpickr.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/scrollspyNav.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}">
    <!--  END CUSTOM STYLE FILE  -->

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
                                <div class="col-xl-9">
                                    <div class="invoice-content">
                                        <div class="invoice-detail-body">
                                            <div class="text-center mt-0 mb-4">

                                                <h4>{{ $invoice }}</h4>

                                            </div>
                                            <div class="invoice-detail-header">
                                                <form class="row g-3" action="/admin/pembayaran" method="POST">
                                                    @csrf
                                                    <div class="col-md-6">
                                                        <label for="date" class="form-label">Tanggal</label>
                                                        <input type="hidden" class="form-control" name="invoice" id="invoice" value="{{ $invoice }}">
                                                        <input type="text" class="form-control" name="date" id="date" value="{{ optional($items->first())->date }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="ids" class="form-label">Santri</label>
                                                        <select type="text" class="form-control" id="ids" name="ids" required>
                                                            @if ($items)
                                                                <option value="{{ optional($items->first())->ids }}">{{ optional($items->first())->name }}</option>
                                                            @else
                                                                <option selected disabled value="">Pilih...</option>
                                                            @endif
                                                            @foreach ($students as $student)
                                                                @if ($student->unit <> 'Pembayaran')
                                                                    <option value="{{ $student->id }}">{{ $student->nis . ' - ' . $student->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" class="form-control" name="name" id="name">
                                                        <input type="hidden" class="form-control" name="category" id="payment_category">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="idb" class="form-label">Pembayaran</label>
                                                        <select class="form-select" id="idb" required>
                                                            <option selected disabled value="">Pilih...</option>
                                                        </select>
                                                        <input type="hidden" class="form-control" id="billingName">
                                                        <input type="hidden" class="form-control" id="account" name="account" value="{{ optional($items->first())->account }}">
                                                        <input type="hidden" class="form-control" id="billing" name="billing" value="{{ optional($items->first())->billing }}">
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="amount" class="form-label">Jumlah</label>
                                                        <input type="number" class="form-control" name="amount" id="amount" required>
                                                        <input type="hidden" class="form-control" name="is_once" id="is_once" required>
                                                        <input type="hidden" class="form-control" name="is_monthly" id="is_monthly" required>
                                                        <input type="hidden" class="form-control" value="{{ session('user.name') }}" name="admin" id="admin">
                                                    </div>
                                                    <div class="col-12 mt-4">
                                                        <button class="btn btn-primary" type="submit">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="invoice-detail-items">

                                                <div class="table-responsive">
                                                    <table class="table item-table">
                                                        <thead class="mb-2">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Deskripsi</th>
                                                                <th class="text-right">Jumlah</th>
                                                                <th class="text-center">Hapus</th>
                                                            </tr>
                                                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                            @foreach ($items as $index => $item)

                                                                <tr>
                                                                    <td>{{ $loop->index +1 }}</td>
                                                                    <td>{{ $item->billing }}</td>
                                                                    <td>{{ number_format($item->amount,0) }}</td>
                                                                    <td class="text-center">
                                                                        <form action="/admin/pembayaran/{{ $item->id }}" method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-icon btn-rounded" onclick="return confirm('Apakah anda yakin?')"><i class="far fa-trash-alt"></i></button>
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

                                <div class="col-xl-3">
                                    
                                    <div class="invoice-actions text-center p-4">
                                        <h5 class="m-0">{{ number_format($total,0) }}</h5>
                                    </div>

                                    <div class="invoice-actions-btn">
                                        <div class="invoice-action-btn">

                                            <div class="row">
                                                <div class="col-xl-12 col-md-4 d-none">
                                                    <a href="javascript:void(0);" class="btn btn-primary btn-send">Kirim</a>
                                                </div>
                                                <div class="col-xl-12 col-md-4">
                                                    <a href="/admin/pembayaran/view/{{ $invoice }}" class="btn btn-secondary btn-preview">Tampilkan</a>
                                                </div>
                                                <div class="col-xl-12 col-md-4">
                                                    <a href="/admin/pembayaran" class="btn btn-success btn-download">Simpan</a>
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
    {{-- <script src="{{ asset('src/assets/js/apps/invoice-add.js') }}"></script> --}}
    <!-- END PAGE LEVEL SCRIPTS -->     
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    {{-- <script src="{{ asset('src/assets/js/scrollspyNav.js') }}"></script> --}}
    <script src="{{ asset('src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    {{-- <script src="{{ asset('src/plugins/src/flatpickr/custom-flatpickr.js') }}"></script> --}}
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        var f1 = flatpickr(document.getElementById('date'));

        // Make sure to get the 'ids' value initially
        let ids = document.getElementById('ids').value;

        // Function to get billing and payment data
        function getBillingPayment(ids) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('name').value = data.student.name;
                    document.getElementById('payment_category').value = data.student.payment_category;
                    console.log(data);

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
                    document.getElementById('is_once').value = '';
                    document.getElementById('is_monthly').value = '';
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
                    document.getElementById('is_once').value = data.is_once;
                    document.getElementById('is_monthly').value = data.is_monthly;
                }
            };
            xhr.open('GET', '/admin/tagihan/sisa/' + id + '/' + ids + '/' + name, true);
            xhr.send();
        });
    </script>

@endsection