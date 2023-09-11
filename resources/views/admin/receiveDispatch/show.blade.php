@extends('layouts.admin.app')
@section('page-name')Recieved Dispatch  @endsection
@section('body')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dispatches Recieved</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">IMMS </a>
                    </li>
                    <li class="breadcrumb-item active">Dispatches Recieved</li>
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

                                <th scope="col" style="width: 40px">
                                    #
                                </th>
                                <th class="sort" style="width: 180px" data-sort="reference">
                                    Ref Number</th>

                                <th class="sort" style="width: 160px" data-sort="date">
                                    Weight</th>

                                <th class="sort" style="width: 200px" data-sort="rece">
                                    Receive </th>



                                <th class="sort" style="width: 200px" data-sort="rece">
                                    Destination </th>,

                                    {{-- status --}}
                                <th class="sort" style="width: 200px" data-sort="Status">
                                    Status </th>

                                <th></th>

                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            @foreach ($dispatchDetails as $myMail)

                            <tr>
                                <td>
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </td>
                                <td>{{ $myMail->details->refNumber }}</td>
                                </td>
                                <td>
                                   {{ $myMail->details->weight }}
                                </td>
                                <td>
                                   {{ $myMail->details->destination->name }}
                                </td>
                                <td>
                                   {{ $myMail->details->destination->address }}
                                </td>
                                <td>
                                    @if ($myMail->details->status == 4)
                                        <span class="badge badge-pill bg-warning font-size-12">Pending</span>
                                    @elseif($myMail->details->status == 5)
                                        <span class="badge badge-pill bg-success font-size-12">Delivered</span>
                                    @endif



                                <td>
                                    {{-- received --}}
                                    <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#sendDispatch{{ $myMail->id }}">Received</a>
                                    <div class="modal fade" id="sendDispatch{{ $myMail->id }}" aria-hidden="true" aria-labelledby="..." tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                               <form action="{{ route('receiveDispatch.recieved',$myMail->id) }}" method="post">
                                                @csrf
                                                 @method('PUT')
                                                    <div class="modal-body text-center p-5">
                                                        <lord-icon
                                                            src="https://cdn.lordicon.com/tdrtiskw.json"
                                                            trigger="loop"
                                                            colors="primary:#f7b84b,secondary:#405189"
                                                            style="width:130px;height:130px">
                                                        </lord-icon>
                                                        <div class="pt-4">
                                                            <h4>confirm Recieved</h4>
                                                            <p class="text-muted">Are you sure you want to confirm this dispatch?</p>
                                                            <!-- Toogle to second dialog -->
                                                            <button class="btn btn-warning">
                                                                <i class="mdi mdi-send"></i> Confirm
                                                            </button>
                                                        </div>
                                                    </div>
                                               </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end received --}}
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
