@extends('templates.navbar')
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="../src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="../src/assets/css/light/components/modal.css" rel="stylesheet" type="text/css" />
    <link href="../src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="../src/assets/css/dark/components/modal.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->

@section('content')

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing mt-4">
            <div class="middle-content container-xxl p-0">
                <div class="row layout-top-spacing">
                    <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
                    
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
                                        <h4 class="p-0 mt-2">Pengguna</h4>
                                        <button type="button" class="btn btn-sm btn-primary inputUser" data-bs-toggle="modal" data-bs-target="#userModal">Tambah</button>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col" class="d-none d-md-table-cell">Role</th>
                                                <th class="text-center d-none d-sm-table-cell" scope="col">Access</th>
                                                <th class="text-center" scope="col"></th>
                                            </tr>
                                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($users as $user)    

                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <div class="avatar me-2">
                                                            <img src="{{ $user->image ? asset('storage/profile/' . $user->image) : '/src/assets/img/no.png' }}" class="rounded-circle" />
                                                        </div>
                                                        <div class="media-body align-self-center">
                                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                                            <span>{{ $user->username }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    <p class="mb-0">{{ $user->position }}</p>
                                                    <span class="text-{{ $user->role == 5 ? 'warning' : ($user->role == 4 ? 'danger' : ($user->role == 3 ? 'secondary' : ($user->role == 2 ? 'info' : 'success'))) }}">{{ $user->division }}</span>
                                                </td>
                                                <td class="text-center d-none d-sm-table-cell">
                                                    <span class="badge badge-light-{{ $user->role == 5 ? 'warning' : ($user->role == 4 ? 'danger' : ($user->role == 3 ? 'secondary' : ($user->role == 2 ? 'info' : 'success'))) }}">{{ $user->role == 5 ? 'Maintainer' : ($user->role == 1 ? 'User' : ($user->role == 2 ? 'Administrator' : ($user->role == 3 ? 'Supervisor' : 'Auditor'))) }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="action-btns">
                                                        <button class="btn btn-outline-secondary btn-icon btn-rounded editUser" data-id="{{ $user->id }}" data-role="{{ $user->role }}" data-bs-toggle="modal" data-bs-target="#userModal" {{ session('user.role') < $user->role ? 'disabled' : '' }}>
                                                            <span class="far fa-edit"></span>
                                                        </button>
                                                        <form action="/pengguna/{{ $user->id }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-outline-danger btn-icon btn-rounded" onclick="return confirm('Apakah anda yakin?')" {{ session('user.role') < $user->role ? 'disabled' : '' }}><i class="far fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="userModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="far fa-times-circle"></i><span class="icon-name"> times-circle</span>
                                            </button>
                                        </div>
                                        <form action="" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" id="methodField" value="">
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <label for="name" class="col-sm-3 col-form-label"><p>Nama</p></label>
                                                    <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name" id="name" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="username" class="col-sm-3 col-form-label"><p>Username</p></label>
                                                    <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="username" id="username" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" id="viewPassword">
                                                    <label for="password" class="col-sm-3 col-form-label"><p>Password</p></label>
                                                    <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="password" id="password" value="semangka" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="division" class="col-sm-3 col-form-label"><p>Division</p></label>
                                                    <div class="col-sm-9">
                                                    <select class="form-select" name="division" id="division" required>
                                                        <option>Yayasan</option>
                                                        <option>Sekolah</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="position" class="col-sm-3 col-form-label"><p>Position</p></label>
                                                    <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="position" id="position" required>
                                                    </div>
                                                </div>
                                                <fieldset class="row mb-3">
                                                    <legend class="col-form-label col-sm-3 pt-0">Access</legend>
                                                    <div class="col-sm-9">
                                                        <div class="form-check disabled">
                                                            <input class="form-check-input role" type="radio" name="role" id="role5" value="5" {{ session('user.role') < 5 ? 'disabled' : '' }}>
                                                            <label class="form-check-label" for="role5">
                                                            <p> Maintainer</p>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input role" type="radio" name="role" id="role4" value="4" {{ session('user.role') < 4 ? 'disabled' : '' }}>
                                                            <label class="form-check-label" for="role4">
                                                            <p> Auditor</p>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input role" type="radio" name="role" id="role3" value="3" {{ session('user.role') < 3 ? 'disabled' : '' }}>
                                                            <label class="form-check-label" for="role3">
                                                            <p> Supervisor</p>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input role" type="radio" name="role" id="role2" value="2" {{ session('user.role') < 2 ? 'disabled' : '' }}>
                                                            <label class="form-check-label" for="role2">
                                                            <p> Administrator</p>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input role" type="radio" name="role" id="role1" value="1">
                                                            <label class="form-check-label" for="role1">
                                                            <p> User</p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
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

    <script src="../src/plugins/src/highlight/highlight.pack.js"></script>

    <script>
        document.querySelectorAll('.editUser').forEach(function(element) {
            element.addEventListener('click', function() {
                const id = this.dataset.id;
                const role = this.dataset.role;
                document.getElementById('userModalLabel').innerHTML = 'Edit Data <b>Pengguna</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/pengguna/' + id);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/pengguna/' + id);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        document.getElementById('name').value = data.user.name;
                        document.getElementById('username').value = data.user.username;
                        document.getElementById('division').value = data.user.division;
                        document.getElementById('position').value = data.user.position;
                        document.querySelectorAll('.role').forEach(function(radio) {radio.checked = false;});
                        document.getElementById('role' + role).checked = true;
                        document.getElementById('viewPassword').classList.add('d-none');
                        document.getElementById('methodField').value = 'PATCH';
                    }
                };
                xhr.send();
            });
        });

        document.querySelectorAll('.inputUser').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('userModalLabel').innerHTML = 'Input Data <b>Pengguna</b>';
                document.querySelector('.modal-content form').setAttribute('action', '/pengguna');
                document.getElementById('name').value = '';
                document.getElementById('username').value = '';
                document.getElementById('division').value = '';
                document.getElementById('position').value = '';
                document.querySelectorAll('.role').forEach(function(radio) {radio.checked = false;});
                document.getElementById('viewPassword').classList.remove('d-none');
                document.getElementById('methodField').value = '';
            });
        });
    </script>

@endsection