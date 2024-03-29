@extends('templates.navbar')

    <!-- BEGIN PAGE LEVEL STYLE -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/fullcalendar/fullcalendar.min.css') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/fullcalendar/custom-fullcalendar.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/components/modal.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/fullcalendar/custom-fullcalendar.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/components/modal.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/flatpickr/flatpickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/flatpickr/custom-flatpickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}">
    <!-- END PAGE LEVEL STYLE -->

@section('content')

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">

                <div class="row layout-top-spacing layout-spacing" id="cancel-row">

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

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="calendar-container">
                            <div class="calendar"></div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="event-form" action="/admin/kalendar" method="post">
                                <input type="hidden" name="_method" id="methodInput" value="">
                                <div class="modal-body">
                                    <div class="row">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="">
                                                <label class="form-label">Judul</label>
                                                <input id="title" name="title" type="text" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <div class="">
                                                <label class="form-label">Deskripsi</label>
                                                <input id="description" name="description" type="text" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <div class="">
                                                <label class="form-label">Tanggal Awal</label>
                                                <input id="start_date" name="start_date" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <div class="">
                                                <label class="form-label">Tanggal Akhir</label>
                                                <input id="end_date" name="end_date" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-12">

                                            <div class="d-flex mt-4">
                                                <div class="n-chk">
                                                    <div class="form-check form-check-primary form-check-inline">
                                                        <input class="form-check-input" type="radio" name="remark" value="Learning" id="remark" name="remark">
                                                        <label class="form-check-label" for="remark" name="remark">Learning</label>
                                                    </div>
                                                </div>
                                                <div class="n-chk">
                                                    <div class="form-check form-check-warning form-check-inline">
                                                        <input class="form-check-input" type="radio" name="remark" value="Project" id="remark" name="remark">
                                                        <label class="form-check-label" for="remark" name="remark">Project</label>
                                                    </div>
                                                </div>
                                                <div class="n-chk">
                                                    <div class="form-check form-check-success form-check-inline">
                                                        <input class="form-check-input" type="radio" name="remark" value="Activity" id="remark" name="remark" checked>
                                                        <label class="form-check-label" for="remark" name="remark">Activity</label>
                                                    </div>
                                                </div>
                                                <div class="n-chk">
                                                    <div class="form-check form-check-danger form-check-inline">
                                                        <input class="form-check-input" type="radio" name="remark" value="Important" id="remark" name="remark">
                                                        <label class="form-check-label" for="remark" name="remark">Important</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer foot-event">
                                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-update-event">Update</button>
                                    <button type="submit" class="btn btn-primary btn-add-event">Add Event</button>
                                </div>
                            </form>
                                <div class="modal-footer foot-delete">
                                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                    <form id="form-delete-event" action="/pengguna/" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-delete-event" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                                    </form>
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
    <script src="{{ asset('src/plugins/src/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/uuid/uuid4.min.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="{{ asset('src/plugins/src/fullcalendar/custom-fullcalendar.js') }}"></script>
    <script src="{{ asset('src/plugins/src/flatpickr/custom-flatpickr.js') }}"></script>
    <script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->

    <script>
        // var f1 = flatpickr(document.getElementById('start'));
        // var f1 = flatpickr(document.getElementById('end'));

        let eventLists = {!! json_encode($events) !!};
    </script>

@endsection
