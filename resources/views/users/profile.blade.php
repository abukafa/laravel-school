@extends('templates.navbar')
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="../src/assets/css/light/components/list-group.css" rel="stylesheet" type="text/css">
    <link href="../src/assets/css/light/users/user-profile.css" rel="stylesheet" type="text/css" />
    <link href="../src/assets/css/dark/components/list-group.css" rel="stylesheet" type="text/css">
    <link href="../src/assets/css/dark/users/user-profile.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../src/assets/css/light/elements/alert.css">
    <link rel="stylesheet" type="text/css" href="../src/assets/css/dark/elements/alert.css">
    <!--  END CUSTOM STYLE FILE  -->
    <link href="../src/plugins/src/croppie/croppie.css" rel="stylesheet" type="text/css">

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
                                                <img src="{{ $user->image ? 'storage/' . $user->image : '/src/assets/img/no.png' }}" id="imgPreview" alt="avatar">
                                            </a>
                                            <input type='file' class='form-control d-none p-1' name='upload_image' id='upload_image' accept='.jpg'>
                                        </form>
                                        <p class="mb-0">{{ session('user.name') }}</p>
                                        <ul class="contacts-block list-unstyled mb-4">
                                            <li class="contacts-block__item">
                                                {{ session('user.position') . ' ' . session('user.division') }}
                                            </li>
                                        </ul> 
                                    </div>            
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
                            <div class="usr-tasks ">
                                <div class="widget-content widget-content-area">
                                    <h3 class="">Password</h3>
                                    <form class="row" action="/password" method="post">
                                        @csrf
                                        <div class="col-12 mb-4">
                                            <label for="current_password" class="form-label">Password Lama</label>
                                            <input type="password" class="form-control form-control-sm" name="current_password" id="current_password">
                                            @error('current_password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="password" class="form-label">Password Baru</label>
                                            <input type="password" class="form-control form-control-sm" name="password" id="password">
                                            <input type="password" class="form-control form-control-sm mt-2" name="password_confirmation" id="password_confirmation">
                                            @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mt-4">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
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
    <script src="../src/assets/js/jquery.min.js"></script>
    <script src="../src/plugins/src/croppie/croppie.js"></script>
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