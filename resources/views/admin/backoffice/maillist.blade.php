@extends('layouts.admin.apps')
@section('page-name')MAIL LIST @endsection
@section('body')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">MAIL TRACKING</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">IMMS</a>
                    </li>
                    <li class="breadcrumb-item active">Tracking</li>
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
                            <h5 class="card-title mb-0">Mail Tracking</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex flex-wrap align-items-start gap-2">
                            <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()">
                                <i class="ri-delete-bin-2-line"></i>
                            </button>




                            {{-- <button type="button" class="btn btn-info">
                                    <i class="ri-file-download-line align-bottom me-1"></i>
                                    Import
                                </button> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-4">
                <form class="form-inline justify-content-center" action="{{ route('admin.list.search') }}" method="GET">
                  <!-- Search input -->
                  <input type="text" name="query" class="form-control mr-sm-2" placeholder="Search" aria-label="Search"><br>
                  <!-- Search button -->
                  <center><button type="submit" class="btn btn-primary my-2 my-sm-0">Track</button><center>
                </form>
              </div>

        </div>
    </div>
    <!--end col-->
    @if(isset($inboxings))
        @if(count($inboxings) > 0)
            <ul>
                <div class="card-body">
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">
                                    #
                                </th>

                                <th class="sort" data-sort="MAIL CODE">
                                    MAIL CODE
                                </th>
                                <th class="sort" data-sort="TRACKING NUMBER">TRACKING NUMBER</th>
                                <th class="sort" data-sort="NAME">NAME</th>
                                <th class="sort" data-sort="PHONE">PHONE</th>
                                <th class="sort" data-sort="P.O BOX">Mail Type</th>
                                <th class="sort" data-sort="WEIGHT">SHELF</th>
                                <th class="sort" data-sort="action">TRACKING</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            @foreach ($inboxings as $key => $inboxing)
                            <tr>
                                <th scope="row">
                                  {{ $key + 1 }}
                                </th>
                                <td class="MAIL CODE"><a href="">{{ $inboxing->innumber }}</a></td>
                                <td class="TRACKING NUMBER">{{ $inboxing->intracking }}</td>
                                <td class="NAME">{{ $inboxing->inname }}</td>
                                <td class="PHONE">{{ $inboxing->phone }}</td>
                                <td class="P.O BOX">{{ $inboxing->mailtype }}</td>
                                <td class="P.O BOX">{{ $inboxing->akabati }}</td>
                                <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#trankingModel{{ $inboxing->id }}">VIEW</button>
                                <div id="trankingModel{{ $inboxing->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Mail Status</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="profile-timeline">
                                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                                        <div class="accordion-item border-0">
                                                            <div class="accordion-header" id="headingTwo">
                                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-success rounded-circle">
                                                                                <i class="mdi mdi-gift-outline"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h6 class="fs-15 mb-1 fw-semibold">Registered - <span class="fw-normal">
                                                                               @if ($inboxing->created_at == null)
                                                                                 <em>Not Yet</em>
                                                                               @else
                                                                               {{ optional(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inboxing->created_at))->format('D, d M Y') }}

                                                                               @endif
                                                                            </span></h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            @if ($inboxing->transdate != null)
                                                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                                    <h6 class="mb-1">Your Item has been Registered on</h6>
                                                                    <p class="text-muted mb-0">{{ optional(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inboxing->transdate))->format('D, d M Y') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="accordion-item border-0">
                                                            <div class="accordion-header" id="headingTwo">
                                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-success rounded-circle">
                                                                                <i class="mdi mdi-gift-outline"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h6 class="fs-15 mb-1 fw-semibold">Transfered - <span class="fw-normal">
                                                                               @if ($inboxing->transdate == null)
                                                                                 <em>Not Yet</em>
                                                                               @else
                                                                               {{ optional(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inboxing->transdate))->format('D, d M Y') }}

                                                                               @endif
                                                                            </span></h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            @if ($inboxing->transdate != null)
                                                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                                    <h6 class="mb-1">Your Item has been Transfered By Register On</h6>
                                                                    <p class="text-muted mb-0">{{ optional(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inboxing->transdate))->format('D, d M Y') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="accordion-item border-0">
                                                            <div class="accordion-header" id="headingTwo">
                                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-success rounded-circle">
                                                                                <i class="mdi mdi-gift-outline"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h6 class="fs-15 mb-1 fw-semibold">RSCN/Available/BRANCH - <span class="fw-normal">
                                                                               @if ($inboxing->rcndate == null)
                                                                                 <em>Not Yet</em>
                                                                               @else
                                                                               {{ optional(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inboxing->rcndate))->format('D, d M Y') }}

                                                                               @endif
                                                                            </span></h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            @if ($inboxing->rcndate != null)
                                                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                                    <h6 class="mb-1">Your Item has been Received by Branch on</h6>
                                                                    <p class="text-muted mb-0">{{ optional(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inboxing->rcndate))->format('D, d M Y') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="accordion-item border-0">
                                                            <div class="accordion-header" id="headingTwo">
                                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-success rounded-circle">
                                                                                <i class="mdi mdi-gift-outline"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h6 class="fs-15 mb-1 fw-semibold">Notified - <span class="fw-normal">
                                                                               @if ($inboxing->notdate == null)
                                                                                 <em>Not Yet</em>
                                                                               @else
                                                                               {{ optional(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inboxing->notdate))->format('D, d M Y') }}

                                                                               @endif
                                                                            </span></h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            @if ($inboxing->notdate != null)
                                                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                                    <h6 class="mb-1">Your Item has been Notfied by Branch on</h6>
                                                                    <p class="text-muted mb-0">{{ optional(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inboxing->notdate))->format('D, d M Y') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <div class="accordion-item border-0">
                                                        <div class="accordion-header" id="headingTwo">
                                                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0 avatar-xs">
                                                                        <div class="avatar-title bg-success rounded-circle">
                                                                            <i class="mdi mdi-gift-outline"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <h6 class="fs-15 mb-1 fw-semibold">Delivered - <span class="fw-normal">
                                                                           @if ($inboxing->delivdate == null)
                                                                             <em>Not Yet</em>
                                                                           @else
                                                                           {{ optional(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inboxing->delivdate))->format('D, d M Y') }}

                                                                           @endif
                                                                        </span></h6>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        @if ($inboxing->delivdate != null)
                                                        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                            <div class="accordion-body ms-2 ps-5 pt-0">
                                                                <h6 class="mb-1">Your Item has been Delivered by Branch On</h6>
                                                                <p class="text-muted mb-0">{{ optional(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inboxing->delivdate))->format('D, d M Y') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <!--end accordion-->
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                                </td><!-- /.modal -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </ul>
        @else
            <p>No results found.</p>
        @endif
    @endif

</div>
<!--end row-->


<!-- Modal -->

<!--end modal -->

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


<!--open editUser model js-->
<script>
    var office = document.querySelector('.office');
    var level = document.querySelector('.level');
    var driverDiv = document.querySelector('.driverDiv');
    level.addEventListener("change", function () {
        if (level.value == 'register') {
            office.disabled = false;
            office.required = true;
            driverDiv.style.display = 'none';
        } else if (level.value == 'driver') {
            office.disabled = true;
            office.required = false;
            driverDiv.style.display = 'block';
        } else {
            office.disabled = true;
            office.required = false;
            driverDiv.style.display = 'none';
        }
    });

</script>

<!--datatable js-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
