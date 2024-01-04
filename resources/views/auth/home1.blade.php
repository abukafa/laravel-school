@extends('templates.navbar')

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/apex/apexcharts.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/dashboard/dash_1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/dashboard/dash_1.css') }}">
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->    

@section('content')

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">

                <div class="row layout-top-spacing">

                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-six">
                            <div class="widget-heading">
                                <h6 class="">Pemasukan</h6>
                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="statistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>

                                        <div class="dropdown-menu left" aria-labelledby="statistics" style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);">View</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-chart">
                                <div class="w-chart-section">
                                    <div class="w-detail">
                                        <p class="w-title">Pembayaran</p>
                                        <p class="w-stats">{{ number_format($total->bayar,0,".",",") }}</p>
                                    </div>
                                    <div class="w-chart-render-one">
                                        <div id="payment-total"></div>
                                    </div>
                                </div>

                                <div class="w-chart-section">
                                    <div class="w-detail">
                                        <p class="w-title">Lain-lain</p>
                                        <p class="w-stats">{{ number_format($total->masuk,0,".",",") }}</p>
                                    </div>
                                    <div class="w-chart-render-one">
                                        <div id="finance-in"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Pengeluaran</h6>
                                    </div>
                                    <div class="task-action">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="expenses" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>

                                            <div class="dropdown-menu left" aria-labelledby="expenses" style="will-change: transform;">
                                                <a class="dropdown-item" href="javascript:void(0);">This Week</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Week</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-content">

                                    <div class="w-info">
                                        <p class="value">Rp. {{ number_format($total->keluar,0,".",",") }} <span></span> 
                                            @if($total->keluar > $total->masuk)
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ff4242" d="M384 160c-17.7 0-32-14.3-32-32s14.3-32 32-32H544c17.7 0 32 14.3 32 32V288c0 17.7-14.3 32-32 32s-32-14.3-32-32V205.3L342.6 374.6c-12.5 12.5-32.8 12.5-45.3 0L192 269.3 54.6 406.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160c12.5-12.5 32.8-12.5 45.3 0L320 306.7 466.7 160H384z"/></svg>
                                            @else
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#386bc2" d="M384 352c-17.7 0-32 14.3-32 32s14.3 32 32 32H544c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32s-32 14.3-32 32v82.7L342.6 137.4c-12.5-12.5-32.8-12.5-45.3 0L192 242.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0L320 205.3 466.7 352H384z"/></svg>
                                            @endif
                                        </p>
                                    </div>
                                    
                                </div>

                                <div class="w-progress-stats">                                            
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ ($total->masuk + $total->keluar) > 0 ? ($total->keluar / ($total->masuk + $total->keluar) * 100) : 0 }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                            <p>{{ round($total->keluar / ($total->masuk + $total->keluar) * 100,2) }}%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-card-three">
                            <div class="widget-content">
                                <div class="account-box">
                                    <div class="info">
                                        <div class="inv-title">
                                            <h5 class="">Total Saldo</h5>
                                        </div>
                                        <div class="inv-balance-info">
                                            <p class="inv-balance">Rp. {{ number_format((($total->bayar + $total->masuk)-$total->keluar),0,".",",") }}</p>
                                            <span class="inv-stats balance-credited">+ 2453</span>
                                        </div>
                                    </div>
                                    <div class="acc-action">
                                        <div class="">
                                            <a href="javascript:void(0);" class="btn-wallet"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
                                        </div>
                                        <a href="/admin/keuangan" class="btn-add-balance">Tambah Transaksi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-three">
                            <div class="widget-heading">
                                <div class="">
                                    <h5 class="">Pembayaran Bulanan</h5>
                                </div>

                                <div class="dropdown ">
                                    <a class="dropdown-toggle" href="#" role="button" id="uniqueVisitors" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </a>

                                    <div class="dropdown-menu left" aria-labelledby="uniqueVisitors">
                                        <a class="dropdown-item" href="javascript:void(0);">View</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content">
                                <div id="progress-bulanan"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-activity-five">

                            <div class="widget-heading">
                                <h5 class="">Histori Transaksi</h5>

                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="activitylog" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>

                                        <div class="dropdown-menu left" aria-labelledby="activitylog" style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);">View All</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Mark as Read</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content">

                                <div class="w-shadow-top"></div>

                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">
                                        @foreach ($history as $item)   
                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    @if (substr($item['account'],0,2) == '11')
                                                        <div class="t-warning">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                        </div>
                                                    @elseif (substr($item['account'],0,2) == '22')
                                                        <div class="t-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                        </div>
                                                    @else
                                                        <div class="t-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>{{ $item['name'] }} : <a href="javscript:void(0);"><span>{{ is_numeric($item['billing']) ? number_format($item['billing'],0,".",",") : $item['billing'] }}</span></a></h5>
                                                    </div>
                                                    <p>{{ $item['date'] }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>                                    
                                </div>

                                <div class="w-shadow-bottom"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-four">
                            <div class="widget-heading">
                                <h5 class="">Progress Pembayaran</h5>
                            </div>
                            <div class="widget-content">
                                <div class="vistorsBrowser">
                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                                        </div>
                                        <div class="w-browser-details">
                                            <div class="w-browser-info">
                                                <h6>Biaya Awal</h6>
                                                <p class="browser-count">{{ $totalPayment['once_percent'] }}%</p>
                                            </div>
                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{ $totalPayment['once_percent'] }}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                                        </div>
                                        <div class="w-browser-details">
                                            
                                            <div class="w-browser-info">
                                                <h6>Biaya Tahunan</h6>
                                                <p class="browser-count">{{ $totalPayment['yearly_percent'] }}%</p>
                                            </div>

                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: {{ $totalPayment['yearly_percent'] }}%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                        </div>
                                        <div class="w-browser-details">
                                            
                                            <div class="w-browser-info">
                                                <h6>Biaya Bulanan</h6>
                                                <p class="browser-count">{{ $totalPayment['monthly_percent'] }}%</p>
                                            </div>

                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{ $totalPayment['monthly_percent'] }}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-five">
                            <div class="widget-heading">
                                <a href="javascript:void(0)" class="task-info">
                                    <div class="usr-avatar">
                                        <span>Y</span>
                                    </div>
                                    <div class="w-title">
                                        <h5>Belum Bayar</h5>
                                        <span>Biaya Tahunan</span>
                                    </div>
                                </a>

                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);">View Project</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Edit Project</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Mark as Done</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="widget-content">

                                <!-- <p>Doloribus nisi vel suscipit modi, optio ex repudiandae voluptatibus officiis commodi.</p> -->

                                <div class="progress-data">
                                    <div class="progress-info">
                                        <div class="task-count"><p>{{ $totalPayment['yearly_person'] }} Persons</p></div>
                                        <div class="progress-stats"><p>{{ 100 - $totalPayment['yearly_percent'] }}%</p></div>
                                    </div>
                                    
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ 100 - $totalPayment['yearly_percent'] }}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="meta-info">

                                    <div class="due-time">
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> {{ $totalPayment['remainingMonths'] }} bulan lagi </p>
                                    </div>

                                    <div class="avatar--group">
                                        @if ($totalPayment['yearly_person'] > 3)
                                            <div class="avatar translateY-axis more-group">
                                                <span class="avatar-title">+{{ $totalPayment['yearly_person']-3 }}</span>
                                            </div>
                                        @endif
                                        @php $count = 0 @endphp
                                        @foreach ($studentPayment as $item)
                                            @if ($count < 3)
                                                @if ($item['yearly_percent'] < 100)
                                                    <div class="avatar translateY-axis">
                                                        <img alt="avatar" src="{{ $item['image'] ? asset('storage/member/' . $item['image']) : '/src/assets/img/no.png' }}"/>
                                                    </div>
                                                    @php $count++ @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-five">
                            <div class="widget-heading">

                                <a href="javascript:void(0)" class="task-info">

                                    <div class="usr-avatar">
                                        <span>M</span>
                                    </div>

                                    <div class="w-title">
                                        <h5>Belum Bayar</h5>
                                        <span>Biaya Bulanan</span>
                                    </div>
                                </a>

                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);">View Project</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Edit Project</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Mark as Done</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="widget-content">

                                <!-- <p>Doloribus nisi vel suscipit modi, optio ex repudiandae voluptatibus officiis commodi.</p> -->

                                <div class="progress-data">
                                    <div class="progress-info">
                                        <div class="task-count"><p>{{ $totalPayment['monthly_person'] }} Persons</p></div>
                                        <div class="progress-stats"><p>{{ 100 - $totalPayment['monthly_percent'] }}%</p></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ 100 - $totalPayment['monthly_percent'] }}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="meta-info">
                                    <div class="due-time">
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> {{ $totalPayment['remainingDays'] }} hari lagi </p>
                                    </div>
                                    <div class="avatar--group">
                                        @if ($totalPayment['monthly_person'] > 3)
                                            <div class="avatar translateY-axis more-group">
                                                <span class="avatar-title">+{{ $totalPayment['monthly_person']-3 }}</span>
                                            </div>
                                        @endif
                                        @php $count=0 @endphp
                                        @foreach ($studentPayment as $item)
                                            @if ($count < 3)
                                                @if ($item['monthly_percent'] < 100)
                                                    <div class="avatar translateY-axis">
                                                        <img alt="avatar" src="{{ $item['image'] ? asset('storage/member/' . $item['image']) : '/src/assets/img/no.png' }}"/>
                                                    </div>
                                                    @php $count++ @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-five">
                            <div class="widget-heading">
                                <h5 class="">Pemasukan Lain-lain</h5>
                            </div>
                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-center">
                                                <th><div class="th-content">Tgl</div></th>
                                                <th><div class="th-content">Keterangan</div></th>
                                                <th><div class="th-content th-heading">Jumlah</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($finances as $item)
                                                @if (substr($item->account,0,2)=='22')
                                                    <tr>
                                                        <td><div class="td-content product-invoice">{{ date('m/d', strtotime($item->date)) }}</div></td>
                                                        <td><div class="td-content customer-name"><span>{{ $item->description }}</span></div></td>
                                                        <td class="text-end"><div class="td-content pricing"><span class="">{{ number_format($item->amount,0,".",",") }}</span></div></td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-five">
                            <div class="widget-heading">
                                <h5 class="">Alokasi Keuangan</h5>
                            </div>
                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table table-scroll">
                                        <thead>
                                            <tr class="text-center">
                                                <th><div class="th-content">Pembayaran</div></th>
                                                <th><div class="th-content th-heading">Jumlah</div></th>
                                                <th><div class="th-content th-heading">Pengeluaran</div></th>
                                                <th><div class="th-content">Saldo</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($alokasi as $item)
                                                <tr>
                                                    <td><div class="td-content product-name"><div class="align-self-center"><p class="prd-name">{{ $item['remark'] }}</p><p class="prd-category text-{{ $item['balance'] > 0 ? 'primary' : 'danger' }}">{{ $item['account'] }}</p></div></div></td>
                                                    <td><div class="td-content text-end"><span class="pricing">{{ number_format($item['payment'],0,".",",") }}</span></div></td>
                                                    <td><div class="td-content text-end"><span class="discount-pricing">{{ number_format($item['finance'],0,".",",") }}</span></div></td>
                                                    <td><div class="td-content text-end text-{{ $item['balance'] > 0 ? 'primary' : 'danger' }}">{{ number_format($item['balance'],0,".",",") }}</div></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                <p class="">Copyright © <span class="dynamic-year">2023</span> Semangkamedia.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Code with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
            </div>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!--  END CONTENT AREA  -->

    <script>
        var paymentByMonth = {!! json_encode($paymentByMonth) !!};

        var financeInByMonth = {!! json_encode($financeInByMonth) !!};

        var monthlyPaymentByMonth = {!! json_encode($monthlyPaymentByMonth) !!};
        const arrMonthlyMonth = [];
        const arrMonthlyData = {};
        // Mendapatkan array unik dari nama grup
        const uniqueGroups = [...new Set(monthlyPaymentByMonth.flatMap(item => Object.keys(item)))];
        // Inisialisasi objek arrMonthlyData
        uniqueGroups.forEach(group => {
            arrMonthlyData[group] = [];
        });
        // Memproses data
        for (const payment of monthlyPaymentByMonth) {
            const month = payment.month_year.slice(0, 3);
            arrMonthlyMonth.push(month);
            // Memproses setiap grup
            uniqueGroups.forEach(group => {
                if (payment[group]) {
                    arrMonthlyData[group].push(parseInt(payment[group]));
                } else {
                    arrMonthlyData[group].push(0);
                }
            });
        }
        const seriesBulanan = [];
        // Membuat objek seriesBulanan secara dinamis, tidak termasuk 'month_year'
        uniqueGroups.forEach(group => {
            if (group !== 'month_year') {
                seriesBulanan.push({
                    name: group,
                    data: arrMonthlyData[group]
                });
            }
        });

    </script>
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('src/plugins/src/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('src/assets/js/dashboard/dash_1.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

@endsection