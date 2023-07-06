@extends('templates.main')

    <link href="/src/assets/css/light/authentication/auth-cover.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/authentication/auth-cover.css" rel="stylesheet" type="text/css" />

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="../src/assets/css/light/elements/alert.css">
    <link rel="stylesheet" type="text/css" href="../src/assets/css/dark/elements/alert.css">
    <!--  END CUSTOM STYLE FILE  -->

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>
                        
                    <div class="auth-cover">
    
                        <div class="position-relative">
    
                            <img src="../src/assets/img/auth-cover.svg" alt="auth-img">
    
                            <h3 class="mt-5 text-white font-weight-bolder px-2">Aplikasi Managemen Sekolah</h3>
                            <p class="text-white px-2">Homeschooling Alquran Bina Insani</p>
                        </div>
                        
                    </div>

                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-body">
    
                            <div class="row">
                                <div class="col-md-12 mb-5 d-flex align-items-center">
                                    <img src="/src/assets/img/logo.png" alt="auth-img" width="100" class="img-fluid">
                                    <div class="ms-4 mt-3">
                                        <h2 class="mb-0">Login</h2>
                                        <p>Masukan nama pengguna</p>
                                    </div>
                                </div>
                                
                                @if(session()->has('loginError'))
                                <div class="col-md-12">
                                    <div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4" role="alert">
                                        <svg> ... </svg>
                                        <strong>Login Gagal..</strong> Silahkan coba lagi..
                                    </div> 
                                </div> 
                                @endif

                                <form action="/login" method="post">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                                <label class="form-check-label" for="form-check-default">
                                                    Tetap masuk
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-secondary w-100">Masuk</button>
                                        </div>
                                    </div>
                                </form>
                                
                                <div class="col-12">
                                    <div class="">
                                        <div class="seperator">
                                            <hr>
                                            <div class="text-center d-lg-none"><h3>Aplikasi Managemen Sekolah</h3></div>
                                            <div class="seperator-text"> <span>Homeschooling Alquran bina Insani</span></div>
                                            <div class="text-center">
                                                <p class="text-muted mb-0">Code by <a href="javascript:void(0);" class="text-warning">Semangkamedia</a></p>
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