@extends('layouts.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Hello, <span>Welcome Here</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Home</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-money color-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Profit (Rp.)</div>
                                    <div class="stat-digit">{{ number_format($sumTransaction) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Customer</div>
                                    <div class="stat-digit">{{ $totalUser }} User</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-layout-grid2 color-pink border-pink"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Transaction</div>
                                    <div class="stat-digit">{{ $countTransaction }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-link color-danger border-danger"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Product</div>
                                    <div class="stat-digit">{{ $countProduct }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-title">
                                <h4>Total Transaction</h4>

                            </div>
                            <div class="card-body">
                                <ul class="timeline">
                                    @for ($i = 0; $i < count($data['count']); $i++)
                                    {{-- {{ dd($data['label']) }} --}}

                                    <li>
                                        <div class="timeline-badge primary">{{ $data['count'][$i] }}</div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h5 class="timeline-title">{{ $data['label'][$i] }}</h5>
                                            </div>
                                            <div class="timeline-body">
                                                <p>{{ $data['data'][$i] }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endfor
                                    <li>
                                        <div class="timeline-badge warning"><i class="fa fa-sun-o"></i></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h5 class="timeline-title">{{ $sumTransaction }}</h5>
                                            </div>
                                            <div class="timeline-body">
                                                <p>All Of Transaction</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                </div>
                <!-- /# row -->

                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <canvas id="pie-chart"></canvas>
                                {{-- <div class="ct-pie-chart"></div> --}}
                            </div>
                            <script>
                            $(function(){
                                //get the pie chart canvas
                                var cData = JSON.parse(`<?php echo $data['chart_data']; ?>`);
                                var ctx = $("#pie-chart");
                            
                                //pie chart data
                                var data = {
                                    labels: cData.label,
                                    datasets: [
                                    {
                                        label: "Month",
                                        data: cData.data,
                                        borderWidth: [1, 1, 1, 1, 1,1,1]
                                    }
                                    ]
                                };
                            
                                //options
                                var options = {
                                    responsive: true,
                                    title: {
                                    display: true,
                                    position: "top",
                                    text: "Monthly Report",
                                    fontSize: 18,
                                    fontColor: "#111"
                                    },
                                    legend: {
                                    display: true,
                                    position: "bottom",
                                    labels: {
                                        fontColor: "#333",
                                        fontSize: 16
                                    }
                                    }
                                };
                            
                                //create Pie Chart class object
                                var chart1 = new Chart(ctx, {
                                    type: "line",
                                    data: data,
                                    options: options
                                });
                            
                            });
                            </script>   
                        </div>
                    </div>
                </div>
                </div>              
            </section>
        </div>
    </div>
</div>
@endsection