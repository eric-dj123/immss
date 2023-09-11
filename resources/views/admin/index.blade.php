@extends('layouts.admin.app')
@section('page-name')
    Dashboard
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">IMMS V.3</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    @can('read summarized report')
        @include('admin.dashboard.admindashboard')
    @endcan
    @can('Read Dispach Recieving')
    @include('admin.dashboard.backofficedashboard')
    @endcan
    @can('read mails')
        @include('admin.dashboard.branchmanagerdashboard')
    @endcan
    @can('read airport')
        <!--end of admin dashboard -->
        @include('admin.dashboard.airportdash')
    @endcan

    @can('read incoming mail')
        @include('admin.dashboard.cntpdashboard')
    @endcan
    @can('create registered mail')
        @include('admin.dashboard.registerdashboard')
    @endcan
    @can('create driver')
    @include('admin.dashboard.chiefdriverdashboard')
   @endcan
    </div> <!-- end .h-100-->

    </div> <!-- end col -->


    </div>
    <!-- end page title -->
@endsection
