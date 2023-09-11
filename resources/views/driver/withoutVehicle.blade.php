@extends('layouts.admin.app')
@section('page-name')Driver @endsection
@section('body')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Driver Without Vehicle</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">IMMS </a>
                    </li>
                    <li class="breadcrumb-item active">Driver Without Vehicle</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-bottom-dashed">
                <div class="row g-4 align-items-center">
                    <div class="col-sm">
                        <div>
                            <h5 class="card-title mb-0">Driver List</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex flex-wrap align-items-start gap-2">
                            <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()">
                                <i class="ri-delete-bin-2-line"></i>
                            </button>


                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">
                                #
                            </th>

                            <th class="sort" data-sort="name">
                                Driver Name
                            </th>
                            <th class="sort" data-sort="email">Email</th>
                            <th class="sort" data-sort="phone">Phone</th>
                            <th class="sort" data-sort="branch">Branch</th>
                            <th class="sort" data-sort="date">Joining Date</th>
                            <th class="sort" data-sort="status">Status</th>
                            <th class="sort" data-sort="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $key => $employee)
                        <tr>
                            <td scope="row">
                                {{ $key + 1 }}
                            </td>
                            <td class="name">{{ $employee->name }}
                            </td>
                            <td class="email">{{ $employee->email }}</td>
                            <td class="phone">{{ $employee->phone }}</td>
                            <td class="branch">{{ $employee->branchname->name }}</td>

                            <td class="date"> {{ $employee->created_at->format('d M, Y') }}</td>
                            <td class="status">
                                @if ($employee->status == 'active')
                                <span class="badge badge-soft-success text-uppercase">active</span>
                                @else
                                <span class="badge badge-soft-danger text-uppercase">inactive</span>
                                @endif
                            </td>
                            <td>
                               {{-- assign --}}
                                <a href="" class="btn btn-soft-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#topmodal{{ $employee->id }}">Assign</a>
                                <div id="topmodal{{ $employee->id }}" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body text-center p-5">

                                                    <div class="text-muted text-center mx-lg-3">
                                                        <h4 class="">Vehicle Assignment</h4>
                                                        <p>Assign a vehicle to this driver</p>
                                                    </div>

                                                    <div class="mt-4">
                                                        <form action="{{ route('driver.assignVehicle',$employee->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                {{-- select driver --}}
                                                                <select class="form-select" name="vehicle" aria-label="Default select example" required>
                                                                    <option selected disabled>Select Vehicle</option>
                                                                    @forelse($vehicles as $vehicle)
                                                                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }} - {{ $vehicle->plate_number }}</option>
                                                                    @empty
                                                                        <option value="">No Vehicle Found</option>
                                                                    @endforelse
                                                                </select>
                                                            </div>

                                                            <div class="mt-3">
                                                                <button type="submit" class="btn btn-success w-100">Confirm</button>
                                                            </div>

                                                        </form>

                                                    </div>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->



@endsection
@section('css')
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script')


<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

@endsection
