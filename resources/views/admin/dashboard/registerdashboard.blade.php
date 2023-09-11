@if (auth()->user()->office=='r')
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending </p>
                        </div>

                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $pendinginboxre }}">{{ $pendinginboxre }}</span></h4>
                            <a href="{{ route('admin.mailsr.RegisteredMail') }}" class="text-decoration-underline">View pending</a>
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
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Registered</p>
                        </div>

                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $approvedinboxre }}">{{ $approvedinboxre }}</span></h4>

                            <a href="{{ route('admin.mailsr.RegisteredMail') }}" class="text-decoration-underline">View Registered</a>
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
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Transfered</p>
                        </div>

                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$transferinboxre }}">{{ $transferinboxre }}</span></h4>

                            <a href="{{ route('admin.transferr.RegisteredMailTransfer') }}" class="text-decoration-underline">View Transfered</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-danger rounded fs-2">
                                <i class="bx bx-envelope text-danger"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->


</div> <!-- end row-->
@endif

 @if (auth()->user()->office=='o')
 <div class="row">
    <div class="col-xl-4 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $pendinginboxo }}">{{ $pendinginboxo }}</span></h4>
                        <a href="{{ route('admin.mails.OrdinaryMail') }}" class="text-decoration-underline">View pending</a>
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
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Registered</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $approvedinboxo }}">{{ $approvedinboxo }}</span></h4>

                        <a href="{{ route('admin.mails.OrdinaryMail') }}" class="text-decoration-underline">View Registered</a>
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
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Transfered</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $transferinboxo }}">{{ $transferinboxo }}</span></h4>

                        <a href="{{ route('admin.transfero.OrdinaryMailTransfer') }}" class="text-decoration-underline">View Transfered</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-danger rounded fs-2">
                            <i class="bx bx-envelope text-danger"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

 </div> <!-- end row-->
 @endif




 @if (auth()->user()->office=='p')
 <div class="row">
    <div class="col-xl-4 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $pendinginboxp }}">{{ $pendinginboxp }}</span></h4>
                        <a href="{{ route('admin.mailsp.PercelMail') }}" class="text-decoration-underline">View pending</a>
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
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Registered</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$approvedinboxp }}">{{ $approvedinboxo }}</span></h4>

                        <a href="{{ route('admin.mailsp.PercelMail') }}" class="text-decoration-underline">View Registered</a>
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
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Transfered</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $transferinboxp }}">{{ $transferinboxp }}</span></h4>

                        <a href="{{ route('admin.transferp.PercelMailTransfer') }}" class="text-decoration-underline">View Transfered</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-danger rounded fs-2">
                            <i class="bx bx-envelope text-danger"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
 </div> <!-- end row-->
 @endif


@if (auth()->user()->office=='ems')

<div class="row">
    <div class="col-xl-4 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $pendinginboxems }}">{{ $pendinginboxems }}</span></h4>
                        <a href="{{ route('admin.mailsem.EmsMail') }}" class="text-decoration-underline">View pending</a>
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
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Registered</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $approvedinboxems }}">{{ $approvedinboxems }}</span></h4>

                        <a href="{{ route('admin.mailsem.EmsMail') }}" class="text-decoration-underline">View Registered</a>
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
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Transfered</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $transferinboxems }}">{{ $transferinboxems }}</span></h4>

                        <a href="{{ route('admin.transferem.EmsMailTransfer') }}" class="text-decoration-underline">View Transfered</a>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-soft-danger rounded fs-2">
                            <i class="bx bx-envelope text-danger"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->


</div> <!-- end row-->
@endif



