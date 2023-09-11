@extends('layouts.admin.app')
@section('page-name')Dispatches  @endsection
@section('body')
@php
    use App\Models\Box;
@endphp

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dispatches Sent</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">IMMS </a>
                    </li>
                    <li class="breadcrumb-item active">Dispatches Sent</li>
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
                            <h5 class="card-title mb-0">List </h5>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card mb-1">
                    <table class="table align-middle" id="customerTable">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width: 60px">
                                    #
                                </th>
                                <th class="sort" data-sort="date">
                                    DATE </th>

                                <th class="sort" style="width: 140px" data-sort="names">
                                    MAILS NUMBER</th>

                                <th class="sort" style="width: 90px" data-sort="weight">
                                    WEIGHT</th>

                                <th class="sort" data-sort="branch">
                                    BRANCH</th>
                                <th class="sort" data-sort="status">
                                    STATUS</th>

                                <th class="sort" data-sort="received">RECEIVED BY</th>


                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            @foreach ($dispatches as $dispatch)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($dispatch->created_at)->locale('fr')->format('F j, Y') }}
                                </td>
                                <td>
                                    <span class="badge bg-soft-success text-success">
                                        {{ $dispatch->mailsNumber }}
                                    </span>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm apikey-value" readonly
                                        value="{{ $dispatch->weight }}">
                                </td>

                                <td>
                                    {{ $dispatch->branchName->name }}
                                </td>

                                <td>
                                   {{-- status --}}
                                    @if($dispatch->status == 0)
                                    <span class="badge bg-soft-warning text-warning">
                                        Pending
                                    </span>
                                    @elseif($dispatch->status == 1)
                                    <span class="badge bg-soft-success text-success">
                                        Dispatch Sent
                                    </span>
                                    @elseif($dispatch->status == 2)
                                    <span class="badge bg-soft-primary text-danger">
                                        Dispatch Received
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if($dispatch->receivedBy != NULL)
                                    {{ $dispatch->user->name }}
                                    @else
                                    {{-- italic branch Manager received --}}
                                    <i>Not Yet Received</i>
                                    @endif
                                </td>


                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->



@endsection
@section('css')

@endsection

@section('script')
@endsection
