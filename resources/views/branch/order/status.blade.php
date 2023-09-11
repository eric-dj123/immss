@extends('layouts.admin.app')
@section('page-name')Branch Stock Status @endsection
@section('body')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Branch Stock Status</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">IMMS Mail</a>
                    </li>
                    <li class="breadcrumb-item active">Branch Stock Status</li>
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
                            <h5 class="card-title mb-0">Branch Stock Status List</h5>
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
                <table id="manageBrandTable" class="table nowrap table-bordered align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th class="sort" data-sort="name">Name</th>
                            <th class="sort" data-sort="qty">Quantity Remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                        <tr>
                            <td scope="row">
                                {{ $key + 1 }}
                            </td>
                            <td class="name">{{ $item["name"] }}</td>
                            <td class="qty">{{ $item["qty"] }}</td>
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

{{-- <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {

        // manage brand table
        manageBrandTable = $("#manageBrandTable").DataTable({
            'order': [],
            'dom': 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                customize: function(win) {
                    $(win.document.body).find('table').addClass('print-table');
                    $(win.document.body).find('table tr td:last-child').remove();
                    $(win.document.body).find('table tr th:last-child').remove();
                }
            },
            {
                extend: 'csv',
                customize: function(csv) {
                    // remove last column from CSV output
                    return csv.replace(/,[^\n]*\n/g, '\n');
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }
        ]
        });
    });
    function p_master(p_id) {
        var price = $('#price_'+p_id).val();
        var qty = $('#qty_'+p_id).val();
        var total = $('#total_'+p_id).html();
        var pd_change = $('#pd_change_'+p_id).val();
        $('#total_'+p_id).html(parseFloat(qty)*parseFloat(price));
        $('#pd_change_'+p_id).val('yes');
    }
    $(".sellect").chosen({ no_results_text: 'Oops, nothing found!',width:   '100%' });

    function parse_receiver(selected="") {
        var in_nm = selected+"_row";
        $('.check_row').hide();
        $('#'+in_nm).show();
    }
    $(".cv").on('input', function() { upd(); });
    function upd (){

        $('#my-table tbody tr').each(function() {
            var in2 = $(this).find('.p_name');
            var prod_in = in2.find('option:selected');
            var price_pro = prod_in.attr('data-price');
            // alert(price_pro);

            var prod_out = in2.find('option:selected');
            var rem_qty = prod_out.attr('data-remaining');
            $(this).find('.rem_balance').attr('readonly',false);
            $(this).find('.rem_balance').val(rem_qty);
            $(this).find('.rem_balance').attr('readonly',true);

            $(this).find('.p_price').attr('readonly',false);
            $(this).find('.p_price').val(price_pro);
            $(this).find('.p_price').attr('readonly',true);

            var input1 = $(this).find('.p_price');
            var input2 = $(this).find('.p_qty');

            input2.attr("maxlength",rem_qty);

            if (parseFloat(input2.val()) > parseFloat(input2.attr("maxlength"))) {
                input2.val(0);
            }
            var total = $(this).find('.total_save');

            input1.add(input2).on('input', function() {
                var sum = parseFloat(input1.val()) * parseFloat(input2.val());

                total.val(sum);
            });
        });
        // Add event listener to "Add Row" button
    }

    $("#add-row").click(function() {


    var lastSelect = $("#my-table tbody tr:last").find(".sellect:last");
    if (lastSelect.val() == "") {
      alert("Please fill out the last input before adding a new row.");
      return;
    }
        // Clone the first table row
        const newRow = $("#my-table2 tbody tr:first").clone();
        // Reset input values in the cloned row
        newRow.find("input").val("");
          newRow.find("select").val("");
        newRow.find("select").addClass("sellect")
         // Initialize Chosen select boxes in the new row
        newRow.find(".sellect").chosen({ no_results_text: 'Oops, nothing found!',width:   '100%' });


        // Append the new row to the table body
        $("#my-table tbody").append(newRow);




  // Get all selected values from previous rows
  var selectedValues = [];
  $(".sellect").not($(this).closest('#my-table tbody tr').find('.sellect')).each(function() {
    $(this).find("option:selected").each(function() {
      selectedValues.push($(this).val());
    });
  });

  // Remove all options from the dropdown menu that have already been selected in other select boxes
  $(".sellect:last").on("chosen:showing_dropdown", function() {
    $(this).find("option").each(function() {
      if (selectedValues.includes($(this).val())) {
        $(this).remove();
      }
    });
    $(this).trigger("chosen:updated");
  });

  // Remove all selected options from the cloned select box
  $(".sellect:last").val('').trigger('chosen:updated');

  // Reinitialize the Chosen select boxes on the new row
  $(".sellect").chosen({ no_results_text: 'Oops, nothing found!',width:   '100%' });


  // When a Chosen select option is changed
  $('.sellect').on('change', function() {
    var selectedValue = $(this).val();
    // Loop through all other select elements
    $('.sellect').not(this).each(function() {
      // Remove the selected option from their list of options
      $(this).find('option[value="' + selectedValue + '"]').remove();
      // Update Chosen to reflect the change in options
      $(this).trigger('chosen:updated');
    });
  });

    });


    // Add event listener to "Remove" button
    $(document).on("click", ".remove-row", function() {
        $(this).closest("tr").remove(); // Remove the row containing the clicked button
    });
</script>
@endsection