@if (auth()->user()->office=='letter')
<div class="row">
    <div class="col-xl-4 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending OL</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $pendinginboxol }}">{{ $pendinginboxol }}</span></h4>

                        <a href="{{ route('admin.mailsol.OrdinaryLetter') }}" class="text-decoration-underline">View pending</a>
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
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Registered OL</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $approvedinboxol }}">{{ $approvedinboxol }}</span></h4>

                        <a href="{{ route('admin.mailsol.OrdinaryLetter') }}" class="text-decoration-underline">View Registered</a>
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
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Transfered OL</p>
                </div>

            </div>
            <div class="d-flex align-items-end justify-content-between mt-4">
                <div>
                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $transferinboxol }}">{{ $transferinboxol }}</span></h4>

                    <a href="{{ route('admin.transferol.OrdinaryLetterTransfer') }}" class="text-decoration-underline">View Transfered</a>
                </div>
                <div class="avatar-sm flex-shrink-0">
                    <span class="avatar-title bg-soft-danger rounded fs-2">
                        <i class="bx bx-envelope text-danger"></i>
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
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending RL</p>
                </div>

            </div>
            <div class="d-flex align-items-end justify-content-between mt-4">
                <div>

                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $pendinginboxrl }}">{{ $pendinginboxrl }}</span></h4>
                    <a href="{{ route('admin.mailsrl.RegisteredLetter') }}" class="text-decoration-underline">View Pending</a>
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
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Registered RL</p>
                </div>

            </div>
            <div class="d-flex align-items-end justify-content-between mt-4">
                <div>
                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $approvedinboxrl }}">{{ $approvedinboxrl }}</span></h4>

                    <a href="{{ route('admin.mailsrl.RegisteredLetter') }}" class="text-decoration-underline">View Registered</a>
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
                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Transfered RL</p>
            </div>

        </div>
        <div class="d-flex align-items-end justify-content-between mt-4">
            <div>
                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $transferinboxrl }}">{{ $transferinboxrl }}</span></h4>

                <a href="{{ route('admin.transferrl.RegisteredLetterTransfer') }}" class="text-decoration-underline">View Transfered</a>
            </div>
            <div class="avatar-sm flex-shrink-0">
                <span class="avatar-title bg-soft-danger rounded fs-2">
                    <i class="bx bx-envelope text-danger"></i>
                </span>
            </div>
        </div>
    </div><!-- end card body -->
</div><!-- end card -->
</div><!-- end col -->
</div> <!-- end row-->
@endif
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                <div>
                    <button type="button" class="btn btn-soft-secondary btn-sm">
                        ALL
                    </button>
                    <button type="button" class="btn btn-soft-secondary btn-sm">
                        1M
                    </button>
                    <button type="button" class="btn btn-soft-secondary btn-sm">
                        6M
                    </button>
                    <button type="button" class="btn btn-soft-primary btn-sm">
                        1Y
                    </button>
                </div>
            </div><!-- end card header -->

            <div class="card-header p-0 border-0 bg-soft-light">
                <div class="row g-0 text-center">
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0">
                            <h5 class="mb-1"><span class="counter-value" data-target="7585">0</span></h5>
                            <p class="text-muted mb-0">Orders</p>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0">
                            <h5 class="mb-1">$<span class="counter-value" data-target="22.89">0</span>k</h5>
                            <p class="text-muted mb-0">Earnings</p>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0">
                            <h5 class="mb-1"><span class="counter-value" data-target="367">0</span></h5>
                            <p class="text-muted mb-0">Refunds</p>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0 border-end-0">
                            <h5 class="mb-1 text-success"><span class="counter-value" data-target="18.92">0</span>%</h5>
                            <p class="text-muted mb-0">Conversation Ratio</p>
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </div><!-- end card header -->

            <div class="card-body p-0 pb-2">
                <div class="w-100">
                    <div id="customer_impression_charts" data-colors='["--vz-primary", "--vz-success", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-4">
        <!-- card -->
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Sales by Locations</h4>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-soft-primary btn-sm">
                        Export Report
                    </button>
                </div>
            </div><!-- end card header -->

            <!-- card body -->
            <div class="card-body">

                <div id="sales-by-locations" data-colors='["--vz-light", "--vz-success", "--vz-primary"]' style="height: 269px" dir="ltr"></div>

                <div class="px-2 py-2 mt-1">
                    <p class="mb-1">Canada <span class="float-end">75%</span></p>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="75"></div>
                    </div>

                    <p class="mt-3 mb-1">Greenland <span class="float-end">47%</span>
                    </p>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 47%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="47"></div>
                    </div>

                    <p class="mt-3 mb-1">Russia <span class="float-end">82%</span></p>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="82"></div>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>



