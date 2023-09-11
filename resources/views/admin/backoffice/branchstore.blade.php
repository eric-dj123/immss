@extends('layouts.admin.app')
@section('page-name')
Branch Store
@endsection
@php
    use App\Models\MailStock;

@endphp
@section('body')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Branch Store</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">IMMS</a>
                        </li>
                        <li class="breadcrumb-item active">store</li>
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
                                <h5 class="card-title mb-0">Branch Mail Store</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="manageBrandTable" class="table nowrap table-bordered align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th class="sort" data-sort="TRACKING NUMBER">DATE</th>
                                <th class="sort" data-sort="TRACKING NUMBER">INBOXING</th>
                                <th class="sort" data-sort="TRACKING NUMBER">OUTBOXING</th>
                                <th class="sort" data-sort="TRACKING NUMBER">TOTAL IN THE STOCK</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($reps as $key => $rep)
                                <tr>
                                    <td scope="row">
                                        {{ $key + 1 }}
                                    </td>

                                    <td class="email">{{ $rep->date }}</td>
                                    <td>

                                        @php

                                        $percel = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','in')
                                            ->where('mailtype','p')
                                            ->count();
                                        $ordinary = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','in')
                                            ->where('mailtype','o')
                                            ->count();
                                        $registered = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','in')
                                            ->where('mailtype','r')
                                            ->count();
                                        $googlead = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','in')
                                            ->where('mailtype','GAD')
                                            ->count();
                                    @endphp
                                    <b>
                                    <li>PM:{{ $percel }}</li>
                                    <li>OM:{{ $ordinary }}</li>
                                    <li>RM:{{ $registered }}</li>
                                    <li>GAD:{{ $googlead }}</li>
                                    </b>
                                    </td>
                                    <td>
                                        @php

                                        $percelout = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','out')
                                            ->where('mailtype','p')
                                            ->count();
                                        $ordinaryout = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','out')
                                            ->where('mailtype','o')
                                            ->count();
                                        $registeredout = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','out')
                                            ->where('mailtype','r')
                                            ->count();
                                        $googleadout = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','out')
                                            ->where('mailtype','GAD')
                                            ->count();
                                    @endphp
                                    <b>
                                    <li>PM:{{ $percelout }}</li>
                                    <li>OM:{{ $ordinaryout }}</li>
                                    <li>RM:{{ $registeredout }}</li>
                                    <li>GAD:{{ $googleadout }}</li>
                                    </b>
                                    </td>
                                    <td>
                                    @php
                                     $percel = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','in')
                                            ->where('mailtype','p')
                                            ->count();
                                    $ordinary = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','in')
                                            ->where('mailtype','o')
                                            ->count();
                                    $registered = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','in')
                                            ->where('mailtype','r')
                                            ->count();
                                    $googlead = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','in')
                                            ->where('mailtype','GAD')
                                            ->count();
                                  $percelout = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','out')
                                            ->where('mailtype','p')
                                            ->count();
                                 $ordinaryout = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','out')
                                            ->where('mailtype','o')
                                            ->count();
                                $registeredout = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','out')
                                            ->where('mailtype','r')
                                            ->count();
                                $googleadout = DB::table('mail_stocks')
                                            ->where('datereceive', $rep->date)
                                            ->where('mailin','out')
                                            ->where('mailtype','GAD')
                                            ->count();

                                    $perceltotal=$percel-$percelout;
                                    $ordinarytotal=$ordinary-$ordinaryout;
                                    $registeredtotal=$registered-$registeredout;
                                    $googleadtotal=$googlead-$googleadout;
                                    @endphp
                                    <b>
                                    <li>PM:{{ $perceltotal }}</li>
                                    <li>OM:{{ $ordinarytotal }}</li>
                                    <li>RM:{{ $registeredtotal }}</li>
                                    <li>GAD:{{ $googleadtotal }}</li>
                                    </b>
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
    @if ($errors->any())
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('showModal'), {
                keyboard: false
            })
            myModal.show()
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $(".phoneNumber").on("input", function() {
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



    <script type="text/javascript">
        $(".sellect").chosen({
            width: '100%'
        });
    </script>
    <script>
        $(document).ready(function() {

            // top bar active

            // manage brand table
            var rep_tbl = $("#manageBrandTable").DataTable({
                // 'processing': true,
                // 'serverSide': true,
                'order': [],


            });
        });
    </script>
@endsection
