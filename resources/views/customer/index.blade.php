@extends('layouts.customer.app')
@section('page') Dashboard @endsection
@section('content')
<div class="col-xxl-12 order-xxl-0 order-first">
    <div class="d-flex flex-column h-100">
        <div class="row h-100">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                    <i class="ri-money-dollar-circle-fill align-middle"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Total</p>
                                <h4 class=" mb-0"><span class="counter-value" data-target="2390.68">2,390.68</span></h4>
                            </div>
                            <div class="flex-shrink-0 align-self-end">
                                <span class="badge badge-soft-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>more<span> </span></span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                    <i class="ri-arrow-up-circle-fill align-middle"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Total Change</p>
                                <h4 class=" mb-0">$<span class="counter-value" data-target="19523.25">19,523.25</span></h4>
                            </div>
                            <div class="flex-shrink-0 align-self-end">
                                <span class="badge badge-soft-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>3.67 %<span> </span></span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                    <i class="ri-arrow-down-circle-fill align-middle"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Day Change</p>
                                <h4 class=" mb-0">$<span class="counter-value" data-target="14799.44">14,799.44</span></h4>
                            </div>
                            <div class="flex-shrink-0 align-self-end">
                                <span class="badge badge-soft-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>4.80 %<span> </span></span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        {{-- <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Market Graph</h4>
                        <div>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1H
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                7D
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1M
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1Y
                            </button>
                            <button type="button" class="btn btn-soft-primary btn-sm">
                                ALL
                            </button>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body p-0">
                        <div class="bg-soft-light border-top-dashed border border-start-0 border-end-0 border-bottom-dashed py-3 px-4">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="d-flex flex-wrap gap-4 align-items-center">
                                        <h5 class="fs-19 mb-0">0.014756</h5>
                                        <p class="fw-medium text-muted mb-0">$75.69 <span class="text-success fs-11 ms-1">+1.99%</span></p>
                                        <p class="fw-medium text-muted mb-0">High <span class="text-dark fs-11 ms-1">0.014578</span></p>
                                        <p class="fw-medium text-muted mb-0">Low <span class="text-dark fs-11 ms-1">0.0175489</span></p>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div class="d-flex justify-content-end text-end flex-wrap gap-4 ms-auto">
                                            <div class="pe-3">
                                                <h6 class="mb-2 text-truncate text-muted">Total Balance</h6>
                                                <h5 class="mb-0">$72.8k</h5>

                                            </div>
                                            <div class="pe-3">
                                                <h6 class="mb-2 text-muted">Profit</h6>
                                                <h5 class="text-success mb-0">+$49.7k</h5>
                                            </div>
                                            <div class="pe-3">
                                                <h6 class="mb-2 text-muted">Loss</h6>
                                                <h5 class="text-danger mb-0">-$23.1k</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                    </div><!-- end cardbody -->

                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row --> --}}
    </div>
</div>
@endsection
