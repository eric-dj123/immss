<div class="row">
    <div class="col-xl-4 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending Dispatch</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                data-target="{{ $pendingdispatch }}">{{ $pendingdispatch }}</span></h4>
                        <a href="{{ route('admin.inbox.AirportDispach') }}" class="text-decoration-underline">View
                            pending</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-primary rounded fs-2">
                            <i class="bx bx-envelope text-primary"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->


    <div class="col-xl-4 col-md-6">
        <!-- card -->


        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Dispatch Transfer</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                data-target="{{ $assigneddispatch }}">{{ $assigneddispatch }}</span></h4>
                        <a href="{{ route('admin.inbox.DispatchTransfered') }}" class="text-decoration-underline">View
                            Transfer</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-info rounded fs-2">
                            <i class="bx bx-envelope text-info"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-4 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Dispatch CNTP Approved</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                data-target="{{ $approveddispatchcntp }}">{{ $approveddispatchcntp }}</span></h4>
                        <a href="{{ route('admin.inbox.Mailarrived') }}" class="text-decoration-underline">View CNTP
                            Approved</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-success rounded fs-3">
                            <i class="bx bx-envelope text-primary"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div> <!-- end row-->
<!DOCTYPE html>
<html>

<head>
    <!-- Include required libraries and stylesheets -->
    <link rel="stylesheet" href="path/to/apexcharts.css">
    <script src="path/to/apexcharts.js"></script>
</head>

<body>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <h4 class="header-title">Basic Column Chart</h4>
                    <div dir="ltr">
                        <div id="basic-column" class="apex-charts"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <h4 class="header-title">Basic Column Chart</h4>
                    <div dir="ltr">
                        <div id="basic-column" class="apex-charts"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        use Carbon\Carbon;
    @endphp
    <!DOCTYPE html>
    <html>

    <head>
        <title>Bar Chart Example</title>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/apexcharts.min.js"></script>
    </head>

    <body>
        <div id="basic-column"></div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var dispatchCounts = @json($dispatch_counts_ems);
                var dispatchCountspercel = @json($dispatch_counts_percel);
                var dispatchCountsmails = @json($dispatch_counts_mails);
                var data = [{
                        name: "EMS",
                        data: Object.values(dispatchCounts)
                    },
                    {
                        name: "PERCEL",
                        data: Object.values(dispatchCountspercel)
                    },
                    {
                        name: "Mails",
                        data: Object.values(dispatchCountsmails)
                    }
                ];

                var options = {
                    chart: {
                        type: 'bar',
                        height: 350,
                    },
                    series: data,
                    xaxis: {
                        categories: [
                            @foreach ($created_days as $days)
                                '{{ \Carbon\Carbon::parse($days)->format('l') }}',
                            @endforeach
                        ]
                    },
                };

                var chart = new ApexCharts(document.querySelector("#basic-column"), options);
                chart.render();
            });
        </script>
    </body>

    </html>

</body>

</html>
