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
                                        <h4 class="p-0 mt-2">Akun Transaksi</h4>
                                        <button type="button" class="btn btn-sm btn-primary inputAcoount" data-bs-toggle="modal" data-bs-target="#accountModal">Tambah</button>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Akun</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Deskripsi</th>
                                                <th class="text-center" scope="col">Opsi</th>
                                            </tr>
                                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($accounts as $index => $account)    
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $account->number }}</td>
                                                <td>{{ $account->unit }}</td>
                                                <td>{{ $account->description }}</td>
                                                <td class="text-center">
                                                    <div class="action-btns">
                                                        <button class="btn btn-outline-secondary btn-icon btn-rounded editAccount" data-id="{{ $account->id }}" data-bs-toggle="modal" data-bs-target="#accountModal">
                                                            <span class="far fa-edit"></span>
                                                        </button>
                                                        <form action="/admin/akun/{{ $account->id }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-outline-danger btn-icon btn-rounded" onclick="return confirm('Apakah anda yakin?')"><i class="far fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                            </tr>
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
    <div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle"></i><span class="icon-name"> times-circle</span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="number" class="col-sm-3 col-form-label"><p>Kode Akun</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="number" id="number" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="unit" class="col-sm-3 col-form-label"><p>Unit Akun</p></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="unit" id="unit" onchange="numAccount(this.value)" required>
                                    <option selected disabled value="">Pilih...</option>
                                    <option>Pembayaran</option>
                                    <option>Pemasukan</option>
                                    <option>Pengeluaran</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3" id="optional">
                            <label for="allocation" class="col-sm-3 col-form-label"><p>Alokasi</p></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="allocation" id="allocation" onchange="allocAccount(this.value)">
                                    <option selected disabled value="">Pilih...</option>
                                    @foreach ($accounts as $account)
                                        @if ($account->unit == 'Pembayaran')
                                            <option value="{{ $account->number }}">{{ $account->number . ' - ' . $account->description }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-sm-3 col-form-label"><p>Deskripsi</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="description" id="description" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="detail" class="col-sm-3 col-form-label"><p>Keterangan</p></label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="detail" id="detail">
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
        document.getElementById('optional').style.display = 'none';
        function numAccount(unit)
        {
            if(unit === 'Pengeluaran'){
                document.getElementById('optional').style.display = '';
                document.getElementById('number').value = '3300' + (Math.floor(Math.random() * 100) % 100).toString().padStart(2, '0');
            } else if (unit === 'Pemasukan') {
                document.getElementById('optional').style.display = 'none';
                document.getElementById('number').value = '2200' + (Math.floor(Math.random() * 100) % 100).toString().padStart(2, '0');
            } else if (unit === 'Pembayaran') {
                document.getElementById('optional').style.display = 'none';
                document.getElementById('number').value = '11' + (Math.floor(Math.random() * 100) % 100).toString().padStart(2, '0') + (Math.floor(Math.random() * 100) % 100).toString().padStart(2, '0');
            }
        }

        function allocAccount(acc)
        {
            const toStr = acc.toString();
            const oldStr = document.getElementById('number').value;
            const newStr = oldStr.substring(0, 2) + toStr.substring(2, 4) + oldStr.substring(4);
            document.getElementById('number').value = newStr;

        }
                
        document.querySelectorAll('.editAccount').forEach(function(element) {
            element.addEventListener('click', function() {
                const id = this.dataset.id;
                document.getElementById('accountModalLabel').innerHTML = 'Edit Data <b>Akun</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/admin/akun/' + id);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/admin/akun/' + id);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        document.getElementById('number').value = data.account.number;
                        document.getElementById('unit').value = data.account.unit;
                        document.getElementById('description').value = data.account.description;
                        document.getElementById('detail').value = data.account.detail;
                        document.getElementById('allocation').value = data.account.allocation;
                        document.getElementById('methodField').value = 'PATCH';
                        if (data.account.unit === 'Pengeluaran'){
                            document.getElementById('optional').style.display = '';
                        }else{
                            document.getElementById('optional').style.display = 'none';
                        }
                    }
                };
                xhr.send();
            });
        });

        document.querySelectorAll('.inputAcoount').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('accountModalLabel').innerHTML = 'Input Data <b>Akun</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/admin/akun');
                document.getElementById('number').value = '';
                document.getElementById('unit').value = '';
                document.getElementById('description').value = '';
                document.getElementById('detail').value = '';
                document.getElementById('methodField').value = '';
                document.getElementById('optional').style.display = 'none';
            });
        });
    </script>

@endsection