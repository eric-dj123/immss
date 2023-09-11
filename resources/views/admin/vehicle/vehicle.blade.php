@extends('layouts.admin.app')
@section('page-name')Vehicle @endsection
@section('body')

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                <h4 class="mb-sm-0">VEHICLE MANAGEMENT</h4>


                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">IMMS Mail</a>
                        </li>
                        <li class="breadcrumb-item active">Vehicle</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="customerList">
                <div class="card-header border-bottom-dashed">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm">
                            <div>

                                <h5 class="card-title mb-0">VEHICLE LIST</h5>

                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex flex-wrap align-items-start gap-2">
                                <button class="btn btn-soft-danger" id="remove-actions"
                                    onClick="deleteMultiple()">
                                    <i class="ri-delete-bin-2-line"></i>
                                </button>

                                    <button type="button" class="btn btn-success add-btn"
                                        data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal">
                                        <i class="ri-add-line align-bottom me-1"></i>New
                                        Vehicle
                                    </button>


                                {{-- <button type="button" class="btn btn-info">
                                    <i class="ri-file-download-line align-bottom me-1"></i>
                                    Import
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div>

                          <table id="datatableAjax" class="table table-centered table-hover align-middle table-nowrap mb-0"
                                style="width: 100%;">
                                <thead class="table-light text-muted">

                                    <tr>
                                        <th scope="col" style="width: 80px">
                                           #
                                        </th>

                                        <th class="sort" data-sort="MAIL CODE">
                                            Vehicle Name
                                        </th>
                                        <th class="sort" data-sort="TRACKING NUMBER">Plate Number</th>
                                        <th class="sort" data-sort="NAME">Model</th>
                                        <th class="sort" data-sort="PHONE">Type</th>
                                        <th class="sort" data-sort="P.O BOX">Mileage</th>

                                        <th class="sort" data-sort="DATE">DATE</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($vehicles as $key => $vehicle)
                                    <tr>
                                        <th scope="row">
                                          {{ $key + 1 }}
                                        </th>
                                        <td class="MAIL CODE"><a href="">{{ $vehicle->name }}</a></td>
                                        <td class="TRACKING NUMBER">{{ $vehicle->plate_number }}</td>
                                        <td class="NAME">{{ $vehicle->model }}</td>
                                        <td class="PHONE">{{ $vehicle->type }}</td>
                                        <td class="P.O BOX">{{ $vehicle->fuel_liters }}</td>

                                        <td class="date"> {{ $vehicle->created_at->format('d M, Y') }}</td>


                                        <td>

                                            <a href="#showModal{{ $vehicle->id }}" data-bs-toggle="modal" type="button"
                                                class="btn btn-primary btn-sm"><span>Edit</span></a>

                                            <div class="modal fade" id="showModal{{ $vehicle->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title">VEHICLE INFORMATION UPDATE</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close" id="close-modal"></button>
                                                        </div>
                                                        <form class="tablelist-form" id="myForm" method="post" action="{{ route('admin.vehicle.update',$vehicle->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">

                                                                <div class="mb-3">
                                                                    @if($errors->any())
                                                                    <div class="alert alert-danger">
                                                                      <p><strong>Opps Something went wrong</strong></p>
                                                                      <ul>
                                                                      @foreach ($errors->all() as $error)
                                                                        <li>* {{ $error }}</li>
                                                                      @endforeach
                                                                      </ul>
                                                                    </div>
                                                                      @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="customername-field" class="form-label">Vehicle Name
                                                                        </label>
                                                                    <input type="text" id="customername-field" name="name"
                                                                        class="form-control" placeholder="Enter Vehicle name"
                                                                        value="{{ $vehicle->name }}" required autocomplete="off"/>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a name .
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="name-field" class="form-label">Plate Number</label>
                                                                    <input type="text" class="form-control" name="plate_number"
                                                                        placeholder="Enter Plate Number" required  value="{{ $vehicle->plate_number }}" autocomplete="off"/>
                                                                    <div class="invalid-feedback">
                                                                        Please enter Number.
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="phone-field" class="form-label">Model</label>
                                                                    <input type="text"  name="model" class="form-control"
                                                                        placeholder="Enter Model." required value="{{ $vehicle->model }}" autocomplete="off"/>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a MODEL.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="status-field" class="form-label">Mileage </label>
                                                                    <input type="text" name="fuel_liters" class="form-control phoneNumber"
                                                                        placeholder="Enter Mileage." required value="{{ $vehicle->fuel_liters }}" autocomplete="off"/>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a Type
                                                                    </div>
                                                                </div>

                                                            <div class="mb-3">
                                                                <label for="status-field"
                                                                    class="form-label">Vehicle Type</label>
                                                                <select class="form-control" data-choices
                                                                    data-choices-search-false name="type"
                                                                    id="status-field" required>
                                                                    <option
                                                                    @if ($vehicle->type == 'Moto') selected @endif
                                                                    value="Moto">Moto</option>
                                                                <option
                                                                    @if ($vehicle->type == 'Van') selected @endif
                                                                    value="Van">
                                                                    Van
                                                                </option>
                                                                <option
                                                                    @if ($vehicle->type == 'Truck') selected @endif
                                                                    value="Truck">
                                                                    Truck
                                                                </option>


                                                                </select>
                                                            </div>

                                                    </div>
                                                            <div class="modal-footer">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <button type="button" class="btn btn-light"
                                                                        data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                    <button type="submit" class="btn btn-success"
                                                                        id="add-btn" onclick="submitForm()">
                                                                        UPDATE
                                                                    </button>
                                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="#deleteRecordModal{{ $vehicle->id }}" data-bs-toggle="modal"  type="button" class="btn btn-danger btn-sm"><span>Delete</span></a>

                                            <!-- Modal -->
                                            <div class="modal fade zoomIn" id="deleteRecordModal{{ $vehicle->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" id="deleteRecord-close"
                                                                data-bs-dismiss="modal" aria-label="Close"
                                                                id="btn-close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{ route('admin.vehicle.destroy',$vehicle->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            <div class="mt-2 text-center">
                                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                                    trigger="loop"
                                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                                    style="width: 100px; height: 100px"></lord-icon>
                                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                    <h4>Are you sure ?</h4>
                                                                    <p class="text-muted mx-4 mb-0">
                                                                        Are you sure you want to remove this record ?
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                <button type="button" class="btn w-sm btn-light"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="submit" class="btn w-sm btn-danger"
                                                                    id="delete-record">
                                                                    Yes, Delete It!
                                                                </button>
                                                            </div>
                                                           </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end modal -->
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">Vehicle Information Registration</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close" id="close-modal"></button>
                                </div>
                                <form class="tablelist-form" method="post" action="{{route('admin.vehicle.store') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            @if($errors->any())
                                            <div class="alert alert-danger">
                                              <p><strong>Opps Something went wrong</strong></p>
                                              <ul>
                                              @foreach ($errors->all() as $error)
                                                <li>* {{ $error }}</li>
                                              @endforeach
                                              </ul>
                                            </div>
                                              @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="customername-field" class="form-label">Vehicle Name
                                                </label>
                                            <input type="text" id="customername-field" name="name"
                                                class="form-control" placeholder="Enter Vehicle name"
                                                value="{{ old('intracking') }}" required autocomplete="off"/>
                                            <div class="invalid-feedback">
                                                Please enter a name .
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name-field" class="form-label">Plate Number</label>
                                            <input type="text" class="form-control" name="plate_number"
                                                placeholder="Enter Plate Number" required  value="{{ old('plate_number') }}" autocomplete="off"/>
                                            <div class="invalid-feedback">
                                                Please enter Number.
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone-field" class="form-label">Model</label>
                                            <input type="text"  name="model" class="form-control"
                                                placeholder="Enter Model." required value="{{ old('model') }}" autocomplete="off"/>
                                            <div class="invalid-feedback">
                                                Please enter a MODEL.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status-field" class="form-label">Mileage</label>
                                            <input type="text" name="fuel_liters" class="form-control"
                                                placeholder="Enter mileage ." required value="{{ old('type') }}" autocomplete="off"/>
                                            <div class="invalid-feedback">
                                                Please enter a Type
                                            </div>
                                        </div>

                                    <div class="mb-3">
                                        <label for="status-field"
                                            class="form-label">Vehicle Type</label>
                                        <select class="form-control" data-choices
                                            data-choices-search-false name="type"
                                            id="status-field" required>
                                            <option value="" disabled selected>
                                                Select Vehicle type </option>
                                                <option @if (old('Moto') == 'Moto') selected @endif  value="Moto">Moto</option>
                                                <option @if (old('car') == 'Van') selected @endif  value="Van">Van</option>
                                                <option @if (old('car') == 'Truck') selected @endif  value="Truck">Truck</option>


                                        </select>
                                    </div>

                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-success" id="add-btn">
                                                Save
                                            </button>
                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


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
@if($errors->any())
<script>
    var myModal = new bootstrap.Modal(document.getElementById('showModal'), {
        keyboard: false
    })
    myModal.show()

</script>
@endif
<script>
    $(document).ready(function () {
        $(".phoneNumber").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
    });

</script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatableAjax').DataTable({
            processing: true,


        });
    });
</script>
@endsection
