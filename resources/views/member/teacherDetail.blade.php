@extends('templates.navbar')

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/components/list-group.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/users/user-profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/components/list-group.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/users/user-profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/elements/alert.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/croppie/croppie.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/flatpickr/flatpickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/flatpickr/custom-flatpickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}">
    <!--  END CUSTOM STYLE FILE  -->

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
                                                @if ($teacher)
                                                    <img src="{{ $teacher->image ? asset('storage/member/' . $teacher->image) : '/src/assets/img/no.png' }}" id="imgPreview" alt="avatar">
                                                @else
                                                    <img src="/src/assets/img/no.png" id="imgPreview" alt="avatar">
                                                @endif
                                            </a>
                                            <input type='file' class='form-control d-none p-1' name='upload_image' id='upload_image' accept='.jpg'>
                                        </form>
                                        <p class="mb-0">{{ $teacher ? $teacher->name : '.. nama ..' }}</p>
                                        <ul class="contacts-block list-unstyled mb-4">
                                            <li class="contacts-block__item">
                                                {{ !$teacher ? '.. status ..' : ($teacher->active == 1 ? 'Active' : 'Suspend') }}
                                            </li>
                                        </ul> 
                                    </div>            
                                </div>
                            </div>
                        </div>
                            <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
                                <div class="usr-tasks ">
                                    <div class="widget-content widget-content-area">
                                        <form action="{{ $teacher ? '/admin/guru/' . $teacher->id : '/admin/guru' }}" method="post">
                                            <div class="row">
                                            <h3 class="">Biodata</h3>
                                            @csrf
                                            <input type="hidden" name="_method" id="methodField" value="{{ $teacher ? 'PATCH' : '' }}">
                                            <div class="col-md-6 mb-4">
                                                <label for="nig" class="form-label">NIG</label>
                                                <input type="hidden" class="form-control form-control" name="id" id="id" value="{{ $teacher ? $teacher->id : '' }}">
                                                <input type="number" class="form-control form-control" name="nig" id="nig" value="{{ $teacher ? $teacher->nig : '' }}" required>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" class="form-control form-control" name="name" id="name" value="{{ $teacher ? $teacher->name : '' }}" required>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="nickname" class="form-label">Panggilan</label>
                                                <input type="text" class="form-control form-control" name="nickname" id="nickname" value="{{ $teacher ? $teacher->nickname : '' }}" required>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select type="text" class="form-select form-select" name="gender" id="gender" required>
                                                    <option selected disabled value="{{ $teacher ? $teacher->gender : '' }}">{{ $teacher ? $teacher->gender : 'Pilih...' }}</option>
                                                    <option>Laki-laki</option>
                                                    <option>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="active" class="form-label">Status</label required>
                                                <select type="text" class="form-select form-select" name="active" id="active" required>
                                                    <option selected disabled value="{{ $teacher ? $teacher->active : '' }}">{{ !$teacher ? 'Pilih...' : ($teacher->active == 1 ? 'Active' : 'Suspend') }}</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Suspend</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label for="birth_place" class="form-label">Tempat & Tgl Lahir</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control form-control" name="birth_place" id="birth_place" value="{{ $teacher ? $teacher->birth_place : '' }}" required>
                                                    <input type="text" class="form-control form-control" name="birth_date" id="birth_date" value="{{ $teacher ? $teacher->birth_date : '' }}" required>
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
                                                <input type="text" class="form-control form-control" name="address" id="address" value="{{ $teacher ? $teacher->address : '' }}">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="hamlet" class="form-label">Kampung</label>
                                                <input type="text" class="form-control form-control" name="hamlet" id="hamlet" value="{{ $teacher ? $teacher->hamlet : '' }}">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="village" class="form-label">Desa</label>
                                                <input type="text" class="form-control form-control" name="village" id="village" value="{{ $teacher ? $teacher->village : '' }}">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="district" class="form-label">Kecamatan</label>
                                                <input type="text" class="form-control form-control" name="district" id="district" value="{{ $teacher ? $teacher->district : '' }}">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="city" class="form-label">Kabupaten</label>
                                                <input type="text" class="form-control form-control" name="city" id="city" value="{{ $teacher ? $teacher->city : '' }}">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="postal_code" class="form-label">Kode Pos</label>
                                                <input type="number" class="form-control form-control" name="postal_code" id="postal_code" value="{{ $teacher ? $teacher->postal_code : '' }}">
                                            </div>
                                            <hr>
                                            <div class="col-md-4 mb-4">
                                                <label for="phone" class="form-label">Telephone</label>
                                                <input type="text" class="form-control form-control" name="phone" id="phone" value="{{ $teacher ? $teacher->phone : '' }}" required>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="registered" class="form-label">Tahun Masuk</label>
                                                <input type="number" class="form-control form-control" name="registered" id="registered" value="{{ $teacher ? $teacher->registered : session('school.period') }}" required>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="grade" class="form-label">Grade</label>
                                                <input type="number" class="form-control form-control" name="grade" id="grade" value="{{ $teacher ? $teacher->grade : '' }}">
                                            </div>
                                            <hr>
                                            <div class="col-md-4 mb-4">
                                                <label for="resign" class="form-label">Tahun Resign</label>
                                                <input type="text" class="form-control form-control" name="resign" id="resign" value="{{ $teacher ? $teacher->resign : '-' }}">
                                            </div>
                                            <div class="col-md-8 mb-4">
                                                <label for="update_job" class="form-label">Pekerjaan Selanjutnya</label>
                                                <input type="text" class="form-control form-control" name="update_job" id="update_job" value="{{ $teacher ? $teacher->update_job : '-' }}">
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <label for="note" class="form-label">Catatan</label>
                                                <input type="text" class="form-control form-control" name="note" id="note" value="{{ $teacher ? $teacher->note : '' }}">
                                            </div>
                                            <div class="mb-2">
                                                <button class="btn btn-primary" type="submit" {{ $teacher && auth()->user()->role < 2 && auth()->user()->name <> $teacher->name ? 'disabled' : '' }}>Simpan</button>
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
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/flatpickr/flatpickr.js') }}"></script>

    <script src="{{ asset('src/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/croppie/croppie.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        var f1 = flatpickr(document.getElementById('birth_date'));

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
                    const id = $('#id').val();
                    console.log('response ok ' + id);
                    $.ajax({
                        url: "/admin/guru/image/" + id,
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
                        },
                        error: function(xhr, status, error) {
                            // Handle the error here
                            alert(error + ' : Isi data terlebih dulu.');
                        }
                    });
                })
            });
        });
    </script>

@endsection