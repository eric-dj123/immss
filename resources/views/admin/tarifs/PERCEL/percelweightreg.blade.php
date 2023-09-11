@extends('layouts.admin.app')
@section('page-name')
weight Registration
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('body')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Weight Registration</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">IMMS</a>
                        </li>
                        <li class="breadcrumb-item active">Mail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-bottom-dashed">
                <div class="row g-4 align-items-center">
                    <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">weight Registration List</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">


                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModal">
                                        <i class="ri-add-line align-bottom me-1"></i> New
                                        weight
                                    </button>


                                </div>
                            </div>
                        </div>

                    <div class="card-body">
                        <table id="datatableAjax" class="table table-centered table-hover align-middle table-nowrap mb-0"
                            style="width: 100%;">
                            <thead>
                                <tr>

                                    <th scope="col">
                                        #
                                    </th>

                                    <th class="sort" data-sort="name">
                                    	Weight
                                    </th>
                                    <th class="sort" data-sort="name">
                                    	Type
                                    </th>
                                    <th class="sort" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($weights as $key =>$weight)
                                    <tr>

                                        <td scope="row">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="name"><a href="">{{ $weight->weight }}</a>
                                        </td>
                                        <td class="name"><a href="">{{ $weight->type }}</a>
                                    </td>

                                        <td>
                                            <a href="#showModals{{ $weight->prw_id }}" data-bs-toggle="modal"
                                                type="button" class="btn btn-primary btn-sm"><span>Edit</span></a>
                                            <div class="modal fade" id="showModals{{ $weight->prw_id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title">WEIGHT INFORMATION UPDATE</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"
                                                                id="close-modal"></button>
                                                        </div>
                                                        <form class="tablelist-form" id="myForm" method="post"
                                                            action="{{ route('admin.pweight.update', $weight->prw_id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">

                                                                <div class="mb-3">
                                                                    @if ($errors->any())
                                                                        <div class="alert alert-danger">
                                                                            <p><strong>Opps Something went wrong</strong>
                                                                            </p>
                                                                            <ul>
                                                                                @foreach ($errors->all() as $error)
                                                                                    <li>* {{ $error }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="weightname-field"
                                                                        class="form-label">Weight/kg
                                                                    </label>
                                                                    <input type="text" id="weightname-field"
                                                                        name="weight" class="form-control"
                                                                        placeholder="Enter weight"
                                                                        value="{{ $weight->weight }} {{ old('weight') }}"
                                                                        required />
                                                                    <div class="invalid-feedback">
                                                                        Please enter Orgin weight .
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
                                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="#deleteRecordModal{{ $weight->prw_id }}" data-bs-toggle="modal"
                                                type="button" class="btn btn-danger btn-sm"><span>Delete</span></a>

                                                <div class="modal fade" id="deleteRecordModal{{ $weight->prw_id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light p-3">
                                                                <h5 class="modal-title">Are You Sure You Want To Delete weight <br>{{ $weight->weightname }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"
                                                                    id="close-modal"></button>
                                                            </div>
                                                            <form class="tablelist-form" id="myForm" method="post"
                                                                action="{{ route('admin.pweight.destroy',$weight->prw_id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-body">

                                                                    <div class="mb-3">
                                                                        @if ($errors->any())
                                                                            <div class="alert alert-danger">
                                                                                <p><strong>Opps Something went
                                                                                        wrong</strong></p>
                                                                                <ul>
                                                                                    @foreach ($errors->all() as $error)
                                                                                        <li>* {{ $error }}</li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </div>




                                                        <div class="modal-footer">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="submit" class="btn btn-danger"
                                                                    id="add-btn" onclick="submitForm()">
                                                                  Delete
                                                                </button>
                                                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>

    </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        <!--end col-->
    </div>
    <!--end row-->


    <!-- Modal -->

    <!--end modal -->

    <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">weight Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form" method="post" action="{{ route('admin.pweight.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            @if ($errors->any())
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
                            <label for="weightname-field"
                                class="form-label">Weight/kg
                            </label>
                            <input type="text" id="weightname-field"
                                name="weight" class="form-control"
                                placeholder="Enter weight"
                                value="{{ old('weight') }}"
                                required />
                            <div class="invalid-feedback">
                                Please enter Orgin weight .
                            </div>

                        </div>



                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
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

@endsection
@section('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script')
    @if ($errors->any())
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('showModal'), {
                keyboard: false
            })
            myModal.show()
        </script>
    @endif
    <script>
        var checkAll = document.getElementById("checkAll");
        var checkboxes = document.querySelectorAll("tbody input[type=checkbox]");
        var deleteBtn = document.getElementById("deleteBtn");

        checkAll.addEventListener("change", function(e) {
            var t = e.target.checked;
            checkboxes.forEach(function(e) {
                e.checked = t;
            });
            toggleDeleteBtn();
        });

        checkboxes.forEach(function(e) {
            e.addEventListener("change", function(e) {
                checkAll.checked = Array.from(checkboxes).every(function(e) {
                    return e.checked;
                });
                toggleDeleteBtn();
            });
        });

        function toggleDeleteBtn() {
            var checkedBoxes = document.querySelectorAll("tbody input[type=checkbox]:checked");
            if (checkedBoxes.length > 0) {
                deleteBtn.style.display = "block";
            } else {
                deleteBtn.style.display = "none";
            }
        }
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
