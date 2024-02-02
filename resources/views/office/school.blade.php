@extends('templates.navbar')

@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing mt-4">
            <div class="middle-content container-xxl p-0">
                <div class="row">
                    <div id="flLoginForm" class="col-lg-12 layout-spacing">

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
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Data Sekolah</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form class="row g-3" action="/admin/sekolah" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nama Sekolah</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $school ? $school->name : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="nickname" class="form-label">Inisial</label>
                                        <input type="text" class="form-control" id="nickname" name="nickname" value="{{ $school ? $school->nickname : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="npsn" class="form-label">NPSN</label>
                                        <input type="number" class="form-control" id="npsn" name="npsn" value="{{ $school ? $school->npsn : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="organization" class="form-label">Yayasan</label>
                                        <input type="text" class="form-control" id="organization" name="organization" value="{{ $school ? $school->organization : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="permit" class="form-label">Izin Operasional</label>
                                        <input type="text" class="form-control" id="permit" name="permit" value="{{ $school ? $school->permit : '' }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="address" class="form-label">Alamat Sekolah</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $school ? $school->address : '' }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="map" class="form-label">Tautan Lokasi Sekolah</label>
                                        <input type="url" class="form-control" id="map" name="map" value="{{ $school ? $school->map : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Telepon</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $school ? $school->phone : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $school ? $school->email : '' }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="motto" class="form-label">Motto Sekolah</label>
                                        <input type="text" class="form-control" id="motto" name="motto" value="{{ $school ? $school->motto : '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="period" class="form-label">Periode</label>
                                        <input type="text" class="form-control" id="period" name="period" value="{{ $school ? $school->period : '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="head" class="form-label">Kepala Sekolah</label>
                                        <input type="text" class="form-control" id="head" name="head" value="{{ $school ? $school->head : '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="contact" class="form-label">Kontak Admin</label>
                                        <input type="text" class="form-control" id="contact" name="contact" value="{{ $school ? $school->contact : '' }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="notes" class="form-label">Catatan</label>
                                        <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"></textarea>
                                        {{-- <input type="text" class="form-control" id="notes" name="notes" value="{{ $school ? $school->notes : '' }}"> --}}
                                    </div>
                                    <div class="col-6">
                                        <label for="logo" class="form-label">Logo</label>
                                        <input type="file" class="form-control" id="logo" name="logo" value="{{ $school ? $school->logo : '' }}">
                                        <img src="{{ $school->logo ? asset('storage/logo.png') : '/src/assets/img/logo.png' }}" width="250" alt="logo" id="imgPreview">
                                    </div>
                                    <div class="col-12 mt-2">
                                        <button type="submit" disabled class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
