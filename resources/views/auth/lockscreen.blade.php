@extends('templates.main')

    <link href="/src/assets/css/light/authentication/auth-cover.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/authentication/auth-cover.css" rel="stylesheet" type="text/css" />

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="../src/assets/css/light/elements/alert.css">
    <link rel="stylesheet" type="text/css" href="../src/assets/css/dark/elements/alert.css">
    <!--  END CUSTOM STYLE FILE  -->

@section('body')

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex h-100">
        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>
                        
                    <div class="auth-cover">

                        <div class="position-relative">

                            <img src="../src/assets/img/auth-cover.svg" alt="auth-img">
    
                            <h4 class="mt-5 text-white font-weight-bolder px-2">Aplikasi Managemen Sekolah</h4>
                            <p class="text-white px-2">{{ session('school.name') }}</p>
                        </div>
                        
                    </div>

                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="media mb-4">
                                        <div class="avatar avatar-lg me-3">
                                            <img alt="avatar" src="{{ session('user.image') ? asset('storage/' . session('user.image')) : '/src/assets/img/no.png' }}" class="rounded-circle">
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h3 class="mb-0">{{ session('user.name') }}</h3>
                                            <p class="mb-0">Masukan kembali password anda</p>
                                        </div>
                                    </div>
                                </div>

                                @if(session()->has('loginError'))
                                <div class="col-md-12">
                                    <div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                        <strong>Password Salah..</strong> Coba lagi yah..
                                    </div> 
                                </div> 
                                @endif

                                <form action="/lockscreen" method="POST">
                                    @csrf
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control">
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
                                            <div class="seperator-text"> <span>{{ session('school.organization') }}</span></div>
                                            <div class="text-center">
                                                <p class="text-muted mb-0">Code by <a href="https://abukafa.github.io" target="_blank" class="text-warning">Semangkamedia</a></p>
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
@endsection
