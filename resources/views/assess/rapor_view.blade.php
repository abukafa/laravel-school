@extends('templates.navbar')

<!--  BEGIN CUSTOM STYLE FILE  -->
<link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/apps/invoice-preview.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/apps/invoice-preview.css') }}" />
<!--  END CUSTOM STYLE FILE  -->

@section('content')

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">

                <div class="row invoice layout-top-spacing layout-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                        <div class="doc-container">

                            <div class="row">

                                <div class="col-xl-9">

                                    <div class="invoice-container">
                                        <div class="invoice-inbox">

                                            <div id="ct" class="">

                                                <div class="invoice-00001">
                                                    <div class="content-section">

                                                        <div class="inv--head-section inv--detail-section">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-12 mr-auto">
                                                                    <div class="d-flex">
                                                                        <img class="company-logo" src="{{ $school->logo ? asset('storage/logo.png') : '/src/assets/img/logo.png' }}" alt="company">
                                                                        <h3 class="in-heading align-self-center">{{ $school->nickname }}</h3>
                                                                    </div>
                                                                    <p class="inv-street-addr mt-3">{{ $school->name }}</p>
                                                                    <p class="inv-email-address">{{ $school->email }}</p>
                                                                    <p class="inv-email-address">{{ $school->phone }}</p>
                                                                </div>

                                                                <div class="col-sm-6 text-sm-end">
                                                                    <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4"><span class="inv-title"></span> <span class="inv-number">RAPOR SEMESTER {{ $semester }}</span></p>
                                                                    <p class="inv-created-date"><span class="inv-title"></span><span class="inv-date">{{ $student->name }}</span></p>
                                                                    <p class="inv-due-date"><span class="inv-title"></span> <span class="inv-date">{{ $student->nis }}</span></p>
                                                                    <p class="inv-created-date"><span class="inv-title"></span><span class="inv-date">{{ $student->registered }}</span></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="inv--product-table-section">
                                                            <div class="table-responsive px-4">
                                                                <table>
                                                                    <thead class="text-center">
                                                                        <tr>
                                                                            <th>SUBJECT</th>
                                                                            <th>ITEM</th>
                                                                            <th colspan="2">SCORE</th>
                                                                            <th>DESCRIPTION</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($scores as $item)
                                                                        @php
                                                                            $subject = explode('-', $item->subject);
                                                                        @endphp
                                                                        <tr>
                                                                            <td>{{ trim($subject[0]) }}</td>
                                                                            <td>{{ trim($subject[1]) }}</td>
                                                                            <td>{{ $item->month_6 }}</td>
                                                                            <td>{{ app('convertToGrade')($item->month_6) }}</td>
                                                                            <td style="word-wrap: break-word;">{{ ucfirst($item->competence_1) . $item->competence_2 }}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="inv--note">

                                                            <div class="row mt-4">
                                                                <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                                    <em>Ciamis, {{ date('l j M Y') }}</em>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                </div>

                                <div class="col-xl-3">

                                    <div class="invoice-actions-btn">

                                        <div class="invoice-action-btn">

                                            <div class="row">
                                                <div class="col-xl-12 col-md-3 col-sm-6">
                                                    <a href="javascript:void(0);" class="btn btn-primary btn-print  action-print">Print</a>
                                                </div>
                                                <div class="col-xl-12 col-md-3 col-sm-6">
                                                    <a href="/data/rapor" class="btn btn-dark btn-edit">Kembali</a>
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

    <script src="{{ asset('src/assets/js/apps/invoice-preview.js') }}"></script>

@endsection
