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
                                                <h5>Rincian Tagihan</h5>
                                            </div>
                                            <form action="/admin/tagihan" method="POST">
                                                <div class="invoice-detail-header">
                                                    <div class="row g-3">
                                                        @csrf
                                                        <div class="col-md-6">
                                                            <label for="year" class="form-label">Tahun Pembayaran</label>
                                                            <input type="text" class="form-control" name="year" id="year" value="{{ $items ? $items->first()->year : $year }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="category" class="form-label">Kategori Pembayaran</label>
                                                            <input type="text" class="form-control" list="kategory" name="category" id="category" value="{{ $items ? $items->first()->category : '' }}" required>
                                                            <datalist id="kategory">
                                                                @if ($categories)
                                                                    @foreach($categories as $item)
                                                                        <option value="{{ $item->category }}">
                                                                    @endforeach
                                                                @endif
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-detail-items mt-4">
                                                    <div class="table-responsive">
                                                        <table class="table item-table align-middle">
                                                            <thead class="mb-2">
                                                                <tr class="text-center">
                                                                    <th class="w-25">Akun</th>
                                                                    <th>Tagihan</th>
                                                                    <th class="text-right w-25">Jumlah</th>
                                                                    <th>Sekali</th>
                                                                    <th>Bulanan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                                @foreach ($accounts as $i => $account)
                                                                    @if ($account->unit == 'Pembayaran')
                                                                        <tr>
                                                                            <td>
                                                                                <input type="text" class="form-control text-center" name="account[]" id="account" value="{{ $account->number }}">
                                                                            </td>
                                                                            <td>
                                                                                @php
                                                                                    $matchingItem = $items ? $items->firstWhere('account', $account->number) : '';
                                                                                @endphp
                                                                                <input type="text" class="form-control" name="name[]" id="name" value="{{ $matchingItem ? $matchingItem->name : $account->description }}">
                                                                            </td>

                                                                            <td>
                                                                                <input type="hidden" class="form-control text-end" name="id[]" value="{{ $matchingItem ? $matchingItem->id : '0' }}">
                                                                                <input type="text" class="form-control text-end" name="amount[]" value="{{ $matchingItem ? $matchingItem->amount : '0' }}">
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="form-check form-switch form-check-inline mt-1">
                                                                                    <input class="form-check-input" type="checkbox" role="switch" name="is_once[{{ $i }}]" id="is_once_{{ $i }}" value="1" {{ $matchingItem && $matchingItem->is_once == 1 ? 'checked' : '' }}>
                                                                                    <label class="form-check-label d-inline d-md-none" for="is_once_{{ $i }}">Sekali</label>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="form-check form-switch form-check-inline mt-1">
                                                                                    <input class="form-check-input" type="checkbox" role="switch" name="is_monthly[{{ $i }}]" id="is_monthly_{{ $i }}" value="1" {{ $matchingItem && $matchingItem->is_monthly == 1 ? 'checked' : '' }}>
                                                                                    <label class="form-check-label d-inline d-md-none" for="is_monthly_{{ $i }}">Bulanan</label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary me-1">Simpan</button>
                                                    <a href="/admin/tagihan" class="btn btn-secondary ms-1">Kembali</a>
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
        document.getElementById('account').addEventListener('change', function() {
            var number = this.value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('remark').value = data.account.description;
                }
            };
            xhr.open('GET', '/admin/akun/no/' + number, true);
            xhr.send();
        });
    </script>

@endsection