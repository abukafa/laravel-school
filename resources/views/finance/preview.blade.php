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
                                                                    <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4"><span class="inv-title"></span> <span class="inv-number">{{ $items->first()->invoice }}</span></p>
                                                                    <p class="inv-created-date mt-sm-5 mt-3"><span class="inv-title"></span><span class="inv-date">Tanggal Transaksi</span></p>
                                                                    <p class="inv-due-date"><span class="inv-title"></span> <span class="inv-date">{{ $items->first()->date }}</span></p>
                                                                </div>                                                                
                                                            </div>
                                                            
                                                        </div>
    
                                                        <div class="inv--detail-section inv--customer-detail-section">

                                                            <div class="row">
                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                                    <p class="inv-customer-name">{{ $items->first()->vendor }}</p>
                                                                    <p class="inv-street-addr">{{ $items->first()->account }}</p>
                                                                    <p class="inv-email-address">{{ $items->first()->remark }}</p>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="inv--product-table-section">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead class="">
                                                                        <tr>
                                                                            <th scope="col">No</th>
                                                                            <th scope="col" class="d-table-cell d-lg-none">Tanggal</th>
                                                                            <th scope="col">Penerima</th>
                                                                            <th class="text-end" scope="col">Uraian</th>
                                                                            <th class="text-end" scope="col">Jumlah</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($items as $index => $item)
                                                                            <tr>
                                                                                <td>{{ $loop->index +1 }}</td>
                                                                                <td class="d-table-cell d-lg-none">{{ $item->date }}</td>
                                                                                <td>{{ $item->vendor }}</td>
                                                                                <td class="text-end">{{ $item->description }}</td>
                                                                                <td class="text-end">{{ number_format($item->amount,0) }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="inv--total-amounts">
                                                        
                                                            <div class="row mt-4">
                                                                <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                                </div>
                                                                <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                                    <div class="text-sm-end">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-7 grand-total-title mt-3">
                                                                                <h4 class="">Total : </h4>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5 grand-total-amount mt-3">
                                                                                <h4 class="">{{ number_format($total,0) }}</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="inv--note">

                                                            <div class="row mt-4">
                                                                <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                                    <em>Jazaakumullahu khoiron kathiron.</em>
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
                                                @php
                                                    $date = date("Y-m-d", strtotime($items->first()->date . '+1 week'));
                                                @endphp
                                                <div class="col-xl-12 col-md-3 col-sm-6">
                                                    <a href="{{ (session('user.role') < 5 && $date < date('Y-m-d')) ? '#' : '/admin/keuangan/inv/' . $items->first()->invoice }}" class="btn btn-dark btn-edit" @if ($date < date('Y-m-d')) onclick="alert('Tanggal Expired.. Invoice tidak bisa diedit..')" @endif>Edit</a>
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