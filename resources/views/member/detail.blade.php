@extends('templates.navbar')

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/components/list-group.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/users/user-profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/components/list-group.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/users/user-profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/elements/alert.css') }}">
    <!--  END CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/croppie/croppie.css') }}">

@section('content')

    <!-- Content -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing mt-4">
            <div class="middle-content container-xxl p-0">
                <div class="layout-top-spacing">
                    <div class="row layout-spacing">
                        
                        <!-- FLASH ALERT -->
                        @if (session()->has('success') || session()->has('danger'))
                        <div class="col-12">
                            <div class="alert alert-icon-left alert-light-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show mb-4" role="alert">
                                <button type="button" class="btn-close mt-1" data-bs-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                                <strong>{{ session('success') ?: session('danger') }}.</strong>
                            </div>
                        </div>
                        @endif

                        <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 mb-4">
                            <div class="user-profile">
                                <div class="widget-content widget-content-area">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="mb-2">Profile</h3>
                                    </div>
                                    <div class="text-center user-info">
                                        <form action="/image" method="post" enctype="multipart/form-data">
                                            <a href="javascript:void(0);" id="uploaded_image">
                                                @if ($student)
                                                    <img src="{{ $student->image ? 'storage/' . $student->image : '/src/assets/img/no.png' }}" id="imgPreview" alt="avatar">
                                                @else
                                                    <img src="/src/assets/img/no.png" id="imgPreview" alt="avatar">
                                                @endif
                                            </a>
                                            <input type='file' class='form-control d-none p-1' name='upload_image' id='upload_image' accept='.jpg'>
                                        </form>
                                        <p class="mb-0">{{ $student ? optional($student->name) : '.. nama ..' }}</p>
                                        <ul class="contacts-block list-unstyled mb-4">
                                            <li class="contacts-block__item">
                                                {{ $student ? optional($student->rumble) : '.. kelas ..' }}
                                            </li>
                                        </ul> 
                                    </div>            
                                </div>
                            </div>
                        </div>
                            <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
                                <div class="usr-tasks ">
                                    <div class="widget-content widget-content-area">
                                        <form action="/password" method="post">
                                            <div class="row">
                                            <h3 class="">Biodata</h3>
                                            @csrf
                                            <div class="col-md-6 mb-4">
                                                <label for="nis" class="form-label">NIS</label>
                                                <input type="text" class="form-control form-control" name="nis" id="nis">
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" class="form-control form-control" name="name" id="name">
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="nickname" class="form-label">Panggilan</label>
                                                <input type="text" class="form-control form-control" name="nickname" id="nickname">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="gender" class="form-label">Gender</label>
                                                <input type="text" class="form-control form-control" name="gender" id="gender">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="rumble" class="form-label">Kelas</label>
                                                <input type="text" class="form-control form-control" name="rumble" id="rumble">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="father_birth" class="form-label">Tempat & Tgl Lahir</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control form-control" name="father_birth" id="birth_place">
                                                    <input type="text" class="form-control form-control" name="birth_date" id="birth_date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="usr-tasks ">
                                    <div class="widget-content widget-content-area">
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                <label for="address" class="form-label">Alamat</label>
                                                <input type="text" class="form-control form-control" name="address" id="address">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="hamlet" class="form-label">Kampung</label>
                                                <input type="text" class="form-control form-control" name="hamlet" id="hamlet">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="Village" class="form-label">Desa</label>
                                                <input type="text" class="form-control form-control" name="Village" id="Village">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="district" class="form-label">Kecamatan</label>
                                                <input type="text" class="form-control form-control" name="district" id="district">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="city" class="form-label">Kabupaten</label>
                                                <input type="text" class="form-control form-control" name="city" id="city">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="postal_code" class="form-label">Kode Pos</label>
                                                <input type="text" class="form-control form-control" name="postal_code" id="postal_code">
                                            </div>
                                            <hr>
                                            <div class="col-md-4 mb-4">
                                                <label for="hobby" class="form-label">Hobby</label>
                                                <input type="text" class="form-control form-control" name="hobby" id="hobby">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="sport" class="form-label">Olahraga</label>
                                                <input type="text" class="form-control form-control" name="sport" id="sport">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="ambition" class="form-label">Cita-cita</label>
                                                <input type="text" class="form-control form-control" name="ambition" id="ambition">
                                            </div>
                                            <hr>
                                            <div class="col-md-4 mb-4">
                                                <label for="father" class="form-label">Nama Ayah</label>
                                                <input type="text" class="form-control form-control" name="father" id="father">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="father_birth" class="form-label">Tgl Lahir</label>
                                                <input type="text" class="form-control form-control" name="father_birth" id="father_birth">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="father_note" class="form-label">Ket</label>
                                                <select type="text" class="form-select form-select" name="father_note" id="father_note">
                                                    <option>Tinggal bersama</option>
                                                    <option>Bekerja di luar kota</option>
                                                    <option>Sudah meninggal</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="mother" class="form-label">Nama Ibu</label>
                                                <input type="text" class="form-control form-control" name="mother" id="mother">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="mother_birth" class="form-label">Tgl Lahir</label>
                                                <input type="text" class="form-control form-control" name="mother_birth" id="mother_birth">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="mother_note" class="form-label">Ket</label>
                                                <select type="text" class="form-select form-select" name="mother_note" id="mother_note">
                                                    <option>Tinggal bersama</option>
                                                    <option>Bekerja di luar kota</option>
                                                    <option>Sudah meninggal</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="phone" class="form-label">Telepon</label>
                                                <input type="text" class="form-control form-control" name="phone" id="phone">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="job" class="form-label">Pekerjaan</label>
                                                <input type="text" class="form-control form-control" name="job" id="job">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="income" class="form-label">Penghasilan</label>
                                                <input type="text" class="form-control form-control" name="income" id="income">
                                            </div>
                                            <hr>
                                            <div class="col-md-4 mb-4">
                                                <label for="image" class="form-label">Foto Profil</label>
                                                <input type="text" class="form-control form-control" name="image" id="image">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="payment_category" class="form-label">Pembayaran</label>
                                                <input type="text" class="form-control form-control" name="payment_category" id="payment_category">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="graduation" class="form-label">Kelulusan</label>
                                                <input type="text" class="form-control form-control" name="graduation" id="graduation">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="next_school" class="form-label">Sekolah Lanjutan</label>
                                                <input type="text" class="form-control form-control" name="next_school" id="next_school">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="next_school_address" class="form-label">Alamat Sekolah</label>
                                                <input type="text" class="form-control form-control" name="next_school_address" id="next_school_address">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="note" class="form-label">Catatan</label>
                                                <input type="text" class="form-control form-control" name="note" id="note">
                                            </div>
                                            <div class="mb-2">
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uploadimageModal" tabindex="-1" aria-labelledby="ModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Upload & Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col text-center">
                            <div id="image_demo" style="width:350px; margin-top:30px"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary crop_image">Crop & Upload Image</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('src/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/croppie/croppie.js') }}"></script>
    <script>
        $('#uploaded_image').click(function() {
            $('#upload_image').trigger('click')
        });

        $(document).ready(function() {

            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square' //circle
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });

            $('#upload_image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });

            $('.crop_image').click(function(event) {
                console.log('click');
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response) {
                    console.log('response ok');
                    $.ajax({
                        url: "/image",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        type: "POST",
                        data: {
                            "image": response
                        },
                        success: function(data) {
                            $('#uploadimageModal').modal('hide');
                            $('#imgPreview').attr('src', data.image_path);
                            console.log(data);
                        }
                    });
                })
            });
        });
    </script>

@endsection