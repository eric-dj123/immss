@extends('layouts.admin.app')
@section('page-name')Dispatch Sorting @endsection
@section('body')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">DISPATCH SORTING</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">IMMS</a>
                    </li>
                    <li class="breadcrumb-item active">Dispatch Sortings</li>
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
                            <h5 class="card-title mb-0">DISPATCH LIST</h5>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body">

                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>

                            </th>
                            <th scope="col">
                                #
                            </th>

                            <th class="sort" data-sort="name">
                                Dispatch Code
                            </th>

                            <th class="sort" data-sort="phone">Gross Weight</th>
                            <th class="sort" data-sort="branch">Dispatch Type</th>
                            <th class="sort" data-sort="date">Current Weight</th>
                            <th class="sort" data-sort="date">Date Received</th>
                            <th class="sort" data-sort="date">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inboxings as $key => $inboxing)
                        <tr>
                            <td scope="row">

                            </td>
                            <td scope="row">
                                {{ $key + 1 }}
                            </td>
                            <td class="name"><a
                                    href="">{{ $inboxing->dispatchNumber }}</a>
                            </td>
                            <td class="email">{{ $inboxing->grossweight }}</td>

                            <td class="phone">{{ $inboxing->dispachetype }}</td>
                            <td class="phone">{{ $inboxing->currentweight }}</td>
                            <td class="date"> {{ $inboxing->cntppickupdate }}</td>
                            <td>
                            @if($inboxing->status==2)

                            <a href="{{ route('admin.cntpsort.sortingpercelview', ['id' => encrypt($inboxing->id)]) }}" type="button"
                                class="btn btn-primary btn-sm"><span>Dispatch Sort</span></a>
                            @elseif ($inboxing->status==3)
                            <span class="badge bg-info">Dispatch Sort Completed</span>
                            @endif
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
    var checkAll = document.getElementById("checkAll");
    var checkboxes = document.querySelectorAll("tbody input[type=checkbox]");
    var deleteBtn = document.getElementById("deleteBtn");

    checkAll.addEventListener("change", function (e) {
      var t = e.target.checked;
      checkboxes.forEach(function (e) {
        e.checked = t;
      });
      toggleDeleteBtn();
    });

    checkboxes.forEach(function (e) {
      e.addEventListener("change", function (e) {
        checkAll.checked = Array.from(checkboxes).every(function (e) {
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
<!--datatable js-->



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
