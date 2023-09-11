@extends('layouts.admin.app')
@section('page-name')Purchase Form @endsection
@section('body')
<style>
    select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
        background: #eee;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }
</style>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Purchase</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">IMMS P.O B</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Purchase</li>
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
                            <h5 class="card-title mb-0">Purchase List</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="card card-outline">
                    <div class="card-header">
                        <h4 class="card-title">Edit purchase</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label text-info">P.O. Code</label>
                                <div>{{ $purchase_1->code }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplier_id" class="control-label text-info">Supplier</label>
                                    <div>{{ $supplier->suppliername }}</div>
                                </div>
                            </div>
                        </div>
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
                        <form method="POST" action="{{ route('admin.purchase.update', $purchase_1->code) }}" id="po-form">
                            @csrf
                            @method('PUT')
                                <table class="table table-striped table-bordered" id="list">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="10%">
                                        <col width="35%">
                                        <col width="25%">
                                        <col width="25%">
                                    </colgroup>
                                    <thead>
                                        <tr class="text-light bg-primary text-white">
                                            <th class="text-center py-1 px-2"></th>
                                            <th class="text-center py-1 px-2">Qty</th>
                                            <th class="text-center py-1 px-2">Item</th>
                                            <th class="text-center py-1 px-2">Cost</th>
                                            <th class="text-center py-1 px-2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($purchases as $key => $purchase)
                                        <tr>
                                            <td class="py-1 px-2 text-center">
                                                #
                                              </td>
                                            <td class="py-1 px-2 text-center qtyu">
                                                <input type="hidden" name="purcha_id[]" value="{{ $purchase->purcha_id }}">
                                                <input type="number" name="qty[]" class="form-control" oninput="calc();" value="{{ $purchase->quantity }}">
                                                <input type="hidden" name="item_id[]" class="form-control" value="{{ $purchase->item_id }}">
                                                <span class="visible"></span>
                                                <input type="hidden" readonly name="total[]" class="form-control" value="{{ $purchase->total }}">
                                            </td>
                                            <td class="py-1 px-2 item">
                                                @php
                                                //  get item name bt items model
                                                $item = App\Models\Item::find($purchase->item_id)->first();
                                                @endphp
                                              {{ $item->name }} <br>
                                            </td>
                                            <td class="py-1 px-2 text-right costu">
                                                <input type="text" name="price[]" class="form-control" oninput="calc();" value="{{ $purchase->total/$purchase->quantity }}">
                                            </td>
                                            <td class="py-1 px-2 text-right total">
                                              {{ $purchase->total }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-right py-1 px-2" colspan="4">Grand Total</th>
                                            <th class="text-right py-1 px-2 sub-total">0</th>
                                        </tr>
                
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-1 text-center">
                        <button class="btn btn-flat btn-primary" type="submit" form="po-form">Save</button>
                        <a class="btn btn-flat btn-dark" href="{{ route('admin.purchase.list') }}">Cancel</a>
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

<!--datatable js-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

<script>
    $(document).ready(function () {
        calc();
    });
    function calc(){
        var sub_total = 0;
        var grand_total = 0;
        var discount = 0;
        var tax = 0;
        $('table#list tbody tr').each(function(){
            // sub_total += parseFloat($(this).val())
            $(this).find('.total').html((parseFloat($(this).find('input[name="qty[]"]').val())*parseFloat($(this).find('input[name="price[]"]').val())));
            $(this).find('input[name="total[]"]').val((parseFloat($(this).find('input[name="price[]"]').val())*parseFloat($(this).find('input[name="qty[]"]').val())));
        })
        $('table#list tbody input[name="total[]"]').each(function(){
            sub_total += parseFloat($(this).val())

        })
        $('table#list tfoot .sub-total').text(parseFloat(sub_total))


    }
</script>
@endsection
