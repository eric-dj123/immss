@extends('layouts.admin.app')
@section('page-name') EMS National @endsection
@section('body')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"> EMS National </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">IMMS </a>
                    </li>
                    <li class="breadcrumb-item active">EMS National</li>
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
                            <h5 class="card-title mb-0">EMS National List</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 60px">
                                #
                            </th>
                            <th class="sort" style="width: 160px" data-sort="names">
                                DISPATCH NUMBER</th>

                            <th class="sort" data-sort="date">
                                DATE </th>

                            <th class="sort" style="width: 90px" data-sort="names">
                                MAILS N<sup>0</sup></th>

                            <th class="sort" data-sort="sender">
                                SENDER</th>

                            <th class="sort" data-sort="amount">
                                SENDER PHONE</th>

                            <th class="sort" data-sort="status">
                                SENDER EMAIL </th>

                            <th class="sort" data-sort="status">
                               CODE
                            </th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($myMails as $myMail)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $myMail->dispatchNumber }}

                            </td>
                            <td>{{ \Carbon\Carbon::parse($myMail->created_at)->locale('fr')->format('F j, Y') }}
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm apikey-value" readonly
                                    value="{{ $myMail->mailsNumber }}">
                            </td>

                            <td>
                                {{ $myMail->senderName }}
                            </td>

                            <td>
                                {{ $myMail->senderPhone }}
                            </td>

                            <td>
                                {{ \App\Models\Box::where('pob',$myMail->senderPOBox)->first()->email }}
                            </td>
                            <td>
                                <span class="badge badge-soft-danger py-1"> {{ $myMail->securityCode }}

                                </span>
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
        $(".numbers").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9.]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
    });

</script>
@endsection