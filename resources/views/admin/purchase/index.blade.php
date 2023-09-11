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
            <h4 class="mb-sm-0">Items</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">IMMS Mails</a>
                    </li>
                    <li class="breadcrumb-item active">Items</li>
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
                        <h4 class="card-title">Create New purchase</h4>
                    </div>
                    <div class="card-body">

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
                        <form method="POST" action="{{ route('admin.purchase.store') }}" id="po-form">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="supplier_id" class="control-label text-info">Supplier</label>
                                            <select name="supplier_id" id="supplier_id" class="custom-select select2">
                                            <option value="" disabled>Select Supplier</option>
                                            @foreach ($suppliers as $sup)
                                                <option {{ old('supplier_id') == $sup->id ? 'selected':'' }} value="{{ $sup->id }}">{{ $sup->suppliername }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <fieldset>
                                    <legend class="text-info">Please Select Item</legend>
                                    <div class="row justify-content-center align-items-end">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="item_id" class="control-label">Item</label>
                                                <select  id="item_id" class="custom-select ">
                                                    <option disabled selected></option>
                                                    @foreach ($items as $item)
                                                        @php

                                                            $item_arr[1][$item['item_id']] = $item;
                                                            $cost_arr[$item['item_id']] = $item['sellingprice'];
                                                        @endphp
                                                        <option value="{{ $item['item_id'] }}" price="{{ $item['purchasingprice'] }}">{{ $item['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="display: none;">
                                            <div class="form-group">
                                                <label for="prrice" class="control-label">Price</label>
                                                <input type="number" step="any" class="form-control rounded-0" id="prrice" placeholder="Price">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="display: none;">
                                            <div class="form-group">
                                                <label for="qty" class="control-label">Qty</label>
                                                <input type="number" step="any" class="form-control rounded-0 qttty" id="qty" placeholder="Quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-center" style="display: none;">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="add_to_list">Add to List</button>
                                            </div>
                                        </div>
                                </fieldset>
                                <hr>
                                <table class="table table-striped table-bordered" id="list">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="20%">
                                        <col width="35%">
                                        <col width="15%">
                                        <col width="25%">
                                    </colgroup>
                                    <thead>
                                        <tr class="text-light bg-primary text-white">
                                            <th class="text-center py-4 px-2"></th>
                                            <th class="text-center py-1 px-2">Qty</th>
                                            <th class="text-center py-1 px-2">Item</th>
                                            <th class="text-center py-1 px-2">Cost</th>
                                            <th class="text-center py-1 px-2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                        <a class="btn btn-flat btn-dark" href="">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
<table id="clone_list" class="d-none">
    <tr>
        <td class="py-1 px-2 text-center">
            <button class="btn btn-outline-danger btn-sm rem_row" type="button" onclick="rem($(this));">
                x
            </button>
        </td>
        <td class="py-1 px-2 text-center qtyu">
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-outline-secondary quantity-minus-btn">-</button>
                  </div>
                  <input type="number" class="form-control quantity-input"  name="qty[]" oninput="calc();">
                  <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary quantity-plus-btn">+</button>
                  </div>
                </div>
            </div>
            <input type="hidden" name="item_id[]" class="form-control">
            <span class="visible"></span>
            <input type="hidden" readonly name="total[]" class="form-control">
        </td>
        <td class="py-1 px-2 item">
        </td>
        <td class="py-1 px-2 text-right costu">
            <input type="text" name="price[]" class="form-control" oninput="calc();">
        </td>
        <td class="py-1 px-2 text-right total">
        </td>
    </tr>
</table>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>

<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script>
    $(document).ready(function() {
      // Plus button click event
      $(document).on("click", ".quantity-plus-btn", function() {
        var inputField = $(this).closest(".input-group").find(".quantity-input");
        var value = parseInt(inputField.val());
        inputField.val(value + 1);
        calc();
      });

      // Minus button click event
      $(document).on("click", ".quantity-minus-btn", function() {
        var inputField = $(this).closest(".input-group").find(".quantity-input");
        var value = parseInt(inputField.val());
        if (value > 0) {
          inputField.val(value - 1);
          calc();
        }
      });

          // Quantity input change event
    $(document).on("change", ".quantity-input", function() {
      var inputField = $(this);
      var value = parseInt(inputField.val());
      if (isNaN(value) || value < 1) {
        inputField.val(1);
      }
    });
    });
  </script>
<script>
    var items = $.parseJSON('{!! json_encode($item_arr) !!}')
    var costs = $.parseJSON('{!! json_encode($cost_arr) !!}')

    $(function(){
        $('.select2').select2({
            placeholder:"Please select here",
            width:'resolve',
        })
        var $select = $('#item_id');
        var allOptions = Array.from($select[0].options).map(function(option) {
            return { value: option.value, text: option.text, price: option.getAttribute('price') };
        });

        $select.selectize({
            plugins: ['remove_button'],
            hideSelected: true,
            closeAfterSelect: true,
            dropdownParent: "body",
            render: {
                item: function(item, escape) {
                    return '<div class="item">' + escape(item.text) + '</div>';
                },
                option: function(item, escape) {
                    return '<div class="option">' + item.text +'</div>';
                }
            },
            onInitialize: function() {
                this.$control_input.attr('autocomplete', 'on');
                this.clearOptions();
                this.onSearchChange('');
            },
            onDropdownOpen: function() {
                if (this.$control_input.val().trim() !== '') {
                    this.$control_input.focus();
                } else {
                    this.clearOptions();
                }
            },
            onDelete: function(values) {
                // Handle delete event
                this.clearOptions();
                this.onSearchChange('');
                this.close();
            },
            dropdownDirection: 'down',
            placeholder: 'Search For Item...',
            allowEmptyOption: false,
            loadThrottle: 300,
            valueField: 'value',
            labelField: 'text',
            searchField: ['text'],
            create: false,
            onType: function(str) {
                if (str.trim() === '') {
                    this.clearOptions();
                    this.close();
                } else {
                    var filteredOptions = allOptions.filter(function(option) {
                        return option.text.toLowerCase().includes(str.toLowerCase());
                    });

                    this.clearOptions();
                    this.load(function(callback) {
                        callback(filteredOptions);
                    });
                    this.open();
                }
            }
        });

        $('#item_id').change(function(){
            var selectize = $select[0].selectize;
            var selectedItem = selectize.getValue();
            // alert(selectedItem);
            if (selectedItem > 0) {
                var selectedOption = selectize.options[selectedItem];
            var price = selectedOption.price;
            // alert(price);
            $('#prrice').val(0);
                var b = $('#item_id');
                var get_op = b.find('option:selected');
                var sel_op = get_op.attr('price');
                // alert(sel_op);
                $("#prrice").val(price);
                $(".qttty").val(1);
                $("#add_to_list").click();
                selectize.clear();
            }


        })

        $('#add_to_list').click(function(){
            var supplier = $('#supplier_id').val()
            var item = $('#item_id').val()
            if (item > 0) {
            var qty = $('#qty').val() > 0 ? $('#qty').val() : 0;
            // var price = costs[item] || 0
            var price = $("#prrice").val() || 0
            var total = parseFloat(qty) *parseFloat(price)
            // console.log(supplier,item)
            console.log(item);
            var item_name = items[1][item]['name'] || 'N/A';
            var item_description = items[1][item]['description'] || 'N/A';
            var tr = $('#clone_list tr').clone()
            if(item == '' || qty == '' ){
                alert('Form Item textfields are required.','warning');
                return false;
            }
            if($('table#list tbody').find('tr[data-id="'+item+'"]').length > 0){
                alert('Item is already exists on the list.','error');
                return false;
            }
            tr.find('[name="item_id[]"]').val(item)
            tr.find('[name="qty[]"]').val(qty)
            tr.find('[name="price[]"]').val(price)
            tr.find('[name="total[]"]').val(total)
            tr.attr('data-id',item)
            tr.find('.qty .visible').text(qty)
            tr.find('.item').html(item_name)
            tr.find('.cost').text(parseFloat(price).toLocaleString('en-US'))
            tr.find('.total').text(parseFloat(total).toLocaleString('en-US'))
            $('table#list tbody').append(tr)
            calc()
            $('#item_id').val('').trigger('change')
            $('#qty').val('')
            tr.find('.rem_row').click(function(){
                rem($(this))
            })

            $('[name="discount_perc"],[name="tax_perc"]').on('input',function(){
                calc();
            })
            $('#supplier_id').attr('readonly','readonly');
            }
        });

    /*  $('#po-form').submit(function(e){
      e.preventDefault();
            var _this = $(this)
      $.ajax({
        url: "php_action/updatepurchase.php",
        data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
        error:err=>{
          console.log(err)
          alert("Data Processed Successfully");
          window.location.href = "purchaselist.php";
        },
        success:function(resp){
          console.log(resp);
          alert("Data Processed Successfully");
          window.location.href = "purchaselist.php";
        }
      })
    })*/

        if('<?php echo isset($id) && $id > 0 ?>' == 1){
            calc()
            $('#supplier_id').trigger('change')
            $('#supplier_id').attr('readonly','readonly')
            $('table#list tbody tr .rem_row').click(function(){
                rem($(this))
            })
        }
    })
    function rem(_this){
        _this.closest('tr').remove()
        calc()
        if($('table#list tbody tr').length <= 0)
            $('#supplier_id').removeAttr('readonly')

    }
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
