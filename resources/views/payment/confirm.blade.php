@extends('templates.navbar')

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css') }}">
    <!-- END PAGE LEVEL CUSTOM STYLES -->

@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">
                <div class="row mt-4">
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <table class="multi-table table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Salary</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center dt-no-sorting">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>$320,800</td>
                                            <td>
                                                <div class="t-dot bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="Normal"></div>
                                            </td>
                                            <td class="text-center"> <button class="btn btn-primary">view</button> </td>
                                        </tr>
                                        <tr>
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>$433,060</td>
                                            <td>
                                                <div class="t-dot bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="Low"></div>
                                            </td>
                                            <td class="text-center"> <button class="btn btn-primary">view</button> </td>
                                        </tr>
                                        <tr>
                                            <td>Sonya Frost</td>
                                            <td>Software Engineer</td>
                                            <td>Edinburgh</td>
                                            <td>23</td>
                                            <td>$103,600</td>
                                            <td>
                                                <div class="t-dot bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="Medium"></div>
                                            </td>
                                            <td class="text-center"> <button class="btn btn-primary">view</button> </td>
                                        </tr>
                                        <tr>
                                            <td>Quinn Flynn</td>
                                            <td>Support Lead</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>$342,000</td>
                                            <td>
                                                <div class="t-dot bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="High"></div>
                                            </td>
                                            <td class="text-center"> <button class="btn btn-primary">view</button> </td>
                                        </tr>
                                        <tr>
                                            <td>Dai Rios</td>
                                            <td>Personnel Lead</td>
                                            <td>Edinburgh</td>
                                            <td>35</td>
                                            <td>$217,500</td>
                                            <td>
                                                <div class="t-dot bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="Normal"></div>
                                            </td>
                                            <td class="text-center"> <button class="btn btn-primary">view</button> </td>
                                        </tr>
                                        <tr>
                                            <td>Gavin Joyce</td>
                                            <td>Developer</td>
                                            <td>Edinburgh</td>
                                            <td>42</td>
                                            <td>$92,575</td>
                                            <td>
                                                <div class="t-dot bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="High"></div>
                                            </td>
                                            <td class="text-center"> <button class="btn btn-primary">view</button> </td>
                                        </tr>
                                        <tr>
                                            <td>Martena Mccray</td>
                                            <td>Post-Sales support</td>
                                            <td>Edinburgh</td>
                                            <td>46</td>
                                            <td>$324,050</td>
                                            <td>
                                                <div class="t-dot bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="Medium"></div>
                                            </td>
                                            <td class="text-center"> <button class="btn btn-primary">view</button> </td>
                                        </tr>
                                        <tr>
                                            <td>Jennifer Acosta</td>
                                            <td>Junior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>43</td>
                                            <td>$75,650</td>
                                            <td>
                                                <div class="t-dot bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="High"></div>
                                            </td>
                                            <td class="text-center"> <button class="btn btn-primary">view</button> </td>
                                        </tr>
                                        <tr>
                                            <td>Shad Decker</td>
                                            <td>Regional Director</td>
                                            <td>Edinburgh</td>
                                            <td>51</td>
                                            <td>$183,000</td>
                                            <td>
                                                <div class="t-dot bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="Low"></div>
                                            </td>
                                            <td class="text-center"> <button class="btn btn-primary">view</button> </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Salary</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('src/assets/js/custom.js') }}"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/jszip.min.js') }}"></script>    
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/custom_miscellaneous.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->     
    
@endsection